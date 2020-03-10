<?php

namespace COV;

use COV\model\Bundesland;
use COV\model\Deutschland;
use DOMDocument;
use DOMNode;
use DOMXPath;

class App
{

  private $data;

  public function __construct()
  {

    $data_dir = __DIR__ . '/../data/';
    $url = 'https://www.rki.de/DE/Content/InfAZ/N/Neuartiges_Coronavirus/Fallzahlen.html';
    $data = file_get_contents($url);
    $dom = new DOMDocument('1.0', 'utf-8');
    @$dom->loadHTML($data);
    $domx = new DOMXPath($dom);
    $tables = $domx->query('//table/tbody/.')->item(0);

    $this->data = new Deutschland();

    $faelle = 0;
    /**
     * @var $node DOMNode
     */
    foreach ($tables->childNodes as $node) {
      $bundesland = $node->childNodes->item(0)->textContent;
      $faelle = $node->childNodes->item(1)->textContent;
      $tot = $node->childNodes->item(2)->textContent;
      $hotspot = $node->childNodes->item(3)->textContent;
      $this->data->add(
          (new Bundesland())
              ->set_bundesland($bundesland)
              ->set_faelle($faelle)
              ->set_tot($tot)
              ->set_hotspot($hotspot)
      );
    }

    $json = json_encode($this->data, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
    #print_r( $json );
    #exit;
    $filename = md5($faelle ) . '.json';
    if (file_exists($data_dir . $filename ) === false) {
      file_put_contents($data_dir . $filename, $json);
    }

  }


}