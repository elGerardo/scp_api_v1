<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\JsonValidationException;
use Illuminate\Contracts\Validation\Validator;

class StoreSCPRequest extends FormRequest
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
            "id" => "required|numeric|unique:scp,id",
            "name" => "required|max:255",
            "weight" => "nullable|numeric",
            "height" => "nullable|numeric",
            "picture" => "nullable|url",
            "description" => "required|string",
            "category_id" => "required|exists:category,id"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new JsonValidationException($validator);
    }
}
