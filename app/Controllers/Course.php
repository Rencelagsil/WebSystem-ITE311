<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\CourseModel;

class Course extends BaseController
{
    public function enroll()
    {
        // Set JSON content type
        $this->response->setContentType('application/json');

        if (!session()->get('isLoggedIn')) {
            return $this->response->setStatusCode(401)->setJSON(['success' => false, 'message' => 'User not logged in']);
        }

        $course_id = $this->request->getPost('course_id');
        $user_id = session()->get('user_id');

        if (!$course_id) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Course ID is required']);
        }

        $enrollmentModel = new EnrollmentModel();
        $courseModel = new CourseModel();

        // Check if course exists
        $course = $courseModel->find($course_id);
        if (!$course) {
            return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'Course not found']);
        }

        // Check if already enrolled
        if ($enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Already enrolled in this course']);
        }

        // Enroll user
        $data = [
            'user_id' => $user_id,
            'course_id' => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s')
        ];

        if ($enrollmentModel->enrollUser($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Successfully enrolled in the course']);
        } else {
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Failed to enroll']);
        }
    }
}
