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
                'role' => 'student',
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
            return redirect()->to(base_url('dashboard'));
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
                       'user_id' => $user['id'],
                   ]);

                   // Redirect to unified dashboard
                   return redirect()->to(base_url('dashboard'));
               }
       
               return redirect()->back()->with('login_error', 'Invalid credentials');
           }
       
           return view('auth/login');
       }

 //Logout
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }

  // Handles the dashboard each role admin, teacher, student
        public function dashboard()
    {
        $session = session();
        if (! $session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $role = $session->get('userRole');
        $data = [
            'userRole' => $role,
            'userEmail' => $session->get('userEmail')
        ];

        if ($role === 'admin') {
            $userModel = new \App\Models\UserModel();
            $courseModel = new \App\Models\CourseModel();

            $data['totalUsers'] = $userModel->countAllResults();
            $data['courseCount'] = $courseModel->countAllResults();

            // Get all courses for the course table
            $courses = $courseModel->findAll();
            $data['courses'] = $courses;

            // Recent activity placeholder
            $data['recentActivities'] = [
                ['name'=>'Jane Smith','role'=>'Teacher','action'=>'Added','target'=>'New Course: "Math 101"','created_at'=>'2025-09-21 09:50'],
                ['name'=>'Mike Johnson','role'=>'Teacher','action'=>'Updated','target'=>'Course: "Science 201"','created_at'=>'2025-09-20 16:45'],
                ['name'=>'Alice Brown','role'=>'Student','action'=>'Submitted','target'=>'Assignment: "History HW1"','created_at'=>'2025-09-19 14:30'],
                ['name'=>'David Lee','role'=>'Student','action'=>'Completed','target'=>'Quiz: "Math 101 Quiz 1"','created_at'=>'2025-09-18 10:15'],
                ['name'=>'Sarah Green','role'=>'Teacher','action'=>'Graded','target'=>'Student Assignment: "Science Lab 2"','created_at'=>'2025-09-18 09:45'],
            ];
        } elseif ($role === 'teacher') {
            $courseModel = new \App\Models\CourseModel();
            $enrollmentModel = new \App\Models\EnrollmentModel();
            $user_id = $session->get('user_id');

            // Get courses taught by this teacher
            $courses = $courseModel->where('instructor_id', $user_id)->findAll();

            // Add student count and status to each course
            $teacherCourses = [];
            foreach ($courses as $course) {
                $studentCount = $enrollmentModel->where('course_id', $course['id'])->countAllResults();
                $teacherCourses[] = [
                    'id' => $course['id'],
                    'title' => $course['title'],
                    'students' => $studentCount,
                    'status' => 'active' // Assuming all courses are active for now
                ];
            }

            $data['teacherCourses'] = $teacherCourses;
            $data['notifications'] = [
                ['id' => 1, 'message' => 'New assignment submitted by John Doe', 'time' => '2 hours ago', 'type' => 'assignment'],
                ['id' => 2, 'message' => 'Student Sarah Wilson needs help with project', 'time' => '4 hours ago', 'type' => 'help'],
                ['id' => 3, 'message' => 'Course "Web Development" has 3 new enrollments', 'time' => '1 day ago', 'type' => 'enrollment']
            ];
        } elseif ($role === 'student') {
            $enrollmentModel = new \App\Models\EnrollmentModel();
            $courseModel = new \App\Models\CourseModel();
            $user_id = $session->get('user_id');

            // Get enrolled courses
            $enrolledCourses = $enrollmentModel->getUserEnrollments($user_id);
            $data['enrolledCourses'] = $enrolledCourses;

            // Get all courses
            $allCourses = $courseModel->findAll();

            // Get enrolled course IDs
            $enrolledCourseIds = array_column($enrolledCourses, 'course_id');

            // Get available courses (not enrolled)
            $availableCourses = array_filter($allCourses, function($course) use ($enrolledCourseIds) {
                return !in_array($course['id'], $enrolledCourseIds);
            });
            $data['availableCourses'] = array_values($availableCourses);

            // Dummy data for other sections (can be updated later)
            $data['upcomingDeadlines'] = [
                ['course' => 'Web Development', 'assignment' => 'Final Project', 'due_date' => '2025-01-25', 'status' => 'pending'],
                ['course' => 'Database Management', 'assignment' => 'SQL Quiz', 'due_date' => '2025-01-28', 'status' => 'pending'],
                ['course' => 'Software Engineering', 'assignment' => 'Design Document', 'due_date' => '2025-02-01', 'status' => 'pending']
            ];
            $data['recentGrades'] = [
                ['course' => 'Web Development', 'assignment' => 'HTML/CSS Project', 'grade' => 95, 'date' => '2025-01-20'],
                ['course' => 'Database Management', 'assignment' => 'ERD Design', 'grade' => 88, 'date' => '2025-01-18'],
                ['course' => 'Software Engineering', 'assignment' => 'Requirements Analysis', 'grade' => 92, 'date' => '2025-01-15']
            ];
        }

        return view('auth/dashboard', $data);
    }
}
