# Auto menfes Twitter
using twitter api https://developer.twitter.com/

## Tutorial
Ganti bagian dengan key dan token mu (https://developer.twitter.com/en/apps)
```
 define('CONSUMER_KEY', 'key here'); 
 define('CONSUMER_SECRET', 'secret here'); 
 define('access_token', 'token here'); 
 define('access_token_secret', 'token secret here'); 
```
isi dengan kata untuk triggered dm
```
if(strpos($tweet, 'KATA UNTUK TRIGGERED DM') !== false)
```

## Setting Cronjobs
untuk cronjobs bisa disetting setiap 2-5 menit sekali biar aman

### Hosting tidak support cron jobs?
bisa pake google script https://script.google.com/ 

### Caranya?
Login ke google script kemudian Klik "Project Baru" dan Isi dengan 
```
function cronExecute() {
var url = "https://webkamu.com/Autobase.php"; // ganti dengan url kalian
var options = {
"method" : "get",
"headers" : {'User-Agent' : 'Mozilla Firefox 14.0',
'Accept-Charset' : 'ISO-8859-1,utf-8;q=0.7,*;q=0.7'
},
"payload" : "",
"contentType" : "application/xml; charset=utf-8"
};
var request_starttime = new Date();
// fetch the HTTP / HTTPS request and get the response
var response = UrlFetchApp.fetch(url,options);
var request_endtime = new Date();
}
```
Kalo bingung bisa search google "membuat cronjobs dengan google script"

## Update

* Fixing bug 
* added Destroy dm setelah di post
* etc
