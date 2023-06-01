<?php
$feeling = isset($_GET["diet_feeling"]) ? $_GET["diet_feeling"] : "";
$improvements = isset($_GET["improvements"]) ? $_GET["improvements"] : [];
$comments = isset($_GET["comments"]) ? $_GET["comments"] : "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Thank You</title>
	<style>
		* {
			box-sizing: border-box;
		}

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

		p {
			font-size: 18px;
			line-height: 1.6;
			margin-bottom: 10px;
		}

		.container {
			max-width: 600px;
			margin: 0 auto;
			background-color: #fff;
			border-radius: 8px;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
			padding: 40px;
		}

		.icon-checkmark {
			display: inline-block;
			width: 60px;
			height: 60px;
			background-color: #27ae60;
			border-radius: 50%;
			margin-bottom: 20px;
			line-height: 60px;
			text-align: center;
			color: #fff;
			font-size: 36px;
		}

		.thank-you-message {
			font-size: 24px;
			color: #333;
			margin-bottom: 20px;
		}

		.answer-label {
			font-weight: bold;
			color: #555;
		}

		.answer-value {
			color: #333;
			margin-left: 5px;
		}

		.improvements-list {
			list-style-type: none;
			padding-left: 0;
			margin-top: 10px;
			margin-bottom: 20px;
			text-align: center;
			/* Change to center */
		}

		.improvements-list li {
			display: inline-block;
			/* Add this line */
			margin-right: 10px;
			/* Add or adjust margin as needed */
		}

		.improvements-list li::before {
			content: '\2713';
			/* Checkmark symbol */
			color: #27ae60;
			display: inline-block;
			width: 20px;
			margin-right: 5px;
			/* Adjust margin as needed */
			vertical-align: middle;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="icon-checkmark">&#10003;</div>
		<h1>Thank You!</h1>
		<p class="thank-you-message">Your submitted answers:</p>
		<p><span class="answer-label">Diet Feeling:</span> <span class="answer-value"><?php echo $feeling; ?></span></p>
		<p class="answer-label">Improvements:</p>
		<ul class="improvements-list">
			<?php foreach ($improvements as $improvement) : ?>
				<li><?php echo $improvement; ?></li>
			<?php endforeach; ?>
		</ul>
		<p><span class="answer-label">Comments:</span> <span class="answer-value"><?php echo $comments; ?></span></p>
		<a class="button" href="diet_plan.php">Get Your Diet Plan</a>

		<style>
			.button {
				display: inline-block;
				background-color: #27ae60;
				color: #fff;
				border: none;
				padding: 10px 20px;
				font-size: 16px;
				border-radius: 4px;
				text-decoration: none;
				margin-top: 20px;
				transition: background-color 0.3s ease;
				box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			}

			.button:hover {
				background-color: #1f8f54;
				box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
			}

			.button:active {
				background-color: #169a4e;
				box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
				transform: translateY(1px);
			}
		</style>

	</div>
</body>

</html>