#!/usr/bin/php -q

<?php
require_once('Phirehose.php');
require_once('OauthPhirehose.php');

/**
 * Example of using Phirehose to display a live filtered stream using track words 
 */
class FilterTrackConsumer extends OauthPhirehose
{
  /**
   * Enqueue each status
   *
   * @param string $status
   */

  public function enqueueStatus($status)
  {
    /*
     * In this simple example, we will just display to STDOUT rather than enqueue.
     * NOTE: You should NOT be processing tweets at this point in a real application, instead they should be being
     *       enqueued and processed asyncronously from the collection process. 
     */


	$m = new MongoClient();
	$db = $m->SocialMedia;

    $data = json_decode($status, true);
	$refinedData = array(
                        'created_at' => $data['created_at'],
                        'tweet_id' => $data['id_str'],
                        'text' => urldecode($data['text']),
                        'user_id' => $data['user']['id_str'],
                        'user_name' => $data['user']['name'],
                        'user_screen_name' => $data['user']['screen_name'],
                        'coordinates' => $data['coordinates'],
                        'place' => array('place_type'=> $data['place']['place_type'], 'place_name' => $data['place']['name']),
                        'language' => $data['lang'],
			'retweeted' => $data['retweeted']
                        );
	
    
	//$refinedJSON = json_encode($refinedData,true);

	if(!is_null($refinedData['coordinates'])&&coordInUppsala($refinedData['coordinates']['coordinates'])){
		//if(coordInUppsala($refinedData['coordinates']['coordinates'])){
		//print $refinedData['user_screen_name'] . ': ' . $refinedData['text'] . "\n";
		$collection = $db->selectCollection('coordTweets');
		$collection->insert($refinedData);		
		//}
	}elseif($refinedData['place']['place_name']=='Uppsala'||stripos($refinedData['text'],"uppsala")!==false){
	//print $refinedData['user_screen_name'] . ': ' . $refinedData['text'] . "\n";
	$collection = $db->selectCollection('uppsalaTweets');
	$collection->insert($refinedData);
	}else{
	//print $refinedData['user_screen_name'] . ': ' . $refinedData['text'] . "\n";
	$collection = $db->selectCollection('restTweets');
	$collection->insert($refinedData);
	}
	      

      //print $refinedData['user_screen_name'] . ': ' . $refinedData['text'] . "\n";
      
    	
	
        /*$myFile = fopen('tweetsWithUppsala.json', 'a');
        fwrite($myFile, $refinedJSON . "\n");
        fclose($myFile);*/
	
	

	
  }
}

function coordInUppsala($coordinates){

	if($coordinates[0]>17.51&&$coordinates[0]<17.80){
		if($coordinates[1]>59.79&&$coordinates[1]<59.91){
		return true;
		}else{ return false;}	
	}else{ return false;}
}

// The OAuth credentials you received when registering your app at Twitter
define("TWITTER_CONSUMER_KEY", "UhAWWHnOa8pHU78FgYaHmWEQN");
define("TWITTER_CONSUMER_SECRET", "qaXWnC2aQ3BmABbMYVDiOQ2EXij9SOBauVIx25YLbuKo47srhO");


// The OAuth data for the twitter account
define("OAUTH_TOKEN", "3150881842-bxomhSUyXuvGy12WAdq5uBz7OUwPi9qwMuebza6");
define("OAUTH_SECRET", "PebJAPeR2ej1fkzRg8nZfVffNCgOQpuUgeXTC8eFT3T9K");

// Start streaming
$sc = new FilterTrackConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
$sc->setTrack(array('uppsala'));
$sc->setLocations(array(
       array(17.51,59.79,17.80,59.91)
   ));
$sc->consume();
