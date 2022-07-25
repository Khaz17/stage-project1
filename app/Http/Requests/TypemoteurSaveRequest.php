<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypemoteurSaveRequest extends FormRequest
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
            'libelle_tm' => 'required|string|unique:type_moteurs',
        ];
    }

    public function messages(){
        return [
            'libelle_tm.required' => '?',
            'libelle_tm.string' => 'Le libellé doit être une chaîne de charactères',
            'libelle_tm.unique' => 'Type déjà enregistré',
        ];
    }
}
