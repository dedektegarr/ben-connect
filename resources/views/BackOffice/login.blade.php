<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login Command Center Provinsi Bengkulu</title>
    <link href="{{ asset('assets/FrontOffice/img/favicon.png') }}" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
    <style>
        /* Preloader */
        #preloader {
            position: fixed;
            width: 100%;
            height: 100%;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .loader {
            display: flex;
            justify-content: space-between;
            width: 80px;
        }

        .loader div {
            width: 18px;
            height: 18px;
            background:rgb(0, 0, 0);
            border-radius: 50%;
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .loader div:nth-child(1) { animation-delay: -0.32s; }
        .loader div:nth-child(2) { animation-delay: -0.16s; }
        .loader div:nth-child(3) { animation-delay: 0; }

        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }
    </style>
</head>



<body>
    
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div class="container" id="container">
        <!-- Form Sign-In -->
        <div class="sign-in form-container">
            <form action="{{ route('authenticate') }}" method="POST">
                @csrf
                <h2>Command Center Provinsi Bengkulu</h2>
                <br>
                <input class="email1" name="email" type="email" placeholder="Email">
                <div class="passdiv">
                    <input class="pass1" name="password" type="password" placeholder="Password">
                    <i class="show-hide fa fa-lock"></i>
                </div>
                <br>
                <button type="submit">Login</button>
            </form>
        </div>

        <!-- Overlay -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <img src="{{ asset('assets/Logo.png') }}" class="img-fluid mobile-logo" style="margin-bottom:40%;">
                    <p>Masukkan email dan password Anda untuk mengakses akun.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="./script.js"></script>
    @include('sweetalert::alert')
</body>
</html>
<script>
    window.addEventListener("load", function() {
        setTimeout(function() {
        document.getElementById("preloader").style.display = "none";
        }, 2000); // 2000ms = 2 detik
    });
</script>

<script>
    document.querySelectorAll(".show-hide").forEach((icon) => {
    icon.addEventListener("click", () => {
            const input = icon.previousElementSibling;
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-lock", "fa-unlock");
            } else {
                input.type = "password";
                icon.classList.replace("fa-unlock", "fa-lock");
            }
        });
    });

    const container = document.querySelector('.container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    registerBtn.addEventListener('click', () => {
        container.classList.add('active');
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove('active');
    });

    const form = document.querySelector("form");
    const name = document.querySelector(".name");
    const email = document.querySelector(".email");
    const pass = document.querySelector('.pass');
    const namefield = document.querySelector(".namefield");
    const emailfield = document.querySelector(".emailfield");
    const passfield = document.querySelector(".passfield");
    const emailfield1 = document.querySelector(".emailfield1");
    const passfield1 = document.querySelector(".passfield1");
    const email1 = document.querySelector(".email1");
    const pass1 = document.querySelector(".pass1");

    function checkname() {
        const namepattern = /^[a-z\d]{6,12}$/i;
        if (!name.value.match(namepattern)) {
            return namefield.style.display = "inline";
        }
        namefield.style.display = "none";
    }

    function checkemail() {
        const emailpattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!email.value.match(emailpattern)) {
            return emailfield.style.display = "inline";
        }
        emailfield.style.display = "none";
    }

    function checkpass() {
        const passpattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,12}$/;
        if (!pass.value.match(passpattern)) {
            return passfield.style.display = "inline";
        }
        passfield.style.display = "none";
    }

    function checkemail1() {
        const emailpattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!email1.value.match(emailpattern)) {
            return emailfield1.style.display = "inline";
        }
        emailfield1.style.display = "none";
    }

    function checkpass1() {
        const passpattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,12}$/;
        if (!pass1.value.match(passpattern)) {
            return passfield1.style.display = "inline";
        }
        passfield1.style.display = "none";
    }

</script>

<!-- <script>
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script> -->

<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
    box-sizing: border-box;
}

body {
    background: #f6f5f7;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Montserrat', sans-serif;
    height: 100vh;
    margin: 0;
}

h1 {
    font-weight: bold;
    margin: 0;
}

p {
    font-size: 14px;
    font-weight: 100;
    line-height: 20px;
    margin: 20px 0;
}

button {
    border-radius: 20px;
    border: 1px solid #112637;
    background-color: #112637;
    color: #FFFFFF;
    font-size: 12px;
    font-weight: bold;
    padding: 12px 45px;
    text-transform: uppercase;
    cursor: pointer;
    transition: transform 80ms ease-in;
}

button:active {
    transform: scale(0.95);
}

form {
    background-color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 50px;
    height: 100%;
    border-radius: 25px;
}

input {
    background-color: #eee;
    border: none;
    padding: 12px 15px;
    margin: 8px 0;
    width: 100%;
    border-radius: 10px;
}

.container {
    background-color: #fff;
    border-radius: 25px;
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    width: 768px;
    max-width: 100%;
    min-height: 480px;
    position: relative;
}

.form-container {
    position: absolute;
    top: 0;
    height: 100%;
    border-radius: 25px;
    transition: all 0.6s ease-in-out;
}

.sign-in {
    left: 0;
    width: 50%;
    z-index: 2;
}

.overlay-container {
    position: absolute;
    border-radius: 25px;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    z-index: 100;
}

