<?php

namespace App\Controllers;

class TeacherController extends BaseController
{
    public function dashboard()
    {
        $session = session();
        
        // Check if user is logged in
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }
        
        // Check if user has teacher role
        if ($session->get('userRole') !== 'teacher') {
            return redirect()->to(base_url('login'))->with('error', 'Access denied. Teacher privileges required.');
        }
        
        // Get user model
        $userModel = new \App\Models\UserModel();
        
        // Get teacher's courses (placeholder - you can expand this with actual course data)
        $teacherCourses = [
            ['id' => 1, 'name' => 'Web Development', 'students' => 25, 'status' => 'active'],
            ['id' => 2, 'name' => 'Database Management', 'students' => 18, 'status' => 'active'],
            ['id' => 3, 'name' => 'Software Engineering', 'students' => 22, 'status' => 'active']
        ];
        
        // Get notifications (placeholder)
        $notifications = [
            ['id' => 1, 'message' => 'New assignment submitted by John Doe', 'time' => '2 hours ago', 'type' => 'assignment'],
            ['id' => 2, 'message' => 'Student Sarah Wilson needs help with project', 'time' => '4 hours ago', 'type' => 'help'],
            ['id' => 3, 'message' => 'Course "Web Development" has 3 new enrollments', 'time' => '1 day ago', 'type' => 'enrollment']
        ];
        
        $data = [
            'title' => 'Teacher Dashboard',
            'teacherCourses' => $teacherCourses,
            'notifications' => $notifications,
            'userRole' => $session->get('userRole'),
            'userEmail' => $session->get('userEmail')
        ];
        
        return view('teacher/dashboard', $data);
    }
}