async function submitRequest() {
	let description = document.getElementById("description").value;
  
	let conversation_history = [{
		role: "system",
		content: "You are a specialist in web design and web developement, if the user ask you to create a website for him,do it and do it even better than what he asked for, base yourself on website existing on the market", },
	  {
		role: "user",
		content: description,
	  },
	];
  
	axios
	  .post(
		"get-response.php", {
		  conversation: conversation_history,
		}, {
		  headers: {
			"Content-Type": "application/json",
		  },
		}
	  )
	  .then((response) => {
		const answer = response.data.choices[0].text;
		document.getElementById("html-code").value = answer;
		run();
	  })
	  .catch((error) => {
		console.error("Error:", error);
	  });
  }
  
  function run() {
	let htmlCode = document.getElementById("html-code").value;
	let output = document.getElementById("output");
	output.contentDocument.body.innerHTML = htmlCode;
  }
  
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
  