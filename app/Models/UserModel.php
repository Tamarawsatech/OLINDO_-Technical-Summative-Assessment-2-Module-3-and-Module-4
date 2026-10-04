<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['username', 'full_name', 'email', 'created_at', 'password'];

    public function getByUsername(string $username): ?array
    {
        return $this->where('username', $username)->first();
    }

    public function getDemoUser(): ?array
    {
        $user = $this->select('id, username, full_name, email, created_at')
            ->orderBy('id', 'ASC')->first();
        return $user ?: null;
    }
}
