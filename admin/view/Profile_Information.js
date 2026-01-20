function validateForm() {
    // Get values from the form
    let fullName = document.forms["profileForm"]["full_name"].value.trim();
    let dob      = document.forms["profileForm"]["dob"].value;
    let gender   = document.forms["profileForm"]["gender"].value;

    // 1. Check Full Name
    if (fullName == "") {
        alert("Full Name must be filled out");
        return false;
    }
    // check letters and spaces only
    if (!/^[a-zA-Z ]+$/.test(fullName)) {
        alert("Full Name can only contain letters and spaces");
        return false;
    }

    // 2. Check Date of Birth
    if (dob == "") {
        alert("Date of Birth must be selected");
        return false;
    }

    // 3. Check Gender
    if (gender == "") {
        alert("Please select a Gender");
        return false;
    }

    // If everything is okay, form will submit
    return true;
}

// Cancel button function
function cancelForm() {
    window.location.href = "dashboard.php";
}
