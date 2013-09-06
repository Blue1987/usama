<?php
include('youtube.class.php');

$youtube = new YouTube();

$searchResults = $youtube->getSearchResults('apple');

var_dump($searchResults);
?>