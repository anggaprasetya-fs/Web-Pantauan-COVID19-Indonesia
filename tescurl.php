<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://uangkan.com/otp/send");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Mobile Safari/537.36");
$output = curl_exec($ch);
curl_close($ch);

$json2 = json_decode($output);

echo "<pre>";
print_r($json2);
echo "</pre>";

?>