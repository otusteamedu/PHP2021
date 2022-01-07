<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PolisRequest extends FormRequest
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
            'polis.patient_id' => ['required'],
            'polis.insurance_id' => ['required'],
            'polis.number' => ['required'],
            'polis.startDate' => [],
            'polis.endDate' => [],
            'polis.avans' => [],
            'polis.program_id' => [],
            'polis.description' => []
        ];
    }
}
