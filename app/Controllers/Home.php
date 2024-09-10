<?php

namespace App\Controllers;
use App\Models\ProfileModel;
use App\Models\ProfileHandlerModel;


class Home extends BaseController
{

    protected $profileModel ;
    protected $profileHandlerModel;


    public function __construct()
    {
         helper(['session']); // Load session helper

        // Initialize the service model in the constructor
        $this->profileModel = new ProfileModel();

        $this->profileHandlerModel =  new ProfileHandlerModel();
    }
    public function index()
    {
        $profiledata = $this->profileModel->asArray()->findAll();

        $profilehandlers = $this->profileHandlerModel->asArray()->findAll();


        $data = array("profiledata" => $profiledata, "profilehandlers" => $profilehandlers,);


        return view('home', $data);
    }

    public function saveprofile()
    {
        // Load the ProfileModel
        $profileModel = new ProfileModel();
        

        // Validate form data (optional, add rules as per your requirements)
        $validation = \Config\Services::validation();

        // Get the form data
        $data = [
            'PROFILE_NAME'     => $this->request->getPost('profile_name'),
            'PROFILE_ADMIN'    => $this->request->getPost('profile_owner'),
            'PROFILE_HANDLER'  => $this->request->getPost('writer'),
            'INSTITUTION'      => $this->request->getPost('institution'),
            // Add any other fields you need to save
        ];

        $validation->setRules([
            'PROFILE_NAME'    => 'required',
            'PROFILE_ADMIN'   => 'required',
            'PROFILE_HANDLER' => 'required',
            'INSTITUTION'     => 'required',
        ]);

        if ($validation->run($data)) {
            // Save the data to the database
            $profileModel->save($data);

            // Set success message and redirect
            return redirect()->back()->with('success', 'Profile added successfully.');
        } else {
            // Validation failed, show errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    }
}
