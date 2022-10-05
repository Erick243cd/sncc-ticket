<?php
//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
namespace App\Controllers;

use App\Models\TripModel;
use App\Models\UserModel;
use App\Models\BookingModel;

class Pages extends BaseController
{
    private $userModel;
    private $bookingModel;
    private $tripModel;
    public function __construct()
    {
        helper('form,custom');
        $this->bookingModel = new BookingModel();
        $this->userModel = new UserModel();
        $this->tripModel = new TripModel();
    }

    public function views($page = 'home'){
//        if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
//
//            return view('errors/err_404');
//        }

        $data['title'] = ucfirst($page);
        if ($page === "home"){
            $tripModel= new TripModel();
            $data['cities'] = $tripModel->orderBy('city_name', 'ASC')
                                          ->join("ph_cities", "ph_trips.city_from_id = ph_cities.city_id")
                                          ->groupBy('city_name')
                                          ->findAll();
        }
        return view('pages/'.$page, $data);
    }

    function dashboard(){
        $data = [
            'travellers'=>$this->userModel->where('user_role', 'traveller')->countAll(),
            'users'=>$this->userModel->where('user_role', 'admin')->countAll(),
            'bookings'=>$this->bookingModel->where('bk_status', 1)->countAll(),
            'trips'=>$this->tripModel->where('trip_status', 1)->countAll()
        ];
        $data['user_data'] = session()->get('user_data');
        if ($data['user_data'] == null){
            return redirect()->to('/login');
        }
        $data['title'] = "Dashboard";
        echo view('dashboard/index', $data);
    }
    
    function refreshNow(){
        return refresh();
    }
}
