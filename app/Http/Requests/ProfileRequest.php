<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Worksome\RequestFactories\Concerns\HasFactory;

class ProfileRequest extends FormRequest
{
    use HasFactory;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email:dns',
                'max:255',
            ],
            'password' => [
                'nullable',
                'confirmed',
                Password::defaults()
            ],
        ];
    }
}
