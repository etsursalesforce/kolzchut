<?php

require '../vendor/autoload.php';


$_solrConnectionString = getenv('SOLR_URL');
if (preg_match('%([^:]+):(\d+)(.*)%', $_solrConnectionString, $regs, PREG_OFFSET_CAPTURE)) {
    $solrHost = $regs[1][0];
    $solrPort = $regs[2][0];
    $solrPath = $regs[3][0];
} else {
    die("Failed to parse Solr connection string");
}

$config = array(
    'adapteroptions' => array(
        'host' => $solrHost,
        'port' => $solrPort,
        'path' => $solrPath,
    )
);



$client = new Solarium_Client($config);
