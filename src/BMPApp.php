<?php

namespace COV;

class BMPApp
{


  /**
   * BMPApp constructor.
   */
  public function __construct()
  {
    $data_dir = __DIR__ . '/../data/bmp/';
    $sources = json_decode(
        file_get_contents(__DIR__ . '/sources.json')
    );

      foreach ($sources as $entry) {
        $time = time();
        print_r($time.PHP_EOL);
        $url = str_replace('{timestamp}', $time , $entry->url);
        $data = file_get_contents($url);
        sleep(1);
        $md5 = md5($data);
        $file = $data_dir . $md5 . $entry->filename;
        if (file_exists($file) === false) {
          file_put_contents($file, $data);
        }
      }



  }
}