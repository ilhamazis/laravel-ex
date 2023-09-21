<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Attachment;
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
        ]);

        $roles[RoleEnum::INTERVIEWER->value]->permissions()->sync([
            $permissions[PermissionEnum::VIEW_DASHBOARD->value]->id,
            $permissions[PermissionEnum::VIEW_JOB->value]->id,
        ]);

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
                'applicant_id' => $applicant->id,
                'job_id' => $job->id,
            ]);

            $attachment = Attachment::factory()->create([
                'application_id' => $application->id,
                'created_by' => null,
                'updated_by' => null,
            ]);

            $step = Step::factory()->create(['application_id' => $application->id]);

            $review = Review::factory()->create([
                'step_id' => $step->id,
                'user_id' => $interviewer->id,
            ]);

            $note = Note::factory()->create([
                'step_id' => $step->id,
                'user_id' => $humanCapital->id,
            ]);

            $template = Template::factory()->create([
                'created_by' => $humanCapital->id,
                'updated_by' => $humanCapital->id,
            ]);
        }
    }
}
