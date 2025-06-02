-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS agai_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE agai_db;

-- Create models table
CREATE TABLE IF NOT EXISTS models (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    capabilities TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create pricing_plans table
CREATE TABLE IF NOT EXISTS pricing_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price VARCHAR(100) NOT NULL,
    features JSON NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create admin_users table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user (password: admin123)
INSERT INTO admin_users (username, password_hash) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insert sample models
INSERT INTO models (name, description, capabilities) VALUES
('AGAI-Basic', 'Perfect for individual users and small projects', 'Text generation, Basic analysis'),
('AGAI-Pro', 'Enhanced capabilities for professional use', 'Advanced text generation, Complex analysis, API integration'),
('AGAI-Enterprise', 'Full-scale AI solutions for large organizations', 'Custom solutions, Full API access, Advanced integrations');

-- Insert sample pricing plans
INSERT INTO pricing_plans (name, price, features) VALUES
('Basic', '$49/month', '["Basic API access", "5,000 requests/month", "Standard support"]'),
('Professional', '$199/month', '["Advanced API access", "50,000 requests/month", "Priority support"]'),
('Enterprise', 'Custom', '["Full API access", "Unlimited requests", "24/7 dedicated support"]');

-- Create indexes for better performance
CREATE INDEX idx_models_name ON models(name);
CREATE INDEX idx_pricing_plans_name ON pricing_plans(name);
CREATE INDEX idx_admin_users_username ON admin_users(username);
