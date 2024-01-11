<?php

namespace App\Http\Requests\Admin;

class RoleUpdateRequest extends RoleStoreRequest
{
    /**
     * Check whether the request is for updating
     * 
     * @var bool $is_updating
     */
    protected $is_updating = true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update roles');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return parent::rules();
    }
}
