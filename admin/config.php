<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'agai_db');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    // Log error (in a real application, use proper error logging)
    error_log("Connection failed: " . $e->getMessage());
    die("Connection failed. Please try again later.");
}

// Security functions
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        die('CSRF token validation failed');
    }
    return true;
}

function check_login() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php');
        exit;
    }
}

// Database helper functions
function get_all_models() {
    global $pdo;
    try {
        $stmt = $pdo->query('SELECT * FROM models ORDER BY created_at DESC');
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching models: " . $e->getMessage());
        return [];
    }
}

function get_all_pricing_plans() {
    global $pdo;
    try {
        $stmt = $pdo->query('SELECT * FROM pricing_plans ORDER BY created_at DESC');
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching pricing plans: " . $e->getMessage());
        return [];
    }
}

function add_model($name, $description, $capabilities) {
    global $pdo;
    try {
        $stmt = $pdo->prepare('INSERT INTO models (name, description, capabilities, created_at) VALUES (?, ?, ?, NOW())');
        return $stmt->execute([$name, $description, $capabilities]);
    } catch (PDOException $e) {
        error_log("Error adding model: " . $e->getMessage());
        return false;
    }
}

function update_model($id, $name, $description, $capabilities) {
    global $pdo;
    try {
        $stmt = $pdo->prepare('UPDATE models SET name = ?, description = ?, capabilities = ? WHERE id = ?');
        return $stmt->execute([$name, $description, $capabilities, $id]);
    } catch (PDOException $e) {
        error_log("Error updating model: " . $e->getMessage());
        return false;
    }
}

function delete_model($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare('DELETE FROM models WHERE id = ?');
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        error_log("Error deleting model: " . $e->getMessage());
        return false;
    }
}

function add_pricing_plan($name, $price, $features) {
    global $pdo;
    try {
        $stmt = $pdo->prepare('INSERT INTO pricing_plans (name, price, features, created_at) VALUES (?, ?, ?, NOW())');
        return $stmt->execute([$name, $price, json_encode($features)]);
    } catch (PDOException $e) {
        error_log("Error adding pricing plan: " . $e->getMessage());
        return false;
    }
}

function update_pricing_plan($id, $name, $price, $features) {
    global $pdo;
    try {
        $stmt = $pdo->prepare('UPDATE pricing_plans SET name = ?, price = ?, features = ? WHERE id = ?');
        return $stmt->execute([$name, $price, json_encode($features), $id]);
    } catch (PDOException $e) {
        error_log("Error updating pricing plan: " . $e->getMessage());
        return false;
    }
}

function delete_pricing_plan($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare('DELETE FROM pricing_plans WHERE id = ?');
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        error_log("Error deleting pricing plan: " . $e->getMessage());
        return false;
    }
}

// Initialize session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
