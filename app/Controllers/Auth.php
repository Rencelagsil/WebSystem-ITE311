<?php

namespace App\Controllers;

class Auth extends BaseController
{
    
// Handles registration 
    public function register()
    {
        $session = session();
        if ($session->get('isLoggedIn')) {
            return $this->redirectBasedOnRole($session->get('userRole'));
        }

        // Process form submission (POST)
        if ($this->request->getMethod() === 'POST') {
            $name = trim((string) $this->request->getPost('name'));
            $email = trim((string) $this->request->getPost('email'));
            $password = (string) $this->request->getPost('password');
            $passwordConfirm = (string) $this->request->getPost('password_confirm');

            if ($name === '' || $email === '' || $password === '' || $passwordConfirm === '') {
                return redirect()->back()->withInput()->with('register_error', 'All fields are required.');
            }

            if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return redirect()->back()->withInput()->with('register_error', 'Invalid email address.');
            }

            if ($password !== $passwordConfirm) {
                return redirect()->back()->withInput()->with('register_error', 'Passwords do not match.');
            }

            $userModel = new \App\Models\UserModel();

            if ($userModel->where('email', $email)->first()) {
                return redirect()->back()->withInput()->with('register_error', 'Email is already registered.');
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $userId = $userModel->insert([
                'name' => $name,
                'email' => $email,
                'role' => 'role',
                'password' => $passwordHash,
            ], true);

            if (! $userId) {
                return redirect()->back()->withInput()->with('register_error', 'Registration failed.');
            }

            return redirect()
                ->to(base_url('login'))
                ->with('register_success', 'Account created successfully. Please log in.');
        }

        // Display form (GET)
        return view('auth/register');
    }

// Login
    public function login()
    {
        $session = session(); 

        if ($session->get('isLoggedIn')) {
            $role = $session->get('userRole');
            switch ($role) {
                case 'admin':
                    return redirect()->to(base_url('admin/dashboard'));
                case 'teacher':
                    return redirect()->to(base_url('teacher/dashboard'));
                case 'student':
                    return redirect()->to(base_url('student/dashboard'));
                default:
                    return redirect()->to(base_url('dashboard')); 
            }
        }
         // Process form submission (POST)
           if ($this->request->getMethod() === 'POST') {
               $email = trim((string) $this->request->getPost('email'));
               $password = (string) $this->request->getPost('password');
       
               $userModel = new \App\Models\UserModel();
               $user = $userModel->where('email', $email)->first();
               
               if ($user && password_verify($password, $user['password'])) {
                   // Store the user's email and role in the session
                   $session->set([
                       'isLoggedIn' => true,
                       'userEmail' => $email,
                       'userRole' => $user['role'], 
                   ]);
                   
                   // Redirect based on user role
                   switch ($user['role']) {
                       case 'admin':
                           return redirect()->to(base_url('admin/dashboard'));
                       case 'teacher':
                           return redirect()->to(base_url('teacher/dashboard'));
                       case 'student':
                           return redirect()->to(base_url('student/dashboard'));
                   }
               }
       
               return redirect()->back()->with('login_error', 'Invalid credentials');
           }
       
           return view('auth/login');
       }

 //Destroy user session
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }

        public function dashboard()
    {
        $session = session();
        if (! $session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        return view('dashboard/index');
    }
}