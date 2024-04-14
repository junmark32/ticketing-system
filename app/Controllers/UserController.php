<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
class UserController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function studentRegister()
    {
        return view('user/Reg_Student');
    }

    public function alumniRegister()
    {
        return view('user/Reg_Alumni');
    }

    public function outsiderRegister()
    {
        return view('user/Reg_Outsider');
    }

    public function registerStudent()
    {
        $model = new UsersModel();

        // Get data from form or request
        $data = [
            'Username' => $this->request->getVar('username'),
            'PasswordHash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT), // Hash the password
            'UserType' => 'student', // Default UserType to student
            'SchoolID' => $this->request->getVar('school_id'),
            'FirstName' => $this->request->getVar('first_name'),
            'LastName' => $this->request->getVar('last_name'),
            'DateOfBirth' => $this->request->getVar('date_of_birth'),
            'Phone' => $this->request->getVar('phone'),
            'Email' => $this->request->getVar('email'),
            'Status' => 'active' // Default Status to active
        ];

        // Insert the data into the database
        $model->insert($data);

        // Optionally, you can redirect the user to a success page or show a success message
        return redirect()->to('/tickets/login');
    }


    public function registerAlumni()
    {
        $model = new UsersModel();

        // Get data from form or request
        $data = [
            'Username' => $this->request->getVar('username'),
            'PasswordHash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT), // Hash the password
            'UserType' => 'alumni', // Default UserType to student
            'AlumniID' => $this->request->getVar('alumni_id'),
            'FirstName' => $this->request->getVar('first_name'),
            'LastName' => $this->request->getVar('last_name'),
            'DateOfBirth' => $this->request->getVar('date_of_birth'),
            'Phone' => $this->request->getVar('phone'),
            'Email' => $this->request->getVar('email'),
            'Status' => 'active' // Default Status to active
        ];

        // Insert the data into the database
        $model->insert($data);

        // Optionally, you can redirect the user to a success page or show a success message
        return redirect()->to('/tickets/login');
    }

    public function registerOutsider()
    {
        $model = new UsersModel();
    
        // Generate a random SchoolID
        $generatedID = mt_rand(100000, 999999); // Example: Generates a 6-digit random number
    
        // Get data from form or request
        $data = [
            'Username' => $this->request->getVar('username'),
            'PasswordHash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT), // Hash the password
            'UserType' => 'outsider', // Default UserType to outsider
            'GeneratedNumber' => $generatedID, // Assign the generated SchoolID
            'FirstName' => $this->request->getVar('first_name'),
            'LastName' => $this->request->getVar('last_name'),
            'DateOfBirth' => $this->request->getVar('date_of_birth'),
            'Phone' => $this->request->getVar('phone'),
            'Email' => $this->request->getVar('email'),
            'Status' => 'active' // Default Status to active
        ];
    
        // Insert the data into the database
        $model->insert($data);
    
        // Optionally, you can redirect the user to a success page or show a success message
        return redirect()->to('/tickets/login');
    }
    

    private function generateUniqueID() {
        // Generate a unique ID using timestamp or any other method
        return uniqid('OUT_', true);
    }

    public function fn_login()
    {
        // Load the model
        $model = new UsersModel();

        // Get username and password from the form or request
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Check if the user exists
        $user = $model->where('Username', $username)->first();

        if ($user) {
            // Verify the password
            if (password_verify($password, $user['PasswordHash'])) {
                // Password is correct, set session and redirect to dashboard or any desired page
                $session = session();
                $session->set('isLoggedIn', true);
                $session->set('userID', $user['UserID']);
                // Optionally, you can set more session data like user type, name, etc.

                // Redirect to appropriate dashboard based on UserType
                switch ($user['UserType']) {
                    case 'admin':
                        return redirect()->to('/admin_dashboard');
                        break;
                    case 'student':
                        return redirect()->to('/student_dashboard');
                        break;
                    case 'alumni':
                        return redirect()->to('/alumni_dashboard');
                        break;
                    default:
                        return redirect()->to('/outsider_dashboard');
                        break;
                }
            } else {
                // Password is incorrect, show error message
                return redirect()->back()->with('error', 'Incorrect password.');
            }
        } else {
            // User does not exist, show error message
            return redirect()->back()->with('error', 'User does not exist.');
        }
    }
 



    public function adminDashboard()
    {
        return view('admin/Admin_Dashboard');
    }
}

    
    





