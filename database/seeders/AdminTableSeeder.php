<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\User;
use Common\ValueObject\PermissionValueObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Model::unguard();

        /** @var string $mail */
        $mail = config('admin.default_admin_mail');

        $user = User::where([
            'email' => $mail,
        ])->first();

        if ($user === null) {
            $user = User::create([
                'name' => 'Admin',
                'email' => $mail,
                'email_verified_at' => now(),
                'password' => Hash::make(config('admin.default_admin_password')),
                'created_at' => now(),
                'actual_language_id' => Language::findByCode('EN')->first()->getId(),
            ]);
            $user->save();

            $user->assignRole(Role::findByName('admin'));
            $user->givePermissionTo(PermissionValueObject::canDeletePost()->getValue());
        }
    }
}
