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
            'firstname' => 'required',
            'lastname' => 'required',
            'location' => 'required',
            'contact_number' => 'required',
            'qualification' => 'required',
            'image'=>'required',
            'cv'=>'required',
            'college'=>'required',
            'about'=>'required',
            'description'=>'required',
            'experience'=>'required',
        ];
    }
}
