<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CityModel;
use App\Models\CountryModel;


class Cities extends BaseController
{
    private $cityModel;
    private $validation;
    private $countryModel;

    public function __construct()
    {
        $this->cityModel = new CityModel();
        $this->countryModel = new CountryModel();
        $this->validation = \Config\Services::validation();
        helper('form, custom');
    }

    public function index()
    {
        if (!is_logged()) return redirect()->to('/login');

        $data = [
            'cities' => $this->cityModel->asObject()
                ->join('ph_countries', 'ph_countries.ctry_id=ph_cities.country_id')
                ->orderBy('city_id', 'DESC')
                ->paginate(10),
            'user_data' => session()->get('user_data'),
            'pager' => $this->cityModel->pager
        ];
        return view('cities/index', $data);
    }

    public function create()
    {
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
                'city_name' => [
                    'label' => 'City Name',
                    'rules' => 'required|is_unique[ph_cities.city_name]'
                ],
                'city_picture' => [
                    'label' => 'Image',
                    'rules' => 'uploaded[city_picture]|max_size[city_picture, 4096]|is_image[city_picture]'
                ]
            ]);
            if ($this->validation->withRequest($this->request)->run()) {

                $temp_path = './assets/images/cities/temp';//Temporary Path before Fit image
                $real_path = './assets/images/cities';//Real Path after Fit image
                $file = $this->request->getFile('city_picture');
                $imageName = $file->getRandomName();

                if ($file->isValid() && !$file->hasMoved()) {
                    $file->move($temp_path, $imageName);
                    // resizing image
                    \Config\Services::image()->withFile($temp_path . '/' . $imageName)
                        ->fit(600, 400, 'center')
                        ->save($real_path . '/' . $imageName);

                    $data = [
                        'country_id' => $this->request->getVar('ctry_id'),
                        'city_name' => $this->request->getVar('city_name'),
                        'city_pircture' => $imageName
                    ];

                    $this->cityModel->save($data);

                    session()->setFlashdata('success', 'City has been created succesffuly');
                    return redirect()->to('/cities');
                }

            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        echo view('cities/add', $data);
    }

    function edit($city_id)
    {

        if (!is_logged()) return redirect()->to('/login');
        $data['user_data'] = session()->get('user_data');
        $data['countries'] = $this->countryModel->asObject()->orderBy('ctry_name', 'ASC')->findAll();

        $data["city"] = $this->cityModel->asObject()
            ->join('ph_countries', 'ph_cities.country_id=ph_countries.ctry_id')
            ->where('city_id', $city_id)->first();
        if ($data["city"] !== null) {

            echo view('cities/edit', $data);

        } else {
            return view('errors/err_404');
        }
    }

    function refreshNow()
    {
        return refresh();
    }

    function update()
    {
        if (!is_logged()) return redirect()->to('/login');
        $data = [];
        $data['validation'] = null;
        $data['user_data'] = session()->get('user_data');
        $this->validation->setRules([
            'ctry_id' => [
                'label' => 'Country',
                'rules' => 'required'
            ],
            'city_name' => [
                'label' => 'City Name',
                'rules' => 'required'
            ]
        ]);

        $city_id = $this->request->getVar('city_id');
        if ($this->validation->withRequest($this->request)->run()) {
            $data = [
                'country_id' => $this->request->getVar('ctry_id'),
                'city_name' => $this->request->getVar('city_name')
            ];
            $this->cityModel->where('city_id', $city_id)->set($data)->update();

            session()->setFlashdata('success', "City Has been Updated succesfully");
            return redirect()->to('/cities');
        } else {
            $data['validation'] = $this->validation->getErrors();
        }
        return redirect()->to('cities/edit/' . $city_id);
    }

}
