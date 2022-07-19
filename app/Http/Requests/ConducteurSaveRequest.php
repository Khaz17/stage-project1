<?php

namespace App\Http\Requests;

use App\Rules\IsAdult;
use Illuminate\Foundation\Http\FormRequest;

class ConducteurSaveRequest extends FormRequest
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
            'nom_c' => 'required|string',
            'prenom_c' => 'required|string',
            'date_naissance_c' => ['required','date', new IsAdult],
            'telephone_c' => 'required|string|unique:conducteurs',
            'email_c' => 'email|unique:conducteurs',
            'adresse_c' => 'required|string',
            'type_permis' => 'required|not_in:0',
            'delivrance_p' => 'required|date|before_or_equal:today',
            'expiration_p' => 'required|date|after:delivrance_p',
            'scan_permis' => 'required|unique:conducteurs|string',
        ];
    }

    public function messages(){
        return [
            'nom_c.required' => 'Le nom du conducteur est obligatoire',
            'nom_c.string' => 'Le nom du conducteur doit être une chaîne de caractères',
            'prenom_c.required' => 'Le prénom du conducteur est obligatoire',
            'prenom_c.string' => 'Le prénom du conducteur doit être renseigné sous forme de chaîne de caractères',
            'date_naissance_c.required' => 'La date de naissance du conducteur est obligatoire',
            'date_naissance_c.date' => 'Format invalide',
            'telephone_c.required' => 'Le numéro de téléphone du conducteur est obligatoire',
            'telephone_c.unique' => 'Ce numéro de téléphone est utilisé par un autre conducteur',
            'email_c.email' => 'Format invalide',
            'email_c.unique' => 'Cette adresse email est utilisée par un autre conducteur',
            'adresse_c.required' => "L'adresse est obligatoire",
            'adresse_c.string' => "L'adresse doit être renseignée sous forme de chaîne de caractères",
            'type_permis.required' => 'Le type de permis est obligatoire',
            'type_permis.not_in' => 'Le type du permis doit être renseigné',
            'delivrance_p.required' => 'La date de délivrance du permis est obligatoire',
            'delivrance_p.date' => 'Format invalide',
            'delivrance_p.before_or_equal' => "La date de délivrance du permis n'est pas valide",
            'expiration_p.required' => "La date d'expiration du permis est obligatoire",
            'expiration_p.date' => 'Format invalide',
            'expiration_p.after' => "Le permis de conduire n'est plus valide",
            'scan_permis.unique' => 'Le scan du permis est unique pour chaque conducteur',
            'scan_permis.required' => 'Le scan du permis est obligatoire'
        ];
    }
}