.overlay {
    background: linear-gradient(to right, #112637, rgb(21, 58, 88));
    color: #FFFFFF;
    position: relative;
    height: 100%;
    width: 200%;
    left: -100%;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
}

.overlay-right {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    text-align: center;
    height: 100%;
    width: 50%;
    right: 0;
}

.passdiv {
    position: relative;
    width: 100%;
}

.show-hide {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #555;
    font-size: 20px;
}

.show-hide:hover {
    color: #000;
}

/* Responsive Design */
@media (max-width: 768px) {

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
        height: 100vh;
        padding: 10px;
        border-radius: 0;
        box-shadow: none;
    }

    .form-container {
        width: 100%;
        max-width: 400px;
        position: relative;
    }

    .sign-in {
        width: 100%;
        left: 0;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .overlay-container {
        position: relative;
        width: 100%;
        left: 0;
        height: auto;
    }

    .overlay {
        width: 100%;
        height: auto;
        background: linear-gradient(to bottom, #112637, rgb(21, 58, 88));
        transform: none;
        border-radius: 10px;
    }

    .overlay-right {
        width: 100%;
        height: auto;
        padding: 20px;
        text-align: center;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    p {
        font-size: 14px;
    }

    input {
        font-size: 14px;
        padding: 10px;
        margin: 10px 0;
        width: 100%;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    button {
        padding: 10px 30px;
        font-size: 14px;
        background-color: #112637;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .passdiv {
        margin-bottom: 15px;
    }

    img {
        width: 100px;
        height: auto;
        margin-bottom: 20px;
    }

    .show-hide {
        font-size: 18px;
        right: 8px;
    }
}


</style>

<!-- <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    :root {
        --bg: #112637;
        --darkgreen: #7db855be;
    }

    body {
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
        font-weight: 300px;
        font-style: normal;
        background-color: #f7f7f7;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        height: 100vh;
    }

    .container {
        background-color: var(--bg);
        border-radius: 20px;
        position: relative;
        overflow: hidden;
        width: 650px;
        height: 450px;
        max-widtg: 100%;
        box-shadow: 5px 5px 10px 0px grey;
        padding: 50px 0px;
        text-align: center;
    }

    .container p {
        font-size: 12px;
        line-height: 20px;
        letter-spacing: 0.3px;
    }

    .forgetpass {
        margin-top: 20px;
    }

    a {
        color: black;
        text-decoration: none;
        font-size: 20px;
    }

    button {
        font-size: 12px;
        padding: 10px;
        width: 95px;
        height: 40px;
        border-radius: 15px;
        background: #fff;
        color: white;
        margin: 20px 0px;
    }

    h1 {
        font-size: 24px;
    }

    .container button.hidden {
        background-color: transparent;
        background-color: black;
    }

    .icons i {
        margin: 10px 3px 20px 3px;
    }

    .container form {
        display: flex;
        align-items: center;
        flex-direction: column;
        height: 100%;
        padding: 0 40px;
    }

    input {
        width: 100%;
        height: 40px;
        padding: 10px;
        border-radius: 15px;
        font-size: 14px;
        margin: 10px 0px;
        outline: none;
        border: 2px solid white;
    }

    .passdiv {
        width: 100%;
        height: 43px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        background-color: white;
        border-radius: 15px;
        margin: 10px 0;
    }

    .passdiv i {
        padding-right: 15px;
        cursor: pointer;
        transition: .2s ease;
    }

    .form_container {
        position: absolute;
        top: 0;
        height: 100%;
    }

    .sign_in {
        left: 0;
        width: 100%;
        z-index: 2;
    }

    .container.active .sign_in {
        transform: translateX(100%);
        opacity: 0;
    }

    .sign_up {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }

    .container.active .sign_up {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: move 0.6s;
    }

    .text {
        display: none;
        padding: 0px 2px;
        color: brown;
    }

    @keyframes move {

        0%,
        49.99% {
            opacity: 0;
            z-index: 1;
        }

        50%,
        100% {
            opacity: 1;
            z-index: 5;
        }
    }

    .toggle_container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: all 0.6s ease-in-out;
        border-radius: 130px 0 0 130px;
        z-index: 1000;
    }

    .container.active .toggle_container {
        transform: translateX(-100%);
        border-radius: 0 130px 130px 0;
    }

    .toggle {
        background-color: var(--darkgreen);
        height: 100%;
        color: #000;
        position: relative;
        left: -100%;
        width: 200%;
        transform: translateX(0);
        transition: all 0.6s ease-in-out;
    }

    .toggle p {
        padding-top: 20px;
    }

    .container.active .toggle {
        transform: translateX(50%);
    }

    .toggle_panel {
        position: absolute;
        width: 50%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 30px;
        text-align: center;
        top: 0;
        transform: translateX(0);
        transition: all 0.6s ease-in-out;
    }

    .toggle_left {
        transform: translateX(-200%);
    }

    .container.active .toggle_left {
        transform: translateX(0);
    }

    .toggle_right {
        right: 0;
        transform: translateX(0);
    }

    .container.active .toggle_right {
        transform: translateX(200%);
    }

    @media (max-width:868px) {
        .container {
            width: 80%;
            height: 370px;
        }
    }
</style> -->
