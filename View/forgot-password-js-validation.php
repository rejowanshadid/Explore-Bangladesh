<script>
function validate(p) {

    const username = p.username.value.trim();
    const usernameErrMsg = document.getElementById("usernameErrMsg");
    usernameErrMsg.innerHTML = "";

    const newPassword = p.newPassword.value.trim();
    const newPasswordErrMsg = document.getElementById("newPasswordErrMsg");
    newPasswordErrMsg.innerHTML = "";

    const confirmPassword = p.confirmPassword.value.trim();
    const confirmPasswordErrMsg = document.getElementById("confirmPasswordErrMsg");
    confirmPasswordErrMsg.innerHTML = "";

    let flag = true;

    if (username === "") {
        usernameErrMsg.innerHTML = "Please enter your username";
        flag = false;
    }

    if (newPassword === "") {
        newPasswordErrMsg.innerHTML = "Please enter a new password";
        flag = false;
    }

    if (confirmPassword === "") {
        confirmPasswordErrMsg.innerHTML = "Please confirm your password";
        flag = false;
    } else if (newPassword !== confirmPassword) {
        confirmPasswordErrMsg.innerHTML = "Passwords do not match";
        flag = false;
    }

    return flag;
}
</script>