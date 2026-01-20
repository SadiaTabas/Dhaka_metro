function validateDelete() {
    let boxes = document.getElementsByName("ticket_id[]");
    let checked = false;

    for (let i = 0; i < boxes.length; i++) {
        if (boxes[i].checked) {
            checked = true;
            break;
        }
    }

    if (!checked) {
        alert("Please select at least one journey");
        return false;
    }

    return confirm("Are you sure you want to delete selected journey history?");
}
