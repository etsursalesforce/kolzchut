<?php

require '../vendor/autoload.php';

$config = array(
    'adapteroptions' => array(
        'host' => 'ec2-23-20-198-252.compute-1.amazonaws.com',
        'port' => 8983,
        'path' => '/solr/solr',
    )
);

$client = new Solarium_Client($config);
