<?php
    error_reporting(E_ALL);
    ini_set('error_reporting', E_ALL);
    include('youtube.class.php');
    $youtube = new YouTube();
    $searchResults = $youtube->getSearchResults('apple');
    var_dump($searchResults);    
    echo "your sister!";
?>
