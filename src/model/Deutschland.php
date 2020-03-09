<?php


namespace COV\model;


use JsonSerializable;
use stdClass;

class Deutschland implements JsonSerializable
{

  private $bundeslaender;

  public function __construct()
  {
    $this ->bundeslaender=[];
  }

  public function add( Bundesland $bundesland ){
    $this->bundeslaender[]=$bundesland;
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function jsonSerialize()
  {
    $cls = new stdClass();
    $cls -> Deutschland = $this -> bundeslaender;
    $cls -> timestamp = time();
    return $cls;

  }
}