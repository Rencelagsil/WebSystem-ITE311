<?php

namespace App\Controllers;

class StudentController extends BaseController
{
    public function dashboard()
    {
        $session = session();
        
        // Check if user is logged in
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }
        
        // Check if user has student role
        if ($session->get('userRole') !== 'student') {
            return redirect()->to(base_url('login'))->with('error', 'Access denied. Student privileges required.');
        }
        
        // Get student's enrolled courses (placeholder - you can expand this with actual course data)
        $enrolledCourses = [
            ['id' => 1, 'name' => 'Web Development', 'instructor' => 'Dr. Smith', 'progress' => 75, 'next_deadline' => '2025-01-25'],
            ['id' => 2, 'name' => 'Database Management', 'instructor' => 'Prof. Johnson', 'progress' => 60, 'next_deadline' => '2025-01-28'],
            ['id' => 3, 'name' => 'Software Engineering', 'instructor' => 'Dr. Brown', 'progress' => 45, 'next_deadline' => '2025-02-01']
        ];
        
        // Get upcoming deadlines
        $upcomingDeadlines = [
            ['course' => 'Web Development', 'assignment' => 'Final Project', 'due_date' => '2025-01-25', 'status' => 'pending'],
            ['course' => 'Database Management', 'assignment' => 'SQL Quiz', 'due_date' => '2025-01-28', 'status' => 'pending'],
            ['course' => 'Software Engineering', 'assignment' => 'Design Document', 'due_date' => '2025-02-01', 'status' => 'pending']
        ];
        
        // Get recent grades
        $recentGrades = [
            ['course' => 'Web Development', 'assignment' => 'HTML/CSS Project', 'grade' => 95, 'date' => '2025-01-20'],
            ['course' => 'Database Management', 'assignment' => 'ERD Design', 'grade' => 88, 'date' => '2025-01-18'],
            ['course' => 'Software Engineering', 'assignment' => 'Requirements Analysis', 'grade' => 92, 'date' => '2025-01-15']
        ];
        
        $data = [
            'title' => 'Student Dashboard',
            'enrolledCourses' => $enrolledCourses,
            'upcomingDeadlines' => $upcomingDeadlines,
            'recentGrades' => $recentGrades,
            'userRole' => $session->get('userRole'),
            'userEmail' => $session->get('userEmail')
        ];
        
        return view('student/dashboard', $data);
    }
}