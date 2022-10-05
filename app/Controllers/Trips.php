<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AirlineModel;
use App\Models\TripModel;
use App\Models\TrajetModel;
use App\Models\CityModel;
use CodeIgniter\Exceptions\PageNotFoundException;

/*
 * Trips Manager Controller
 */


class Trips extends BaseController
{
    private $validation;
    private $tripModel;
    private $trajetModel;
    private $cityModel;
    private $airlineModel;

    public function __construct()
    {
        helper('form, text');
        $this->validation = \Config\Services::validation();
        $this->tripModel = new TripModel();
        $this->trajetModel = new TrajetModel();
        $this->cityModel = new CityModel();
        $this->airlineModel = new AirlineModel();
    }


    public function index()
    {
        if (!is_logged()) return redirect()->to('/login');
        $data = [
            'trips' => $this->tripModel->asObject()
                ->orderBy('trip_id', "DESC")
                ->join('ph_cities', 'ph_cities.city_id=ph_trips.city_to_id')
                ->join('ph_airlines', 'ph_airlines.airline_id=ph_trips.airline_id')
                ->paginate(10),
            'pager' => $this->tripModel->pager,
            'user_data' => session()->get('user_data')
        ];
        return view('trips/index', $data);

    }

    public function searchOneaway()
    {
        $wheres = ['trip_status' => 1];
        $data['trips'] = $this->tripModel->asObject()
            ->orderBy('depart_date', "ASC")
            ->join('ph_cities', 'ph_cities.city_id=ph_trips.city_to_id')
            // ->join('ph_airlines', 'ph_airlines.airline_id=ph_trips.airline_id')
            ->where($wheres)
            ->findAll();

        $session = session();

        $newdata = [
            'city_from_id' => 1,
            'city_to_id' => 1,
            'trip_category' => 1,
            'depart_date' => date('Y-d-m'),
            'return_date' => date('Y-d-m'),
            'adult_number' => 1,
            'child_number' => 0,
            'infants_number' => 0,
            'caoch' => 1,
        ];

        $session->set('flight_data', $newdata);
        return view('trips/list', $data);

    }
    //return view('trips/list', $data);//


    /*
     * Show more detail for trip
     */
    public function viewmore($trip_id)
    {
        $data = [
            'trip' => $this->tripModel->asObject()
                ->join('ph_cities', 'ph_cities.city_id=ph_trips.city_to_id')
                ->join('ph_airlines', 'ph_airlines.airline_id=ph_trips.airline_id')
                ->where("trip_id", $trip_id)
                ->first(),
            'from' => $this->tripModel->asObject()
                ->join('ph_cities', 'ph_cities.city_id=ph_trips.city_from_id')
                ->where("trip_id", $trip_id)
                ->first(),
            'session_data' => session()->get('flight_data'),
            'user_data' => session()->get('user_data'),
            'trip_sess' => session()->get('trip_id')
        ];

        if (!empty($data['trip'])) {
            echo view('trips/detail', $data);
        } else {
            return view('errors/err_404');
        }
    }

