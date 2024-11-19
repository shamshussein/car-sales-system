function validateRegisterForm() {
    var name = document.getElementById("logName").value;
    var password = document.getElementById("logPassword").value;
    var phone = document.getElementById("logphone").value;
    var email = document.getElementById("logemail").value;

    if (name == "" || password == "" || phone == "" || email == "") {
        document.getElementById("errorMsg").innerHTML = "Please fill the required fields"
        return false;
    }
    else if (name.length < 3 || password.length < 8 || phone.length < 8 || email.length < 8) {
        document.getElementById("errorMsg").innerHTML = "Please enter a correct details"
        return false;
    }
    else if (password.length < 8) {
        document.getElementById("errorMsg").innerHTML = "Your password must include at least 8 characters"
        return false;
    }
    else if (phone.length < 8) {
        document.getElementById("errorMsg").innerHTML = "Your phone number must include at least 8 numbers"
        return false;
    }
    else if (name.length < 3) {
        document.getElementById("errorMsg").innerHTML = "Please enter a correct username"
        return false;
    }
    else if (email.length < 8) {
        document.getElementById("errorMsg").innerHTML = "Please enter a correct email"
        return false;
    }
    else {
        return true;
    }
}

function validateLoginForm() {
    var name = document.getElementById("logName").value;
    var password = document.getElementById("logPassword").value;


    if (name == "" || password == "") {
        document.getElementById("errorMsg").innerHTML = "Please fill the required fields"
        return false;
    }
    else if (name.length < 3 || password.length < 8) {
        document.getElementById("errorMsg").innerHTML = "Please enter a correct details"
        return false;
    }
    else if (password.length < 8) {
        document.getElementById("errorMsg").innerHTML = "Your password must include at least 8 characters"
        return false;
    }

    else if (name.length < 3) {
        document.getElementById("errorMsg").innerHTML = "Please enter a correct username"
        return false;
    }
    else {
        return true;
    }
}

function validateContactForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;

    if (name == "" || email == "") {
        document.getElementById("errorMsg").innerHTML = "Please fill the required fields"
        return false;
    }
    else {
        alert('Form successfuly submitted!');
        return true;
    }
}
let slideIndex = 0;

function showSlides() {
    let slides = document.getElementsByClassName('slideimg');
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].style.display = 'block';
    setTimeout(showSlides, 2000);
}
showSlides();
