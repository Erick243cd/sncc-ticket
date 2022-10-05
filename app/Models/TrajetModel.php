<?php

namespace App\Models;

use CodeIgniter\Model;

class TrajetModel extends Model
{
    protected $table = 'ph_trajets';

    protected $primaryKey = 'trajet_id';

    protected $allowedFields = ['trajet_id', 'city_from_id', 'city_to_id'];
}