<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model {

    protected $table = 'items';

    protected $primaryKey = 'item_id';

    protected $guarded = ['item_id'];

    protected $casts = [
        'prices' => 'array'
    ];

}
