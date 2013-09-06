<?php
    error_reporting(E_ALL);
    ini_set('error_reporting', E_ALL);

class YouTube {
    function getSearchResults($keywords, $maxResults = 25) {
  
        require_once 'src/Google_Client.php';
        require_once 'src/contrib/Google_YouTubeService.php';
        
        
        $DEVELOPER_KEY = 'AIzaSyAS4Is-lTVmOeq63eHUhQjfQSzYwdsWhBc';
        
        $client = new Google_Client();
        $client->setDeveloperKey($DEVELOPER_KEY);
        
        $youtube = new Google_YoutubeService($client);
        
        try {
            $searchResponse = $youtube->search->listSearch('id,snippet', array(
              'q' => $keywords,
              'maxResults' => $maxResults,
            ));
        
        
            $searchResults = array();
            
            foreach ($searchResponse['items'] as $searchResult) {
            
                if ($searchResult['id']['kind'] == 'youtube#video') {
                    $searchResults[] = array('id' => $searchResult['id']['videoId'], 'title' => $searchResult['snippet']['title'], 'description' => $searchResult['snippet']['description'], 'thumbnail' => $searchResult['snippet']['thumbnails']['default']['url']);
                  
                }
            }
        
            return $searchResults;
            
        } catch (Google_ServiceException $e) {
            return false;
        } catch (Google_Exception $e) {
            return false;
        }
        
        
    }
}

?>