    function create()
    {
        if (!is_logged()) return redirect()->to('/login');
        $data = [
            'user_data' => session()->get('user_data'),
            'cities' => $this->cityModel->asObject()->orderBy('city_name', 'ASC')->findAll(),
            'airlines' => $this->airlineModel->asObject()->orderBy('airline_name', 'ASC')->findAll()
        ];
        if ($this->request->getMethod() == 'post') {
            $this->validation->setRules([
                'city_to' => [
                    'label' => 'Departure',
                    'rules' => 'required'
                ],
                'city_from' => [
                    'label' => 'Destination',
                    'rules' => 'required'
                ],

                'depart_date' => [
                    'label' => 'Dapart Date',
                    'rules' => 'required'
                ],
                'takeoff_time' => [
                    'label' => 'Take Off',
                    'rules' => 'required'
                ],

                'start_depart' => [
                    'label' => 'Lieu de départ',
                    'rules' => 'required'
                ],
                'place_numbers' => [
                    'label' => 'Nombre de place',
                    'rules' => 'required|numeric'
                ],
                'price_by_place' => [
                    'label' => 'Prix par place',
                    'rules' => 'required|numeric'
                ],
                'airline_id' => [
                    'label' => 'Airline',
                    'rules' => 'required'
                ],
            ]);
            if ($this->validation->withRequest($this->request)->run()) {
                $data = array(
                    'city_from_id' => $this->request->getVar('city_from'),
                    'city_to_id' => $this->request->getVar('city_to'),
                    'depart_date' => $this->request->getVar('depart_date'),
                    'price_by_place' => $this->request->getVar('price_by_place'),
                    'start_depart' => $this->request->getVar('start_depart'),
                    'place_numbers' => $this->request->getVar('place_numbers'),
                    'take_off' => $this->request->getVar('takeoff_time'),
                    'airline_id' => $this->request->getVar('airline_id'),
                    'trip_status' => 1
                );

                $this->tripModel->save($data);
                session()->setFlashdata('success', 'Le voyage a été enregistré avec succès');
                return redirect()->to('/trips');
            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        return view('trips/add', $data);
    }

    function more($trip_id)
    {
        if (!is_logged()) return redirect()->to('/login');

        $data = [
            'trip' => $this->tripModel->asObject()
                ->join('ph_cities', 'ph_cities.city_id=ph_trips.city_to_id')
                ->join('ph_airlines', 'ph_airlines.airline_id=ph_trips.airline_id')
                ->where("trip_id", $trip_id)->first(),
            'city_from' => $this->tripModel->asObject()
                ->join('ph_cities', 'ph_cities.city_id=ph_trips.city_from_id')
                ->where("trip_id", $trip_id)->first(),
            'user_data' => session()->get('user_data')
        ];

        if (!empty($data['trip']) && !empty($data['city_from'])) {
            echo view('trips/more_admin', $data);
        } else {
            return view('errors/err_404');
        }
    }

    function edit($trip_id)
    {
        if (!is_logged()) return redirect()->to('/login');
        $data = [
            'trip' => $this->tripModel->asObject()->join('ph_cities', 'ph_cities.city_id=ph_trips.city_to_id')->join('ph_airlines', 'ph_airlines.airline_id=ph_trips.airline_id')->where("trip_id", $trip_id)->first(),
            'city_from' => $this->tripModel->asObject()->join('ph_cities', 'ph_cities.city_id=ph_trips.city_from_id')->where("trip_id", $trip_id)->first(),
            'airlines' => $this->airlineModel->asObject()->orderBy('airline_name', 'ASC')->findAll(),
            'cities' => $this->cityModel->asObject()->orderBy('city_name', 'ASC')->findAll(),
            'user_data' => session()->get('user_data')
        ];

        if (!empty($data['trip']) && !empty($data['city_from'])) {
            if ($this->request->getMethod() == 'post') {
                $this->validation->setRules([
                    'city_to' => [
                        'label' => 'Departure',
                        'rules' => 'required'
                    ],
                    'city_from' => [
                        'label' => 'Destination',
                        'rules' => 'required'
                    ],
                    'trip_category' => [
                        'label' => 'Flight Category',
                        'rules' => 'required'
                    ],
                    'depart_date' => [
                        'label' => 'Dapart Date',
                        'rules' => 'required'
                    ],
                    'takeoff_time' => [
                        'label' => 'Take Off',
                        'rules' => 'required'
                    ],
                    'landing_time' => [
                        'label' => 'Landing',
                        'rules' => 'required'
                    ],
                    'flight_stops' => [
                        'label' => 'Stop number',
                        'rules' => 'required|integer'
                    ],
                    'total_time' => [
                        'label' => 'Total time',
                        'rules' => 'required'
                    ],
                    'first_price' => [
                        'label' => 'First class Price',
                        'rules' => 'required|numeric'
                    ],
                    'economic_price' => [
                        'label' => 'Economic class Price',
                        'rules' => 'required|numeric'
                    ],
                    'premium_price' => [
                        'label' => 'Premium class Price',
                        'rules' => 'required|numeric'
                    ],
                    'business_price' => [
                        'label' => 'Business class Price',
                        'rules' => 'required|numeric'
                    ],
                    'fixed_price_child_premium' => [
                        'label' => 'Child Business class Price',
                        'rules' => 'required|numeric'
                    ],
                    'fixed_price_child_economic' => [
                        'label' => 'Child Economic class Price',
                        'rules' => 'required|numeric'
                    ],
                    'fixed_price_child_business' => [
                        'label' => 'Child Business class Price',
                        'rules' => 'required|numeric'
                    ],
                    'fixed_price_child_first' => [
                        'label' => 'Child First class Price',
                        'rules' => 'required|numeric'
                    ],
                    'fixed_price_infant' => [
                        'label' => 'Infant First class Price',
                        'rules' => 'required|numeric'
                    ],
                    'airline_id' => [
                        'label' => 'Airline',
                        'rules' => 'required'
                    ],
                    'condition_fly' => [
                        'label' => 'Airline',
                        'rules' => 'required|max_length[1000]'
                    ],
//                    'return_date' => [
//                        'label' => 'Return date',
//                        'rules' => 'required'
//                    ],
                ]);
                if ($this->validation->withRequest($this->request)->run()) {
                    $data = array(
                        'city_from_id' => $this->request->getVar('city_from'),
                        'city_to_id' => $this->request->getVar('city_to'),
                        'depart_date' => $this->request->getVar('depart_date'),
                        'return_date' => $this->request->getVar('return_date'),
                        'duration' => $this->request->getVar('total_time'),
                        'take_off' => $this->request->getVar('takeoff_time'),
                        'landing' => $this->request->getVar('landing_time'),
                        'total_time' => $this->request->getVar('total_time'),
                        'trip_categorie' => $this->request->getVar('trip_category'),
                        'arrival_date' => null,
                        'fixed_price_premium_class' => $this->request->getVar('premium_price'),
                        'fixed_price_economic_price' => $this->request->getVar('economic_price'),
                        'fixed_price_business_class' => $this->request->getVar('business_price'),
                        'fixed_price_first_class' => $this->request->getVar('first_price'),

                        'fixed_price_child_premium' => $this->request->getVar('fixed_price_child_premium'),
                        'fixed_price_child_economic' => $this->request->getVar('fixed_price_child_economic'),
                        'fixed_price_child_business' => $this->request->getVar('fixed_price_child_business'),
                        'fixed_price_child_first' => $this->request->getVar('fixed_price_child_first'),

                        'fixed_price_infant' => $this->request->getVar('fixed_price_infant'),
                        'airline_id' => $this->request->getVar('airline_id'),
                        'nb_stop' => $this->request->getVar('flight_stops'),
                        'conditions' => $this->request->getVar('condition_fly')
                    );

                    $this->tripModel->where('trip_id', $trip_id)->set($data)->update();
                    session()->setFlashdata('success', 'The Flight has been updated succefully');
                    return redirect()->to('/trips');
                } else {
                    $data['validation'] = $this->validation->getErrors();
                }
            }
            echo view('trips/edit', $data);

        } else {
            return view('errors/err_404');
        }
    }

    function desactivate($trip_id = null)
    {
        if (!is_logged()) return redirect()->to('/login');
        $trip = $this->tripModel->where("trip_id", $trip_id)->first();
        if (!empty($trip)) {
            $data = ['trip_status' => 0];
            $this->tripModel->where('trip_id', $trip_id)->set($data)->update();
            session()->setFlashdata('success', 'The Flight has been updated succefully');
            return redirect()->to('/trips');
        } else {
            return view('errors/err_404');
        }
    }

    function activate($trip_id = null)
    {
        if (!is_logged()) return redirect()->to('/login');

        $trip = $this->tripModel->where("trip_id", $trip_id)->first();
        if (!empty($trip)) {
            $data = ['trip_status' => 1];
            $this->tripModel->where('trip_id', $trip_id)->set($data)->update();
            session()->setFlashdata('success', 'The Flight has been updated succefully');
            return redirect()->to('/trips');
        } else {
            return view('errors/err_404');
        }
    }

    /*
     * V1.2 Futures
     */
    function managebook($trip_id = null)
    {
        $data = [
            'trip' => $this->tripModel->asObject()
                ->join('ph_cities', 'ph_cities.city_id=ph_trips.city_to_id')
                ->join('ph_airlines', 'ph_airlines.airline_id=ph_trips.airline_id')
                ->where("trip_id", $trip_id)
                ->first(),

            'from' => $this->tripModel->asObject()
                ->join('ph_cities', 'ph_cities.city_id=ph_trips.city_from_id')
                ->where("trip_id", $trip_id)
                ->first(),
            'session_data' => session()->get('flight_data'),
            'user_data' => session()->get('user_data')
        ];

        if (!empty($data['trip'])) {
            echo view('trips/manage_book', $data);
        } else {
            return view('errors/err_404');
        }
    }

    function passengersData()
    {
        if ($this->request->getMethod() == 'post') {
            $data = [
                'trip_id' => session()->get('trip_id'),
                'flydata' => session()->get('flight_data'),
                'trip' => $this->tripModel->asObject()->where('trip_id', session()->get('trip_id'))->first(),
                'post' => $this->request->getVar()
            ];

            $child_price = 0;
            $total_for_child = 0;
            $adult_price = 0;
            $total_for_adult = 0;
            $infant_price = 0;
            $total_for_infant = 0;
            if ($this->request->getVar('child_class') !== null) {
                foreach ($this->request->getVar('child_class') as $key => $value) {
                    switch ($value) {
                        case 'Business':
                            $child_price = $data['trip']->fixed_price_child_business;
                            break;
                        case 'First class':
                            $child_price = $data['trip']->fixed_price_child_first;
                            break;
                        case 'Economy':
                            $child_price = $data['trip']->fixed_price_child_economic;
                            break;
                        case 'Premium':
                            $child_price = $data['trip']->fixed_price_child_premium;
                    }
                    $total_for_child += $child_price;
                }
            }
            if ($this->request->getVar('adult_class') !== null) {
                foreach ($this->request->getVar('adult_class') as $key => $value) {
                    switch ($value) {
                        case 'Business':
                            $adult_price = $data['trip']->fixed_price_business_class;
                            break;
                        case 'First class':
                            $adult_price = $data['trip']->fixed_price_first_class;
                            break;
                        case 'Economy':
                            $adult_price = $data['trip']->fixed_price_economic_price;
                            break;
                        case 'Premium':
                            $adult_price = $data['trip']->fixed_price_premium_class;
                    }
                    $total_for_adult += $adult_price;
                }
            }

            if ($this->request->getVar('infant_firstname') !== null) {
                foreach ($this->request->getVar('infant_firstname') as $item) {
                    $infant_price = $data['trip']->fixed_price_infant;
                    $total_for_infant += $infant_price;
                }
            }

            $totalPrices = [
                'total_for_adult' => $total_for_adult,
                'total_for_child' => $total_for_child ?? 0,
                'total_for_infant' => $total_for_infant ?? 0
            ];

            session()->set('passengers', $data['post']);
            session()->set('totalPrices', $totalPrices);

            return redirect()->to('trips/viewmore/' . $data['trip_id']);
        } else {
            return view('errors/err_404');
        }
    }


}
