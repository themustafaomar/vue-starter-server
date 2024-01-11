<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Check whether the request is for updating
     * 
     * @var bool $is_updating
     */
    protected $is_updating = false;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:5', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'.($this->is_updating ? ','.$this->user->id : '')],
            'password' => [$this->is_updating ? 'nullable' : 'required', 'min:8'],
            'status' => ['required', 'in:'.UserStatus::list()],
            'role' => ['required', 'exists:roles,id'],
        ];
    }
}
