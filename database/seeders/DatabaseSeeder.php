<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Job;
use App\Models\Permission;
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
        ]);

        $roles[RoleEnum::INTERVIEWER->value]->permissions()->sync([
            //
        ]);

        if (App::isLocal()) {
            $humanCapital = User::factory()->create(['email' => 'hc@sevima.com']);
            $interviewer = User::factory()->create(['email' => 'interviewer@sevima.com']);

            $humanCapital->roles()->attach($roles[RoleEnum::HUMAN_CAPITAL->value]->id);
            $interviewer->roles()->attach($roles[RoleEnum::INTERVIEWER->value]->id);

            $job = Job::factory()->create([
                'created_by' => $humanCapital->username,
                'updated_by' => $humanCapital->username,
                'deleted_by' => null,
            ]);

            $applicant = Applicant::factory()->create();

            $application = Application::factory()->create([
                'applicant_id' => $applicant->id,
                'job_id' => $job->id,
            ]);

            $attachment = Attachment::factory()->create([
                'application_id' => $application->id,
                'created_by' => $applicant->name,
                'updated_by' => $applicant->name,
            ]);

            $step = Step::factory()->create(['application_id' => $application->id]);

            $comment = Comment::factory()->create([
                'step_id' => $step->id,
                'user_id' => $interviewer->id,
            ]);

            $template = Template::factory()->create([
                'created_by' => $humanCapital->username,
                'updated_by' => $humanCapital->username,
            ]);
        }
    }
}
