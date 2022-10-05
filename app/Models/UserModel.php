<?php


namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'ph_users';

    protected $primaryKey = 'user_id';

    protected $allowedFields = [
        'user_id', 'user_email', 'first_name','last_name',
        'phone_number','user_pwd','user_role','user_created_at','user_status','home_airport','user_picture'
    ];
}
