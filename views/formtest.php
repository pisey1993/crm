<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AJAX POST Example</title>
</head>
<body>
  <h2>Send Data to PHP without Reload</h2>
  
  <form id="myForm">
    <label for="inputData">Enter something:</label>
    <input type="text" id="inputData" name="inputData" required />
    <button type="submit">Send</button>
  </form>
  
  <div id="result" style="margin-top: 20px; font-weight: bold;"></div>
  
  <script>
    const form = document.getElementById('myForm');
    const resultDiv = document.getElementById('result');

    form.addEventListener('submit', (event) => {
      event.preventDefault();

      const formData = new FormData(form);

      fetch('controllers/getdata.php', {
        method: 'POST',
        body: formData,
      })
      .then(response => response.text())
      .then(data => {
        resultDiv.textContent = 'Response from PHP: ' + data;
      })
      .catch(error => {
        resultDiv.textContent = 'Error: ' + error.message;
      });
    });
  </script>
</body>
</html>
