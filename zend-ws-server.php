<?php
// sample SOAP server using Zend.

$path = dirname(__FILE__);
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once 'MyWebService.php';
require_once 'Zend/Loader/StandardAutoloader.php';

$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf' => true));
$loader->register();

if ( $_SERVER['QUERY_STRING'] == 'wsdl' ) {
    $auto = new Zend\Soap\AutoDiscover();
    $auto->setClass('MyWebService')
         ->setUri('http://localhost/mywebservice/zend-ws-server.php');
    $wsdl = $auto->generate();
    header('Content-Type: text/xml');
    echo $wsdl->toXml();

    $wsdl->dump( 'MyWebService.wsdl' );
    $dom = $wsdl->toDomDocument();
    exit;
}
else {
    $server = new Zend\Soap\Server( 'http://localhost/mywebservice/zend-ws-server.php?wsdl' );
    $server->setClass('MyWebService');
    $server->handle();

    $request = $server->getLastRequest();
    $response = $server->getResponse();
    file_put_contents('zend-ws-access.log', $request.$response, FILE_APPEND);
}
?>