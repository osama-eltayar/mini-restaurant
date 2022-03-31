<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
            'reservation_id' => ['required', 'exists:reservations,id'],
            'waiter_id'      => ['required', 'exists:waiters,id'],
            'meals'          => ['required', 'array'],
            'meals.*'        => ['required',
                                 Rule::exists('meals', 'id')
                                     ->where(function ($query) {
                                         return $query->where('quantity_available', '>', 0);
                                     })
            ],
        ];
    }
}
