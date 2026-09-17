<script>
function validate(p) {

    const firstName = p.firstName.value.trim();
    const firstNameErrMsg = document.getElementById("firstNameErrMsg");
    firstNameErrMsg.innerHTML = "";

    const lastName = p.lastName.value.trim();
    const lastNameErrMsg = document.getElementById("lastNameErrMsg");
    lastNameErrMsg.innerHTML = "";

    const male = p.Gender[0].checked;
    const female = p.Gender[1].checked;
    const genderErrMsg = document.getElementById("genderErrMsg");
    genderErrMsg.innerHTML = "";

    const email = p.email.value.trim();
    const emailErrMsg = document.getElementById("emailErrMsg");
    emailErrMsg.innerHTML = "";

    const phone = p.phone.value.trim();
    const phoneErrMsg = document.getElementById("phoneErrMsg");
    phoneErrMsg.innerHTML = "";

    const country = p.country.value;
    const countryErrMsg = document.getElementById("countryErrMsg");
    countryErrMsg.innerHTML = "";

    const division = p.division.value;
    const divisionErrMsg = document.getElementById("divisionErrMsg");
    divisionErrMsg.innerHTML = "";

    const road = p.road.value.trim();
    const roadErrMsg = document.getElementById("roadErrMsg");
    roadErrMsg.innerHTML = "";

    const postcode = p.postcode.value.trim();
    const postcodeErrMsg = document.getElementById("postcodeErrMsg");
    postcodeErrMsg.innerHTML = "";

    const userName = p.userName.value.trim();
    const userNameErrMsg = document.getElementById("userNameErrMsg");
    userNameErrMsg.innerHTML = "";

    const password = p.password.value.trim();
    const passwordErrMsg = document.getElementById("passwordErrMsg");
    passwordErrMsg.innerHTML = "";

    const confirmPassword = p.confirmPassword.value.trim();
    const confirmPasswordErrMsg = document.getElementById("confirmPasswordErrMsg");
    confirmPasswordErrMsg.innerHTML = "";

    let flag = true;

    if (firstName === "") {
        firstNameErrMsg.innerHTML = "Please enter your first name";
        flag = false;
    }

    if (lastName === "") {
        lastNameErrMsg.innerHTML = "Please enter your last name";
        flag = false;
    }

    if (!male && !female) {
        genderErrMsg.innerHTML = "Please select your gender";
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

    if (country === "" || country === "select country") {
        countryErrMsg.innerHTML = "Please select your country";
        flag = false;
    }

    if (division === "" || division === "select devision") {
        divisionErrMsg.innerHTML = "Please select your division";
        flag = false;
    }

    if (road === "") {
        roadErrMsg.innerHTML = "Please enter your road/street";
        flag = false;
    }

    if (postcode === "") {
        postcodeErrMsg.innerHTML = "Please enter your post code";
        flag = false;
    }

    if (userName === "") {
        userNameErrMsg.innerHTML = "Please enter your username";
        flag = false;
    }

    if (password === "") {
        passwordErrMsg.innerHTML = "Please enter your password";
        flag = false;
    }

    if (confirmPassword === "") {
        confirmPasswordErrMsg.innerHTML = "Please confirm your password";
        flag = false;
    } else if (password !== confirmPassword) {
        confirmPasswordErrMsg.innerHTML = "Password does not match";
        flag = false;
    }

    return flag;
}
</script>