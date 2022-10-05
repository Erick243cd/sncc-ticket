<?php

namespace App\Models;

class AirlineModel extends \CodeIgniter\Model
{
    protected $table = 'ph_airlines';

    protected $primaryKey = 'airline_id';

    protected $allowedFields = ['airline_name', 'airline_description', 'airline_picture', 'airline_contact_number', 'airline_email', 'country_id'];
}