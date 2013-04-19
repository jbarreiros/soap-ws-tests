<?php
// sample SOAP client using native PHP SOAP extension.

$client = new SoapClient(
    'http://localhost/mywebservice/php-ws-server.php?wsdl',
    array( 'trace' => 1 )
);

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

$request = $client->__getLastRequest();
$response = $client->__getLastResponse();
file_put_contents('php-ws-access.log', $request.$response, FILE_APPEND);
?>