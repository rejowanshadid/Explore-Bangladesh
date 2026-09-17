<!DOCTYPE html>
<html lang="en">

<head>
    <title>Explore Bangladesh - Forgot Password</title>

    <link rel="stylesheet" href="forgot-password.css">
</head>

<body>

<h1 style="text-align: center;">
    <span class="explore">Explore</span>
    <span class="bangladesh">Bangladesh</span>
</h1>

<form action="../Controller/forgot-password-php-validation.php" method="POST" onsubmit="return validate(this)">

<table align="center">

    <tr>
        <td>

            <fieldset class="forgot-info">

                <legend>Reset Password</legend>

                <h2>Reset Your Password</h2>

                <p class="forgot-text">
                    Enter your username and create a new password
                </p>

                <br>

                <label for="username">User Name</label>
                : <input type="text"
                         id="username"
                         name="username">
                <span id="usernameErrMsg" class="error-msg"></span>

                <br><br><br>

                <label for="newPassword">New Password</label>
                : <input type="password"
                         id="newPassword"
                         name="newPassword">
                <span id="newPasswordErrMsg" class="error-msg"></span>

                <br><br><br>

                <label for="confirmPassword">Confirm Password</label>
                : <input type="password"
                         id="confirmPassword"
                         name="confirmPassword">
                <span id="confirmPasswordErrMsg" class="error-msg"></span>

                <br><br><br>

                <input type="submit"
                       value="RESET PASSWORD"
                       class="reset-btn">

                <br><br>

                <a href="login.php" class="back-btn">BACK</a>

            </fieldset>

        </td>
    </tr>

</table>

</form>

<?php include 'forgot-password-js-validation.php'; ?>

</body>

</html>