document.getElementById("journeyForm").addEventListener("submit", function (e) {
    e.preventDefault();

    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;
    var date = document.getElementById("journey_date").value;

    if (from === "" || to === "" || date === "") {
        alert("All fields are required");
        return;
    }

    if (from === to) {
        alert("Check Your Destination");
        return;
    }

    var today = new Date().toISOString().split("T")[0];
    if (date < today) {
        alert("You cannot select a past date!");
        return;
    }

     
    window.location.href = "payment.php";
});
