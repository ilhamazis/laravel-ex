<?php

namespace App\Http\Requests;

use App\Enums\ApplicationExperienceEnum;
use App\Enums\AttachmentExtensionEnum;
use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

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

        return [
            'photo' => ['required', 'file', 'mimetypes:image/jpeg,image/png', 'max:4096'],
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'numeric'],
            'place_of_birth' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'is_married' => ['required', 'boolean'],
            'address' => ['required', 'string'],
            'email' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'numeric'],
            'linkedin_url' => ['nullable', 'url'],
            'education' => ['required', Rule::in(['S3', 'S2', 'S1', 'D4', 'D3', 'D2', 'D1', 'SMK', 'SMA'])],
            'school' => ['required', 'string', 'max:255'],
            'faculty' => [Rule::when(
                in_array($this->education, ['S3', 'S2', 'S1', 'D4', 'D3', 'D2', 'D1']),
                ['required', 'string', 'max:255'],
            )],
            'major' => [Rule::when(
                in_array($this->education, ['S3', 'S2', 'S1', 'D4', 'D3', 'D2', 'D1', 'SMK', 'SMA']),
                ['required', 'string', 'max:255'],
            )],
            'experience' => ['required', new Enum(ApplicationExperienceEnum::class)],
            'salary_before' => ['nullable', 'numeric', 'max:2147483647'],
            'salary_expected' => ['nullable', 'numeric', 'max:2147483647'],
            'curriculum_vitae' => ['required', 'file', 'mimetypes:application/pdf', 'max:5120'],
            'portfolio' => [
                Rule::when(
                    $job->need_portfolio,
                    ['required', 'file', 'mimetypes:application/pdf', 'max:5120'],
                ),
            ],
            'statement_of_honesty' => ['accepted'],
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
