<script>
function validate(p) {

    const username = p.username.value.trim();
    const usernameErrMsg = document.getElementById("usernameErrMsg");
    usernameErrMsg.innerHTML = "";

    const password = p.password.value.trim();
    const passwordErrMsg = document.getElementById("passwordErrMsg");
    passwordErrMsg.innerHTML = "";

    let flag = true;

    if (username === "") {
        usernameErrMsg.innerHTML = "Please enter your email or username";
        flag = false;
    }

    if (password === "") {
        passwordErrMsg.innerHTML = "Please enter your password";
        flag = false;
    }

    return flag;
}
</script>