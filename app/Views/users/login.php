<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login and Signup Forms</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    body {
        background-color: #f2f2f2;
    }
    .container {
        max-width: 400px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
    }
    label {
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="tel"],
    select {
        width: calc(100% - 20px);
        margin-bottom: 15px;
        border-radius: 3px;
    }
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        border: none;
        border-radius: 3px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    .toggle-btn {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        border: none;
        border-radius: 3px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-bottom: 10px;
    }
    .toggle-btn:hover {
        background-color: #0056b3;
    }
    .login-btn {
        margin-right: 5px;
    }
    .signup-btn {
        margin-left: 5px;
    }
    .btn-container {
        text-align: center;
    }
    .signup-form {
        display: none;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Login</h2>
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger">
            <?= session('error') ?>
        </div>
    <?php endif; ?>
    <form id="loginForm" action="/login/authenticate" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary login-btn">Login</button>
    </form>
    <div class="btn-container">
        <button class="toggle-btn signup-btn" id="toggleSignup">Signup</button>
    </div>
</div>

<div class="container signup-form">
    <h2>Signup</h2>
    <form id="signupForm" action="/signup" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="userType">User Type:</label>
            <select class="form-control" id="userType" name="userType" onchange="toggleFields()">
                <option value="" disabled selected>Choose an account type</option>
                <option value="student">Student</option>
                <option value="alumni">Alumni</option>
                <option value="outsider">Outsider</option>
            </select>
        </div>
        <div id="schoolIDField" style="display: none;">
            <div class="form-group">
                <label for="schoolID">School ID:</label>
                <input type="text" class="form-control" id="schoolID" name="schoolID" required>
            </div>
        </div>
        <div id="alumniCardNumberField" style="display: none;">
            <div class="form-group">
                <label for="alumniCardNumber">Alumni Card Number:</label>
                <input type="text" class="form-control" id="alumniCardNumber" name="alumniCardNumber">
            </div>
        </div>
        <div class="form-group">
            <label for="firstName">First Name:</label>
            <input type="text" class="form-control" id="firstName" name="firstName" required>
        </div>
        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" class="form-control" id="lastName" name="lastName" required>
        </div>
        <div class="form-group">
            <label for="dateOfBirth">Date of Birth:</label>
            <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary signup-btn">Signup</button>
    </form>
    <div class="btn-container">
        <button class="toggle-btn login-btn" id="toggleLogin">Login</button>
    </div>
</div>

<script>
function toggleFields() {
    var userType = document.getElementById('userType').value;
    var schoolIDField = document.getElementById('schoolIDField');
    var alumniCardNumberField = document.getElementById('alumniCardNumberField');

    if (userType === 'student') {
        schoolIDField.style.display = 'block';
        schoolIDField.querySelector('input').setAttribute('required', 'required');
        alumniCardNumberField.style.display = 'none';
        alumniCardNumberField.querySelector('input').removeAttribute('required');
    } else if (userType === 'alumni') {
        schoolIDField.style.display = 'none';
        schoolIDField.querySelector('input').removeAttribute('required');
        alumniCardNumberField.style.display = 'block';
        alumniCardNumberField.querySelector('input').setAttribute('required', 'required');
    } else if (userType === 'outsider') {
        schoolIDField.style.display = 'none';
        schoolIDField.querySelector('input').removeAttribute('required');
        alumniCardNumberField.style.display = 'none';
        alumniCardNumberField.querySelector('input').removeAttribute('required');
    } else {
        schoolIDField.style.display = 'none';
        schoolIDField.querySelector('input').removeAttribute('required');
        alumniCardNumberField.style.display = 'none';
        alumniCardNumberField.querySelector('input').removeAttribute('required');
    }
}

document.getElementById('toggleSignup').addEventListener('click', function() {
    document.getElementById('loginForm').style.display = 'none';
    document.querySelector('.signup-form').style.display = 'block';
});

document.getElementById('toggleLogin').addEventListener('click', function() {
    document.querySelector('.signup-form').style.display = 'none';
    document.getElementById('loginForm').style.display = 'block';
});
</script>

</body>
</html>
