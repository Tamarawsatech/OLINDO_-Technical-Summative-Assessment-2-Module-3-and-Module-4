<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DemoUserSeeder extends Seeder
{
    public function run()
    {
        $username = 'kcolindo';
        $passwordHash = password_hash('admin12345!', PASSWORD_DEFAULT);
        $userModel = model('App\\Models\\UserModel');
        $user = $userModel->where('username', $username)->first();

        if ($user !== null) {
            $userModel->update($user['id'], ['password' => $passwordHash]);
            return;
        }

        $userModel->insert([
            'username'   => $username,
            'full_name'  => 'Karl Michael C. Olindo',
            'email'      => 'kcolindo@fit.edu.ph',
            'password'   => $passwordHash,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
