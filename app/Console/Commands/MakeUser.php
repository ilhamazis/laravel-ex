<?php

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class MakeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user for CMS access';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->ask('Name');
        $username = $this->ask('Username');
        $email = $this->ask('Email');
        $password = $this->secret('Password');
        $role = $this->choice('Role', RoleEnum::values());

        $data = [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ];

        try {
            $validated = $this->validate($data);

            $user = $this->createUser(RoleEnum::tryFrom($validated['role']), $validated);

            $this->info('Berhasil membuat user!');
            $this->table(
                ['Nama', 'Username', 'Email', 'Password'],
                [[$user->name, $user->username, $user->email, $password]],
            );
        } catch (ValidationException $e) {
            $this->error('[ERROR] ' . $e->getMessage());
        }
    }

    private function validate(array $data): array
    {
        $validationArray = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', Rule::unique(User::class, 'username')],
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'password' => ['required', 'string'],
            'role' => ['required', Rule::in(RoleEnum::values())],
        ];

        $validator = Validator::make($data, $validationArray);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->getMessages());
        }

        return $validator->validated();
    }

    private function createUser(RoleEnum $roleEnum, array $data): User
    {
        $roleId = Role::query()->where('name', $roleEnum)->first()->id;
        $user = User::query()->create($data);

        $user->roles()->attach($roleId);

        return $user;
    }
}
