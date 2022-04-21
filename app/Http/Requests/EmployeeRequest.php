<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'first_name' => ['required', 'min:2', 'max:190', 'alpha'],
            'last_name' => ['required', 'min:2', 'max:190', 'alpha'],
            'company_id' => ['nullable', 'exists:companies,id', 'numeric'],
            'email' => ['nullable', 'email', 'max:190', 'string', 'unique:users,email'],
            'phone' => ['nullable', 'numeric', 'digits:10'],
        ];
    }
}
