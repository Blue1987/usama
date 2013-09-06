<?php
class YouTube {
	function getSearchResults($keywords, $maxResults = 25) {
		
		set_include_path('./src');
  
		require_once 'Google_Client.php';
		require_once 'contrib/Google_YoutubeService.php';
		
		
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