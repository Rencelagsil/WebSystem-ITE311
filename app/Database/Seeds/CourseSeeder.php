<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Web Development Fundamentals',
                'description' => 'Learn the basics of HTML, CSS, and JavaScript for building modern websites.',
                'instructor_id' => 2, // Rose
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Database Management Systems',
                'description' => 'Comprehensive course on database design, SQL, and data management principles.',
                'instructor_id' => 3, // Albert
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Software Engineering Principles',
                'description' => 'Explore software development methodologies, design patterns, and best practices.',
                'instructor_id' => 2, // Rose
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert the data
        $this->db->table('courses')->insertBatch($data);
    }
}
