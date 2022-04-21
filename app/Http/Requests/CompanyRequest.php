<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        $company = $this->company->id ?? '';

        return [
            'name' => ['required', 'min:5', 'max:190', "unique:companies,name,{$company}"],
            'email' => ['nullable', 'email', 'max:190', "unique:companies,email,{$company}"],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'dimensions:min_width=100,min_height=100'],
            'website' => ['nullable', 'url', 'max:190'],
        ];
    }
}
