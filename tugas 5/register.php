<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css"/>
</head>
<body>
    <nav>
        <div class="">
            <img src="logo.jpg" alt="Logo">
        </div>
        <ul>
            <li>
                <a href="tugasbab2prak.php">Home</a>
            </li>
            <li>
                <a href="login.php">Login</a>
            </li>
            <li>
                <a href="tampilan.php">Tampilan</a>
            </li>
            <li>
                <a href="dashboard.php">Dasboard</a>
            </li>
        </ul>
    </nav>
    <img class="wave" src="imge1.png"/>
    <div class="wrapper">
        <form action="">
            <h1>SIGN UP</h1>
            <div class="input-box">
                <input type="text" placeholder="First Name" 
                required>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Last Name" 
                required>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Email address" 
                required>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Enter Password" 
                required>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Confirm Password" 
                required>
            </div>
            <button type="submit" class="btn">CREATE ACCOUNT</button>
        </form>
    </div>

    <div id="snackbar-register">Account successfully created!</div>
    <script>
        function showSnackbarRegister() {
            var snackbar = document.getElementById("snackbar-register");
            snackbar.className = "show";
            setTimeout(function(){ 
                snackbar.className = snackbar.className.replace("show", ""); 
            }, 3000);
        }
    
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah submit default
            showSnackbarRegister(); // Memunculkan snackbar
        });
    </script>    
</body>
</html>