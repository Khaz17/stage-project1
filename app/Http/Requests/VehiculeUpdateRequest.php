<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculeUpdateRequest extends FormRequest
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
            'numero_chassis' => 'required|unique:vehicules,numero_chassis,'.$this->vid,
            'immatriculation' => 'required|unique:vehicules,immatriculation,'.$this->vid,
            'nbre_places' => 'required|numeric',
            'prix_acquisition' => 'required|integer',
            'date_acquisition' => 'required|date',
            'consommation_de_base' => 'required|numeric',
            'recette_hebdo_attendue' => 'required|integer',
            'usage' => 'required|not_in:0',
            'modele' => 'required|not_in:0',
            'type_moteur' => 'required|not_in:0',
        ];
    }

    public function messages()
    {
        return [
            'numero_chassis.required' => 'Le numéro de châssis est obligatoire',
            'numero_chassis.unique' => 'Le numéro de châssis est unique',
            'immatriculation.required' => "Le numéro d'immatriculation est obligatoire",
            'immatriculation.unique' => "Le numéro d'immatriculation est unique",
            'nbre_places.required' => "Doit être renseigné",
            'prix_acquisition.required' => "Le prix d'acquisition est obligatoire",
            'prix_acquisition.integer' => "Le prix d'acquisition doit être renseigné sous la forme d'un entier",
            'date_acquisition.required' => "La date d'acquisition est obligatoire",
            'date_acquisition.date' => "Doit être renseigné sous la forme d'une date",
            'consommation_de_base.required' => 'La consommation de base du moteur est obligatoire',
            'consommation_de_base.numeric' => 'Doit être une valeur numérique',
            'recette_hebdo_attendue.required' => "La recette hebdomadaire attendue est obligatoire",
            'recette_hebdo_attendue.integer' => "La recette hebdomadaire attendue doit être renseignée sous la forme d'un entier",
            'modele.required' => 'Le nom du modèle est obligatoire',
            'modele.not_in' => 'Le nom du modèle est obligatoire',
            'type_moteur.required' => 'Le type du moteur est obligatoire',
            'type_moteur.not_in' => 'Le type du moteur est obligatoire',
            'usage.required' => "L'usage affecté au véhicule est obligatoire",
            'usage.not_in' => "L'usage affecté au véhicule est obligatoire",
        ];
    }
}
