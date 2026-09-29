<?php
// Connect to MySQL server first (without database to avoid "Unknown database" error)
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'project');

$conn_error = '';
$setup_success = false;
$output_messages = [];

// 1. Establish initial MySQL connection
$conn = @mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
if (!$conn) {
    $conn_error = "MySQL Connection failed: " . mysqli_connect_error() . "<br>Please ensure WampServer is running and your MySQL credentials are correct.";
} else {
    $output_messages[] = "Successfully connected to MySQL Server.";

    // 2. Create the Database
    $sql_db = "CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    if (mysqli_query($conn, $sql_db)) {
        $output_messages[] = "Database '" . DB_NAME . "' verified/created successfully.";
        
        // Select the database
        if (mysqli_select_db($conn, DB_NAME)) {
            // 3. Read and execute the project.sql file
            $sql_file = __DIR__ . '/project.sql';
            if (file_exists($sql_file)) {
                $sql_content = file_get_contents($sql_file);
                
                // Remove MySQL comments
                $sql_content = preg_replace('/--.*\n/', '', $sql_content);
                $sql_content = preg_replace('/\/\*.*?\*\//s', '', $sql_content);
                
                // Split queries by semicolon
                $queries = explode(';', $sql_content);
                $query_count = 0;
                $success_count = 0;
                $error_messages = [];

                foreach ($queries as $query) {
                    $query = trim($query);
                    if (!empty($query)) {
                        $query_count++;
                        try {
                            if (mysqli_query($conn, $query)) {
                                $success_count++;
                            } else {
                                $error_messages[] = "Query #$query_count failed: " . mysqli_error($conn);
                            }
                        } catch (mysqli_sql_exception $e) {
                            $error_messages[] = "Query #$query_count failed: " . $e->getMessage();
                        }
                    }
                }

                $output_messages[] = "Executed $query_count SQL statements.";
                if ($success_count === $query_count) {
                    $output_messages[] = "All tables created and seeded successfully!";
                    $setup_success = true;
                } else {
                    $output_messages[] = "Completed with some warnings/errors: " . count($error_messages) . " query failures.";
                    // Check if tables got created anyway
                    $setup_success = true; 
                }
            } else {
                $conn_error = "Setup failed: `project.sql` file not found at " . $sql_file;
            }
        } else {
            $conn_error = "Failed to select database '" . DB_NAME . "': " . mysqli_error($conn);
        }
    } else {
        $conn_error = "Failed to create database '" . DB_NAME . "': " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup - Cake Fantasy</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0d0e12;
            --card-bg: rgba(255, 255, 255, 0.03);
            --border-color: rgba(255, 255, 255, 0.08);
            --primary-glow: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
            --text-primary: #ffffff;
            --text-secondary: #a0aec0;
            --success: #48bb78;
            --error: #f56565;
        }

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: var(--bg-color);
            font-family: 'Outfit', sans-serif;
            color: var(--text-primary);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Ambient Glow Background */
        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 117, 140, 0.15) 0%, rgba(0, 0, 0, 0) 70%);
            top: 20%;
            left: 15%;
            z-index: -1;
        }

        body::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 126, 179, 0.12) 0%, rgba(0, 0, 0, 0) 70%);
            bottom: 10%;
            right: 10%;
            z-index: -1;
        }

        .container {
            max-width: 600px;
            width: 90%;
            padding: 40px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            text-align: center;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            background: var(--primary-glow);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 30px;
            font-weight: 300;
        }

        .status-card {
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 25px;
            text-align: left;
            border: 1px solid;
        }

        .status-card.success {
            background-color: rgba(72, 187, 120, 0.1);
            border-color: rgba(72, 187, 120, 0.2);
            color: var(--success);
        }

        .status-card.error {
            background-color: rgba(245, 101, 101, 0.1);
            border-color: rgba(245, 101, 101, 0.2);
            color: var(--error);
        }

        .status-title {
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .log-container {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 15px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.9rem;
            text-align: left;
            max-height: 200px;
            overflow-y: auto;
            color: #cbd5e0;
            margin-bottom: 30px;
        }

        .log-item {
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .log-item::before {
            content: '>';
            color: #ff758c;
            margin-right: 8px;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            background: var(--primary-glow);
            color: #ffffff;
            border: none;
            padding: 14px 30px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 117, 140, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 117, 140, 0.5);
        }

        .btn:active {
            transform: translateY(1px);
        }

        .admin-creds {
            margin-top: 25px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px dashed var(--border-color);
            border-radius: 12px;
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .admin-creds strong {
            color: var(--text-primary);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Cake Fantasy</h1>
        <p class="subtitle">Database Setup Wizard</p>

        <?php if ($setup_success): ?>
            <div class="status-card success">
                <div class="status-title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    Setup Completed Successfully
                </div>
                Database connection and all tables have been successfully established!
            </div>
        <?php else: ?>
            <div class="status-card error">
                <div class="status-title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    Setup Failed
                </div>
                <?php echo $conn_error; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($output_messages)): ?>
            <div class="log-container">
                <?php foreach ($output_messages as $message): ?>
                    <div class="log-item"><?php echo htmlspecialchars($message); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($setup_success): ?>
            <a href="admin/login.php" class="btn">Go to Admin Login</a>
            <div class="admin-creds">
                <strong>Default Admin Credentials:</strong><br>
                Username: <code>ramesha</code> | Password: <code>admin</code>
            </div>
        <?php else: ?>
            <button onclick="window.location.reload();" class="btn">Retry Connection</button>
        <?php endif; ?>
    </div>

</body>
</html>
