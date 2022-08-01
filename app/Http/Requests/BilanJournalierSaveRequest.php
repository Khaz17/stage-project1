<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BilanJournalierSaveRequest extends FormRequest
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
            'kilometrage' => 'required|numeric',
            'qte_essence_consommee' => 'required|numeric',
            'recette_journaliere' => 'required|integer',
            'date_bilan' => 'required|date|before_or_equal:today',
            'vehicule' => 'required|not_in:0',
        ];
    }

    public function messages(){
        return [
            'kilometrage.required' => 'Le kilométrage doit obligatoirement être saisi',
            'kilometrage.numeric' => 'Le kilométrage saisi doit être un nombre',
            'qte_essence_consommee.required' => "La quantité d'essence consommée doit être obligatoirement saisie",
            'qte_essence_consommee.numeric' => 'La valeur saisie doit être un nombre',
            'recette_journaliere.required' => "La recette de la journée doit obligatoirement être saisie",
            'recette_journaliere.integer' => "La valeur saisie doit être un entier",
            'date_bilan.required' => "La date du bilan est obligatoire",
            'date_bilan.date' => '?',
            'date_bilan.before_or_equal' => '?',
            'vehicule.required' => 'Le véhicule est obligatoire',
            'vehicule.not_in' => 'Le véhicule est obligatoire',
        ];
    }
}
