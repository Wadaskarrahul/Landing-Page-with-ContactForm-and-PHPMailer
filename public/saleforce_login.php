<?php
$client_id = "3MVG9WVXk15qiz1Lut1JzAeRk_PDgZKzeIjos7F9wuud8bvdQe6BJ3H7KrZj5PWuhbi_q8ElqxpMnBp11WUox";
$redirect_uri = "https://60a5-210-16-94-178.ngrok-free.app/rahul/app/callback.php";
$auth_url = "https://login.salesforce.com/services/oauth2/authorize?"
    . "response_type=code"
    . "&client_id=" . $client_id
    . "&redirect_uri=" . urlencode($redirect_uri);

header("Location: $auth_url");
exit;
?>
