<?php

namespace App\Listeners;

use App\Models\Customer;
use App\Models\CustomerWaiting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddCustomerToWaitingList
{
    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $customer = Customer::query()
                            ->firstOrCreate(
                                ['phone' => $event->customerData['phone']],
                                ['name' => $event->customerData['name']]
                            );
        CustomerWaiting::create([
                                    'customer_id' => $customer->id,
                                    'table_id'    => $event->table->id,
                                    'from'        => $event->from,
                                    'to'          => $event->to
                                ]);
    }
}
