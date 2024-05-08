<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navi Bank</title>
    <link rel="stylesheet" href="css/bootstrap/5.3.3/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo.gif" type="image/x-icon">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <div class="container p-1 ">
        <main class="form-signin w-50 m-auto">
            <form action="process_login.php" method="post" onsubmit="showLoading(event)">
                <img class="mb-4" src="img/logo.gif" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="name@example.com" required>
                    <label for="userEmail">Email address</label>
                </div>
                <br>
                <div class="form-floating">
                    <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Password" required>
                    <label for="userPassword">Password</label>
                </div>

                <div class="form-check text-start my-3">
                    <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Remember me
                    </label>
                </div>
                
                <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
                <p class="mt-5 mb-3 text-body-secondary">© (Navi Bank) 2024</p>
            </form>
            
        </main>
    </div>
    <script>
        function showLoading(event) {
            event.preventDefault(); // Prevent immediate form submission
            document.getElementById("loadingScreen").style.display = "block"; // Show loading spinner
        
            setTimeout(() => {
                event.target.submit(); // Submit the form after 3 seconds
            }, 3000); // 3-second delay
        
        }
    </script>
    <!-- Loading screen hidden by default -->
    <div id="loadingScreen" class="loading">
        <div class="spinner"></div> <!-- Rotating spinner -->
        Loading...
    </div>
    <script src="js/bootstrap/5.3.3/bootstrap.min.js"></script>
</body>
</html>