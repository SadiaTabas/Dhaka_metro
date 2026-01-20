function validateForm() {
    let phone = document.getElementById("phone").value.trim();
    let password = document.getElementById("password").value.trim();
    let phoneError = "";
    let passwordError = "";
    let isValid = true;

    // Mobile validation (BD format)
    let phonePattern = /^01[3-9]\d{8}$/;
    if (phone === "") {
        phoneError = "Mobile number is required.";
        isValid = false;
    } else if (!phonePattern.test(phone)) {
        phoneError = "Please enter a valid 11-digit mobile number.";
        isValid = false;
    }

    // Password validation
    if (password === "") {
        passwordError = "Password is required.";
        isValid = false;
    }

    // Display errors
    document.getElementById("phoneError").textContent = phoneError;
    document.getElementById("passwordError").textContent = passwordError;

    return isValid;
}
