<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Admin User',
                'email' => 'admin@lms.com',
                'role' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
            ],
            [
                'name' => 'John Student',
                'email' => 'student@lms.com',
                'role' => 'student',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
            ],
            [
                'name' => 'Jane Instructor',
                'email' => 'instructor@lms.com',
                'role' => 'instructor',
                'password' => password_hash('teacher123', PASSWORD_DEFAULT),
            ],
        ];
            $this->db->table('users')->insertBatch($data);

    }
}
