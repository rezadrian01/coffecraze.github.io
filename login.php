<?php
session_start();
require('functions.php');
require('session.php');


if (isset($_SESSION["data"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    //cek apakah ada phone di database
    $result = mysqli_query($conn, "SELECT * FROM user WHERE phone = '$phone';");
    if (mysqli_num_rows($result) === 1) {
        $data = mysqli_fetch_assoc($result);
        if (password_verify($password, $data['password'])) {
            if(isset($_POST['remember'])){
                setcookie('user', hash('sha256', $phone), time() + (60 * 60 * 24));
            }
            //mengambil data user sebelum dimasukan ke session
            $data = addSession($phone);
            $_SESSION["data"] = array(
                "phone" => $data['phone'],
                "username" => $data['username'],
                "alamat" => $data['alamat'],
                "role" => $data['role']
            );

            if($data['role'] === 'admin'){
                header("Location: dashboard.php");
                exit();
            }

            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
        <link rel="stylesheet" href="./src/output.css">
</head>

<body>
    <div class="flex justify-center h-screen">
        <div class="w-1/4">
            <div class="text-3xl text-center font-semibold my-7">
                Login to <span class="bg-gradient-to-br from-[#a1887f] from-15% to-[#3e2723] to-40% text-3xl font-black uppercase bg-clip-text text-transparent">COFFEE</span>
            </div>

            <!-- Nomor Telepon Input -->
            <form action="" method="post">
                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                    <label for="phone" class="text-sm text-[#757575]">Mobile phone</label>

                    <input id="phone" type="text" onkeypress="validate(event)" class="text-sm outline-none" placeholder="Mobile phone" name="phone">
                </div>

                <!-- Password Input -->
                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400">
                    <label for="password" class="text-sm text-gray-500">Password</label>

                    <div class="flex justify-between gap-x-2 items-center">
                        <input id="password" type="password" class="grow text-sm outline-none" placeholder="Password" name="password">

                        <button id="show_hide_pass" type="button" onclick="showHidePassword()" class="p-1 transition hover:bg-[#eeeeee] rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- remember me -->
                <div class="mt-4">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>

                <?php if (isset($error)) : ?>
                    <p class="text-xs italic text-red-500">Nomor telepon atau password salah!</p>
                <?php endif; ?>

                <button type="submit" name="login" class="py-2.5 w-full bg-[#723E29] text-base text-white font-medium rounded-full mt-7">Login</button>
            </form>

            <div class="text-sm text-center mt-4">
                Don't have an account? <span><a href="signup.php" class="text-[#723E29] hover:underline">Sign up here</a></span>
            </div>
        </div>
    </div>

    <script>
        // Show and Hide Password Function
        const showHidePassword = () => {
            const passwordElement = document.getElementById("password");
            const buttonShowHidePass = document.getElementById("show_hide_pass");

            if (passwordElement.type === "password") {
                passwordElement.type = "text";

                buttonShowHidePass.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>'
            } else {
                passwordElement.type = "password";

                buttonShowHidePass.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>';
            }
        };

        function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>
</body>

</html>
