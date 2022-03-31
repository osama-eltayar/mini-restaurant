<?php

namespace App\Services;

use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class GetAvailableTableService
{
    public function execute(array $data)
    {
        $from = Carbon::create(Arr::get($data, 'from'));
        $to   = Carbon::create(Arr::get($data, 'to'));

        if (!$from->isSameDay($to))
            return collect();

        return $this->getTables($from, $to, Arr::get($data, 'capacity'));
    }

    private function getTables($from, $to, $capacity)
    {
        return Table::query()
                    ->capacity($capacity)
                    ->whereDoesntHave('reservations', function ($query) use ($from, $to) {
                        $query->overlap($from, $to);
                    })
                    ->get();
    }
}
