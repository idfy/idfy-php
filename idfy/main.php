<?php
set_include_path(realpath(dirname(__FILE__)));
require(dirname(__FILE__) . '/client.php');

$client = new Client;
echo $client->DEFAULTS
?>