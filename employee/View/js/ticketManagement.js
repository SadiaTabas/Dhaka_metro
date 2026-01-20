document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('ticketManagementForm');
    const ticketIdInput = form.ticket_id;
    const actionSelect = form.action;

    form.addEventListener('submit', function(e) {
        let errors = [];

        // Remove previous error if exists
        const existingError = form.querySelector('.error-msg');
        if (existingError) existingError.remove();

        // Remove previous red borders
        ticketIdInput.classList.remove("error");
        actionSelect.classList.remove("error");

        // Validation
        if (ticketIdInput.value.trim() === "" && actionSelect.value === "") {
            errors.push("All fields are required.");
            ticketIdInput.classList.add("error");
            actionSelect.classList.add("error");
        } else {
            if (ticketIdInput.value.trim() === "") {
                errors.push("Ticket ID is required.");
                ticketIdInput.classList.add("error");
            }
            if (actionSelect.value === "") {
                errors.push("Please select an action.");
                actionSelect.classList.add("error");
            }
        }

        if (errors.length > 0) {
            const errorDiv = document.createElement('div');
            errorDiv.classList.add("error-msg"); // ensure correct class
            errorDiv.innerText = errors.join("\n");

            // insert above submit button
            const submitBtn = form.querySelector('.submit-btn');
            form.insertBefore(errorDiv, submitBtn);

            e.preventDefault(); // prevent form submission
        }
    });
});
