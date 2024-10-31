<!DOCTYPE html>
<html>

<head>
    <title>QR Scanner</title>
</head>

<body>
    <h1>Scanner</h1>
         <center>
        <video id="video" style="width: 50%;"></video>
        <canvas id="canvas" hidden></canvas>
        <p id="output"></p>
        <center>
            <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
            <script>
    const event_id = <?php echo $event_id; ?>;
    const video = document.getElementById('video');
    const canvasElement = document.getElementById('canvas');
    const canvas = canvasElement.getContext('2d');
    const output = document.getElementById('output');

    function startQRScanner() {
        navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: 'environment'
            }
        })
        .then(function(stream) {
            video.srcObject = stream;
            video.setAttribute('playsinline', true); // Required for iOS
            video.play();
            requestAnimationFrame(scanQR);
        })
        .catch(err => {
            console.error("Error accessing camera: ", err);
        });
    }

    function scanQR() {
        if (video.readyState === video.HAVE_ENOUGH_DATA) {
            canvasElement.height = video.videoHeight;
            canvasElement.width = video.videoWidth;
            canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
            const imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
            const code = jsQR(imageData.data, imageData.width, imageData.height);

            if (code) {
                // Output the QR code data and stop scanning
                // output.innerText = `QR Code: ${code.data}`;
                console.log(code.data);
                stopScanner();
                // Optionally navigate to the scanned URL
                location.href = code.data+'&event_id='+event_id;
            }
        }
        requestAnimationFrame(scanQR);
    }

    function stopScanner() {
        // Stop the video stream and cleanup
        const stream = video.srcObject;
        if (stream) {
            const tracks = stream.getTracks();
            tracks.forEach(track => track.stop());
        }
        video.srcObject = null;
    }

    startQRScanner();
</script>

</body>

</html>