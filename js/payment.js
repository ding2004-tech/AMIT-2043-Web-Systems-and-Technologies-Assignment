function success(){
    alert("YOU HAVE SUCCESS MAKE PAYMENT FOR THEIR TICKET!!!");
    window.location.href = "";
}

function calculateTicketTotal() {
    var ticketQty = parseInt(document.getElementById('qty').textContent);
    var ticketPrice = <?php echo $ticketPrice; ?>;
    var ticketTotal = ticketQty * ticketPrice;
    document.getElementById('ticketTotal').textContent = ticketTotal.toFixed(2);
    calculateTotal();
}

function calculateTotal() {
    var ticketTotal = parseFloat(document.getElementById('ticketTotal').textContent);
    var subtotal = ticketTotal; 
    var serviceTax = subtotal * 0.06; 
    var voucher = parseFloat(document.getElementById('voucher').value);
    var total = subtotal + serviceTax - voucher;
    document.getElementById('subtotal').textContent = subtotal.toFixed(2);
    document.getElementById('serviceTax').textContent = serviceTax.toFixed(2);
    document.getElementById('total').textContent = total.toFixed(2);
    toggleProceedPaymentButton(); 
}

calculateTicketTotal();
