<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    // table name
    protected $table = 'provinces';

    public function getProvinces() {
        $prov = City::select('*')->orderBy('province_name')->get();

        return $prov;
    }

    public function getDistrictsByProvID($prov_id, $prov_name) {
        $this->table = 'districts';
        $dist = City::where('province_id' , '=', $prov_id)
                ->orderBy('district_name')->get();

        return $dist;
    }

    public function getSubDistrictsByID($prov_id, $dist_id) {
        $this->table = 'sub_districts';
        $sub_dist = City::where('province_id' , '=', $prov_id)->where('district_id', '=', $dist_id)
                ->orderBy('sub_district_name')->get();

        return $sub_dist;
    }
}
