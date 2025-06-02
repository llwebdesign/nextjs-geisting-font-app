<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

// In a real application, you would fetch this data from a database
$models = [
    [
        'id' => 1,
        'name' => 'AGAI-Basic',
        'description' => 'Perfect for individual users and small projects',
        'capabilities' => 'Text generation, Basic analysis',
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 2,
        'name' => 'AGAI-Pro',
        'description' => 'Enhanced capabilities for professional use',
        'capabilities' => 'Advanced text generation, Complex analysis, API integration',
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 3,
        'name' => 'AGAI-Enterprise',
        'description' => 'Full-scale AI solutions for large organizations',
        'capabilities' => 'Custom solutions, Full API access, Advanced integrations',
        'created_at' => '2024-01-15'
    ]
];

// Handle form submission (in a real application, this would update the database)
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $success_message = 'Model added successfully!';
        } elseif ($_POST['action'] === 'edit') {
            $success_message = 'Model updated successfully!';
        } elseif ($_POST['action'] === 'delete') {
            $success_message = 'Model deleted successfully!';
        }
    }
}

// Get model for editing if ID is provided
$editing_model = null;
if (isset($_GET['edit'])) {
    foreach ($models as $model) {
        if ($model['id'] == $_GET['edit']) {
            $editing_model = $model;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGAI Admin - Manage Models</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #191970;
            --text-color: #000000;
            --bg-color: #ffffff;
            --success-color: #28a745;
            --error-color: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
        }

        .admin-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h1 {
            font-size: 1.5rem;
            margin: 0;
        }

        .admin-nav {
            display: flex;
            gap: 1rem;
        }

        .admin-nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .admin-nav a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .card {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            font-family: inherit;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #1e1e8f;
        }

        .btn-danger {
            background-color: var(--error-color);
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .message {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <h1>Manage AGAI Models</h1>
        <nav class="admin-nav">
            <a href="dashboard.php">Dashboard</a>
            <a href="manage_pricing.php">Manage Pricing</a>
            <a href="logout.php" class="btn-danger">Logout</a>
        </nav>
    </header>

    <div class="container">
        <?php if ($success_message): ?>
            <div class="message success">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>

        <?php if ($error_message): ?>
            <div class="message error">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h2><?php echo $editing_model ? 'Edit Model' : 'Add New Model'; ?></h2>
            <form method="POST" action="">
                <input type="hidden" name="action" value="<?php echo $editing_model ? 'edit' : 'add'; ?>">
                <?php if ($editing_model): ?>
                    <input type="hidden" name="id" value="<?php echo $editing_model['id']; ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="name">Model Name</label>
                    <input type="text" id="name" name="name" required 
                           value="<?php echo $editing_model ? htmlspecialchars($editing_model['name']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required><?php 
                        echo $editing_model ? htmlspecialchars($editing_model['description']) : ''; 
                    ?></textarea>
                </div>

                <div class="form-group">
                    <label for="capabilities">Capabilities</label>
                    <textarea id="capabilities" name="capabilities" required><?php 
                        echo $editing_model ? htmlspecialchars($editing_model['capabilities']) : ''; 
                    ?></textarea>
                </div>

                <button type="submit" class="btn">
                    <?php echo $editing_model ? 'Update Model' : 'Add Model'; ?>
                </button>

                <?php if ($editing_model): ?>
                    <a href="manage_models.php" class="btn" style="margin-left: 1rem;">Cancel</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="card">
            <h2>Existing Models</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($models as $model): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($model['name']); ?></td>
                        <td><?php echo htmlspecialchars($model['description']); ?></td>
                        <td><?php echo htmlspecialchars($model['created_at']); ?></td>
                        <td class="action-buttons">
                            <a href="?edit=<?php echo $model['id']; ?>" class="btn">Edit</a>
                            <form method="POST" action="" style="display: inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $model['id']; ?>">
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this model?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
