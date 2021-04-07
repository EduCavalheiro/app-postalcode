<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PcCounty extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'pc_counties';

    public function district()
    {
        return $this->hasOne(PcDistrict::class, 'cod_district', 'cod_district');
    }
}
