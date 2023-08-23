<?php
class Api_email
{
  function send_email($email, $subject, $content)
  {
    //echo $email;echo $subject;echo $content;
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_PORT => "8080",
      CURLOPT_URL => "http://172.16.0.49:8080/api/v1/mail/send",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      // CURLOPT_POSTFIELDS => array(
      //   'receiver' => $email,
      //   'subject' => $subject,
      //   'content' => $content
      // ),
      CURLOPT_POSTFIELDS =>"{\n\t\"receiver\": \"$email\",\n\t\"subject\": \"$subject\",\n\t\"content\": \"$content\"\n}",
      CURLOPT_HTTPHEADER => array(
        "authorization: Basic YmxiX3NpbW9uaWthOnMhbW9uMWs0LTNzZG0=",
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: c4b63833-8609-311d-30d5-cfae5d8c5bc7"
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
  }
}
