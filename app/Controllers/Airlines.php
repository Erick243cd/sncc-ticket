<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AirlineModel;
use App\Models\CountryModel;

class Airlines extends BaseController
{
    private $validation;
    private $airlineModel;
    private $countryModel;
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->airlineModel = new AirlineModel();
        $this->countryModel = new CountryModel();
        helper('form, custom');
    }

    public function index()
    {
        if (!is_logged()) return redirect()->to('/login');

        $data = [
            'airlines' => $this->airlineModel->asObject()
                ->join('ph_countries', 'ph_countries.ctry_id=ph_airlines.country_id')
                ->orderBy('airline_id', 'DESC')
                ->paginate(10),
            'user_data' => session()->get('user_data'),
            'pager' => $this->airlineModel->pager
        ];
        return view('airlines/index', $data);
    }

    public function create(){
        if (!is_logged()) return redirect()->to('/login');
        $data = [];
        $data['validation'] = null;
        $data['user_data'] = session()->get('user_data');
        $data['countries'] = $this->countryModel->asObject()->orderBy('ctry_name', 'ASC')->findAll();

        if ($this->request->getMethod() == 'post') {
            $this->validation->setRules([
                'ctry_id' => [
                    'label' => 'Country',
                    'rules' => 'required'
                ],
                'airline_name' => [
                    'label' => 'Airline Name',
                    'rules' => 'required|is_unique[ph_airlines.airline_name]'
                ],
                'airline_email' => [
                    'label' => 'Airline Email',
                    'rules' => 'required|is_unique[ph_airlines.airline_email]|valid_email'
                ],
                'airline_phone' => [
                    'label' => 'Airline Phone',
                    'rules' => 'required'
                ],
                'airline_description' => [
                    'label' => 'Airline Description',
                    'rules' => 'required|min_length[10]|max_length[500]'
                ],
                'airline_picture' => [
                    'label' => 'Image',
                    'rules' => 'uploaded[airline_picture]|max_size[airline_picture, 4096]|is_image[airline_picture]'
                ]
            ]);
            if ($this->validation->withRequest($this->request)->run()) {

                $temp_path = './assets/images/airlines/temp';//Temporary Path before Fit image
                $real_path = './assets/images/airlines';//Real Path after Fit image
                $file = $this->request->getFile('airline_picture');
                $imageName = $file->getRandomName();

                if ($file->isValid() && !$file->hasMoved()) {
                    $file->move($temp_path, $imageName);
                    // resizing image
                    \Config\Services::image()->withFile($temp_path . '/' . $imageName)
                        ->fit(600, 360, 'center')
                        ->save($real_path . '/' . $imageName);

                    $data = [
                        'country_id' => $this->request->getVar('ctry_id'),
                        'airline_name' => $this->request->getVar('airline_name'),
                        'airline_description' => $this->request->getVar('airline_description'),
                        'airline_email' => $this->request->getVar('airline_email'),
                        'airline_contact_number' => $this->request->getVar('airline_phone'),
                        'airline_picture' => $imageName
                    ];

                    $this->airlineModel->save($data);

                    session()->setFlashdata('success', 'Airline has been created succesffuly');
                    return redirect()->to('/airlines');
                }

            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        echo view('airlines/add', $data);
    }
    function refreshNow()
    {
        return refresh();
    }

    public function edit($airline_id){
        if (!is_logged()) return redirect()->to('/login');

        $data['user_data'] = session()->get('user_data');
        $data['countries'] = $this->countryModel->asObject()->orderBy('ctry_name', 'ASC')->findAll();

        $data["airline"] = $this->airlineModel->asObject()
            ->join('ph_countries', 'ph_airlines.country_id=ph_countries.ctry_id')
            ->where('ph_airlines.airline_id', $airline_id)->first();
        if ($data["airline"] !== null){
            echo view('airlines/edit', $data);
        }else{
            return view('errors/err_404');
        }
    }

    public function update(){
        $data = [];
        $data['validation'] = null;
        $data['user_data'] = session()->get('user_data');
        $this->validation->setRules([
            'ctry_id' => [
                'label' => 'Country',
                'rules' => 'required'
            ],
            'airline_name' => [
                'label' => 'Airline Name',
                'rules' => 'required'
            ],
            'airline_email' => [
                'label' => 'Airline Email',
                'rules' => 'required'
            ],
            'airline_phone' => [
                'label' => 'Airline Phone',
                'rules' => 'required'
            ],
            'airline_description' => [
                'label' => 'Airline Description',
                'rules' => 'required|min_length[10]|max_length[500]'
            ],
        ]);

        $airline_id = $this->request->getVar('airline_id');
        if ($this->validation->withRequest($this->request)->run()) {
            $data = [
                'country_id' => $this->request->getVar('ctry_id'),
                'airline_name' => $this->request->getVar('airline_name'),
                'airline_description' => $this->request->getVar('airline_description'),
                'airline_email' => $this->request->getVar('airline_email'),
                'airline_contact_number' => $this->request->getVar('airline_phone'),
            ];
            $this->airlineModel->where('airline_id',$airline_id)->set($data)->update();

            session()->setFlashdata('success', "Airline Has been Updated succesfully");
            return redirect()->to('/airlines');
        } else {
            $data['validation'] = $this->validation->getErrors();
        }
        return redirect()->to('airlines/edit/'.$airline_id);
    }
}
