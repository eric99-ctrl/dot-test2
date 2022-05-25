<?php

namespace App\Repositories;

use App\Models\Province;
use App\Interfaces\ProvinceInterface;

class ProvinceRepository implements ProvinceInterface
{
    public function store(array $data)
    {
        try {
            $result['data'] = Province::create($data);
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
            $result['data'] = Province::where('province_id', $id)->first();
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
            $result['data'] = Province::whereNull('id')->truncate();
            $result['status'] = true;
            return $result;
        } catch (\Exception $e) {
            $result['data'] = $e->getMessage();
            $result['status'] = false;
            return $result;
        }
    }


}