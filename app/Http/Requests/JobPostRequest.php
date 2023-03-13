<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostRequest extends FormRequest
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
            'title'=>'max:50',
            'location' => 'regex:/^[a-zA-Z0-9\-, ]+$/',
            'deadline'=>'after_or_equal:now',
            'skill'=>'min:3',
            'type_id'=>'required',
            'qualification'=>'max:100',
            'experience'=>'max:200',
            'vacancy'=>'required',
            'description'=>'max:200',
            'responsibility'=>'max:200',
            'benefit'=>'max:200',
        ];
    }
}
