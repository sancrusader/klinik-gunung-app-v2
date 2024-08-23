<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload atau Capture KTP</title>
    <style>
        #video {
            width: 100%;
            height: auto;
            border: 1px solid black;
        }

        #canvas {
            display: none;
        }
    </style>
</head>

<body>
    <h1>Upload atau Capture KTP</h1>

    <!-- Form untuk upload file -->
    <form id="upload-form" action="{{ route('ktp.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Upload File KTP</h2>
        <input type="file" name="ktp_file" accept="image/*">
        <button type="submit">Upload</button>
    </form>

    <!-- Video element to display camera feed -->
    <h2>Capture KTP</h2>
    <video id="video" autoplay></video>
    <button id="capture">Capture</button>

    <!-- Canvas element to hold the captured image -->
    <canvas id="canvas"></canvas>

    <!-- Form untuk upload gambar dari kamera -->
    <form id="camera-form" action="{{ route('ktp.upload') }}" method="POST">
        @csrf
        <input type="hidden" name="ktp_image" id="ktp_image">
        <button type="submit">Upload KTP dari Kamera</button>
    </form>

    <script>
        // Select the elements
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureButton = document.getElementById('capture');
        const ktpImageInput = document.getElementById('ktp_image');
        const context = canvas.getContext('2d');
        const cameraForm = document.getElementById('camera-form');

        // Get access to the camera
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error("Error accessing the camera: ", err);
            });

        // Capture image from video stream when button is clicked
        captureButton.addEventListener('click', () => {
            // Set canvas dimensions to video dimensions
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            // Draw image from video onto canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            // Convert canvas image to base64
            const imageData = canvas.toDataURL('image/png');
            // Set base64 image data to hidden input field
            ktpImageInput.value = imageData;
        });

        // Optional: Prevent camera form submission if no image captured
        cameraForm.addEventListener('submit', (e) => {
            if (!ktpImageInput.value) {
                e.preventDefault();
                alert('Capture an image first.');
            }
        });
    </script>
</body>

</html>
