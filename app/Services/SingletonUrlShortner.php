<?php

namespace App\Services;
use App\Services\ServiceUrlShortener;

class SingletonUrlShortner
{
  // Hold the class instance.
  private static $instance = null;
  private $service;


  // The db connection is established in the private constructor.
  private function __construct()
  {
    $this->service = new ServiceUrlShortener;
  }

  public static function get_instance()
  {
    if(!self::$instance)
    {
      self::$instance = new SingletonUrlShortner();
    }

    return self::$instance;
  }

  public function get_service()
  {
    return $this->service;
  }
}
