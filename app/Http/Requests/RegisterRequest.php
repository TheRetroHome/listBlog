<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:6'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Поле "Имя" не заполнено',
            'email.required'=>'Поле "Email" не заполнено',
            'password.required'=>'Поле "Пароль" не заполнено',
            'email.email'=>'Поле Email не соответствует формату',
            'email.unique'=>'Email не уникален',
            'password.confirmed'=>'Пароли не совпадают',
            'password.min'=>'Минимальное кол-во символов в пароле должно быть 6'
        ];
    }
}
