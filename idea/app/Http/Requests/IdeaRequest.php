<?php

namespace App\Http\Requests;

use App\IdeaStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IdeaRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required|string",
            "description" => "nullable|string",
            "status" => ["required", Rule::enum(IdeaStatus::class)],
            "links" => "nullable|array",
            "steps" => "nullable|array",
/*            "steps.*.description" => "string",
            "steps.*.completed" => "boolean:",*/
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120",
//            "links.*" => "url",
        ];
    }
}
