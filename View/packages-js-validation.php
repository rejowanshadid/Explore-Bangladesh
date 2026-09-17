<script>
function validate(p) {

    const travelDate = p.travelDate.value;
    const travelDateErrMsg = document.getElementById("travelDateErrMsg");
    travelDateErrMsg.innerHTML = "";

    const travelerDetails = p.travelerDetails.value.trim();
    const travelerDetailsErrMsg = document.getElementById("travelerDetailsErrMsg");
    travelerDetailsErrMsg.innerHTML = "";

    let flag = true;

    if (travelDate === "") {
        travelDateErrMsg.innerHTML = "Please select a travel date";
        flag = false;
    }

    if (travelerDetails === "") {
        travelerDetailsErrMsg.innerHTML = "Please enter traveler details";
        flag = false;
    }

    return flag;
}
</script>