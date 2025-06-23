<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        // dd($this->request->all());
       return [
            'name'        => 'required|string|min:1|max:100|unique:products,name,' . $this->product,
            'code'        => 'required|string|max:100|unique:products,code,' . $this->product,
            'category_id' => 'required|exists:categories,id',
            'brand_id'    => 'nullable|exists:brands,id',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'nullable|integer|min:0',
            'image'       => 'nullable|array|min:1'
        ];
    }
}
