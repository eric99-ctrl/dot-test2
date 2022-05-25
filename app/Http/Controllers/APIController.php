<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Interfaces\CityInterface;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ApiCityInterface;
use App\Interfaces\ProvinceInterface;
use App\Interfaces\ApiProvinceInterface;


class APIController extends Controller
{
    private ProvinceInterface $province;
    private ApiProvinceInterface $apiProvince;
    private CityInterface $city;
    private ApiCityInterface $apiCity;

    public function __construct(
        ProvinceInterface $province, ApiProvinceInterface $apiProvince,
        CityInterface $city, ApiCityInterface $apiCity
        )
    {
        $this->province = $province;
        $this->apiProvince = $apiProvince;
        $this->city = $city;
        $this->apiCity = $apiCity;
    }

    public function importProvince()
    {
        $result = DB::transaction( function() {
            try {
               $this->province->deleteAll();
               $result['status'] = true;
               return $result;
            } catch (\Exception $e) {
                $result['status'] = false;
                $result['data'] = $e->getMessage();
                return $result;
            }
        });

        if($result['status'] === true){
            $api = $this->apiProvince->fetchData();
            if($api['status'] === true){
                $provinces = $api['data']->rajaongkir['results'];
                foreach ($provinces as $province) {
                    $item['province_id'] = $province['province_id'];
                    $item['province_name'] = $province['province'];
                    $result = DB::transaction( function() use($item){
                        try {
                            $this->province->store($item);
                            $result['status'] = true;
                            return $result;
                        } catch (\Exception $e) {
                            $result['status'] = false;
                            $result['data'] = $e->getMessage();
                            return $result;
                        }
                    });

                    if($result['status'] === false){
                        break;
                        $resultProcess['status'] = false;
                        $resultProcess['message'] = $result['data'];
                        return $resultProcess;
                    }
                }
                $resultProcess['status'] = true;
                $resultProcess['message'] = 'Proses Import data provinsi Berhasil';
                return $resultProcess;
            }else{
                $resultProcess['status'] = false;
                $resultProcess['message'] =  $api['data'];
                return $resultProcess;
            }
        }else{
            $resultProcess['status'] = false;
            $resultProcess['message'] =  $result['data'];
            return $resultProcess;
        }
    }

    public function searchProvince(Request $request)
    {
        $id = $request->all()['id'];
        $result = $this->province->search($id);
        if($result['status'] === true){
            return response()->json([
                'status' => '200',
                'message' => 'Proses berhasil',
                'data' => $result['data']
            ], 200);
        }else {
            return response()->json([
                'status' => '405',
                'message' => 'Proses Gagal',
                'data' => $result['data']
            ], 200);
        }
    }

    public function importCity()
    {
        $result = DB::transaction( function() {
            try {
               $this->city->deleteAll();
               $result['status'] = true;
               return $result;
            } catch (\Exception $e) {
                $result['status'] = false;
                $result['data'] = $e->getMessage();
                return $result;
            }
        });

        if($result['status'] === true){
            $api = $this->apiCity->fetchData();
            if($api['status'] === true){
                $cities = $api['data']->rajaongkir['results'];
                foreach ($cities as $city) {
                    $item['city_id'] = $city['city_id'];
                    $item['city_name'] = $city['city_name'];
                    $item['province_id'] = $city['province_id'];
                    $item['province_name'] = $city['province'];
                    $item['type'] = $city['type'];
                    $item['postal_code'] = $city['postal_code'];
                    $result = DB::transaction( function() use($item){
                        try {
                            $this->city->store($item);
                            $result['status'] = true;
                            return $result;
                        } catch (\Exception $e) {
                            $result['status'] = false;
                            $result['data'] = $e->getMessage();
                            return $result;
                        }
                    });

                    if($result['status'] === false){
                        break;
                        $resultProcess['status'] = false;
                        $resultProcess['message'] = $result['data'];
                        return $resultProcess;
                    }
                }
                $resultProcess['status'] = true;
                $resultProcess['message'] = 'Proses Import data kota/kabupaten Berhasil';
                return $resultProcess;
            }else{
                $resultProcess['status'] = false;
                $resultProcess['message'] =  $api['data'];
                return $resultProcess;
            }
        }else{
            $resultProcess['status'] = false;
            $resultProcess['message'] =  $result['data'];
            return $resultProcess;
        }
    }

    public function searchCity(Request $request)
    {
        $id = $request->all()['id'];
        $result = $this->city->search($id);
        if($result['status'] === true){
            return response()->json([
                'status' => '200',
                'message' => 'Proses berhasil',
                'data' => $result['data']
            ], 200);
        }else {
            return response()->json([
                'status' => '405',
                'message' => 'Proses Gagal',
                'data' => $result['data']
            ], 200);
        }
    }

    public function swabSearchProvince(Request $request)
    {
        $id = $request->all()['id'];
        $api = $request->all()['fromAPI'];

        if(strtoupper($api) === "TRUE" ){
            $result = $this->apiProvince->search($id);
            if($result['status'] === true){
                $data = $result['data']->rajaongkir['results'];
            }else{
                $data = $result['data'];
            }
        }else{
            $result = $this->province->search($id);
            if($result['status'] === true){
                $data = $result['data'];
            }else{
                $data = $result['data'];
            }
        }

        if($result['status'] === true){
            return response()->json([
                'status' => '200',
                'message' => 'Proses berhasil',
                'data' => $data
            ], 200);
        }else {
            return response()->json([
                'status' => '405',
                'message' => 'Proses Gagal',
                'data' => $data
            ], 200);
        }
    }

    public function swabSearchCity(Request $request)
    {
        $id = $request->all()['id'];
        $api = $request->all()['fromAPI'];

        if(strtoupper($api) === "TRUE" ){
            $result = $this->apiCity->search($id);
            if($result['status'] === true){
                $data = $result['data']->rajaongkir['results'];
            }else{
                $data = $result['data'];
            }
        }else{
            $result = $this->city->search($id);
            if($result['status'] === true){
                $data = $result['data'];
            }else{
                $data = $result['data'];
            }
        }

        if($result['status'] === true){
            return response()->json([
                'status' => '200',
                'message' => 'Proses berhasil',
                'data' => $data
            ], 200);
        }else {
            return response()->json([
                'status' => '405',
                'message' => 'Proses Gagal',
                'data' => $data
            ], 200);
        }
    }


}
