<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Jason',
                'email' => 'jason@gmail.com',
                'role' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Rose',
                'email' => 'rose@gmail.com',
                'role' => 'teacher',
                'password' => password_hash('rose123', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
                        [
                'name' => 'Albert',
                'email' => 'albert@gmail.com',
                'role' => 'teacher',
                'password' => password_hash('alber123', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Justine',
                'email' => 'justine@gmail.com',
                'role' => 'student',
                'password' => password_hash('justine123', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
                        [
                'name' => 'Nabunturan',
                'email' => 'nabunturan@gmail.com',
                'role' => 'student',
                'password' => password_hash('nabunturan123', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert the data
        $this->db->table('users')->insertBatch($data);
    }
}