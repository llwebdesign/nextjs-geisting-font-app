<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGAI - Advanced Artificial Intelligence</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="light-mode">
    <header class="header">
        <nav class="nav">
            <div class="logo">AGAI</div>
            <div class="nav-links">
                <a href="#about">About</a>
                <a href="#models">Models</a>
                <a href="#capabilities">Capabilities</a>
                <a href="#pricing">Pricing</a>
                <a href="#eligibility">Eligibility</a>
                <select id="languageSelect" onchange="changeLanguage(this.value)">
                    <option value="en">English</option>
                    <option value="da">Danish</option>
                </select>
                <button onclick="toggleTheme()" class="theme-toggle">
                    Toggle Theme
                </button>
            </div>
        </nav>
    </header>

    <main>
        <section id="hero" class="hero">
            <h1>Welcome to AGAI</h1>
            <p>Advanced Artificial Intelligence for the Modern World</p>
        </section>

        <section id="about" class="section">
            <h2>About AGAI</h2>
            <p>AGAI is a cutting-edge artificial intelligence platform designed to revolutionize how businesses and individuals interact with AI technology.</p>
        </section>

        <section id="models" class="section">
            <h2>Our Models</h2>
            <div class="models-grid">
                <div class="model-card">
                    <h3>AGAI-Basic</h3>
                    <p>Perfect for individual users and small projects</p>
                </div>
                <div class="model-card">
                    <h3>AGAI-Pro</h3>
                    <p>Enhanced capabilities for professional use</p>
                </div>
                <div class="model-card">
                    <h3>AGAI-Enterprise</h3>
                    <p>Full-scale AI solutions for large organizations</p>
                </div>
            </div>
        </section>

        <section id="capabilities" class="section">
            <h2>Capabilities</h2>
            <div class="capabilities-grid">
                <div class="capability-card">
                    <h3>Natural Language Processing</h3>
                    <p>Advanced text understanding and generation</p>
                </div>
                <div class="capability-card">
                    <h3>Computer Vision</h3>
                    <p>Image and video analysis</p>
                </div>
                <div class="capability-card">
                    <h3>Data Analysis</h3>
                    <p>Complex pattern recognition and insights</p>
                </div>
            </div>
        </section>

        <section id="pricing" class="section">
            <h2>Pricing Plans</h2>
            <div class="pricing-grid">
                <div class="pricing-card">
                    <h3>Basic</h3>
                    <p class="price">$49/month</p>
                    <ul>
                        <li>Basic API access</li>
                        <li>5,000 requests/month</li>
                        <li>Standard support</li>
                    </ul>
                </div>
                <div class="pricing-card featured">
                    <h3>Professional</h3>
                    <p class="price">$199/month</p>
                    <ul>
                        <li>Advanced API access</li>
                        <li>50,000 requests/month</li>
                        <li>Priority support</li>
                    </ul>
                </div>
                <div class="pricing-card">
                    <h3>Enterprise</h3>
                    <p class="price">Custom</p>
                    <ul>
                        <li>Full API access</li>
                        <li>Unlimited requests</li>
                        <li>24/7 dedicated support</li>
                    </ul>
                </div>
            </div>
        </section>

        <section id="eligibility" class="section">
            <h2>Eligibility</h2>
            <div class="eligibility-content">
                <p>AGAI is available for:</p>
                <ul>
                    <li>Registered businesses</li>
                    <li>Academic institutions</li>
                    <li>Research organizations</li>
                    <li>Individual developers (with approved use cases)</li>
                </ul>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>AGAI</h4>
                <p>Advanced AI Solutions</p>
            </div>
            <div class="footer-section">
                <h4>Contact</h4>
                <p>Email: contact@agai.com</p>
            </div>
            <div class="footer-section">
                <h4>Legal</h4>
                <a href="#">Terms of Service</a>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 AGAI. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
