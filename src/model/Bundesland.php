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

  public function set_bestaetigte_faelle($anzahl ){
    $this->properties['best. Fälle'] = $anzahl;
    return $this;
  }

  public function set_elektronisch_uebermittelte_faelle($anzahl ){
    $this->properties['elektronisch übermittelte Fälle'] = $anzahl;
    return $this;
  }

  public function set_hotspot( $anzahl ){
    $this->properties['Besonders betroffenes Gebiet'] = $anzahl;
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function jsonSerialize()
  {

    foreach ( $this->properties as $key => $val ){
      if(!$val){
        unset($this->properties[$key]);
      }
    }

    return $this->properties;
  }
}