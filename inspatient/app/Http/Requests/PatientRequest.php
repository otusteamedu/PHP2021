<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'patient.name' => ['required'],
            'patient.birthday' => ['required'],
            'patient.phone' => [],
            'patient.email' => [],
            'patient.address' => [],
            'patient.work' => [],
            'patient.filial_id' => [],
            'patient.aboutAdding' => [],
            'patient.aboutRemove' => [],
            'patient.description' => [],
        ];
    }
}
