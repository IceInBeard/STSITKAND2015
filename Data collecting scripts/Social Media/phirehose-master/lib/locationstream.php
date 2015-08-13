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
    $data = json_decode($status, true);
	$refinedData = array(
                        'created_at' => $data['created_at'],
                        'tweet_id' => $data['id_str'],
                        'text' => urldecode($data['text']),
                        'user_id' => $data['user']['id_str'],
                        'user_name' => $data['user']['name'],
                        'user_screen_name' => $data['user']['screen_name'],
                        'coordinates' => $data['coordinates'],
                        'place' => $data['place'],
                        'language' => $data['lang'],
			'retweeted' => $data['retweeted']
                        );
	
    
      
      print $refinedData['user_screen_name'] . ': ' . $refinedData['text'] . "\n";
      
    
	$refinedJSON = json_encode($refinedData,true);
      $myFile = fopen('tweetsLocation.json', 'a');
      fwrite($myFile, $refinedJSON . "\n");
      fclose($myFile);
	$m = new MongoClient();
	$db = $m->SocialMedia;
	$collection = $db->tweetsByLocation;
	$collection->insert($refinedData);
	

	
  }
}



// The OAuth credentials you received when registering your app at Twitter
define("TWITTER_CONSUMER_KEY", "UhAWWHnOa8pHU78FgYaHmWEQN");
define("TWITTER_CONSUMER_SECRET", "qaXWnC2aQ3BmABbMYVDiOQ2EXij9SOBauVIx25YLbuKo47srhO");


// The OAuth data for the twitter account
define("OAUTH_TOKEN", "3150881842-bxomhSUyXuvGy12WAdq5uBz7OUwPi9qwMuebza6");
define("OAUTH_SECRET", "PebJAPeR2ej1fkzRg8nZfVffNCgOQpuUgeXTC8eFT3T9K");

// Start streaming
$sc = new FilterTrackConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
$sc->setLocations(array(
       array(17.51, 59.79, 17.80, 59.91)
   ));;
$sc->consume();
