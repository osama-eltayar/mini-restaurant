<?php

namespace App\Http\Requests;

use App\Rules\CheckAvailableTable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'capacity'             => ['required', 'integer', 'between:1,8'],
            'reservation.from'     => ['required', 'date', 'after_or_equal:now'],
            'reservation.to'       => ['required', 'date', 'after:from'],
            'reservation.table_id' => ['required',
                                       'exists:tables,id',
                                       new CheckAvailableTable(Arr::get($this->get('reservation'), 'from'),
                                                               Arr::get($this->get('reservation'), 'to'),
                                                               $this->get('capacity'))
            ],
            'customer.name'        => ['required', 'string', 'between:5,50'],
            'customer.phone'       => ['required', 'string', 'between:10,14']
        ];
    }
}
