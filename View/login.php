<!DOCTYPE html>
<html lang="en">

<head>
    <title>Explore Bangladesh - Login</title>

    <link rel="stylesheet" href="login.css">
</head>

<body>

<h1 style="text-align: center;">
    <span class="explore">Explore</span>
    <span class="bangladesh">Bangladesh</span>
</h1>

<form action="../Controller/login-controller.php" method="POST" onsubmit="return validate(this)">

<table align="center">

    <tr>
        <td>

            <fieldset class="login-info">

                <legend>Login Information</legend>

                <h2>Welcome Back!</h2>

                <p class="login-text">
                    Login to continue your journey with Explore Bangladesh
                </p>

                <br>

                <label for="username">Email / Username</label>

                <input type="text"
                       id="username"
                       name="username">
                    <span id="usernameErrMsg" class="error-msg"></span>

                <br><br><br>

                <label for="password">Password</label>

                <input type="password"
                       id="password"
                       name="password">
                    <span id="passwordErrMsg" class="error-msg"></span>

                <br><br><br><br>

                <a href="forgot-password.php" class="forgot">
                    Forgot / Reset Password
                </a>

                <br><br><br>

              
                 <input type="submit"
                 value="LOGIN"
                 class="login-btn">
                

                <br><br><br>

                <div class="register">
                    <span>New user?</span>
                    <a href="registration.php">REGISTRATION</a>
                </div>
            </fieldset>

        </td>
    </tr>

</table>

</form>
<?php include 'login-js-validation.php'; ?>
</body>

</html>