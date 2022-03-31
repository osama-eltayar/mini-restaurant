<?php

namespace App\Rules;

use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckAvailableTable implements Rule
{
    private $from;
    private $to;
    private $capacity;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($from,$to,$capacity)
    {
        $this->from = $from;
        $this->to = $to;
        $this->capacity = $capacity;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->isAvailableTable($this->getTable($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry the table is not available .';
    }

    private function getTable($value)
    {
        return Table::query()->findOrFail($value);
    }

    private function isAvailableTable(Table $table)
    {
        $from = Carbon::create($this->from);
        $to   = Carbon::create($this->to);

        if (! $from->isSameDay($to))
            return false ;


        return ($table->capacity > $this->capacity) && !$table->reservations()
                                                              ->overlap($from, $to)
                                                              ->exists();
    }
}
