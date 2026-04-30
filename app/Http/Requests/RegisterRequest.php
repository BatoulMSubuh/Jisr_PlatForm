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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       return [
            'role' => 'required|in:student,company',

            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',

            //  student fields
            // 'university' => 'required_if:role,student|string',
            // 'major' => 'nullable:role,student|string',
            // 'graduation_year' => 'nullable:role,student|integer|digits:4',
            // 'phone' => 'required_if:role,student|regex:/^09\d{8}$/',
            // 'bio' => 'nullable|string|max:255',
            // 'profile_picture' => ['nullable', 'image', 'max:2048'],

            //  company fields
            'company_name' => 'required_if:role,company|string',
            // 'industry' => 'required_if:role,company|string',
            // 'website' => 'nullable|url',
            // 'location' => 'required_if:role,company|string',
            // 'description' => 'nullable|string|max:1000',
            
        ];
    }
}
