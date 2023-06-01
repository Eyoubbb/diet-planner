<?php
session_start();

$conversation = isset($_POST['conversation']) ? $_POST['conversation'] : array();
$userMessage = end($conversation)['content'];

// Add the user message to the conversation
$conversation[] = array('role' => 'user', 'content' => $userMessage);

$data = array(
    'messages' => $conversation
);

$apiKey = "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";
$endpoint = "https://api.openai.com/v1/chat/completions";

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\nAuthorization: Bearer " . $apiKey,
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);

$context = stream_context_create($options);
$result = file_get_contents($endpoint, false, $context);
$response = json_decode($result);

$gptReply = $response->choices[0]->message->content;

// Add the GPT reply to the conversation
$conversation[] = array('role' => 'assistant', 'content' => $gptReply);

$_SESSION['conversation'] = $conversation;

echo $gptReply;
