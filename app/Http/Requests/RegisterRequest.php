<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username'=> 'required|string|max:50|unique:users,username',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/|confirmed'
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            "username.required" => "Please provide username",
            "username.string" => "Username must be string",
            "username.max" => "Username cannot exceed 50 characters",
            "username.unique" => "Username is already taken. Please provide another username",
            
            "email.required" => "Please provde an email address",
            "email.email" => "Invalid email",
            "email.unique" => "Email already registered. Login to continue",
            
            "password.required" => "Please provide password.",
            "password.min" => "Password must be at least 8 character.",
            "password.regex" => "Password must contain at least one upper case character and one lower case character",
            "password.confirmed" => "Password confirmation must match",
            
            "login.required" => "Please provide username or email"
            ];
    }
}
