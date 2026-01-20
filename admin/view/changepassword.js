function validateForm() {

    let currentPass = document.forms["changePasswordForm"]["current_password"].value.trim();
    let newPass     = document.forms["changePasswordForm"]["new_password"].value.trim();
    let confirmPass = document.forms["changePasswordForm"]["confirm_password"].value.trim();

    if (currentPass === "") {
        alert("Enter current password");
        return false;
    }

    if (newPass === "") {
        alert("Enter new password");
        return false;
    }

    if (newPass.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
    }

    if (confirmPass === "") {
        alert("Confirm your password");
        return false;
    }

    if (newPass !== confirmPass) {
        alert("Passwords do not match");
        return false;
    }

    return true;
}
