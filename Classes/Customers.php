<?php

class Customers
{
public $id;
public $firstname;
public $lastname;
public $address;
public $city;

   public function __construct()
   {
       settype($this->id, 'integer');
   }
}