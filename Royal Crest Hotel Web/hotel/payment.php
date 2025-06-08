<?php
// This should be at the TOP of your file, before any HTML output
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = ""; // Removed space between quotes if your password is empty
    $dbname = "royal_crest_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// Get form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];


// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bookings (first_name, last_name, email, phone, text_alerts, country, street_address, city, state, zip_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssisssss", $firstName, $lastName, $email, $phone, $textAlerts, $country, $streetAddress, $city, $state, $zipCode);

// Execute the statement
if ($stmt->execute()) {
    echo "Booking confirmed successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 18px;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .form-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .phone-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .phone-prefix {
            flex: 0 0 50px;
        }
        .phone-number {
            flex: 1;
        }
        .checkbox-container {
            margin-top: 10px;
        }
        .note {
            font-size: 14px;
            color: #666;
            margin-top: -10px;
            margin-bottom: 15px;
        }
        .required:after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body>
    <h1>CONFIRM YOUR BOOKING</h1>

    <div class="form-section">
        <h2>Room 1 Guest Name <span class="required"></span></h2>
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" name="firstName" required>
        
        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lastName" required>
    </div>

    <div class="form-section">
        <h2>Email Address <span class="required"></span></h2>
        <input type="email" id="email" name="email" required>
        <p class="note">Double-check for typos</p>
        <p class="note">Confirmation email sent to this address</p>
    </div>

    <div class="form-section">
        <h2>Mobile Phone Number <span class="required"></span></h2>
        <div class="phone-container">
            <div class="phone-prefix">+1</div>
            <input type="tel" id="phone" name="phone" pattern="\(\d{3}\) \d{3}-\d{4}" placeholder="(###) ###-####" class="phone-number" required>
        </div>

            


        <p class="note">So the property can reach you</p>
        <div class="checkbox-container">
            <input type="checkbox" id="textAlerts" name="textAlerts">
            <label for="textAlerts">Receive text alerts about this trip and occasional offers</label>
        </div>
    </div>

    <h1>Billing Address</h1>
    <p class="note">Credit card billing address</p>

    <div class="form-section">
        <h2>Country <span class="required"></span></h2>
        <select id="country" name="country" required>
            <option value="US" selected>United States of America</option>
           
        </select>
    </div>

    <div class="form-section">
        <label for="streetAddress" class="required">Street Address</label>
        <input type="text" id="streetAddress" name="streetAddress" required>
        
        <label for="city" class="required">City</label>
        <input type="text" id="city" name="city" required>
        
        <label for="state" class="required">State</label>
        <select id="state" name="state" required>
            
            
        </select>
        
        <label for="zipCode" class="required">Billing ZIP Code</label>
        <input type="text" id="zipCode" name="zipCode" required>
    </div>

<!-- Change the opening body tag to include a form element -->
<form action="process_booking.php" method="POST">
<!-- All your existing form fields go here -->
<!-- Change the book link to a submit button -->
<button type="submit">Book</button>
</form>

    


</body>
</html>