<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <!-- Include Instascan and WebRTC adapter scripts -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    
    <!-- CSS for modal styling -->
    <style>
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }
        
        /* Modal content */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }
        
        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>QR Code Scanner</h1>
    <video id="preview"></video>
    <!-- Add input field and button -->
    <input type="text" id="manualGeneratedNumber" placeholder="Enter Generated Number">
    <button onclick="manualScan()">Scan Manually</button>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-result"></p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            initializeScanner();
        });

        function initializeScanner() {
            let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
            scanner.addListener('scan', function (content) {
                displayModal(content);
            });
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function (e) {
                console.error(e);
            });
        }

function displayModal(content) {
    let modal = document.getElementById('myModal');
    let modalContent = document.getElementById('modal-result');
    modalContent.innerText = content;
    modal.style.display = "block";
    let { PurchaseID, GeneratedNumber } = JSON.parse(content);

    // Send data to server for validation
    fetch('validation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ purchaseId: PurchaseID, generatedNumber: GeneratedNumber }),
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Network was not ok.');
        }
    })
    .then(data => {
        // Display result returned from server
        modalContent.innerText = data.message;
    })
    .catch(error => {
        console.error('Error:', error);
    });

    // Close the modal when the user clicks anywhere outside of it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    // Close the modal when the user clicks on the close button
    let closeButton = document.getElementsByClassName("close")[0];
    closeButton.onclick = function() {
        modal.style.display = "none";
    }
}</script>
</body>
</html>

