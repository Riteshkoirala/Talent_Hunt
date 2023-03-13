<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeekerRequest extends FormRequest
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
            'firstname' => 'max:40',
            'lastname' => 'max:40',
            'location' => 'regex:/^[a-zA-Z0-9\-, ]+$/',
            'contact_number' => 'regex:/^[0-9\+]+$/',
            'skill' => 'min:3',
            'qualification' => 'max:200',
            'image'=>'max:60000',
            'cv'=>'max:60000',
            'college'=>'max:100',
            'about'=>'max:200',
            'description'=>'max:200',
            'experience'=>'max:200',
        ];
    }
}
