<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Diet Plan</title>
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
			margin-bottom: 30px;
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
			background-color: #fff;
			border-radius: 8px;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
			padding: 40px;
		}

		.step {
			display: none;
		}

		.step.active {
			display: block;
		}

		.form-field {
			margin-bottom: 20px;
		}

		.form-field label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
			color: #555;
		}

		.form-field input[type="text"],
		.form-field select {
			width: 100%;
			padding: 10px;
			font-size: 16px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		.button-container {
			margin-top: 30px;
		}

		.button {
			display: inline-block;
			background-color: #27ae60;
			color: #fff;
			border: none;
			padding: 12px 24px;
			font-size: 18px;
			border-radius: 4px;
			text-decoration: none;
			margin-right: 10px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			white-space: nowrap;
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

		.diet-plan {
			text-align: left;
			margin-top: 30px;
		}

		.diet-plan h3 {
			font-size: 24px;
			color: #27ae60;
			margin-bottom: 15px;
		}

		.diet-plan ul {
			list-style-type: none;
			padding-left: 0;
			margin-bottom: 20px;
		}

		.diet-plan li {
			margin-bottom: 8px;
		}
	</style>
</head>

<body>
	<div class="container">
		<h1>Diet Plan</h1>
		<form id="dietForm" action="generate_diet_plan.php" method="post">
			<div class="step active" id="step1">
				<div class="form-field">
					<label for="gender">Gender:</label>
					<select id="gender" name="gender">
						<option value="">Select Gender</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select>
				</div>
				<div class="button-container">
					<button type="button" class="button" onclick="nextStep(2)">Next</button>
				</div>
			</div>
			<div class="step" id="step2">
				<div class="form-field">
					<label for="age">Age:</label>
					<input type="text" id="age" name="age">
				</div>
				<div class="form-field">
					<label for="weight">Weight:</label>
					<input type="text" id="weight" name="weight">
				</div>
				<div class="form-field">
					<label for="height">Height:</label>
					<input type="text" id="height" name="height">
				</div>
				<div class="button-container">
					<button type="button" class="button" onclick="prevStep(1)">Previous</button>
					<button type="button" class="button" onclick="nextStep(3)">Next</button>
				</div>
			</div>
			<div class="step" id="step3">
				<div class="form-field">
					<label for="activity_level">Activity Level:</label>
					<select id="activity_level" name="activity_level">
						<option value="">Select Activity Level</option>
						<option value="sedentary">Sedentary (little to no exercise)</option>
						<option value="light">Lightly active (light exercise/sports 1-3 days/week)</option>
						<option value="moderate">Moderately active (moderate exercise/sports 3-5 days/week)</option>
						<option value="active">Very active (hard exercise/sports 6-7 days a week)</option>
						<option value="extra_active">Extra active (very hard exercise/sports and a physical job)</option>
					</select>
				</div>
				<div class="form-field">
					<label for="goal">Diet Goal:</label>
					<select id="goal" name="goal">
						<option value="">Select Diet Goal</option>
						<option value="lose">Lose Weight</option>
						<option value="maintain">Maintain Weight</option>
						<option value="gain">Gain Weight</option>
					</select>
				</div>
				<div class="button-container">
					<button type="button" class="button" onclick="prevStep(2)">Previous</button>
					<button type="submit" class="button">Submit</button>
				</div>
			</div>
		</form>
	</div>
	<script>
		let currentStep = 1;

		function nextStep(step) {
			document.getElementById(`step${currentStep}`).classList.remove('active');
			currentStep = step;
			document.getElementById(`step${currentStep}`).classList.add('active');
		}

		function prevStep(step) {
			document.getElementById(`step${currentStep}`).classList.remove('active');
			currentStep = step;
			document.getElementById(`step${currentStep}`).classList.add('active');
		}
	</script>
</body>

</html>