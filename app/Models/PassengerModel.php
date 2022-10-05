<?php
namespace App\Models;

use CodeIgniter\Model;

class PassengerModel extends Model
{
protected $table = 'ph_passengers';

protected $primaryKey = 'passenger_id';

protected $allowedFields = ['adult_firstname', 'adult_lastname', 'adult_gender',
    'adult_class', 'child_firstname', 'child_lastname','child_gender','child_class',
    'infant_firstname','infant_lastname','infant_gender','bk_pin'
];
}
