<?php
$gender = $_POST['gender'] ?? '';
$age = $_POST['age'] ?? '';
$weight = $_POST['weight'] ?? '';
$height = $_POST['height'] ?? '';
$activityLevel = $_POST['activity_level'] ?? '';

$data = array(
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        [
            'role' => 'system',
            'content' => 'You are a helpful assistant.'
        ],
        [
            'role' => 'user',
            'content' => "generate a full diet plan with a lot of details for this person: \nGender: $gender \nAge: $age \nWeight: $weight \nHeight: $height \nActivity Level: $activityLevel"
        ]
    ],
    'temperature' => 0.9,
);

function getResponseFromApi($data): string
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.openai.com/v1/chat/completions",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer " . getenv('OPENAI_API_KEY')
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data)
    ));
    $response = curl_exec($curl);

    if ($response === FALSE) {
        return "Error no response from OpenAI";
    }

    $result = json_decode($response, true);
    curl_close($curl);
    if (isset($result['error'])) {
        return "Error : " . $result['error']['message'] . " (code :" . $result['error']['code'] . ")";
    }
    return $result['choices'][0]['message']['content'];
}

$dietPlan = getResponseFromApi($data);

if (!$dietPlan) {
    $dietPlan = "No diet plan was generated. Please check your inputs and try again.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Diet Plan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 40px;
            text-align: center;
        }

        h1 {
            color: #27ae60;
            font-size: 36px;
            margin-bottom: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .diet-plan {
            text-align: left;
            margin-top: 30px;
            white-space: pre-line;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Generated Diet Plan</h1>
        <div class="diet-plan">
            <?php echo $dietPlan; ?>
        </div>
    </div>
</body>

</html>