<?php
// sample SOAP client using Zend.

$path = dirname(__FILE__);
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Zend/Loader/StandardAutoloader.php';
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf' => true));
$loader->register();

$client = new Zend\Soap\Client('http://localhost/mywebservice/zend-ws-server.php?wsdl');

try {
    for($i=0; $i<=3; $i++) {
        $result1 = $client->randomQuote();
        echo 'Calling (' . ($i+1) . ') "randomQuote" returned: ' . $result1 . '<br/>';
    }

    $result2 = $client->getAge( '05-26-1981' );
    echo 'Age of person born on 05-26-1981 is: ' . $result2 . '<br/>';

    $result2 = $client->getAge( '1981-05-26' );
    echo 'Age of person born on 05-26-1981 is: ' . $result2 . '<br/>';
}
catch( SoapFault $e ) {
    echo $e->getMessage();
}

//$request = $client->getLastRequest();
//$response = $client->getLastResponse();
//file_put_contents('zend-ws-access.log', $request.$response, FILE_APPEND);
?>