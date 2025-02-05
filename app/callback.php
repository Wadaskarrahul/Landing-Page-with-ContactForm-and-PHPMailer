<?php
$clientId = '3MVG9WVXk15qiz1Lut1JzAeRk_PDgZKzeIjos7F9wuud8bvdQe6BJ3H7KrZj5PWuhbi_q8ElqxpMnBp11WUox';
$clientSecret = '5596BDCB251E17F73D93FEF517DD6977B95E506178B31669908AA718CC87578D';
$username = 'rahul@rahulwadaskar.sandbox';
$password = 'nidhu@2001';

$tokenUrl = 'https://login.salesforce.com/services/oauth2/token';

$data = [
    'grant_type' => 'password',
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'username' => $username,
    'password' => $password
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ],
];

$context  = stream_context_create($options);
$response = file_get_contents($tokenUrl, false, $context);

if ($response === FALSE) {
    die("Error getting access token.");
}

$tokenData = json_decode($response, true);
$accessToken = $tokenData['access_token'];
$instanceUrl = $tokenData['instance_url'];

echo "Access Token: " . $accessToken . "\n";
echo "Instance URL: " . $instanceUrl . "\n";
?>