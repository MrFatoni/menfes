<?php
ini_set('display_errors', 1);
require_once('lib2/twitteroauth.php');
//require_once('lib/twitteroauth.php');
/** Ambil data hari : https://developer.twitter.com/en/apps **/
define('CONSUMER_KEY', 'isi'); //isi
define('CONSUMER_SECRET', 'isi'); //isi
define('access_token', 'isi'); //isi
define('access_token_secret', 'isi'); //isi

// https://developer.twitter.com/en/docs/accounts-and-users/follow-search-get-users/api-reference/get-users-lookup
// ============================================================
function ngetweet($kata,$dmids,$whosend,$timestamps) {
    $konekuser = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
    $getuser = $konekuser->get('users/lookup', array('user_id' => $whosend));
    $getuser = json_encode($getuser);
echo $getuser;
// create log file
$log  = "User: ".$whosend.' - '.date("F j, Y, g:i a").PHP_EOL.
        "Time Stamps: ".$timestamps.PHP_EOL.
        "tweet: ".$kata.PHP_EOL.
        "-------------------------".PHP_EOL;
// Save string to log, use FILE_APPEND to append.
file_put_contents('./logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
// ================
    $koneksi = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
    $eksekusi = $koneksi->post('statuses/update', array('status' => $kata));
    $eksekusi = json_encode($eksekusi);
echo $eksekusi;
    $konekdm = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
    $eksedm = $konekdm->delete('direct_messages/events/destroy', array('id' => $dmids));
    $eksedm = json_encode($eksekusi);
echo $eksedm;
}

// ============================================================
function ngetweetmedia($kata,$img,$dmids,$whosend,$timestamps) {
    $konekuser = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
    $getuser = $konekuser->get('users/lookup', array('user_id' => $whosend));
    $getuser = json_encode($getuser);
echo $getuser;
// create log file
$log  = "User: ".$whosend.' - '.date("F j, Y, g:i a").PHP_EOL.
        "Time Stamps: ".$timestamps.PHP_EOL.
        "tweet: ".$kata.PHP_EOL.
        "-------------------------".PHP_EOL;
// Save string to log, use FILE_APPEND to append.
file_put_contents('./logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
// ================
    $koneksi = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
    $iki = $koneksi->img($img);
    $postfields = array('media_data' => base64_encode($iki));
    $eksekusi = $koneksi->post('https://upload.twitter.com/1.1/media/upload.json', $postfields);
    $img = json_decode(json_encode($eksekusi));
    $postfields = array('media_ids' => $img->media_id_string,'status' => $kata);
    $eksekusi = $koneksi->post('statuses/update', $postfields);
    $eksekusi = json_encode($eksekusi);
echo $eksekusi;
    $konekdm = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
    $eksedm = $konekdm->delete('direct_messages/events/destroy', array('id' => $dmids));
    $eksedm = json_encode($eksedm);
echo $eksedm;
}
// ============================================================

$koneksi = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
$dm = $koneksi->get('direct_messages/events/list');
$someObject = json_decode(json_encode($dm));
foreach ($someObject->events as $item) {
    $tweet = $item->message_create->message_data->text;
    if(strpos($tweet, 'KATA UNTUK TRIGGERED DM') !== false) { // ganti key nya
        $dmids = $item->id;
        $whosend = $item->message_create->sender_id;
        $timestamps = $item->created_timestamp;
        echo $dmids;
        $iki = $item->message_create->message_data->entities->urls;
    if($iki == null){
        ngetweet($tweet,$dmids,$whosend,$timestamps);
    }else{
        $pecah = explode("https://", trim($tweet));
        $tweet = trim($pecah[0]);
        $img = $item->message_create->message_data->attachment->media->media_url.':large';
        ngetweetmedia($tweet,$img,$dmids,$whosend,$timestamps);
}
  }
    }
?>
