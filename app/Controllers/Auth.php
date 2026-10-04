<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    public function login(): string|RedirectResponse
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(site_url('tasks'));
        }

        return view('auth/login', [
            'errors' => [],
            'error'  => session()->getFlashdata('error'),
        ]);
    }

    public function attemptLogin(): string|RedirectResponse
    {
        $validation = service('validation');
        if (! $this->validate(['username' => 'required', 'password' => 'required'])) {
            return view('auth/login', [
                'errors' => $validation->getErrors(),
                'error'  => null,
            ]);
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $user = (new UserModel())->getByUsername($username);

        if ($user === null || empty($user['password']) || ! password_verify($password, $user['password'])) {
            return view('auth/login', [
                'errors' => [],
                'error'  => 'Invalid username or password.',
            ]);
        }

        session()->regenerate(true);
        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'full_name'  => $user['full_name'],
        ]);

        return redirect()->to(site_url('tasks'));
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to(site_url('login'));
    }
}
