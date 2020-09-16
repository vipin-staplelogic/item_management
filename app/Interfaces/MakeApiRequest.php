<?php

namespace App\Interfaces;


interface MakeApiRequest
{

	public static function makeRequest($token ,  $method , $params);

}