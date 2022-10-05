<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\TripModel;
use App\Models\TrajetModel;
use App\Models\UserModel;
use App\Models\PassengerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Bookings extends BaseController
{
    private $bookingModel;
    private $userModel;
    private $tripModel;
    private $validation;
    private $email;
    private $passengerModel;


    public function __construct()
    {
        $this->tripModel = new TripModel();
        $this->bookingModel = new BookingModel();
        $this->userModel = new UserModel();
        $this->passengerModel = new PassengerModel();
        helper('form, custom');
        $this->validation = \Config\Services::validation();
        $this->email = \Config\Services::email();


    }

    function index($trip_id = null)
    {
        $fly_data = session()->get('flight_data');

        $user_data = session()->get('user_data');

        if (empty($fly_data) || empty($user_data)) {

            return view('errors/error_redirect');

        } else {

            if ($this->request->getMethod() == 'post') {
                $trip_id = $this->request->getVar('trip_id');
            }
            $data['cityfrom'] = $this->tripModel->asObject()
                ->join("ph_cities", "ph_trips.city_from_id = ph_cities.city_id")//Differences
                ->where('trip_id', $trip_id)
                ->first();

            $data['cityto'] = $this->tripModel->asObject()
                ->join("ph_cities", "ph_trips.city_to_id = ph_cities.city_id")//Differences
                ->join("ph_airlines", "ph_trips.airline_id = ph_airlines.airline_id")//Differences
                ->where('trip_id', $trip_id)
                ->first();

            $data['sess_data'] = session()->get('flight_data');

            echo view('bookings/index', $data);

        }

    }

    function logforbook()
    {

        return redirect()->to('/login');
    }

    /*
     * Booking function
     */
    function booknow()
    {
        $tripid = $this->request->getVar('trip_id');
        $fly_sess_data = session()->get('flight_data');
        $user_sess_data = session()->get('user_data');
        //$passengers = session()->get('passengers');

        if (empty($tripid) || empty($fly_sess_data) || empty($user_sess_data)) {
            return view('errors/error_redirect');
        }

        $flying = $this->tripModel->asObject()
            ->where('trip_id', $tripid)
            ->first();

        $child_number = $fly_sess_data['child_number'];

        // + $total_children + $taxe + $fee;
        $pinr = 'SNCC' . rand(88888, 999999) . 'PINCD';
        $data = array(
            'trip_id' => $tripid,
            'user_id' => $user_sess_data['user_id'],
            'booking_date' => date('Y-m-d H:i:s'),
            'bk_nb_adult' => $this->request->getVar('adult_number'),
            'bk_nb_child' => $this->request->getVar('child_number'),
            'bk_nb_infant' => $this->request->getVar('infants_number'),
            'bk_caoch' => $fly_sess_data["caoch"],
            'bk_taxe' => 0,
            'bk_fee' => 0,
            'base_amount' => 0,//Base amount
//            'bk_child_amount' => 0,
//            'bk_infant_amount' => 0,
//            'bk_adult_amount' => 0,
//            'bk_total_amount' => 0,
            'transaction_mode' => $this->request->getVar('transact_mode') ?? null,
            'transaction_id' => $this->request->getVar('transact_id') ?? null,
            'bk_token' => $pinr
        );
        $this->bookingModel->save($data);
//        $passengerdata = [
//            'adult_firstname' => implode(',', $passengers['adult_firstname']),
//            'adult_lastname' => implode(',', $passengers['adult_lastname']),
//            'adult_gender' => implode(',', $passengers['adult_gender']),
//            'adult_class' => implode(',', $passengers['adult_class']),
//
//            'child_firstname' => (isset($passengers['child_firstname'])) ? implode(',', $passengers['child_firstname']) : null,
//            'child_lastname' => (isset($passengers['child_lastname'])) ? implode(',', $passengers['child_lastname']) : null,
//            'child_gender' => (isset($passengers['child_gender'])) ? implode(',', $passengers['child_gender']) : null,
//            'child_class' => (isset($passengers['child_class'])) ? implode(',', $passengers['child_class']) : null,
//
//            'infant_firstname' => (isset($passengers['infant_firstname'])) ? implode(',', $passengers['infant_firstname']) : null,
//            'infant_lastname' => (isset($passengers['infant_lastname'])) ? implode(',', $passengers['infant_lastname']) : null,
//            'infant_gender' => (isset($passengers['infant_gender'])) ? implode(',', $passengers['infant_gender']) : null,
//            'bk_pin' => $pinr
//        ];
//        $this->passengerModel->insert($passengerdata);
        return $this->destroysessions($pinr);
    }

    function destroysessions($pinr = null)
    {
        session()->set('trip_id', null);
        session()->set('flight_data', null);
        session()->set('passengers', null);
        session()->set('totalPrices', null);

        $session = session();
        $session->setFlashdata("success", "Félicitations, Votre demande de réservation a été envoyée, vous recevrez une notification dans quelques heures. ");
        $to = "gloriamuhemba845@gmail.com";
        $subject = "$pinr New reservation Command";
        $content = 'Vous avez une nouvelle demande de réservation, </br>
                PINR : ' . $pinr . ' </br>Vérifier votre panneau de contrôle.';

        $this->sendMailtoAdminReservation($to, $subject, $content);

        return redirect()->to('/profile');
    }

    function bookingstatus($booking_id)
    {
        $user_data = session()->get('user_data');
        if (!empty($booking_id) && !empty($user_data)) {

            $data["from"] = $this->bookingModel->asObject()
                ->join('ph_trips', 'ph_trips.trip_id=ph_bookings.trip_id')
                ->join('ph_cities', 'ph_trips.city_from_id=ph_cities.city_id')
                ->where(['ph_bookings.booking_id' => $booking_id, 'ph_bookings.user_id' => $user_data['user_id']])
                ->first();

            $data["booking"] = $this->bookingModel->asObject()
                ->orderBy('booking_id', 'DESC')
                ->join('ph_users', 'ph_bookings.user_id=ph_users.user_id')
                ->join('ph_trips', 'ph_trips.trip_id=ph_bookings.trip_id')
                ->join('ph_cities', 'ph_trips.city_to_id=ph_cities.city_id')
                ->join('ph_airlines', 'ph_trips.airline_id=ph_airlines.airline_id')
                ->where(['ph_bookings.booking_id' => $booking_id, 'ph_bookings.user_id' => $user_data['user_id']])
                ->first();

            if ($data["booking"] == null || $data["from"] == null) {
                return view('errors/err_404');
            } else {
                if ($data["booking"]->bk_status === "process") {
                    return view('bookings/process_status', $data);
                } elseif ($data["booking"]->bk_status === "confirm") {
                    return view('bookings/confirm_status', $data);
                } else {
                    return view('bookings/cancel_status', $data);
                }
            }
        } else {
            return view('errors/err_404');
        }
    }

    /*
     * Listing booking
     */
    function listbooking()
    {
        if (!is_logged()) return redirect()->to('/login');
        if ($this->request->getMethod() === 'post') {
            $data = [
                'user_data' => session()->get('user_data'),
                'bookings' => $this->bookingModel->asObject()
                    ->orderBy('booking_id', 'DESC')
                    ->join('ph_users', 'ph_bookings.user_id=ph_users.user_id')
                    ->join('ph_trips', 'ph_trips.trip_id=ph_bookings.trip_id')
                    ->join('ph_cities', 'ph_trips.city_to_id=ph_cities.city_id')
                    ->join('ph_airlines', 'ph_trips.airline_id=ph_airlines.airline_id')
                    ->where('bk_token', $this->request->getVar('pinr'))
                    ->paginate(6),

                'pager' => $this->bookingModel->pager
            ];

        } else {
            $data = [
                'user_data' => session()->get('user_data'),
                'bookings' => $this->bookingModel->asObject()
                    ->orderBy('booking_id', 'DESC')
                    ->join('ph_users', 'ph_bookings.user_id=ph_users.user_id')
                    ->join('ph_trips', 'ph_trips.trip_id=ph_bookings.trip_id')
                    ->join('ph_cities', 'ph_trips.city_to_id=ph_cities.city_id')
                    ->join('ph_airlines', 'ph_trips.airline_id=ph_airlines.airline_id')
                    ->paginate(3),

                'pager' => $this->bookingModel->pager
            ];
        }
        echo view('bookings/list', $data);
    }

    function adminMore($booking_id)
    {
        if (!is_logged()) return redirect()->to('/login');

        $data["from"] = $this->bookingModel->asObject()
            ->join('ph_trips', 'ph_trips.trip_id=ph_bookings.trip_id')
            ->join('ph_cities', 'ph_trips.city_from_id=ph_cities.city_id')
            ->where(['ph_bookings.bk_token' => $booking_id])
            ->first();

        $data["booking"] = $this->bookingModel->asObject()
            ->orderBy('booking_id', 'DESC')
            ->join('ph_users', 'ph_bookings.user_id=ph_users.user_id')
            ->join('ph_trips', 'ph_trips.trip_id=ph_bookings.trip_id')
            ->join('ph_cities', 'ph_trips.city_to_id=ph_cities.city_id')
            ->join('ph_airlines', 'ph_trips.airline_id=ph_airlines.airline_id')
            ->where(['ph_bookings.bk_token' => $booking_id])
            ->first();
        $data['user_data'] = session()->get('user_data');

        if ($data["booking"] == null || $data["from"] == null) {
            return view('errors/err_404');
        } else {
            return view('bookings/admin_more', $data);
        }
    }

    function confirmBooking($booking_id)
    {
        if (!is_logged()) return redirect()->to('/login');

        $data = [
            'booking' => $this->bookingModel->asObject()
                ->join('ph_users', 'ph_bookings.user_id=ph_users.user_id')
                ->join('ph_trips', 'ph_bookings.trip_id=ph_trips.trip_id')
                ->join('ph_cities', 'ph_trips.city_to_id=ph_cities.city_id')
                ->join('ph_countries', 'ph_countries.ctry_id = ph_cities.country_id')
                ->where('booking_id', $booking_id)->first(),
            'from' => $this->bookingModel->asObject()
                ->join('ph_trips', 'ph_bookings.trip_id=ph_trips.trip_id')
                ->join('ph_airlines', 'ph_airlines.airline_id=ph_trips.airline_id')
                ->join('ph_cities', 'ph_trips.city_from_id=ph_cities.city_id')
                ->join('ph_countries', 'ph_countries.ctry_id = ph_cities.country_id')
                ->where('booking_id', $booking_id)->first(),
            'confirmation' => [
                'ticket_number' => ($this->request->getVar('ticket_number') !== null) ? $this->request->getVar('ticket_number') : null,
                'rsv_number' => ($this->request->getVar('rsv_number') !== null) ? $this->request->getVar('rsv_number') : null,
                'psg_firstname' => ($this->request->getVar('psg_firstname') !== null) ? $this->request->getVar('psg_firstname') : null,
                'psg_lastname' => ($this->request->getVar('psg_lastname') !== null) ? $this->request->getVar('psg_lastname') : null,
            ],
            'user_data' => session()->get('user_data')
        ];
        if (!empty($data['booking'])) {
            $datas = [
                'bk_status' => 'confirm'
            ];
            $this->bookingModel->set($datas)->where('booking_id', $booking_id)->update();

            $this->sendReservationConfirmation($data);

            session()->setFlashdata('success', 'La réservation a été confirmée !');

            return redirect()->to('/booking-list');
        } else {
            return view('errors/err_404');
        }

    }

    function sendReservationConfirmation($data)
    {
        $to = $data['booking']->user_email;
        $contents = "Bonjour, {$to}, votre réservation a été confimé, et nous vous avons envoyé le billet à votre adresse mail";
        $this->email->setFrom('support@bingwagroup.com', 'Reservation SNCC');
        $this->email->setTo($to);
        $this->email->setSubject("Reservation Confirmation");
        $this->email->setMessage($contents);
        if ($this->email->send()) {
            echo "succes";
        } else {
            print_r($this->email->printDebugger($this->email->send()));
        }
    }

    function confirmTicket($booking_id)
    {
        if (!is_logged()) return redirect()->to('/login');
        $data = [
            'booking' => $this->bookingModel->asObject()
                ->join('ph_users', 'ph_bookings.user_id=ph_users.user_id')
                ->join('ph_trips', 'ph_bookings.trip_id=ph_trips.trip_id')
                ->join('ph_cities', 'ph_trips.city_to_id=ph_cities.city_id')
                ->join('ph_countries', 'ph_countries.ctry_id = ph_cities.country_id')
                ->where('booking_id', $booking_id)->first(),
            'from' => $this->bookingModel->asObject()
                ->join('ph_trips', 'ph_bookings.trip_id=ph_trips.trip_id')
                ->join('ph_airlines', 'ph_airlines.airline_id=ph_trips.airline_id')
                ->join('ph_cities', 'ph_trips.city_from_id=ph_cities.city_id')
                ->join('ph_countries', 'ph_countries.ctry_id = ph_cities.country_id')
                ->where('booking_id', $booking_id)->first(),
            'confirmation' => [
                'ticket_number' => ($this->request->getVar('ticket_number') !== null) ? $this->request->getVar('ticket_number') : null,
                'rsv_number' => ($this->request->getVar('rsv_number') !== null) ? $this->request->getVar('rsv_number') : null,
                'psg_firstname' => ($this->request->getVar('psg_firstname') !== null) ? $this->request->getVar('psg_firstname') : null,
                'psg_lastname' => ($this->request->getVar('psg_lastname') !== null) ? $this->request->getVar('psg_lastname') : null,
            ],
            'user_data' => session()->get('user_data')
        ];

        if (!empty($data['booking'])) {
            $newdata = array(
                'bk_status' => 'confirm'
            );
            $this->bookingModel->set($newdata)->where('booking_id', $booking_id)->update();

            $this->sendTicket($data);

            session()->setFlashdata('success', 'Le ticket a été envoyé');

            return redirect()->to('/booking-list');
        } else {
            return view('errors/err_404');
        }
    }


    function sendTicket($data)
    {
        $to = $data['booking']->user_email;
        $contents = "
            Bonjoour {$to}, nous sommes heureux de vous envoyer votre billet de réservation, </br>
            Veuillez consulter votre espace sur notre site web pour tous les détails.
            ";
        $this->email->setFrom('support@bingwagroup.com', 'Reservation SNCC');
        $this->email->setTo($to);
        $this->email->setCC('gloriamuhemba845@gmail.com, josuekzd05@gmail.com, erickbanze.develop@gmail.com');
        $this->email->setSubject("Electronic Ticket");
        $this->email->setMessage($contents);
        if ($this->email->send()) {
            echo "succes";
        } else {
            print_r($this->email->printDebugger($this->email->send()));
        }
    }




    function cancelBooking($booking_id)
    {
        if (!is_logged()) return redirect()->to('/login');

        $data['booking'] = $this->bookingModel->asObject()->join('ph_users', 'ph_bookings.user_id=ph_users.user_id')->join('ph_trips', 'ph_bookings.trip_id=ph_trips.trip_id')->where('booking_id', $booking_id)->first();

        $to = $data['booking']->user_email;

        if (!empty($data["booking"])) {
            $to = $data['booking']->user_email;

            $data = array(
                'bk_status' => 'cancel'
            );
            $this->bookingModel->set($data)->where('booking_id', $booking_id)->update();

            $data['booking'] = $this->bookingModel->asObject()->join('ph_users', 'ph_bookings.user_id=ph_users.user_id')->join('ph_trips', 'ph_bookings.trip_id=ph_trips.trip_id')->where('booking_id', $booking_id)->first();

            $subject = "Réservation annulée et réjetée !";

            $content = "Bonjour {$to}, Votre réservation PINR {$data['booking']->bk_token} 
                        sur SNCC-TICKETS a été réjétée.</span>,
                         Prière de vérifier dans votre espace sur notre site web.";

            $this->sendOperationBookingMessage($to, $subject, $content);
            session()->setFlashdata('success', 'La réservation a été rejetée avec succès !');
            return redirect()->to('/booking-list');
        }
    }


    private function sendOperationBookingMessage($to, $subject, $content)
    {
        $this->email->setFrom('support@bingwagroup.com', 'Reservation SNCC-TICKET');
        $this->email->setTo($to);
        $this->email->setCC('gloriamuhemba845@gmail.com, erickbanze.develop@gmail.com');
        $this->email->setSubject($subject);
        $this->email->setMessage($content);
        if ($this->email->send()) {
            echo "succes";
        } else {
            print_r($this->email->printDebugger($this->email->send()));
        }
    }

    private function sendMailtoAdminReservation($to, $subject, $content)
    {
        $this->email->setFrom('support@bingwagroup.com', 'Réservation SNCC Tickets');
        $this->email->setTo($to);
        $this->email->setSubject($subject);
        $this->email->setMessage($content);
        if ($this->email->send()) {
            echo "succes";
        } else {
            print_r($this->email->printDebugger($this->email->send()));
        }
    }
}
