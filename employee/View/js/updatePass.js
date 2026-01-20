function validatePassword() {
    const pass = document.getElementById("new_pass").value.trim();
    const confirm = document.getElementById("confirm_pass").value.trim();
    const error = document.getElementById("passError");

    // Clear previous error
    error.innerHTML = "";

    // Check new password
    if (pass === "") {
        error.innerHTML = "Please enter a new password.";
        return false;
    }

    if (pass.length < 4) {
        error.innerHTML = "Password must be at least 4 characters.";
        return false;
    }

    // Check confirm password
    if (confirm === "") {
        error.innerHTML = "Please confirm your password.";
        return false;
    }

    // Check password match
    if (pass !== confirm) {
        error.innerHTML = "Passwords do not match!";
        return false;
    }

    return true; // All validations passed
}
