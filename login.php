<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login - Cake Fantasy</title>
    <link rel="stylesheet" href="css/stylelog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Identity Services Library for Real Google Sign-In -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<body>
    <div style="width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh; padding: 20px 0;">
        <?php
        if(isset($_SESSION['customer_msg'])) {
            echo $_SESSION['customer_msg'];
            unset($_SESSION['customer_msg']);
        }
        ?>

        <!-- Register Section -->
        <div class="container" id="signup" style="display: none;">
            <h1 class="form-title">Register</h1>
            
            <!-- Real Google Sign In / Sign Up Button -->
            <div id="googleBtnSignup" style="margin-top: 10px; width: 100%; display: flex; justify-content: center;"></div>
            <button type="button" class="btn-google" id="fallbackGoogleBtnSignup" onclick="openGoogleModal()" style="display: none;">
                <svg width="18" height="18" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.79l7.97-6.2z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                </svg>
                <span>Continue with Google</span>
            </button>

            <p class="or">------- or with email -------</p>

            <form method="POST" action="process.php">
                <div class="input-group">
                    <i class="fa fa-user"></i>
                    <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                    <label for="first_name">First Name</label>
                </div>
                <div class="input-group">
                    <i class="fa fa-user"></i>
                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                    <label for="last_name">Last Name</label>
                </div>
                <div class="input-group">
                    <i class="fa fa-user"></i>
                    <input type="text" name="user_name" id="user_name" placeholder="Username" required>
                    <label for="user_name">Username</label>
                </div>
                <div class="input-group">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="E-mail" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-group">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <input type="submit" class="btn" value="Sign Up" name="signup">
            </form>

            <div class="links">
                <p>Already Have Account?</p>  
                <button id="signInButton">Sign In</button> 
            </div>
        </div>

        <!-- Sign In Section -->
        <div class="container" id="signIn">
            <h1 class="form-title">Sign In</h1>

            <!-- Real Google Sign In Button -->
            <div id="googleBtnSignin" style="margin-top: 10px; width: 100%; display: flex; justify-content: center;"></div>
            <button type="button" class="btn-google" id="fallbackGoogleBtnSignin" onclick="openGoogleModal()" style="display: none;">
                <svg width="18" height="18" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.79l7.97-6.2z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                </svg>
                <span>Sign in with Google</span>
            </button>

            <p class="or">------- or with password -------</p>

            <form method="POST" action="process.php">
                <div class="input-group">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" id="signin_email" placeholder="E-mail" required>
                    <label for="signin_email">Email</label>
                </div>
                <div class="input-group">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" id="signin_password" placeholder="Password" required>
                    <label for="signin_password">Password</label>
                </div>
                <p class="recover">
                    <a href="#">Recover Password</a>
                </p>
                <input type="submit" class="btn" value="Sign In" name="signin">
            </form>

            <div class="links">
                <p>Don't have account yet?</p>  
                <button id="signUpButton">Sign Up</button> 
            </div>
        </div>
    </div>

    <!-- Google Sign In Modal Dialog (Allows testing with any real Gmail address) -->
    <div class="g-modal-overlay" id="googleModal">
        <div class="g-modal-card">
            <button type="button" class="g-modal-close" onclick="closeGoogleModal()">&times;</button>
            
            <div class="g-modal-header">
                <svg width="32" height="32" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.79l7.97-6.2z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                </svg>
                <h3>Sign in with Google</h3>
                <p>Sign in using your real Gmail account</p>
            </div>

            <!-- Custom Real Gmail Login Form -->
            <form method="POST" action="process.php" id="googleForm" class="g-custom-input" style="margin: 0;">
                <input type="hidden" name="google_signin" value="1">
                <div>
                    <label style="position: static; font-size: 0.85rem; color: #5f6368; display: block; margin-bottom: 4px;">Full Name</label>
                    <input type="text" name="google_name" id="g_name" placeholder="Enter your full name" required style="border: 1px solid #dadce0; padding: 10px;">
                </div>
                <div>
                    <label style="position: static; font-size: 0.85rem; color: #5f6368; display: block; margin-bottom: 4px;">Gmail Address</label>
                    <input type="email" name="google_email" id="g_email" placeholder="example@gmail.com" required style="border: 1px solid #dadce0; padding: 10px;">
                </div>
                <button type="submit" class="btn" style="margin-top: 10px;">Sign In with Gmail</button>
            </form>
        </div>
    </div>

    <!-- Hidden Form for Google OAuth JWT Credential Submission -->
    <form method="POST" action="process.php" id="realGoogleForm" style="display: none;">
        <input type="hidden" name="google_signin" value="1">
        <input type="hidden" name="google_email" id="real_google_email">
        <input type="hidden" name="google_name" id="real_google_name">
    </form>

    <script src="js/script.js"></script>
    <script>
        const GOOGLE_CLIENT_ID = "<?php echo defined('GOOGLE_CLIENT_ID') ? GOOGLE_CLIENT_ID : ''; ?>";

        function decodeJwtResponse(token) {
            try {
                var base64Url = token.split('.')[1];
                var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join(''));
                return JSON.parse(jsonPayload);
            } catch (e) {
                console.error("Failed to decode JWT:", e);
                return null;
            }
        }

        function handleCredentialResponse(response) {
            const payload = decodeJwtResponse(response.credential);
            if (payload && payload.email) {
                document.getElementById('real_google_email').value = payload.email;
                document.getElementById('real_google_name').value = payload.name || payload.given_name || 'Google User';
                document.getElementById('realGoogleForm').submit();
            }
        }

        window.onload = function () {
            // Check if Google Identity Services is available and valid Client ID configured
            if (typeof google !== 'undefined' && GOOGLE_CLIENT_ID && !GOOGLE_CLIENT_ID.includes('YOUR_GOOGLE_CLIENT_ID')) {
                google.accounts.id.initialize({
                    client_id: GOOGLE_CLIENT_ID,
                    callback: handleCredentialResponse
                });

                // Render real Google button on sign-in & sign-up
                if (document.getElementById("googleBtnSignin")) {
                    google.accounts.id.renderButton(
                        document.getElementById("googleBtnSignin"),
                        { theme: "outline", size: "large", width: 380, shape: "rectangular", text: "signin_with" }
                    );
                }
                if (document.getElementById("googleBtnSignup")) {
                    google.accounts.id.renderButton(
                        document.getElementById("googleBtnSignup"),
                        { theme: "outline", size: "large", width: 380, shape: "rectangular", text: "signup_with" }
                    );
                }
            } else {
                // Display direct Gmail sign-in button
                document.getElementById("fallbackGoogleBtnSignin").style.display = "flex";
                document.getElementById("fallbackGoogleBtnSignup").style.display = "flex";
            }
        };

        function openGoogleModal() {
            document.getElementById('googleModal').style.display = 'flex';
        }

        function closeGoogleModal() {
            document.getElementById('googleModal').style.display = 'none';
        }

        // Close modal when clicking outside of card
        window.onclick = function(event) {
            var modal = document.getElementById('googleModal');
            if (event.target == modal) {
                closeGoogleModal();
            }
        }
    </script>
</body>
</html>