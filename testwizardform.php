<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Process form data here

	// For example, you can store the answers in variables
	$dietFeeling = $_POST["diet_feeling"];
	$improvements = $_POST["improvements"];
	$comments = $_POST["comments"];

	// You can then use the stored data to send to the ChatGPT API or perform other actions
	// ...

	// Redirect to a thank you page or display a success message
	header("Location: thank_you.php?feeling=" . urlencode($dietFeeling) . "&improvements=" . urlencode(implode(", ", $improvements)) . "&comments=" . urlencode($comments));
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

	<title>Document</title>
</head>

<body><!-- multistep form -->
	<form id="msform" method="GET" action="thank_you.php">
		<!-- progressbar -->
		<ul id="progressbar">
			<li class="active">Diet Assessment</li>
			<li>Improvements</li>
			<li>Additional Comments</li>
		</ul>
		<!-- fieldsets -->
		<fieldset>
			<h2 class="fs-title">Diet Assessment</h2>
			<h3 class="fs-subtitle">
				How are you feeling about your current diet?
			</h3>
			<label><input type="radio" name="diet_feeling" value="Great" /> I feel great</label><br />
			<label><input type="radio" name="diet_feeling" value="Okay" /> I feel okay</label><br />
			<label><input type="radio" name="diet_feeling" value="Not good" /> I do not feel good</label><br />
			<input type="button" name="next" class="next action-button" value="Next" />
		</fieldset>
		<fieldset>
			<h2 class="fs-title">Improvements</h2>
			<h3 class="fs-subtitle">
				What improvements would you like to make in your diet?
			</h3>
			<label><input type="checkbox" name="improvements[]" value="More fruits and vegetables" /> More fruits and vegetables</label><br />
			<label><input type="checkbox" name="improvements[]" value="Less sugar" /> Less sugar</label><br />
			<label><input type="checkbox" name="improvements[]" value="More protein" /> More protein</label><br />
			<label><input type="checkbox" name="improvements[]" value="Balanced meals" /> Balanced meals</label><br />

			<input type="button" name="previous" class="previous action-button" value="Previous" />
			<input type="button" name="next" class="next action-button" value="Next" />
		</fieldset>
		<fieldset>
			<h2 class="fs-title">Additional Comments</h2>
			<h3 class="fs-subtitle">Any other suggestions or feedback?</h3>
			<textarea name="comments" placeholder="Comments"></textarea>
			<input type="button" name="previous" class="previous action-button" value="Previous" />
			<input type="submit" name="submit" class="submit action-button" value="Submit" />
		</fieldset>
	</form>

	<div id="preview" style="display: none;">
		<h2>Review Your Answers</h2>
		<p>Diet Feeling: <span id="preview-diet-feeling"></span></p>
		<p>Improvements: <span id="preview-improvements"></span></p>
		<p>Comments: <span id="preview-comments"></span></p>
	</div>

	<style>
		label {
			display: inline-block;
			margin-bottom: 0.5rem;
		}

		/*custom font*/
		@import url(https://fonts.googleapis.com/css?family=Montserrat);

		/*basic reset*/
		* {
			margin: 0;
			padding: 0;
		}

		html {
			height: 100%;
			/*Image only BG fallback*/

			/*background = gradient + image pattern combo*/
			background: linear-gradient(rgba(196, 102, 0, 0.6),
					rgba(155, 89, 182, 0.6));
		}

		body {
			font-family: montserrat, arial, verdana;
		}

		/*form styles*/
		#msform {
			width: 800px;
			/*increased form width*/
			margin: 50px auto;
			text-align: center;
			position: relative;
		}

		#msform fieldset {
			background: white;
			border: 0 none;
			border-radius: 3px;
			box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
			padding: 20px 30px;
			box-sizing: border-box;
			width: 80%;
			margin: 0 10%;

			/*stacking fieldsets above each other*/
			position: relative;
		}

		/*Hide all except first fieldset*/
		#msform fieldset:not(:first-of-type) {
			display: none;
		}

		/*inputs*/
		#msform input,
		#msform textarea {
			padding: 15px;
			border: 1px solid #ccc;
			border-radius: 3px;
			margin-bottom: 10px;
			width: 100%;
			box-sizing: border-box;
			font-family: montserrat;
			color: #2c3e50;
			font-size: 16px;
			/*increased font size*/
		}

		/*buttons*/
		#msform .action-button {
			width: 100px;
			background: #27ae60;
			font-weight: bold;
			color: white;
			border: 0 none;
			border-radius: 1px;
			cursor: pointer;
			padding: 10px;
			margin: 10px 5px;
			text-decoration: none;
			font-size: 16px;
			/*increased font size*/
		}

		#msform .action-button:hover,
		#msform .action-button:focus {
			box-shadow: 0 0 0 2px white, 0 0 0 3px #27ae60;
		}

		/*headings*/
		.fs-title {
			font-size: 20px;
			/*increased font size*/
			text-transform: uppercase;
			color: #2c3e50;
			margin-bottom: 10px;
		}

		.fs-subtitle {
			font-weight: normal;
			font-size: 16px;
			/*increased font size*/
			color: #666;
			margin-bottom: 20px;
		}

		/*progressbar*/
		#progressbar {
			margin-bottom: 30px;
			overflow: hidden;
			/*CSS counters to number the steps*/
			counter-reset: step;
		}

		#progressbar li {
			list-style-type: none;
			color: white;
			text-transform: uppercase;
			font-size: 14px;
			/*increased font size*/
			width: 33.33%;
			float: left;
			position: relative;
		}

		#progressbar li:before {
			content: counter(step);
			counter-increment: step;
			width: 30px;
			/*increased size*/
			line-height: 30px;
			/*increased size*/
			display: block;
			font-size: 14px;
			/*increased font size*/
			color: #333;
			background: white;
			border-radius: 3px;
			margin: 0 auto 5px auto;
		}

		/*progressbar connectors*/
		#progressbar li:after {
			content: "";
			width: 100%;
			height: 2px;
			background: white;
			position: absolute;
			left: -50%;
			top: 14px;
			/* adjusted position due to increased size */
			z-index: -1;
			/*put it behind the numbers*/
		}

		#progressbar li:first-child:after {
			/*connector not needed before the first step*/
			content: none;
		}

		/*marking active/completed steps green*/
		/*The number of the step and the connector before it = green*/
		#progressbar li.active:before,
		#progressbar li.active:after {
			background: #27ae60;
			color: white;
		}

		/* Add loader styles */
		.loader {
			border: 16px solid #f3f3f3;
			border-top: 16px solid #27ae60;
			border-radius: 50%;
			width: 120px;
			height: 120px;
			animation: spin 2s linear infinite;
			margin: 50px auto;
		}

		@keyframes spin {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}

		#preview {
			margin-top: 20px;
		}

		#preview h2 {
			font-size: 24px;
			margin-bottom: 10px;
		}

		#preview p {
			font-size: 18px;
			margin-bottom: 5px;
		}
	</style>
	<script>
		// jQuery time
		var current_fs, next_fs, previous_fs; // fieldsets
		var left, opacity, scale; // fieldset properties which we will animate
		var animating; // flag to prevent quick multi-click glitches

		$(".next").click(function() {
			if (animating) return false;
			animating = true;

			current_fs = $(this).parent();
			next_fs = $(this).parent().next();

			// activate next step on progressbar using the index of next_fs
			$("#progressbar li")
				.eq($("fieldset").index(next_fs))
				.addClass("active");

			// show the next fieldset
			next_fs.show();
			// hide the current fieldset with style
			current_fs.animate({
				opacity: 0,
			}, {
				step: function(now, mx) {
					// as the opacity of current_fs reduces to 0 - stored in "now"
					// 1. scale current_fs down to 80%
					scale = 1 - (1 - now) * 0.2;
					// 2. bring next_fs from the right(50%)
					left = now * 50 + "%";
					// 3. increase opacity of next_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({
						transform: "scale(" + scale + ")",
						position: "absolute",
					});
					next_fs.css({
						left: left,
						opacity: opacity,
					});
				},
				duration: 800,
				complete: function() {
					current_fs.hide();
					animating = false;
				},
				// this comes from the custom easing plugin
				easing: "easeInOutBack",
			});
		});

		$(".previous").click(function() {
			if (animating) return false;
			animating = true;

			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();

			// de-activate current step on progressbar
			$("#progressbar li")
				.eq($("fieldset").index(current_fs))
				.removeClass("active");

			// show the previous fieldset
			previous_fs.show();
			// hide the current fieldset with style
			current_fs.animate({
				opacity: 0,
			}, {
				step: function(now, mx) {
					// as the opacity of current_fs reduces to 0 - stored in "now"
					// 1. scale previous_fs from 80% to 100%
					scale = 0.8 + (1 - now) * 0.2;
					// 2. take current_fs to the right(50%) - from 0%
					left = (1 - now) * 50 + "%";
					// 3. increase opacity of previous_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({
						left: left,
					});
					previous_fs.css({
						transform: "scale(" + scale + ")",
						opacity: opacity,
					});
				},
				duration: 800,
				complete: function() {
					current_fs.hide();
					animating = false;
				},
				// this comes from the custom easing plugin
				easing: "easeInOutBack",
			});
		});

		// Submit the form
		$(".submit").click(function() {
			$("form#msform").submit();
		});
	</script>

</body>

</html>