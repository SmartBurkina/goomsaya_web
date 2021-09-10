<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'nom' => 'required',
            'prenom' => 'required',
            'numero' => 'required|number',
            'message' => 'required'
        ];
    }

    public function messages(){
        return [
            'nom.required' => 'Vous devez entrer votre nom',
            'prenom.required' => 'Vous devez entrer votre prénom',
            'numero.required' => 'Veuillez entrez votre numéro de téléphone',
            'numero.number' => 'Votre numéro de téléphone ne peut contenir que des chiffres',
            'message.required' => 'Veuillez entrer un message',
        ];
    }
}
