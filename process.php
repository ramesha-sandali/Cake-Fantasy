<?php include('config/constants.php'); ?>

<?php

// Handle Registration
if (isset($_POST['signup'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $user_name = trim($_POST['user_name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Check if username or email already exists
    $checkUser = "SELECT * FROM tbl_users WHERE email = ? OR user_name = ?";
    $stmt = mysqli_prepare($conn, $checkUser);
    mysqli_stmt_bind_param($stmt, "ss", $email, $user_name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['customer_msg'] = "<div class='error'>Username or email already exists!</div>";
        header('location:'.SITEURL.'login.php');
        exit();
    } else {
        // Insert user into database
        $sql = "INSERT INTO tbl_users (first_name, last_name, user_name, email, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $first_name, $last_name, $user_name, $email, $password);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['customer_msg'] = "<div class='success'>Registration successful! Please Sign In.</div>";
            header('location:'.SITEURL.'login.php');
            exit();
        } else {
            $_SESSION['customer_msg'] = "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
            header('location:'.SITEURL.'login.php');
            exit();
        }
    }
}

// Handle Login
if (isset($_POST['signin'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Get user from database
    $sql = "SELECT * FROM tbl_users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['customer_id'] = $row['id'];
            $_SESSION['customer_user'] = $row['user_name'];
            $_SESSION['customer_name'] = $row['first_name'] . ' ' . $row['last_name'];
            $_SESSION['customer_email'] = $row['email'];

            $_SESSION['customer_msg'] = "<div class='success'>Welcome back, " . $row['first_name'] . "!</div>";
            header('location:'.SITEURL.'Project.php');
            exit();
        } else {
            $_SESSION['customer_msg'] = "<div class='error'>Invalid password!</div>";
            header('location:'.SITEURL.'login.php');
            exit();
        }
    } else {
        $_SESSION['customer_msg'] = "<div class='error'>No account found with this email!</div>";
        header('location:'.SITEURL.'login.php');
        exit();
    }
}

// Handle Google Sign In / Registration
if (isset($_POST['google_signin'])) {
    $google_email = trim($_POST['google_email']);
    $google_name = trim($_POST['google_name']);

    if (empty($google_email) || !filter_var($google_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['customer_msg'] = "<div class='error'>Invalid Google email address.</div>";
        header('location:'.SITEURL.'login.php');
        exit();
    }

    // Check if user exists in tbl_users by email
    $sql = "SELECT * FROM tbl_users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $google_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Existing user - log them in directly
        $_SESSION['customer_id'] = $row['id'];
        $_SESSION['customer_user'] = $row['user_name'];
        $_SESSION['customer_name'] = $row['first_name'] . ' ' . $row['last_name'];
        $_SESSION['customer_email'] = $row['email'];

        $_SESSION['customer_msg'] = "<div class='success'>Welcome back, " . $row['first_name'] . "! (Logged in with Google)</div>";
        header('location:'.SITEURL.'Project.php');
        exit();
    } else {
        // User does not exist - register automatically with Google details
        // Split name into first and last
        $parts = explode(' ', $google_name, 2);
        $first_name = !empty($parts[0]) ? $parts[0] : 'GoogleUser';
        $last_name = !empty($parts[1]) ? $parts[1] : '';

        // Generate username from email prefix
        $email_prefix = explode('@', $google_email)[0];
        $base_username = preg_replace('/[^a-zA-Z0-9]/', '', $email_prefix);
        if (empty($base_username)) {
            $base_username = 'user';
        }
        $user_name = $base_username;

        // Ensure username is unique
        $u_check = "SELECT id FROM tbl_users WHERE user_name = ?";
        $u_stmt = mysqli_prepare($conn, $u_check);
        mysqli_stmt_bind_param($u_stmt, "s", $user_name);
        mysqli_stmt_execute($u_stmt);
        $u_res = mysqli_stmt_get_result($u_stmt);
        if (mysqli_num_rows($u_res) > 0) {
            $user_name = $base_username . rand(100, 999);
        }

        // Random password hash
        $random_pwd = bin2hex(random_bytes(8));
        $hashed_pwd = password_hash($random_pwd, PASSWORD_DEFAULT);

        // Insert new user
        $insert_sql = "INSERT INTO tbl_users (first_name, last_name, user_name, email, password) VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "sssss", $first_name, $last_name, $user_name, $google_email, $hashed_pwd);

        if (mysqli_stmt_execute($insert_stmt)) {
            $new_id = mysqli_insert_id($conn);
            $_SESSION['customer_id'] = $new_id;
            $_SESSION['customer_user'] = $user_name;
            $_SESSION['customer_name'] = $first_name . ($last_name ? ' ' . $last_name : '');
            $_SESSION['customer_email'] = $google_email;

            $_SESSION['customer_msg'] = "<div class='success'>Account created and logged in with Google as " . htmlspecialchars($google_email) . "!</div>";
            header('location:'.SITEURL.'Project.php');
            exit();
        } else {
            $_SESSION['customer_msg'] = "<div class='error'>Failed to create Google account: " . mysqli_error($conn) . "</div>";
            header('location:'.SITEURL.'login.php');
            exit();
        }
    }
}
?>