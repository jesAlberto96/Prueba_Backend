<?php

namespace App\Http\Requests;

use App\Http\Controllers\Api\ResponseController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class StoreCandidatosRequest extends FormRequest
{
    
    public function __construct(){
        $this->response = new ResponseController;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'created_by' => 'required|exists:App\Models\User,id',
            'owner' => 'required|exists:App\Models\User,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'created_by.required' => 'El usuario creador es requerido.',
            'created_by.exists' => 'El usuario creador no se encuentra registrado.',
            'owner.required' => 'El usuario encargado es requerido.',
            'owner.exists' => 'El usuario encargado no se encuentra registrado.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->response->sendError($validator->errors(), 406));
    }
}
