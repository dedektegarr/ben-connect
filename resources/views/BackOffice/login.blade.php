<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Halaman Login Command Center Provinsi Bengkulu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <div class="sign_in form_container">
            <img src="{{ asset('assets/Logo.png') }}" class="img-fluid" style="margin-top:20px;">
            <form action="{{ route('authenticate') }}" method="POST" style="margin-top: 10px;">
                @csrf
                <h3>Selamat Datang di Website Command Center Provinsi Bengkulu</h3>
                <p>Gunakan Akun yang telah terdaftar</p>
                <input class="email1" name="email" type="email" placeholder="Email">
                <p class="emailfield1 text">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Masukan Email Yang terdaftar
                </p>
                <div class="passdiv">
                    <input class="pass1" name="password" type="password" placeholder="Password">
                    <i class="fa-solid fa-lock show-hide"></i>
                </div>
                <p class="passfield1 text">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Masukan Password yang telah terdaftar
                </p>
                <button type="submit">Masuk</button>
            </form>
        </div>
    </div>
    <script src="./script.js"></script>
</body>

</html>
@include('sweetalert::alert')
<script>
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

    const icons = document.querySelectorAll(".show-hide");
    icons.forEach((lockicon) => {
        lockicon.addEventListener("click", () => {
            const pinput = lockicon.parentElement.querySelector("input");
            if (pinput.type === "password") {
                lockicon.classList.replace("fa-lock", "fa-unlock")
                return pinput.type = "text";
            }
            lockicon.classList.replace("fa-unlock", "fa-lock");
            pinput.type = "password";
        })
    })

    name.addEventListener("keyup", checkname);
    email.addEventListener("keyup", checkemail);
    pass.addEventListener("keyup", checkpass);
    email1.addEventListener("keyup", checkemail1);
    pass1.addEventListener("keyup", checkpass1);

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        checkname();
        checkemail();
        checkpass();
    });
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    :root {
        --ligthgreen: #bbe06c;
        --darkgreen: #7db855be;
    }

    body {
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
        font-weight: 300px;
        font-style: normal;
        background-color: #E7F0DC;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        height: 100vh;
    }

    .container {
        background-color: var(--ligthgreen);
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
        background: #000;
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
        color: #fff;
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
</style>
