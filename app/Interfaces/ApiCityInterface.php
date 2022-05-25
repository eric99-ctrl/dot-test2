<?php

namespace App\Interfaces;

interface ApiCityInterface
{
   public function fetchData();
   public function search($id);
}