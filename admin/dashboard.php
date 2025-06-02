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
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 2,
        'name' => 'AGAI-Pro',
        'description' => 'Enhanced capabilities for professional use',
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 3,
        'name' => 'AGAI-Enterprise',
        'description' => 'Full-scale AI solutions for large organizations',
        'created_at' => '2024-01-15'
    ]
];

$pricing_plans = [
    [
        'id' => 1,
        'name' => 'Basic',
        'price' => '$49/month',
        'features' => 'Basic API access, 5,000 requests/month',
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 2,
        'name' => 'Professional',
        'price' => '$199/month',
        'features' => 'Advanced API access, 50,000 requests/month',
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 3,
        'name' => 'Enterprise',
        'price' => 'Custom',
        'features' => 'Full API access, Unlimited requests',
        'created_at' => '2024-01-15'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGAI Admin - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #191970;
            --text-color: #000000;
            --bg-color: #ffffff;
            --card-bg: #f5f5f5;
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

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .dashboard-card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card h2 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .btn:hover {
            background-color: #1e1e8f;
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

        .action-buttons a {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .logout-btn {
            background-color: #dc3545;
        }

        .logout-btn:hover {
            background-color: #bb2d3b;
        }

        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
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
        <h1>AGAI Admin Dashboard</h1>
        <nav class="admin-nav">
            <a href="manage_models.php">Manage Models</a>
            <a href="manage_pricing.php">Manage Pricing</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </nav>
    </header>

    <div class="container">
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h2>
                    Models Overview
                    <a href="manage_models.php" class="btn">Manage</a>
                </h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($models as $model): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($model['name']); ?></td>
                            <td><?php echo htmlspecialchars($model['created_at']); ?></td>
                            <td class="action-buttons">
                                <a href="manage_models.php?edit=<?php echo $model['id']; ?>" class="btn">Edit</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="dashboard-card">
                <h2>
                    Pricing Plans
                    <a href="manage_pricing.php" class="btn">Manage</a>
                </h2>
                <table>
                    <thead>
                        <tr>
                            <th>Plan</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pricing_plans as $plan): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($plan['name']); ?></td>
                            <td><?php echo htmlspecialchars($plan['price']); ?></td>
                            <td class="action-buttons">
                                <a href="manage_pricing.php?edit=<?php echo $plan['id']; ?>" class="btn">Edit</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
