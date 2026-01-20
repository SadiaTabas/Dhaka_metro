// Add Route Validation 
document.getElementById("addRouteForm").addEventListener("submit", function (e) {
    const from = this.from_station.value.trim();
    const to = this.to_station.value.trim();
    const fare = this.fare.value.trim();

    if (from === "" || to === "" || fare === "") {
        alert("All route fields are required!");
        e.preventDefault();
        return;
    }

    if (from === to) {
        alert("From and To stations cannot be the same!");
        e.preventDefault();
        return;
    }

    if (fare <= 0) {
        alert("Fare must be greater than 0!");
        e.preventDefault();
    }
});

// Add Staff Validation
document.getElementById("addStaffForm").addEventListener("submit", function (e) {
    const first = this.first_name.value.trim();
    const mobile = this.mobile.value.trim();
    const password = this.password.value.trim();

    if (first === "" || mobile === "" || password === "") {
        alert("First name, mobile, and password are required!");
        e.preventDefault();
        return;
    }

    if (!/^[0-9]{11}$/.test(mobile)) {
        alert("Mobile number must be 11 digits!");
        e.preventDefault();
        return;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters!");
        e.preventDefault();
    }
});
