function validateForgot() {
    const phone = document.getElementById("phone").value.trim();
    const error = document.getElementById("phoneError");
    
    error.innerHTML = "";

    if (phone === "") {
        error.innerHTML = "Phone number is required.";
        return false;
    }

    const pattern = /^01[3-9]\d{8}$/;
    if (!pattern.test(phone)) {
        error.innerHTML = "Invalid phone number format.";
        return false;
    }

    return true;
}