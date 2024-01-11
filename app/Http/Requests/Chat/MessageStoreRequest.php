<?php

namespace App\Http\Requests\Chat;

use App\Enums\MessageType;
use Illuminate\Foundation\Http\FormRequest;

class MessageStoreRequest extends FormRequest
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
            'id' => ['required', 'exists:users,id'],
            'type' => ['required', 'in:'.MessageType::list()],
            'body' => ['required_if:type,'.MessageType::TEXT->value, 'max:500'],
            'voice' => ['required_if:type,'.MessageType::VOICE->value],
        ];
    }
}
