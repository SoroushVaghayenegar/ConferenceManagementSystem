<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = "inventories";

    public function hotel()
    {
        return $this->belongsTo('App\Hotel');
    }
}
