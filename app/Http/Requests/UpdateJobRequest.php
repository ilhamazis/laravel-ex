<?php

namespace App\Http\Requests;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateJobRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', new Enum(JobTypeEnum::class)],
            'status' => ['required', new Enum(JobStatusEnum::class)],
            'quota' => ['required', 'numeric'],
            'banner' => ['nullable', 'image', 'max:512'],
            'need_portfolio' => ['boolean'],
            'start_at' => ['nullable', 'date'],
            'end_at' => ['nullable', 'date'],
        ];
    }
}
