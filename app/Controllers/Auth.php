<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        helper(['url', 'session']);
    }

    public function index()
    {
        // Show the login form
        return view('login');
    }

    public function login()
    {
        $session = session();

        // Get username and password from POST data
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Check if username and password are provided
        if (empty($username) || empty($password)) {
            $session->setFlashdata('error', 'Username and password are required.');
            return redirect()->back()->withInput();
        }

        // Fetch the user by username
        $admin = $this->adminModel->getAdminByUsername($username);

        if ($admin) {
            // Verify password
            if (password_verify($password, $admin['PASS_HASH'])) {
                // Store session data
                $sessionData = [
                    'ADMIN_ID' => $admin['ADMIN_ID'],
                    'ADMIN_NAME' => $admin['ADMIN_NAME'],
                    'ISLOGGEDIN' => true
                ];
                $session->set($sessionData);

                // Redirect to dashboard or home
                return redirect()->to('/dashboard');
            } else {
                // Wrong password
                $session->setFlashdata('error', 'Incorrect password.');
                return redirect()->back()->withInput();
            }
        } else {
            // No user found
            $session->setFlashdata('error', 'No account found with that username.');
            return redirect()->back()->withInput();
        }
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
