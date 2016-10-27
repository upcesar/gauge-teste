<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Interactions extends Model {

    //
    public function brands() {
        return $this->belongsToMany('App\model\Brands', 'brand_id');
    }

}
