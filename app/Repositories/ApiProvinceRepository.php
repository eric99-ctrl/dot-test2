<?php

namespace App\Repositories;

use App\Interfaces\ApiProvinceInterface;
use GuzzleHttp\Client;

class ApiProvinceRepository implements ApiProvinceInterface
{
    public function fetchData()
    {
        try {
            $client = new Client();
            $request = $client->request('GET', 'https://api.rajaongkir.com/starter/province',
                        [
                            'verify' => false,
                            'query' =>  [
                                'key' => '0df6d5bf733214af6c6644eb8717c92c'
                                ]
                        ]
                    );
            $response = $request->getBody()->getContents();
            $resultData = (object) json_decode($response, true);
            $result['data'] = $resultData;
            $result['status'] = true;
            return $result;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $result['data'] = $e->getMessage();
            $result['status'] = false;
            return $result;
        }
    }

    public function search($id)
    {
        try {
            $client = new Client();
            $request = $client->request('GET', 'https://api.rajaongkir.com/starter/province',
                        [
                            'verify' => false,
                            'query' =>  [
                                'key' => '0df6d5bf733214af6c6644eb8717c92c',
                                'id' => $id
                                ]
                        ]
                    );
            $response = $request->getBody()->getContents();
            $resultData = (object) json_decode($response, true);
            $result['data'] = $resultData;
            $result['status'] = true;
            return $result;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $result['data'] = $e->getMessage();
            $result['status'] = false;
            return $result;
        }
    }



}