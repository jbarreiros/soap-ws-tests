<?php
// sample SOAP server using native PHP SOAP extension.

$path = dirname(__FILE__);
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'MyWebService.php';

if ( $_SERVER['QUERY_STRING'] == 'wsdl' ) {
    header('Content-Type: text/xml');
    echo file_get_contents( "{$path}\MyWebService.wsdl" );
    exit;
}
else {
    try {
        $soap = new SoapServer( 'http://localhost/mywebservice/php-ws-server.php?wsdl' );
        $soap->setClass('MyWebService');
        $soap->handle();
    }
    catch (SOAPFault $f) {
        print $f->faultstring;
    }
}

?>