 
document.getElementById("paymentForm").addEventListener("submit", function(e) {

    let amount = document.getElementById("amount").value.trim();
    let method = document.getElementById("payment_method").value;

    if (amount === "" || isNaN(amount) || Number(amount) <= 0) {
        e.preventDefault();
        alert("Please enter a valid amount.");
        return;
    }

    if (method === "") {
        e.preventDefault();
        alert("Please select a payment method.");
    }
});


 
function updateBalance() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        const data = JSON.parse(xhttp.responseText);
        document.getElementById("balanceSpan").innerHTML = data.balance + " BDT";
    }
    xhttp.open("GET", "BalanceAPI.php", true);
    xhttp.send();
}

 
updateBalance();


setInterval(updateBalance, 3000);
