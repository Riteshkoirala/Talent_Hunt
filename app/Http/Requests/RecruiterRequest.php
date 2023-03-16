<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruiterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => 'min:5 | max:50',
           'contact_number' => 'regex:/^[0-9\+]+$/',
           'location' => 'regex:/^[a-zA-Z0-9-]+\s*,\s*[a-zA-Z0-9-]+$/i',
            'image' => 'max:60000',
            'detail' => 'max:200',
        ];
    }

    public function messages(): array
    {
        return [
            'location' => 'location format:- (city, state) or (city-code, state-code)',
        ];
    }


}
