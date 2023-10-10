<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\ApplicationStatusEnum;
use App\Enums\ApplicationStepEnum;
use App\Enums\ApplicationStepStatusEnum;
use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Attachment;
use App\Models\Communication;
use App\Models\Job;
use App\Models\Note;
use App\Models\Permission;
use App\Models\Review;
use App\Models\Role;
use App\Models\Step;
use App\Models\Template;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [];
        foreach (RoleEnum::values() as $role) {
            $roles[$role] = Role::query()->create(['name' => $role]);
        }

        $permissions = [];
        foreach (PermissionEnum::values() as $permission) {
            $permissions[$permission] = Permission::query()->create(['name' => $permission]);
        }

        $roles[RoleEnum::HUMAN_CAPITAL->value]->permissions()->sync([
            $permissions[PermissionEnum::VIEW_DASHBOARD->value]->id,
            $permissions[PermissionEnum::VIEW_JOB->value]->id,
            $permissions[PermissionEnum::CREATE_JOB->value]->id,
            $permissions[PermissionEnum::UPDATE_JOB->value]->id,
            $permissions[PermissionEnum::DELETE_JOB->value]->id,
            $permissions[PermissionEnum::VIEW_APPLICATION->value]->id,
            $permissions[PermissionEnum::VIEW_APPLICATION_STEP->value]->id,
            $permissions[PermissionEnum::UPDATE_APPLICATION_STEP->value]->id,
            $permissions[PermissionEnum::VIEW_APPLICATION_COMMUNICATION->value]->id,
            $permissions[PermissionEnum::CREATE_APPLICATION_COMMUNICATION->value]->id,
            $permissions[PermissionEnum::VIEW_APPLICATION_REVIEW->value]->id,
            $permissions[PermissionEnum::CREATE_APPLICATION_REVIEW->value]->id,
            $permissions[PermissionEnum::VIEW_APPLICATION_ATTACHMENT->value]->id,
            $permissions[PermissionEnum::CREATE_APPLICATION_ATTACHMENT->value]->id,
            $permissions[PermissionEnum::DELETE_APPLICATION_ATTACHMENT->value]->id,
            $permissions[PermissionEnum::VIEW_TEMPLATE->value]->id,
            $permissions[PermissionEnum::CREATE_TEMPLATE->value]->id,
            $permissions[PermissionEnum::UPDATE_TEMPLATE->value]->id,
            $permissions[PermissionEnum::DELETE_TEMPLATE->value]->id,
        ]);

        $roles[RoleEnum::INTERVIEWER->value]->permissions()->sync([
            $permissions[PermissionEnum::VIEW_DASHBOARD->value]->id,
            $permissions[PermissionEnum::VIEW_JOB->value]->id,
            $permissions[PermissionEnum::VIEW_APPLICATION->value]->id,
            $permissions[PermissionEnum::VIEW_APPLICATION_STEP->value]->id,
            $permissions[PermissionEnum::VIEW_APPLICATION_REVIEW->value]->id,
            $permissions[PermissionEnum::CREATE_APPLICATION_REVIEW->value]->id,
            $permissions[PermissionEnum::VIEW_APPLICATION_ATTACHMENT->value]->id,
        ]);

        foreach (ApplicationStepEnum::values() as $index => $step) {
            Step::query()->create([
                'name' => $step,
                'order' => $index + 1,
            ]);
        }

        if (App::isLocal()) {
            $humanCapital = User::factory()->create(['username' => 'human_capital', 'email' => 'hc@sevima.com']);
            $interviewer = User::factory()->create(['username' => 'interviewer', 'email' => 'interviewer@sevima.com']);

            $humanCapital->roles()->attach($roles[RoleEnum::HUMAN_CAPITAL->value]->id);
            $interviewer->roles()->attach($roles[RoleEnum::INTERVIEWER->value]->id);

            $job = Job::factory()->create([
                'created_by' => $humanCapital->id,
                'updated_by' => $humanCapital->id,
                'deleted_by' => null,
            ]);

            $applicant = Applicant::factory()->create();

            $application = Application::factory()->create([
                'status' => ApplicationStatusEnum::ONGOING,
                'applicant_id' => $applicant->id,
                'job_id' => $job->id,
            ]);

            $applicationStepPassed = ApplicationStep::factory()->create([
                'status' => ApplicationStepStatusEnum::PASSED,
                'application_id' => $application->id,
                'step_id' => 1,
                'created_by' => null,
                'updated_by' => null
            ]);

            $applicationStepOngoing = ApplicationStep::factory()->create([
                'status' => ApplicationStepStatusEnum::ONGOING,
                'application_id' => $application->id,
                'step_id' => 2,
                'created_by' => null,
                'updated_by' => null
            ]);

            $application->update(['current_application_step_id' => $applicationStepOngoing->id]);

            $attachment = Attachment::factory()->create([
                'path' => 'dummy.pdf',
                'application_id' => $application->id,
                'created_by' => null,
                'updated_by' => null,
            ]);

            $communication = Communication::factory()->create([
                'application_id' => $application->id,
                'user_id' => $humanCapital->id,
            ]);

            $review = Review::factory()->create([
                'application_step_id' => $applicationStepPassed->id,
                'user_id' => $interviewer->id,
            ]);

            $note = Note::factory()->create([
                'application_step_id' => $applicationStepPassed->id,
                'user_id' => $humanCapital->id,
            ]);

            $template = Template::factory()->create([
                'created_by' => $humanCapital->id,
                'updated_by' => $humanCapital->id,
            ]);
        }
    }
}
