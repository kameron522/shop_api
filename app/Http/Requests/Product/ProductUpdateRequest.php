<?php

namespace App\Http\Requests\Product;

use App\Base\Traits\HasPermission;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ProductUpdateRequest extends FormRequest
{
        /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return HasPermission::IsAllowed(request()->product);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return Product::rules([
            'category_name' => ['nullable'],
        ]);
    }
}
