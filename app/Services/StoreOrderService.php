<?php

namespace App\Services;

use App\Models\Meal;
use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class StoreOrderService
{

    private $orderDetails;

    private $reservation;

    private $totalPrice;

    public function execute($data)
    {
        return DB::transaction(function () use ($data) {
            $this->setReservation($data['reservation_id']);
            $this->setOrderDetails($data['meals']);
            $this->setTotalPrice();
            $order = $this->createOrder($data['waiter_id']);
            $this->attachDetails($order);
            return $order->load('details', 'waiter', 'customer', 'table', 'reservation');
        });

    }

    private function setOrderDetails(array $mealsIds)
    {
        $mealsQuery = Meal::query()
                          ->whereIn('id', $mealsIds)
                          ->select('id')
                          ->selectRaw('price - discount as amount_to_pay');

        $this->orderDetails = $mealsQuery->get()->mapWithKeys(function ($meal) {
            return [$meal->id => ['amount_to_pay' => $meal->amount_to_pay]];
        });

        $this->decreaseMealsQuanity($mealsQuery);
    }

    private function setReservation($reservationId)
    {
        $this->reservation = Reservation::find($reservationId);
    }

    private function setTotalPrice()
    {
        $this->totalPrice = $this->orderDetails->sum('amount_to_pay') ;
    }

    private function createOrder($waiterId)
    {
        return Order::create([
                                 'table_id'       => $this->reservation->table_id,
                                 'reservation_id' => $this->reservation->id,
                                 'customer_id'    => $this->reservation->customer_id,
                                 'waiter_id'      => $waiterId,
                                 'total_paid'     => $this->totalPrice,
                             ]);
    }

    private function attachDetails(Order $order)
    {
        $order->details()->attach($this->orderDetails);
    }

    private function decreaseMealsQuanity($mealsQuery)
    {
        $mealsQuery->update(['quantity_available' => DB::raw('quantity_available - 1 ')]);
    }
}
