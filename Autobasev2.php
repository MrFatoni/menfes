<?php
ini_set('display_errors', 1);
require_once('lib2/twitteroauth.php');
//require_once('lib/twitteroauth.php');
//ikiganteng
/** Ambil data hari : https://developer.twitter.com/en/apps **/
define('CONSUMER_KEY', 'input'); //isi
define('CONSUMER_SECRET', 'input'); //isi
define('access_token', 'input'); //isi
define('access_token_secret', 'input'); //isi
// ================

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
function ngetweetrep($kata,$dmids,$whosend,$timestamps,$linknya) {
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
    $eksekusi = $koneksi->post('statuses/update', array('status' => $kata . " " . $linknya));
    $eksekusi = json_encode($eksekusi);
echo $eksekusi;
    $konekdm = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
    $eksedm = $konekdm->delete('direct_messages/events/destroy', array('id' => $dmids));
    $eksedm = json_encode($eksekusi);
echo $eksedm;
}
// ============================================================
function ngetweetmediarep($kata,$img,$dmids,$whosend,$timestamps,$linknya) {
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
        if(strpos($linknya, 't.co/') !== false){
        echo $linknya;
        echo $linknya;
        echo $linknya;
            $koneksi = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
            $postfields = array('media_ids' => $img->media_id_string,'status' => $kata . " " . $linknya);
            $eksekusi = $koneksi->post('statuses/update', $postfields);
            $eksekusi = json_encode($eksekusi);
        echo $eksekusi;
            $konekdm = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
            $eksedm = $konekdm->delete('direct_messages/events/destroy', array('id' => $dmids));
            $eksedm = json_encode($eksedm);
        echo $eksedm;
        }else{
        echo $linknya;
        echo $linknya;
        echo $linknya;
            $koneksi = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
            $postfields = array('media_ids' => $img->media_id_string,'status' => $kata);
            $eksekusi = $koneksi->post('statuses/update', $postfields);
            $eksekusi = json_encode($eksekusi);
        echo $eksekusi;
            $konekdm = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
            $eksedm = $konekdm->delete('direct_messages/events/destroy', array('id' => $dmids));
            $eksedm = json_encode($eksedm);
        echo $eksedm;
        }
}
// ============================================================

$koneksi = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
$dm = $koneksi->get('direct_messages/events/list');
$someObject = json_decode(json_encode($dm));
foreach ($someObject->events as $item) {
    $tweet = $item->message_create->message_data->text;
    if(strpos($tweet, '[Admin]') !== false) { // ganti key nya
        $dmids = $item->id;
        $whosend = $item->message_create->sender_id;
        $timestamps = $item->created_timestamp;
        echo $dmids;
        $iki = $item->message_create->message_data->entities->urls;
// =====
            if($iki == null){
                if(strpos($tweet, 't.co/') !== false){
                    $pecah = explode("https://", trim($tweet));
                    $tweet = trim($pecah[0]);
                    $repmedia = trim($pecah[1]);
                    $linknya = str_replace("t.co/","https://t.co/", $repmedia);
                    ngetweetrep($tweet,$dmids,$whosend,$timestamps,$linknya);
                }
                    else{
                    ngetweet($tweet,$dmids,$whosend,$timestamps);
                    }
            }
// =====
            else{
                if(strpos($tweet, 't.co/') !== false){
                    $pecah = explode("https://", trim($tweet));
                    $tweet = trim($pecah[0]);
                    $repmedia = trim($pecah[1]);
                    $linknya = str_replace("t.co/","https://t.co/", $repmedia);
                    $img = $item->message_create->message_data->attachment->media->media_url.':large';
                    ngetweetmediarep($tweet,$img,$dmids,$whosend,$timestamps,$linknya);
                }else{
                $pecah = explode("https://", trim($tweet));
                $tweet = trim($pecah[0]);
                $repmedia = trim($pecah[1]);
                $linknya = str_replace("t.co/","https://t.co/", $repmedia);
                $img = $item->message_create->message_data->attachment->media->media_url.':large';
                ngetweetmedia($tweet,$img,$dmids,$whosend,$timestamps);
                    }
                }
  }
    }
?>
