function validateForm() {
    let f = document.forms[0];

    if (
        f.fullname.value === "" ||
        f.mobile.value === "" ||
        f.nid.value === "" ||
        f.dob.value === "" ||
        f.gender.value === "" ||
        f.password.value === "" ||
        f.confirm_password.value === ""
    ) {
        alert("All fields are required");
        return false;
    }

    if (f.mobile.value.length !== 11 || isNaN(f.mobile.value)) {
        alert("Mobile must be 11 digits");
        return false;
    }

    if (f.nid.value.length !== 13 || isNaN(f.nid.value)) {
        alert("NID must be 13 digits");
        return false;
    }

    if (f.password.value !== f.confirm_password.value) {
        alert("Passwords do not match");
        return false;
    }

    return true;
}
