<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BookingModel;

//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

class Users extends BaseController
{
    private $userModel;
    private $validation;
    private $bookingModel;
    private $email;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->bookingModel = new BookingModel();
        $this->email = \Config\Services::email();
        helper('form,custom');
    }

    function register()
    {
        $data = [];
        $data['validation'] = null;
        if ($this->request->getMethod() == 'post') {
            $this->validation->setRules([
                'first_name' => [
                    'label' => 'First Name',
                    'rules' => 'required'
                ],
                'last_name' => [
                    'label' => 'Last Name',
                    'rules' => 'required'
                ],
                'email_adress' => [
                    'label' => 'Email adress',
                    'rules' => 'required|valid_email|is_unique[ph_users.user_email]',
                    'errors' => ['is_unique', 'Email adress has been used, please choose an other']
                ],
                'password' => [
                    'label' => "Password",
                    'rules' => 'required|min_length[6]'
                ],
                'confirm_password' => [
                    'label' => "Confirm Password",
                    'rules' => 'required|matches[password]'
                ]]);
            if ($this->validation->withRequest($this->request)->run()) {
                /* Function to send mail here */
                $data = array(
                    "user_email" => $this->request->getVar('email_adress'),
                    "first_name" => $this->request->getVar('first_name'),
                    "last_name" => $this->request->getVar('last_name'),
                    "phone_number" => $this->request->getVar('phone_number'),
                    "user_role" => 'traveller',
                    'user_pwd' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                    "user_status" => 1,
                    "user_picture"=>'default-profile-picture-avatar-png-green.jpg'
                );
                $this->userModel->save($data);

                //session()->set('user_data', $data);

                return redirect()->to('/profile');

            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        echo view('pages/register', $data);
    }

    function login()
    {
        $data = [];
        $data['validation'] = null;
        if ($this->request->getMethod() == 'post') {
            $this->validation->setRules([
                'email_adress' => [
                    'label' => 'Email Adress',
                    'rules' => 'required|valid_email'
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|check_pwd',
                    'errors' => ['check_pwd' => 'Email or Password incorrect']
                ]
            ]);
            if ($this->validation->withRequest($this->request)->run()) {
                $data = $this->userModel->where(['user_email' => $this->request->getVar('email_adress'), 'user_status' => 1])
                    ->first();

                session()->set('user_data', $data);
                return ($data['user_role'] === 'admin') ? redirect()->to('/dashboard') : redirect()->to('/profile');

            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        return view('pages/login', $data);
    }

    function logout()
    {
        session()->set('trip_id', null);
        session()->set('flight_data', null);
        $session = session()->get('user_data');
        session()->destroy();
        return redirect()->to('/');
    }

    function myprofile()
    {
        $data["user_data"] = session()->get('user_data');

        if (empty($data["user_data"])) {
            return redirect()->to('/login');
        } else {
            $data["bookings"] = $this->bookingModel->asObject()
                ->orderBy('booking_id', 'DESC')
                ->join('ph_users', 'ph_bookings.user_id=ph_users.user_id')
                ->join('ph_trips', 'ph_trips.trip_id=ph_bookings.trip_id')
                ->join('ph_cities', 'ph_trips.city_to_id=ph_cities.city_id')
                ->join('ph_airlines', 'ph_trips.airline_id=ph_airlines.airline_id')
                ->where('ph_bookings.user_id', $data["user_data"]['user_id'])
                ->findAll();

            return ($data["user_data"] == null) ? view('errors/err_404') : view('pages/profile', $data);
        }

    }

    function settings()
    {
        if (!is_logged()) return redirect()->to('/login');
        
        $data["user_data"] = session()->get('user_data');

        if ($this->request->getMethod() == 'post') {
            $this->validation->setRules([
                'first_name' => ['label' => 'First Name', 'rules' => 'required'],
                'last_name' => ['label' => 'Last Name', 'rules' => 'required'],
                'user_email' => ['label' => 'Email adress', 'rules' => 'required|valid_email'],
                'phone_number' => ['label' => 'Phone Number', 'rules' => 'required'],
                'home_airport' => ['label' => 'Home Airport', 'rules' => 'required']
            ]);
            if ($this->validation->withRequest($this->request)->run()) {
                $user_id = $data["user_data"]["user_id"];
                $data = array(
                    "user_email" => $this->request->getVar('user_email'),
                    "first_name" => $this->request->getVar('first_name'),
                    "last_name" => $this->request->getVar('last_name'),
                    "phone_number" => $this->request->getVar('phone_number'),
                    "home_airport" => $this->request->getVar('home_airport'),
                );

                $this->userModel->set($data)->where('user_id', $user_id)->update();
                session()->setFlashdata('success', "Your personal information has been updated");
                $data["user_data"] = $this->userModel->where('user_id', $user_id)->first();
                session()->set('user_data', $data['user_data']);
                return view('dashboard/users/settings', $data);

            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        return view('dashboard/users/settings', $data);
    }

    function changePwd()
    {
        if (!is_logged()) return redirect()->to('/login');
        $data["user_data"] = session()->get('user_data');

        if ($this->request->getMethod() == 'post') {
            $this->validation->setRules([
                'curr_password' => ['label' => 'Current Password',
                    'rules' => 'required|check_pwd',
                    'errors' => ['check_pwd' => 'Unknown Current Password']
                ],
                'newpassword' => ['label' => 'New Password', 'rules' => 'required|min_length[8]'],
                'confirm_password' => ['label' => 'Confirm New password', 'rules' => 'required|matches[newpassword]'],
            ]);
            if ($this->validation->withRequest($this->request)->run()) {
                $user_id = $data["user_data"]["user_id"];
                $data = array(
                    "user_pwd" => password_hash($this->request->getVar('newpassword'), PASSWORD_BCRYPT),
                );
                $this->userModel->set($data)->where('user_id', $user_id)->update();
                session()->setFlashdata('success', "Your password has been updated");
                $data["user_data"] = $this->userModel->where('user_id', $user_id)->first();
                session()->set('user_data', $data['user_data']);
                return view('dashboard/users/settings', $data);
            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        return view('dashboard/users/settings', $data);
    }

    function changeImage()
    {
        $data = [];
        $data['validation'] = null;
        $data['user_data'] = session()->get('user_data');

        if ($this->request->getMethod() == 'post') {
            $this->validation->setRules([
                'user_picture' => [
                    'label' => 'Image',
                    'rules' => 'uploaded[user_picture]|max_size[user_picture, 4096]|is_image[user_picture]'
                ]
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $temp_path = './assets/images/users/temp';//Temporary Path before Fit image
                $real_path = './assets/images/users';//Real Path after Fit image
                $file = $this->request->getFile('user_picture');
                $imageName = $file->getRandomName();

                if ($file->isValid() && !$file->hasMoved()) {
                    $file->move($temp_path, $imageName);
                    // resizing image
                    \Config\Services::image()->withFile($temp_path . '/' . $imageName)
                        ->fit(180, 180, 'center')
                        ->save($real_path . '/' . $imageName);

                    $user_id = $data["user_data"]["user_id"];
                    $this->userModel->set('user_picture', $imageName)->where('user_id', $user_id)->update();
                    $data["user_data"] = $this->userModel->where('user_id', $user_id)->first();
                    session()->set('user_data', $data['user_data']);
                    return view('dashboard/users/settings', $data);
                }

            } else {
                $data["validation"] = $this->validation->getErrors();
            }
        }
        return view('dashboard/users/settings', $data);
    }



    function sendMail(){
        $subject= "Registration for Repanda prices";
        $content = "We send you this email to register on phoebe, Please click on the button to confirm your account.";
        $token="";
        $this->email->setFrom('support@phoebessarl.com', 'Support Phoebe Travels');
        $this->email->setTo('erickbanze.develop@gmail.com');
        $this->email->setSubject($subject);
        $this->email->setMessage($this->mailContent('erickbanze.develop@gmail.com', $content, $token));
        if($this->email->send()){
            echo "succes";
        }else {
            print_r($this->email->printDebugger($this->email->send()));
        }
    }
    function mailContent($to, $content, $token){
        $text = '
    <!doctype html>
    <html>
      <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Red panda prices, Register</title>
    <style>
    /* -------------------------------------
        RESPONSIVE AND MOBILE FRIENDLY STYLES
    ------------------------------------- */
    @media only screen and (max-width: 620px) {
      table[class=body] h1 {
        font-size: 28px !important;
        margin-bottom: 10px !important;
      }
      table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
        font-size: 16px !important;
      }
      table[class=body] .wrapper,
            table[class=body] .article {
        padding: 10px !important;
      }
      table[class=body] .content {
        padding: 0 !important;
      }
      table[class=body] .container {
        padding: 0 !important;
        width: 100% !important;
      }
      table[class=body] .main {
        border-left-width: 0 !important;
        border-radius: 0 !important;
        border-right-width: 0 !important;
      }
      table[class=body] .btn table {
        width: 100% !important;
      }
      table[class=body] .btn a {
        width: 100% !important;
      }
      table[class=body] .img-responsive {
        height: auto !important;
        max-width: 100% !important;
        width: auto !important;
      }
    }
    /* -------------------------------------
        PRESERVE THESE STYLES IN THE HEAD
    ------------------------------------- */
    @media all {
      .ExternalClass {
        width: 100%;
      }
      .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
        line-height: 100%;
      }
      .apple-link a {
        color: inherit !important;
        font-family: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        text-decoration: none !important;
      }
      #MessageViewBody a {
        color: inherit;
        text-decoration: none;
        font-size: inherit;
        font-family: inherit;
        font-weight: inherit;
        line-height: inherit;
      }
      .btn-primary table td:hover {
        background-color: #34495e !important;
      }
      .btn-primary a:hover {
        background-color: #34495e !important;
        border-color: #34495e !important;
      }
    }
    </style>
  </head>
  <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
          <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi '.$to.',</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">'.$content.'</p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                          <tbody>
                            <tr>
                              <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                  <tbody>
                                    <tr>
                                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="'.base_url('auth/confirm/'.$token).'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Confirm account</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">We thank you for the trust and invite you to discover several things on our platform.</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Good luck! Hope it works.</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- START FOOTER -->
            <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                <tr>
                  <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                    <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">NgomaDigitech Inc, 3 Kasongo Nyembo Road, Lubumbashi DRC</span>
                    <br> Visit our Web Site <a href="http://www.redpandaprices.com" style="text-decoration: underline; color: #999999; font-size: 12px; text-align: center;">Red Panda Prices</a>.
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                    Powered by <a href="http://htmlemail.io" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">HTMLemail</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->
          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>';
        return $text;

    }

}
