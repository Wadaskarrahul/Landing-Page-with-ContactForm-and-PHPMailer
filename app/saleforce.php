<?php 


    // Salesforce API credentials
    $clientId = 'YOUR_CONSUMER_KEY';
    $clientSecret = 'YOUR_CONSUMER_SECRET';
    $username = 'YOUR_SALESFORCE_USERNAME';
    $password = 'YOUR_SALESFORCE_PASSWORD_AND_SECURITY_TOKEN';
    
    // Step 1: Get Access Token
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
    
    // Step 2: Prepare Lead Data from Form Submission
    $leadData = [
        'LastName' => $_POST['last_name'],
        'FirstName' => $_POST['first_name'],
        'Company' => $_POST['company'],
        'Email' => $_POST['email']
    ];
    
    // Step 3: Send Data to Salesforce
    $url = $instanceUrl . '/services/data/v57.0/sobjects/Lead/';
    
    $options = [
        'http' => [
            'header'  => "Authorization: Bearer $accessToken\r\n" .
                         "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($leadData),
        ],
    ];
    
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    
    if ($response === FALSE) {
        die("Error creating lead.");
    }
    
    $responseData = json_decode($response, true);
    echo "Lead created with ID: " . $responseData['id'] . "\n";

?>