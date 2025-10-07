<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\CourseModel;
use CodeIgniter\API\ResponseTrait;

class Course extends BaseController
{
    use ResponseTrait;

    public function enroll()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->respond(['success' => false, 'message' => 'User not logged in'], 401);
        }

        $course_id = $this->request->getPost('course_id');
        $user_id = session()->get('user_id');

        if (!$course_id) {
            return $this->respond(['success' => false, 'message' => 'Course ID is required'], 400);
        }

        $enrollmentModel = new EnrollmentModel();
        $courseModel = new CourseModel();

        // Check if course exists
        $course = $courseModel->find($course_id);
        if (!$course) {
            return $this->respond(['success' => false, 'message' => 'Course not found'], 404);
        }

        // Check if already enrolled
        if ($enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->respond(['success' => false, 'message' => 'Already enrolled in this course'], 400);
        }

        // Enroll user
        $data = [
            'user_id' => $user_id,
            'course_id' => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s')
        ];

        if ($enrollmentModel->enrollUser($data)) {
            return $this->respond(['success' => true, 'message' => 'Successfully enrolled in the course']);
        } else {
            return $this->respond(['success' => false, 'message' => 'Failed to enroll'], 500);
        }
    }
}
