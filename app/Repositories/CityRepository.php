<?php

namespace App\Repositories;

use App\Models\City;
use App\Interfaces\CityInterface;

class CityRepository implements CityInterface
{
    public function store(array $data)
    {
        try {
            $result['data'] = City::create($data);
            $result['status'] = true;
            return $result;
        } catch (\Exception $e) {
            $result['data'] = $e->getMessage();
            $result['status'] = false;
            return $result;
        }

    }

    public function search($id)
    {
        try {
            $result['data'] = City::where('city_id', $id)->first();
            $result['status'] = true;
            return $result;
        } catch (\Exception $e) {
            $result['data'] = $e->getMessage();
            $result['status'] = false;
            return $result;
        }
    }

    public function deleteAll()
    {
        try {
            $result['data'] = City::whereNull('id')->truncate();
            $result['status'] = true;
            return $result;
        } catch (\Exception $e) {
            $result['data'] = $e->getMessage();
            $result['status'] = false;
            return $result;
        }
    }


}