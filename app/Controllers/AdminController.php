<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function dashboard()
    {
        $session = session();
        
        // Check if user is logged in
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }
        
        // Check if user has admin role
        if ($session->get('userRole') !== 'admin') {
            return redirect()->to(base_url('login'))->with('error', 'Access denied. Admin privileges required.');
        }
        
        // Get user model to fetch statistics
        $userModel = new \App\Models\UserModel();
        $courseModel = new \App\Models\CourseModel();
        
        // Get total users count
        $totalUsers = $userModel->countAllResults();

        // Get total courses count
        $courseCount = $courseModel->countAllResults();
        
        // Get users by role
        $adminCount = $userModel->where('role', 'admin')->countAllResults(false);
        $teacherCount = $userModel->where('role', 'teacher')->countAllResults(false);
        $studentCount = $userModel->where('role', 'student')->countAllResults(false);
         
        // Get total courses count
        $courseCount = $courseModel->countAllResults();
        
        // Get recent users 
        $recentUsers = $userModel->orderBy('created_at', 'DESC')->findAll();
        
        $data = [
            'title' => 'Admin Dashboard',
            'totalUsers' => $totalUsers,
            'adminCount' => $adminCount,
            'teacherCount' => $teacherCount,
            'studentCount' => $studentCount,
            'courseCount'  => $courseCount, 
            'recentUsers' => $recentUsers,
            'userRole' => $session->get('userRole'),
            'userEmail' => $session->get('userEmail')
        ];
        
        return view('admin/dashboard', $data);
    }
}