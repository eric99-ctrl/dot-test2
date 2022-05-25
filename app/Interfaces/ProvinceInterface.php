<?php

namespace App\Interfaces;

interface ProvinceInterface
{
   public function store(array $data);
   public function search($id);
   public function deleteAll();
}