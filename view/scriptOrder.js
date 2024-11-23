
function validateForm() {
    var nom = document.getElementById('nom').value;
    var prenom = document.getElementById('prenom').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var address = document.getElementById('address').value;
    var address2 = document.getElementById('address2').value;
    var payment = document.getElementById('payment').value;

    if (nom.trim() === '') {
        alert('Please enter your name.');
        return false;
    }

    if (prenom.trim() === '') {
        alert('Please enter your surname.');
        return false;
    }

    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (email.trim() === '') {
        alert('Please enter an email address.');
        return false;
    } else if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    if (phone.trim() === '') {
        alert('Please enter your phone number.');
        return false;
    }

    if (address.trim() === '') {
        alert('Please enter your address.');
        return false;
    }

    if (address2.trim() === '') {
        alert('Please enter a second address (optional).');
        return false;
    }

    if (payment.trim() === '') {
        alert('Please enter your payment method.');
        return false;
    }

    return true;
}
