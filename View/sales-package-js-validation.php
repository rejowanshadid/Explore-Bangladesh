<script>
function validate(p) {

    const packagename = p.packagename.value.trim();
    const packagenameErrMsg = document.getElementById("packagenameErrMsg");
    packagenameErrMsg.innerHTML = "";

    const price = p.price.value.trim();
    const priceErrMsg = document.getElementById("priceErrMsg");
    priceErrMsg.innerHTML = "";

    const duration = p.duration.value.trim();
    const durationErrMsg = document.getElementById("durationErrMsg");
    durationErrMsg.innerHTML = "";

    const image = p.image.value;
    const imageErrMsg = document.getElementById("imageErrMsg");
    imageErrMsg.innerHTML = "";

    const itinerary = p.itinerary.value.trim();
    const itineraryErrMsg = document.getElementById("itineraryErrMsg");
    itineraryErrMsg.innerHTML = "";

    let flag = true;

    if (packagename === "") {
        packagenameErrMsg.innerHTML = "Please enter package name";
        flag = false;
    }

    if (price === "") {
        priceErrMsg.innerHTML = "Please enter package price";
        flag = false;
    }

    if (duration === "") {
        durationErrMsg.innerHTML = "Please enter duration";
        flag = false;
    }

    if (image === "") {
        imageErrMsg.innerHTML = "Please upload an image";
        flag = false;
    }

    if (itinerary === "") {
        itineraryErrMsg.innerHTML = "Please enter itinerary details";
        flag = false;
    }

    return flag;
}
</script>