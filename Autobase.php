<?php
ini_set('display_errors', 1);
require_once('lib2/twitteroauth.php');
//require_once('lib/twitteroauth.php');
/** Ambil data hari : https://developer.twitter.com/en/apps **/
define('CONSUMER_KEY', 'cBo8YGDj10ym4CdDFOpFft2Rv'); //isi
define('CONSUMER_SECRET', 'AFKAiuP2nsGvHTkgGy8q2vv690dhKkggtOCGGWZdVlzLvj1ofL'); //isi
define('access_token', '1195808018048282624-428Yw1jkqqHYw6ZH41ZCjehyehlBBl'); //isi
define('access_token_secret', 'C0WLkw5uponc22FZp36CDW32EpZnTWtr2N9Qp8EaAGBsO'); //isi

//==========================

// function jika hanya text saja maka tweet textnya kemudian destroy dm nya
function ngetweet($kata,$dmids) {
$koneksi = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
$eksekusi = $koneksi->post('statuses/update', array('status' => $kata));
$eksekusi = json_encode($eksekusi);
echo $eksekusi;
// destroy dm jika sudah di tweet
$konekdm = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
$eksedm = $konekdm->delete('direct_messages/events/destroy', array('id' => $dmids));
$eksedm = json_encode($eksekusi);
echo $eksedm;
}

//==========================

// function jika ada gambar maka tweet gambar dan textnya kemudian destroy dm nya
function ngetweetmedia($kata,$img,$dmids) {
$koneksi = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
$iki = $koneksi->img($img);
$postfields = array('media_data' => base64_encode($iki));
$eksekusi = $koneksi->post('https://upload.twitter.com/1.1/media/upload.json', $postfields);
$img = json_decode(json_encode($eksekusi));
$postfields = array('media_ids' => $img->media_id_string,'status' => $kata);
$eksekusi = $koneksi->post('statuses/update', $postfields);
$eksekusi = json_encode($eksekusi);
echo $eksekusi;
// destroy dm jika sudah di tweet
$konekdm = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
$eksedm = $konekdm->delete('direct_messages/events/destroy', array('id' => $dmids));
$eksedm = json_encode($eksedm);
echo $eksedm;
}

//==========================

// get dm list 
$koneksi = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
$dm = $koneksi->get('direct_messages/events/list');
$someObject = json_decode(json_encode($dm));
foreach ($someObject->events as $item) {
$tweet = $item->message_create->message_data->text;
if(strpos($tweet, 'Matamu!') !== false) { // ganti key nya
$dmids = $item->id;
echo $dmids;
$iki = $item->message_create->message_data->entities->urls;
if($iki == null){
ngetweet($tweet,$dmids);
}else{
$pecah = explode("https://", trim($tweet));
$tweet = trim($pecah[0]);
$img = $item->message_create->message_data->attachment->media->media_url.':large';
ngetweetmedia($tweet,$img,$dmids);
}
}
}
?>