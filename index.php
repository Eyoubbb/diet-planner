<?php
session_start();
$conversation = isset($_SESSION['conversation']) ? $_SESSION['conversation'] : array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Basic HTML Editor</title>
  <script src="https://kit.fontawesome.com/168d646a0d.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
  <div class="container">
    <div class="left">
      <label>
        <i class="fa-sharp fa-solid fa-quote-right"></i>Enter your website description here ...
      </label>
      <textarea id="description"></textarea>

      <label> <i class="fa-brands fa-html5"></i> HTML </label>
      <textarea id="html-code" onkeyup="run()"></textarea>

      <button onclick="submitRequest()">Submit</button>
    </div>
    <div class="right">
      <iframe id="output"></iframe>
    </div>
  </div>

  <script>
    async function submitRequest() {
      let description = document.getElementById("description").value;

      let conversation_history = [{
          role: "system",
          content: "You are a specialist in web design and web development. If the user asks you to create a website for him, do it and make it even better than what he asked for. Base yourself on existing websites on the market.",
        },
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
              Authorization: "Bearer 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",
            },
          }
        )
        .then((response) => {
          const answer = response.data;
          document.getElementById("html-code").value = answer;
          run();
        })
        .catch((error) => {
          console.error("Error:", error);
          if (error.response) {
            console.log(error.response.data);
            console.log(error.response.status);
            console.log(error.response.headers);
          }
        });
    }

    function run() {
      let htmlCode = document.getElementById("html-code").value;
      let output = document.getElementById("output");
      output.contentDocument.body.innerHTML = htmlCode;
    }
  </script>
</body>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }

  body {
    background: #454545;
    color: #827c7c;
  }

  .container {
    display: flex;
    width: 100%;
    height: 100vh;
    padding: 20px;
  }

  .left,
  .right {
    flex: 1;
    padding: 10px;
  }

  .right {
    background: #e8efef;
  }

  textarea {
    display: block;
    width: 100%;
    height: 40%;
    margin-bottom: 20px;
    padding: 10px;
    background: #1f1f1f;
    color: #fff;
    border: none;
    font-size: 18px;
    resize: none;
  }

  button {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    background: #1f1f1f;
    color: #fff;
    border: none;
    font-size: 18px;
    cursor: pointer;
  }

  button:hover {
    background: #2f2f2f;
  }

  iframe {
    width: 100%;
    height: 100%;
    border: none;
  }

  label i {
    margin-right: 10px;
  }

  label {
    display: flex;
    align-items: center;
    background: #000;
    padding: 10px;
    margin-bottom: 10px;
    color: #fff;
  }

  .right {
    border-radius: 5px;
  }
</style>

</html>