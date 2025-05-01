<?php

namespace App\Controllers;

use App\Models\Contact;
use App\Utility\Validator;

class ContactController
{
    private $contactModel;

    public function __construct()
    {
        $this->contactModel = new Contact();
    }

    public function add()
    {
        #validation fields
        global $request;
        $data = $request->params();
        $validator = $this->validateInpute($data);
        if ($validator->fails())
            {
                $errors = $validator->errors();
                $this->renderError($errors);
            }
        #check moblile is exsist?
        if($this->contactModel->existsBy('mobile',$data['phone']))
            $this->renderError('phone number already exists!');
        if($this->contactModel->existsBy('email',$data['email']))
            $this->renderError('email already exists!');
        #add contact
        $created = $this->contactModel->create([
            'name'=>$data['name'],
            'mobile'=>$data['phone'],
            'email'=>$data['email']
        ]);
        if ($created)
            $this->renderSucsess('contact is sucsessfully created.');
    }

    private function renderError($message)
    {
        view('contact.addResult' , ['message'=>$message]);
        die();
    }
    
    private function renderSucsess($message)
    {
        view('contact.addResult' , ['message'=>$message]);
        die();
    }

    private function validateInpute($data)
    {
        $validator = new Validator($data);
        $validator->required('name')
                        ->alpha('name')
                        ->required('email')
                        ->email('email')
                        ->required('phone')
                        ->digits('phone');
        return $validator;
    }
}

