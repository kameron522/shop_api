<?php

namespace App\Http\Requests\Shop;

use App\Base\Traits\HasPermission;
use Illuminate\Foundation\Http\FormRequest;

class ShopDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return HasPermission::IsAllowed(request()->shop);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
