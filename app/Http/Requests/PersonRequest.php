<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
        //Validaciones para campos de formulario
        return [
            'cui'                 => 'required|unique:people|size:13', //CUI tiene 13 números
            'identification_card' => 'nullable|unique:people|size:12', //Cédula tenía 12 números
            'name'                => 'required',
            'last_name'           => 'required',
            'birthdate'           => 'required|date_format:Y-m-d|before:2003-01-17', //Mayor de edad
            'address'             => 'required|min:5',
            'phone'               => 'required|size:8', //Teléfono tiene 8 números
            'department'          => 'required|min:5|max:14',
            'township'            => 'required|min:4',
            'email'               => 'required|unique:people|email',
            'image'               => 'bail|required|mimes:jpeg,png|dimensions:width=113,height=142', //Tamaño cédula
        ];
    }

    public function messages()
    {
        return [
            'cui.unique'                 => 'Ya existe un CUI con el mismo valor.',
            'cui.size'                   => 'El campo CUI debe contener 13 caracteres.',
            'identification_card.unique' => 'Ya existe una cédula con el mismo valor.',
            'identification_card.size'   => 'El campo cédula debe contener 12 caracteres.',
            'birthdate.before'           => 'Debe tener al menos 18 años para realizar la solicitud.',
            'address.min'                => 'Ingrese una dirección correcta.',
            'phone.size'                 => 'Ingrese un teléfono correcto.',
            'department.min'             => 'Ingrese un departamento correcto.',
            'department.max'             => 'Ingrese un departamento correcto.',
            'township.min'               => 'Ingrese un municipio correcto.',
            'email.unique'               => 'Ya existe un correo con la misma dirección.',
            'image.required'             => 'El campo fotografía es obligatorio.',
            'image.dimensions'           => 'La fotografía debe ser tamaño cédula (113x142)px.',
            'image.mimes'                => 'El formato de la fotografía no es válido.',
        ];
    }
}
