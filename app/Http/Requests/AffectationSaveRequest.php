<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AffectationSaveRequest extends FormRequest
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
            'date_realisation' => 'required|date|before_or_equal:today',
            'vehicule' => 'required|not_in:0',
            'conducteur' => 'required|not_in:0',
        ];
    }

    public function messages(){
        return [
            'date_realisation.required' => "Il faut préciser la date et l'heure de l'affectation",
            'vehicule.required' => "Le véhicule concerné est obligatoire",
            'vehicule.not_in' => "Le véhicule concerné est obligatoire",
            'conducteur.required' => "Le conducteur est obligatoire",
            'conducteur.not_in' => "Le conducteur est obligatoire",
        ];
    }
}
