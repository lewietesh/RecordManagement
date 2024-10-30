<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;

class Settings extends Controller
{
    protected $adminModel;
    protected $session;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->session = session();
        helper(['url', 'form']);
    }

    /**
     * Display the settings page.
     */
    public function index()
    {
        // Retrieve the admin's data from session or database
        $adminId = $this->session->get('ADMIN_ID');
        $admin = $this->adminModel->find($adminId);

        // Pass admin data to the view
        return view('settings', ['admin' => $admin]);
    }

    /**
     * Update the admin's password.
     */
    public function updatePassword()
    {
        $adminId = $this->session->get('ADMIN_ID');
        
        // Validate form inputs
        $validation = \Config\Services::validation();
        $validation->setRules([
            'current_password' => 'required',
            'new_password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, redirect back with errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Check current password
        $admin = $this->adminModel->find($adminId);
        $currentPassword = $this->request->getPost('current_password');
        
        if (!password_verify($currentPassword, $admin['PASS_HASH'])) {
            // Incorrect current password
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Update the password
        $newPassword = $this->request->getPost('new_password');
        $hash = password_hash($newPassword, PASSWORD_BCRYPT);

        // Update password in the database
        $this->adminModel->update($adminId, ['PASS_HASH' => $hash]);

        // Set success message and redirect back to settings page
        return redirect()->to('/settings')->with('success', 'Password updated successfully.');
    }
}
