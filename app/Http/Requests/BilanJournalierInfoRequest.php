<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BilanJournalierInfoRequest extends FormRequest
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
            'date_bilan' => 'required|date|before_or_equal:today',
            'vehicule' => 'required|not_in:0',
        ];
    }

    public function messages()
    {
        return [
            'date_bilan.required' => "La date du bilan est obligatoire",
            'date_bilan.date' => '?',
            'date_bilan.before_or_equal' => '?',
            'vehicule.required' => 'Le véhicule est obligatoire',
            'vehicule.not_in' => 'Le véhicule est obligatoire',
        ];
    }
}
