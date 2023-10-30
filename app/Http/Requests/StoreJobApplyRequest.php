<?php

namespace App\Http\Requests;

use App\Enums\AttachmentExtensionEnum;
use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreJobApplyRequest extends FormRequest
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
        /** @var Job $job */
        $job = $this->route('job');

        $allowedMimes = AttachmentExtensionEnum::valuesWithCommaSeparatedFormat();

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'numeric'],
            'age' => ['required', 'numeric'],
            'is_married' => ['required', 'boolean'],
            'address' => ['required', 'string'],
            'education' => ['required', Rule::in(['S3', 'S2', 'S1', 'SMK', 'SMA', 'SMP', 'SD'])],
            'school' => ['required', 'string', 'max:255'],
            'faculty' => [Rule::when(
                in_array($this->education, ['S3', 'S2', 'S1']),
                ['required', 'string', 'max:255'],
            )],
            'major' => [Rule::when(
                in_array($this->education, ['S3', 'S2', 'S1', 'SMK', 'SMA']),
                ['required', 'string', 'max:255'],
            )],
            'experience' => ['required', 'numeric'],
            'salary_before' => ['nullable', 'numeric', 'max:2147483647'],
            'salary_expected' => ['nullable', 'numeric', 'max:2147483647'],
            'curriculum_vitae' => ['required', 'file', 'mimes:' . $allowedMimes, 'max:2048'],
            'portfolio' => [
                Rule::when(
                    $job->need_portfolio,
                    ['required', 'file', 'mimes:' . $allowedMimes, 'max:2048'],
                    ['nullable'],
                ),
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $salaryBefore = empty($this->salary_before)
            ? null
            : Str::replace('.', '', $this->salary_before);
        $salaryExpected = empty($this->salary_expected)
            ? null
            : Str::replace('.', '', $this->salary_expected);

        $this->merge([
            'salary_before' => $salaryBefore,
            'salary_expected' => $salaryExpected,
        ]);
    }
}
