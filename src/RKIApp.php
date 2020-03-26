<?php

namespace COV;

use COV\model\Bundesland;
use COV\model\Deutschland;
use DOMDocument;
use DOMNode;
use DOMXPath;

class RKIApp
{

  private $data;

  public function __construct()
  {

    $data_dir = __DIR__ . '/../data/rki/';
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
      $faelle = $node->childNodes->item(1)->textContent;
      $this->data->add(
          (new Bundesland())
              ->set_bundesland($node->childNodes->item(0)->textContent)
              ->set_faelle($faelle)
              ->set_differenz($node->childNodes->item(2)->textContent)
              ->set_pro_hundert($node->childNodes->item(3)->textContent)
              ->set_tot($node->childNodes->item(4)->textContent)
              ->set_hotspot($node->childNodes->item(5)->textContent)
      );
    }

    $json = json_encode($this->data, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
//    print_r( $json );
//    exit;
    $filename = md5($faelle) . '.json';
    if (file_exists($data_dir . $filename) === false) {
      file_put_contents($data_dir . $filename, $json);
    }

  }


}