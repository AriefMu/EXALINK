<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'pegawai_nip'=>'196705282007011003',
            'username'=>'super',
            'password'=>bcrypt('12345'),
            'role'=>'superadmin'
        ]);
    }
}
