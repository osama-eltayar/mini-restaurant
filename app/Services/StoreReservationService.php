<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Arr;

class StoreReservationService
{
    public function execute($data)
    {
        return $this->createReservation(Arr::get($data, 'reservation'),
                                        $this->getCustomer(Arr::get($data, 'customer')));
    }

    private function createReservation(array $reservationData, Customer $customer)
    {
        return $customer->reservations()->create($reservationData);
    }

    private function getCustomer(array $customerData)
    {
        return Customer::query()->firstOrCreate(Arr::only($customerData, 'phone'), Arr::only($customerData, 'name'));
    }
}
