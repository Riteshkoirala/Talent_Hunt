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
            'title'=>'required',
            'location'=>'required',
            'deadline'=>'required',
            'skill'=>'required',
            'type'=>'required',
            'qualification'=>'required',
            'experience'=>'required',
            'vacancy'=>'required',
            'description'=>'required',
            'responsibility'=>'required',
            'benefit'=>'required',
        ];
    }
}
