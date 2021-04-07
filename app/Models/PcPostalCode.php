<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PcPostalCode extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'pc_postal_codes';

    /**
     * Get complete arteria string
     * @return [type]
     */
    public function getCompleteArtAttribute()
    {
        return "{$this->type_art} {$this->first_pre}{$this->title_art}{$this->second_prep}{$this->desig_art}{$this->local_art}";
    }

    /**
     * Get complete postal code
     * @return [type]
     */
    public function getPostalCodeAttribute()
    {
        return "{$this->cp4}{$this->cp3}";
    }

    /**
     * Get district of postal code
     * @return [type]
     */
    public function district()
    {
        return $this->hasOne(PcDistrict::class, "cod_district", "cod_district");
    }

    /**
     * Get county of postal code
     * @return [type]
     */
    public function county()
    {
        return PcCounty::where('cod_district', $this->district->cod_district)->where('cod_county', $this->cod_county)->first();
    }
}
