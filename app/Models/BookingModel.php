<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'ph_bookings';

    protected $primaryKey = 'booking_id';

    protected $allowedFields = ['trip_id', 'user_id', 'booking_date',
        'bk_nb_adult', 'bk_nb_child', 'bk_nb_infant',
        'bk_caoch', 'base_amount', 'bk_taxe', 'bk_fee',
        'bk_total_amount', 'transaction_mode', 'transaction_id','bk_token','bk_confirm_at','bk_status',
        'bk_child_amount','bk_infant_amount','bk_adult_amount'
    ];
}
