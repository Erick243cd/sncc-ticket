<?php

namespace App\Models;

use CodeIgniter\Model;

class TripModel extends Model
{
    protected $table = 'ph_trips';

    protected $primaryKey = 'trip_id';
    protected $allowedFields =
        [
            'city_from_id', 'city_to_id', 'depart_date', 'price_by_place', 'start_depart', 'price_by_place', 'place_numbers',
            'return_date', 'duration',
            'fixed_price_premium_class',
            'fixed_price_economic_price',
            'fixed_price_business_class',
            'fixed_price_first_class', 'fixed_price_child_premium',
            'fixed_price_child_economic', 'fixed_price_child_business',
            'fixed_price_child_first', 'fixed_price_infant',
            'take_off', 'landing', 'total_time', 'airline_id',
            'arrival_date', 'trip_categorie', 'nb_stop',
            'trip_status', 'conditions'
        ];
}

