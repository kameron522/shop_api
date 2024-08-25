<?php

namespace App\Http\Requests\Shop;

use App\Base\Traits\HasPermission;
use App\Models\Shop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ShopUpdateRequest extends FormRequest
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
        return Shop::rules([
            'brand' => ['required', 'string', Rule::unique('shops', 'brand')->ignore($this->shop->id)],
        ]);
    }
}
