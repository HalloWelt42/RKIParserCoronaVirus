<?php


namespace COV\model;


use JsonSerializable;

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
    return $this->bundeslaender;
  }
}