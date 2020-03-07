<?php


namespace COV\model;


use JsonSerializable;

class Bundesland implements JsonSerializable
{

  private $properties;

  public function __construct()
  {
    $this->properties=[];
  }

  public function set_bundesland( $name  ){
    $this->properties['Bundesland'] = $name;
    return $this;
  }

  public function set_faelle( $anzahl ){
    $this->properties['Fälle'] = $anzahl;
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function jsonSerialize()
  {
    return $this->properties;
  }
}