<?php

namespace App\Interfaces;

interface CityInterface
{
   public function store(array $data);
   public function search($id);
   public function deleteAll();
}