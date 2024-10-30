<?php

namespace App\Controllers;
use App\Models\ProfileModel;
use App\Models\ProfileHandlerModel;

class Home extends BaseController
{
    protected $profileModel;
    protected $profileHandlerModel;

    public function __construct()
    {
        helper(['session', 'url']); // Load session and URL helpers
        $this->profileModel = new ProfileModel();
        $this->profileHandlerModel = new ProfileHandlerModel();
    }

    public function index()
    {
        $profiledata = $this->profileModel->asArray()->findAll();
        $profilehandlers = $this->profileHandlerModel->asArray()->findAll();
        $data = [
            "profiledata" => $profiledata,
            "profilehandlers" => $profilehandlers,
        ];

        return view('home', $data);
    }

    public function editProfile($id)
    {
        $profile = $this->request->getPost('id');

        // echo ($profile);

        if ($profile) {
            $data = [
                'ID' => $this->request->getPost('id'),
                'PROFILE_NAME' => $this->request->getPost('profile_name'),
                'PROFILE_ADMIN' => $this->request->getPost('profile_owner'),
                'PROFILE_HANDLER' => $this->request->getPost('writer'),
                'INSTITUTION' => $this->request->getPost('institution'),
                'MAJOR' => $this->request->getPost('major'),
                'TOTAL_COURSES' => $this->request->getPost('courses'),
                'GENDER' => $this->request->getPost('gender'),
                'STATUS' => $this->request->getPost('status'),
            ];

            // Attempt to update the profile
            if ($this->profileModel->update($profile, $data)) {
                return redirect()->to('/')->with('success', 'Profile updated successfully.');
            } else {
                // If update fails, provide error feedback
                return redirect()->back()->with('error', 'Failed to update profile. Please try again.');
            }


        }

        return redirect()->to('/')->with('error', 'Profile not found.');
    }
    public function deleteProfile()
    {
        // Get the profile ID from the POST data
        $id = $this->request->getPost('id');

        // Check if the profile exists before attempting to delete
        if ($this->profileModel->where('ID', $id)->delete()) {
            return redirect()->to('/')->with('success', 'Profile deleted successfully.');
        }

        // If profile not found, redirect with an error message
        return redirect()->to('/')->with('error', 'Profile not found.');

    }

    public function saveProfile()
    {
        // Validate incoming request
        $validation = $this->validate([
            'profile_name' => 'required',
            'profile_owner' => 'required',
            'writer' => 'required',
            'institution' => 'required',
            'major' => 'required',
            'gender' => 'required|in_list[0,1]',
            'status' => 'required|in_list[Active,Inactive,Terminated]',
        ]);

        if (!$validation) {
            // Validation failed, redirect with input and errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Collect form data
        $data = [
            'PROFILE_NAME' => $this->request->getPost('profile_name'),
            'PROFILE_ADMIN' => $this->request->getPost('profile_owner'),
            'PROFILE_HANDLER' => $this->request->getPost('writer'),
            'INSTITUTION' => $this->request->getPost('institution'),
            'MAJOR' => $this->request->getPost('major'),
            'TOTAL_COURSES' => $this->request->getPost('courses'),
            'GENDER' => $this->request->getPost('gender'),
            'STATUS' => $this->request->getPost('status'),
        ];

        // Save data using the model
        if ($this->profileModel->save($data)) {
            return redirect()->to('/')->with('success', 'Profile saved successfully.');
        } else {
            return redirect()->to('/')->with('error', 'Failed to save profile. Please try again.');
        }
    }

}
