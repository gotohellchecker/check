<?php
    date_default_timezone_set("Asia/kolkata");
    //Data From Webhook
    $content = file_get_contents("php://input");
    $update = json_decode($content, true);
    $chat_id = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];
    $id = $update["message"]["from"]["id"];
    $username = $update["message"]["from"]["username"];
    $firstname = $update["message"]["from"]["first_name"];
    $message_id = $upadte["message"]["message_id"];

    //Start message
    if($message == "/start"){
        send_message($chat_id, "Hey $firstname  \nUse /bin xxxxxx To check Bins  \nBot by @reboot13 ");
    }



//Bin Lookup
   if(strpos($message, "/bin") === 0){
        $bin = substr($message, 5);
   $curl = curl_init();
   curl_setopt_array($curl, [
	CURLOPT_URL => "http://gotohell.me/other/api.php?lista=".$bin,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
]);

$result = curl_exec($curl);
curl_close($curl);
$data = json_decode($result, true);

$cok = $data['cok'];
$hasil = $data['result'];
  if ($cok != null) {
        send_MDmessage($chat_id, "***
    Bin: $bin
Type: $cok
Credit/Debit:$hasil
Checked By @$username ***");
    }
else {
    send_MDmessage($chat_id, "Enter Valid BIN");
}
   }
//Send Messages with Markdown (Global)
      function send_MDmessage($chat_id, $message){
       $apiToken = "1662123689:AAEiZBqjdakgn3RKJ_Dz9raRSpHw-9V7MaU";
        $text = urlencode($message);
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&text=$text&parse_mode=Markdown");
    }
    
?>
