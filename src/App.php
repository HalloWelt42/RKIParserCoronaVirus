<?php

namespace COV;

use DOMDocument;
use DOMNode;
use DOMXPath;

class App
{

    public function __construct ()
    {

        $url = 'https://www.rki.de/DE/Content/InfAZ/N/Neuartiges_Coronavirus/Fallzahlen.html';
        $data = file_get_contents( $url );
        $dom = new DOMDocument( '1.0' , 'utf-8' );
        $dom -> loadHTML( $data );
        $domx = new DOMXPath( $dom );
        $tables = $domx -> query( '//table/tbody/.' ) -> item( 0 );

        /**
         * @var $node DOMNode
         */
        foreach ( $tables -> childNodes as $node ) {
            $bundesland = $node -> childNodes -> item( 0 ) -> textContent;
            $faelle = $node -> childNodes -> item( 1 ) -> textContent;
            print_r( "{$bundesland} {$faelle}" );
            print_r( PHP_EOL );
        }

    }


}