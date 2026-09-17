<script>
function validate(p) {

    const fullname = p.fullname.value.trim();
    const fullnameErrMsg = document.getElementById("fullnameErrMsg");
    fullnameErrMsg.innerHTML = "";

    const email = p.email.value.trim();
    const emailErrMsg = document.getElementById("emailErrMsg");
    emailErrMsg.innerHTML = "";

    const phone = p.phone.value.trim();
    const phoneErrMsg = document.getElementById("phoneErrMsg");
    phoneErrMsg.innerHTML = "";

    const role = p.role.value.trim();
    const roleErrMsg = document.getElementById("roleErrMsg");
    roleErrMsg.innerHTML = "";

    let flag = true;

    if (fullname === "") {
        fullnameErrMsg.innerHTML = "Please enter your full name";
        flag = false;
    }

    if (email === "") {
        emailErrMsg.innerHTML = "Please enter your email";
        flag = false;
    }

    if (phone === "") {
        phoneErrMsg.innerHTML = "Please enter your phone number";
        flag = false;
    }

    if (role === "") {
        roleErrMsg.innerHTML = "Please enter your role";
        flag = false;
    }

    return flag;
}
</script>