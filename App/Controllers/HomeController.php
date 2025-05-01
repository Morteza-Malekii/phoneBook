<?php

namespace App\Controllers;

use App\Models\Contact;

class HomeController
{
    private $contactModel;

    public function __construct()
    {
        $this->contactModel = new Contact();
    }

    public function index()
    {
        global $request;
        if (!is_null($request->input('s')))
        {
            $search_keyword = $request->input('s');
            $where = [
                "OR" => [
                    "name[~]" => $search_keyword,
                    "mobile[~]" => $search_keyword,
                    "email[~]" => $search_keyword
                ]];
        }
        $where["ORDER"] = ['id'=>"DESC"];
        $countRows = $this->contactModel->countRows();
        $data = [
                'contacts' => $this->contactModel->get('*',$where),
                'totalItems' => $countRows,
                'itemsPerPage' => $this->contactModel->itemsPerPage,
                'visiblePage' => $this->contactModel->visiblePages
            ];
            view('home.index',$data);
        }
    }


    // $faker = \Faker\Factory::create();
    // for($i=0;$i<200;$i++)
    // {
    //     $this->contactModel->create([
    //         'name'=>$faker->name(),
    //         'email'=>$faker->email(),
    //         'mobile'=>$faker->phoneNumber()
    //     ]);
    // }