<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Custom QR Code with Centered Logo</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      text-align: center;
    }

    input, button {
      padding: 10px;
      margin: 10px;
      width: 300px;
    }

    #preview, #result {
      margin-top: 20px;
    }

    canvas {
      border: 1px solid #ccc;
    }
  </style>
</head>
<body>

  <h2>Generate QR Code With Logo in Center</h2>

  <input type="file" id="logoUpload" accept="image/*"><br>
  <input type="text" id="linkInput" placeholder="Enter your URL (e.g. https://ngrok.io/...)" />
  <br>
  <button onclick="generateCustomQR()">Generate QR</button>

  <div id="preview">
    <h4>Logo Preview:</h4>
    <img id="logoPreview" src="#" alt="Logo Preview" style="max-width: 100px; display: none;margin-left:47%" />
  </div>

  <div id="result">
    <h4>Final QR with Centered Logo:</h4>
    <canvas id="finalQR" width="300" height="300"></canvas>
    <br>
    <a id="downloadBtn" href="#" download="custom_qr.png" style="display:none;">Download QR Code</a>
  </div>

  <script>
    const qrCanvas = document.getElementById("finalQR");
    const qrContext = qrCanvas.getContext("2d");
    const logoPreview = document.getElementById("logoPreview");
    let logoImage = null;

    document.getElementById("logoUpload").addEventListener("change", function (e) {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = function (event) {
        logoImage = new Image();
        logoImage.onload = function () {
          logoPreview.src = event.target.result;
          logoPreview.style.display = "block";
        };
        logoImage.src = event.target.result;
      };
      reader.readAsDataURL(file);
    });

    function generateCustomQR() {
      const url = document.getElementById("linkInput").value.trim();
      if (!url) {
        alert("Please enter a URL.");
        return;
      }

      const qr = new QRious({
        value: url,
        size: 300,
        level: 'H'
      });

      const qrImg = new Image();
      qrImg.onload = function () {
        qrContext.clearRect(0, 0, 300, 300);
        qrContext.drawImage(qrImg, 0, 0, 300, 300);

        if (logoImage) {
          const logoSize = 60;
          const x = (300 - logoSize) / 2;
          const y = (300 - logoSize) / 2;
          qrContext.drawImage(logoImage, x, y, logoSize, logoSize);
        }

        // Enable download
        const downloadLink = document.getElementById("downloadBtn");
        downloadLink.href = qrCanvas.toDataURL("image/png");
        downloadLink.style.display = "inline-block";
      };

      qrImg.src = qr.toDataURL();
    }
  </script>

</body>
</html>
