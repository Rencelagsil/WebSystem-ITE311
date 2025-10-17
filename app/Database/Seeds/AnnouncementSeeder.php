<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Welcome to the New Semester!',
                'content' => 'We are excited to welcome all students to the new semester. Please check your course schedules and ensure you have all required materials ready for the first day of classes.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Midterm Examination Schedule Released',
                'content' => 'The midterm examination schedule for this semester has been released. Students can view their exam schedules on the student portal. Please prepare accordingly and arrive at least 15 minutes before the scheduled exam time.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
        ];

        // Insert the data
        $this->db->table('announcements')->insertBatch($data);
    }
}
