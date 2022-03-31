<?php

namespace App\Http\Requests;

use App\Rules\CheckAvailableTable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class AvailableTableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from'     => ['required', 'date', 'after_or_equal:now'],
            'to'       => ['required', 'date', 'after:from'],
            'capacity' => ['required', 'integer','between:1,8']
        ];
    }
}
