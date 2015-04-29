<?php

function parseDocuments($resultset) {
    $result = array();
    foreach ($resultset as $document) {
        $doc = array();
        foreach($document AS $field => $value) {
            $doc[$field] = $value;
        }
        $doc['title'] = $doc['cleantitle_t'];
        $doc['info'] = $doc['info_txt'];
        $result[] = $doc;
    }

    return $result;
}

$result = array(
    'documents' => array(),
    'numDocuments' => 0,
    'facets' => array()
);

if (empty($_GET['category']) && empty($_GET['term'])) {
    echo json_encode($result);
    exit;
}


require 'solr-base.php';

$query = $client->createSelect();

$categories = $_GET['category'];
if (empty($categories)) $categories = array();
else if (!is_array($categories)) $categories = array($categories);

$category_hash = array();
$q = 'namespace_i:0';
foreach ($categories as $cat) {
    $category_hash[$cat] = 1;
    $q .= ' AND category_ss:"'.Solarium_Query_Helper::escapeTerm($cat).'"';
}

$term = empty($_GET['term']) ? '' : $_GET['term'];
//if ($term) {
//    $q .= ' AND category_txt:"'.Solarium_Query_Helper::escapeTerm($term).'"';
//}

$result['q'] = $q;

$query->setQuery($q);
$query->setFields(array('id', 'category_ss', 'cleantitle_t', 'info_txt', 'summary_t'));
$query->setRows($term ? 0 : 20);

$facetSet = $query->getFacetSet();
$facetSet->createFacetField('category')->setField('category_ss');

// this executes the query and returns the result
$resultset = $client->select($query);

if (!$term) {
    $q_guides = $q . ' AND category_ss:"זכותונים ומדריכים"';
    $query = $client->createSelect();
    $query->setQuery($q_guides);
    $query->setFields(array('id', 'category_ss', 'cleantitle_t', 'info_txt', 'summary_t'));
    $query->setRows(3);

    $result['q_guide'] = $q_guides;
    $result['guides'] = parseDocuments($client->select($query));


    $q_portals = $q . ' AND category_ss:"פורטלים"';
    $query = $client->createSelect();
    $query->setQuery($q_portals);
    $query->setFields(array('id', 'category_ss', 'cleantitle_t', 'info_txt', 'summary_t'));
    $query->setRows(3);

    $result['q_portals'] = $q_portals;
    $result['portals'] = parseDocuments($client->select($query));


}

$result['numDocuments'] = $resultset->getNumFound();
$result['documents'] = parseDocuments($resultset);


$facet = $resultset->getFacetSet()->getFacet('category');
foreach($facet as $value => $count) {
    if ($term && stripos($value, $term) === false) {
        continue;
    }
    if (empty($category_hash[$value]) && $count > 0) {
        // not part of the query, and count > 0
        $result['facets'][] = array(
            'category' => $value,
            'count' => $count
        );
    }
}

echo json_encode($result);
