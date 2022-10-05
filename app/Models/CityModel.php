<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table = 'ph_cities';

    protected $primaryKey = 'city_id';

    protected $allowedFields = ['city_id', 'city_name', 'country_id', 'city_picture'];
}