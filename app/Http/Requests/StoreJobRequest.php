<?php

namespace App\Http\Requests;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreJobRequest extends FormRequest
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
            'type' => ['required', new Enum(JobTypeEnum::class)],
            'quota' => ['required', 'numeric', 'min:0'],
            'location' => ['required', 'string', 'max:255'],
            'need_portfolio' => ['boolean'],
            'sections' => ['required', 'array'],
            'sections.*' => ['array'],
            'sections.*.content' => ['string'],
            'status' => ['required', new Enum(JobStatusEnum::class)],
            'start_at' => ['nullable', 'date'],
            'end_at' => ['nullable', 'date'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (is_array($this->input('sections'))) {
            $filteredSections = [];

            // only take a section content that doesn't have '<p><br></p>' (quill default value)
            foreach ($this->input('sections') as $index => $section) {
                if (isset($section['content']) && $section['content'] !== '<p><br></p>') {
                    $filteredSections[$index]['content'] = $section['content'];
                }
            }

            $this->merge(['sections' => $filteredSections]);
        }
    }
}
