<?php
$result = array(
);

if (empty($_GET['term'])) {
    echo json_encode($result);
    exit;
}

require 'solr-base.php';

$field = 'cleantitle_t';
$query = $client->createSelect();

$q = 'namespace_i:14 AND '.$field.':'.Solarium_Query_Helper::escapeTerm($_GET['term']);

if (!empty($_GET['chosen_cats'])) {
    $chosen_cats = $_GET['chosen_cats'];
    if (!is_array($chosen_cats)) $chosen_cats = array($chosen_cats);

    foreach ($chosen_cats as $cat) {
        $q .= ' AND NOT '.$field.':"'.Solarium_Query_Helper::escapeTerm($cat).'"';
    }

}

$query->setQuery($q);

$facetSet = $query->getFacetSet();
$facetSet->createFacetField('category')->setField('category_ss');


$query->setFields(array($field));
$query->setRows(20);

// this executes the query and returns the result
$resultset = $client->select($query);

// show documents using the resultset iterator
foreach ($resultset as $document) {
    $result[] = $document[$field];
}

echo json_encode($result);
