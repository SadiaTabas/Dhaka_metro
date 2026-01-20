// extendTicket.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('extendTicketForm');
    const ticketIdInput = form.ticket_id;
    const nextStationSelect = form.next_station;

    const ticketIdError = document.getElementById('ticketIdError');
    const nextStationError = document.getElementById('nextStationError');

    form.addEventListener('submit', function(e) {
        let valid = true;

        // Clear previous errors
        ticketIdError.textContent = "";
        nextStationError.textContent = "";
        ticketIdInput.classList.remove("error");
        nextStationSelect.classList.remove("error");

        // Validate Ticket ID
        if (ticketIdInput.value.trim() === "") {
            ticketIdError.textContent = "Ticket ID is required.";
            ticketIdInput.classList.add("error");
            valid = false;
        }

        // Validate Next Station
        if (nextStationSelect.value === "") {
            nextStationError.textContent = "Please select the next station.";
            nextStationSelect.classList.add("error");
            valid = false;
        }

        if (!valid) {
            e.preventDefault(); // Prevent form submission
        }
    });
});
