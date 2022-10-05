<?php

namespace App\Validations;

use App\Models\UserModel;

class CustomRules
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    function check_date(string $str, string &$error = null): bool
    {
        $month = date('m', strtotime($str));
        $year = date('Y', strtotime($str));

        if ($year < date('Y')) {
            return false;
        } else {
            return true;
        }
    }

    function check_pwd(string $str, string &$error = null): bool
    {

        $data = $this->userModel->asObject()
            ->where('user_email', $_POST['email_adress'])
            ->first();
        if (empty($data)) {
            return false;
        } elseif (password_verify($str, $data->user_pwd)) {
            return true;
        } else {
            return false;
        }
    }
}

  