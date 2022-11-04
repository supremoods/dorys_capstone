<?php
$ch = curl_init('https://textbelt.com/text');
$data = array(
  'phone' => '+639972114073',
  'message' => 'Hello world',
  'key' => '249cd51019d3a608d1173e80a6aec1357f5941d6rpwjYBbIeiFCKiqiXBfdIXddg',
);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

?>