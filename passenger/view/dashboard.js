var form = document.getElementById("journeyForm");
if (form) {
    form.addEventListener("submit", function (e) {

        var from = document.getElementById("from").value;
        var to = document.getElementById("to").value;
        var date = document.getElementById("journey_date").value;

        if (from === "" || to === "" || date === "") {
            alert("All fields are required");
            e.preventDefault();
            return;
        }

        if (from === to) {
            alert("Check Your Destination");
            e.preventDefault();
            return;
        }

        if (date !== "") {
            var today = new Date().toISOString().split("T")[0];
            if (date < today) {
                alert("You cannot select a past date!");
                e.preventDefault();
                return;
            }
        }
    });
}
