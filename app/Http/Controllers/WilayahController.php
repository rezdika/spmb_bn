<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function getProvinsi()
    {
        return response()->json(Province::select('id', 'name')->orderBy('name')->get());
    }

    public function getKabupaten(Request $request)
    {
        $provinceId = $request->get('province_id');
        return response()->json(Regency::where('province_id', $provinceId)->select('id', 'name')->orderBy('name')->get());
    }

    public function getKecamatan(Request $request)
    {
        $regencyId = $request->get('regency_id');
        return response()->json(District::where('regency_id', $regencyId)->select('id', 'name')->orderBy('name')->get());
    }

    public function getKelurahan(Request $request)
    {
        $districtId = $request->get('district_id');
        return response()->json(Village::where('district_id', $districtId)->select('id', 'name')->orderBy('name')->get());
    }
}