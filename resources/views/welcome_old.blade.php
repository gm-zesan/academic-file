<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic File Management - Green University of Bangladesh</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #00d4aa;
            --primary-dark: #00b894;
            --secondary: #6c5ce7;
            --accent: #fd79a8;
            --dark: #0a0a0a;
            --light: #ffffff;
            --gray-100: #f8fafc;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            
            --gradient-primary: linear-gradient(135deg, #00d4aa 0%, #00b894 100%);
            --gradient-secondary: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
            --gradient-accent: linear-gradient(135deg, #fd79a8 0%, #fdcb6e 100%);
            --gradient-dark: linear-gradient(135deg, #0a0a0a 0%, #2d3436 100%);
            --gradient-glass: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --shadow-glow: 0 0 50px rgba(0, 212, 170, 0.3);
            
            --font-primary: 'Space Grotesk', sans-serif;
            --font-secondary: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-secondary);
            background: var(--gradient-dark);
            color: var(--light);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Custom Cursor */
        .cursor {
            position: fixed;
            top: 0;
            left: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--primary);
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: difference;
            transition: transform 0.1s ease;
            transform: translate(-50%, -50%);
        }

        .cursor-follower {
            position: fixed;
            top: 0;
            left: 0;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary);
            pointer-events: none;
            z-index: 9998;
            transition: all 0.3s ease;
            transform: translate(-50%, -50%);
        }

        /* Animated Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .floating-shape {
            position: absolute;
            border-radius: 50%;
            animation: float 20s infinite ease-in-out;
            opacity: 0.1;
        }

        .floating-shape:nth-child(1) {
            width: 300px;
            height: 300px;
            background: var(--gradient-primary);
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-shape:nth-child(2) {
            width: 200px;
            height: 200px;
            background: var(--gradient-secondary);
            top: 60%;
            right: 10%;
            animation-delay: -5s;
        }

        .floating-shape:nth-child(3) {
            width: 150px;
            height: 150px;
            background: var(--gradient-accent);
            bottom: 20%;
            left: 60%;
            animation-delay: -10s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            33% {
                transform: translateY(-30px) rotate(120deg);
            }
            66% {
                transform: translateY(30px) rotate(240deg);
            }
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(10, 10, 10, 0.95);
            box-shadow: var(--shadow-lg);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo {
            position: relative;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .logo::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--gradient-secondary);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .logo:hover::before {
            opacity: 1;
        }

        .logo img {
            width: 35px;
            height: 35px;
            object-fit: contain;
            z-index: 2;
            position: relative;
            filter: brightness(0) invert(1);
        }

        .logo-text h1 {
            font-family: var(--font-primary);
            font-size: 1.5rem;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo-text p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            position: relative;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 0;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-primary);
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: var(--light);
            transform: translateY(-2px);
        }

        .nav-link:hover::before {
            width: 100%;
        }

        .login-btn {
            position: relative;
            background: var(--gradient-primary);
            color: var(--light) !important;
            padding: 0.75rem 1.5rem !important;
            border-radius: 50px;
            font-weight: 600;
            overflow: hidden;
            box-shadow: var(--shadow-glow);
        }

        .login-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--gradient-secondary);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .login-btn:hover::before {
            opacity: 1;
        }

        .login-btn span {
            position: relative;
            z-index: 2;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 8rem 0 4rem;
            position: relative;
        }

        .hero-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-content {
            z-index: 10;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 2rem;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(0, 212, 170, 0.4);
            }
            50% {
                box-shadow: 0 0 0 20px rgba(0, 212, 170, 0);
            }
        }

        .hero-content h1 {
            font-family: var(--font-primary);
            font-size: clamp(3rem, 8vw, 5rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #00d4aa 50%, #6c5ce7 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        @keyframes textGlow {
            from {
                filter: drop-shadow(0 0 20px rgba(0, 212, 170, 0.3));
            }
            to {
                filter: drop-shadow(0 0 40px rgba(108, 92, 231, 0.4));
            }
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            margin-bottom: 2.5rem;
            max-width: 500px;
        }

        .hero-stats {
            display: flex;
            gap: 2rem;
            margin-bottom: 2.5rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-family: var(--font-primary);
            font-size: 2rem;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            overflow: hidden;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: var(--light);
            box-shadow: var(--shadow-glow);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--gradient-secondary);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-primary:hover::before {
            opacity: 1;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 60px rgba(0, 212, 170, 0.5);
        }

        .btn-secondary {
            background: transparent;
            color: var(--light);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
            transform: translateY(-3px);
        }

        .btn span {
            position: relative;
            z-index: 2;
        }

        .btn i {
            position: relative;
            z-index: 2;
            transition: transform 0.3s ease;
        }

        .btn:hover i {
            transform: translateX(5px);
        }

        /* Hero Visual */
        .hero-visual {
            position: relative;
            perspective: 1000px;
        }

        .dashboard-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 2rem;
            transform: rotateX(5deg) rotateY(-5deg);
            transition: all 0.5s ease;
            box-shadow: 
                0 30px 60px rgba(0, 0, 0, 0.3),
                0 0 100px rgba(0, 212, 170, 0.2);
        }

        .dashboard-container:hover {
            transform: rotateX(0deg) rotateY(0deg) scale(1.02);
        }

        .dashboard-preview {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .preview-title {
            font-family: var(--font-primary);
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--light);
        }

        .preview-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            font-size: 0.9rem;
        }

        .preview-files {
            display: grid;
            gap: 1rem;
        }

        .file-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .file-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .file-item:hover::before {
            left: 100%;
        }

        .file-item:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
            transform: translateX(10px);
            box-shadow: var(--shadow-md);
        }

        .file-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--light);
            position: relative;
            overflow: hidden;
        }

        .pdf-icon {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
        }

        .doc-icon {
            background: linear-gradient(135deg, #3498db, #2980b9);
        }

        .img-icon {
            background: linear-gradient(135deg, #f39c12, #e67e22);
        }

        .file-info {
            flex: 1;
        }

        .file-name {
            font-weight: 600;
            color: var(--light);
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
        }

        .file-meta {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            display: flex;
            gap: 1rem;
        }

        .file-progress {
            width: 60px;
            height: 3px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--gradient-primary);
            border-radius: 2px;
            animation: progressPulse 2s ease-in-out infinite;
        }

        @keyframes progressPulse {
            0%, 100% {
                opacity: 0.8;
            }
            50% {
                opacity: 1;
            }
        }

        /* Features Section */
        .features {
            padding: 8rem 0;
            position: relative;
        }

        .features-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .features-header {
            text-align: center;
            margin-bottom: 5rem;
        }

        .section-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }

        .features-header h2 {
            font-family: var(--font-primary);
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #00d4aa 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .features-header p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.7);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            position: relative;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.5s ease;
            overflow: hidden;
            cursor: pointer;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--gradient-primary);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .feature-card:hover {
            transform: translateY(-15px);
            border-color: var(--primary);
            box-shadow: 
                var(--shadow-xl),
                0 0 80px rgba(0, 212, 170, 0.3);
        }

        .feature-card:hover::before {
            opacity: 0.1;
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .feature-icon::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--gradient-secondary);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .feature-card:hover .feature-icon::before {
            opacity: 1;
        }

        .feature-icon i {
            position: relative;
            z-index: 2;
            color: var(--light);
        }

        .feature-card h3 {
            font-family: var(--font-primary);
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--light);
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

        /* Footer */
        .footer {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 4rem 0 2rem;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand h3 {
            font-family: var(--font-primary);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .footer-brand p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--gradient-primary);
            transform: translateY(-3px);
        }

        .footer-column h4 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--light);
        }

        .footer-column a {
            display: block;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .footer-column a:hover {
            color: var(--primary);
            transform: translateX(5px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-container {
                grid-template-columns: 1fr;
                gap: 2rem;
                text-align: center;
            }

            .nav-links {
                display: none;
            }

            .hero-stats {
                justify-content: center;
            }

            .cta-buttons {
                justify-content: center;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .dashboard-container {
                transform: none;
            }
        }

        /* Loading Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease forwards;
        }

        /* Scroll Reveal */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }

        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
    </div>

    <!-- Custom Cursor -->
    <div class="cursor"></div>
    <div class="cursor-follower"></div>

    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <div class="logo-section">
                <div class="logo">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='40' fill='%23ffffff'/%3E%3Ctext x='50' y='58' text-anchor='middle' font-family='Arial' font-size='24' font-weight='bold' fill='%2300d4aa'%3EGUB%3C/text%3E%3C/svg%3E" alt="GUB Logo">
                </div>
                <div class="logo-text">
                    <h1>Academic Portal</h1>
                    <p>Green University</p>
                </div>
            </div>
            <div class="nav-links">
                <a href="#home" class="nav-link">Home</a>
                <a href="#features" class="nav-link">Features</a>
                <a href="#about" class="nav-link">About</a>
                <a href="#contact" class="nav-link">Support</a>
                <a href="#login" class="nav-link login-btn">
                    <span>Login Portal</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="fas fa-rocket"></i>
                    <span>Next Generation Platform</span>
                </div>
                
                <h1>Transform Your Academic Journey</h1>
                
                <p class="hero-subtitle">
                    Experience the future of document management with our AI-powered platform, designed exclusively for Green University of Bangladesh's digital excellence.
                </p>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number" data-count="15000">0</span>
                        <span class="stat-label">Active Students</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-count="800">0</span>
                        <span class="stat-label">Faculty Members</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-count="99.9">0</span>
                        <span class="stat-label">% Uptime</span>
                    </div>
                </div>
                
                <div class="cta-buttons">
                    <a href="#" class="btn btn-primary">
                        <span>Launch Experience</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="#features" class="btn btn-secondary">
                        <span>Explore Features</span>
                        <i class="fas fa-play"></i>
                    </a>
                </div>
            </div>

            <div class="hero-visual scroll-reveal">
                <div class="dashboard-container">
                    <div class="dashboard-preview">
                        <div class="preview-header">
                            <div class="preview-title">Smart Dashboard</div>
                            <div class="preview-meta">
                                <i class="fas fa-circle" style="color: #00d4aa; font-size: 8px;"></i>
                                <span>Live</span>
                            </div>
                        </div>
                        <div class="preview-files">
                            <div class="file-item">
                                <div class="file-icon pdf-icon">PDF</div>
                                <div class="file-info">
                                    <div class="file-name">Advanced_AI_Research.pdf</div>
                                    <div class="file-meta">
                                        <span>4.2 MB</span>
                                        <span>2 mins ago</span>
                                    </div>
                                </div>
                                <div class="file-progress">
                                    <div class="progress-fill" style="width: 85%"></div>
                                </div>
                            </div>
                            
                            <div class="file-item">
                                <div class="file-icon doc-icon">DOC</div>
                                <div class="file-info">
                                    <div class="file-name">Thesis_Final_Draft.docx</div>
                                    <div class="file-meta">
                                        <span>2.8 MB</span>
                                        <span>Live editing</span>
                                    </div>
                                </div>
                                <div class="file-progress">
                                    <div class="progress-fill" style="width: 60%"></div>
                                </div>
                            </div>
                            
                            <div class="file-item">
                                <div class="file-icon img-icon">IMG</div>
                                <div class="file-info">
                                    <div class="file-name">Data_Visualization.png</div>
                                    <div class="file-meta">
                                        <span>1.5 MB</span>
                                        <span>1 hour ago</span>
                                    </div>
                                </div>
                                <div class="file-progress">
                                    <div class="progress-fill" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="features-container">
            <div class="features-header scroll-reveal">
                <div class="section-badge">
                    <i class="fas fa-bolt"></i>
                    Advanced Capabilities
                </div>
                <h2>Revolutionary Features</h2>
                <p>Discover cutting-edge tools and capabilities that transform your academic workflow with AI-powered intelligence and seamless collaboration.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card scroll-reveal">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>AI-Powered Intelligence</h3>
                    <p>Advanced machine learning algorithms automatically organize, categorize, and analyze your documents with 99.7% accuracy for seamless workflow optimization.</p>
                </div>

                <div class="feature-card scroll-reveal">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Quantum Security</h3>
                    <p>Military-grade encryption with quantum-resistant algorithms ensures your academic work remains secure against current and future threats.</p>
                </div>

                <div class="feature-card scroll-reveal">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Real-time Collaboration</h3>
                    <p>Work simultaneously with classmates and professors using our zero-latency real-time editing and synchronization engine.</p>
                </div>

                <div class="feature-card scroll-reveal">
                    <div class="feature-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Universal Access</h3>
                    <p>Access your academic universe from any device with offline-first architecture and instant cloud synchronization across all platforms.</p>
                </div>

                <div class="feature-card scroll-reveal">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Predictive Analytics</h3>
                    <p>AI-driven insights provide personalized recommendations and academic performance predictions to optimize your educational success.</p>
                </div>

                <div class="feature-card scroll-reveal">
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3>Hyperspace Performance</h3>
                    <p>Experience sub-millisecond response times with our distributed edge computing network processing millions of documents instantly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3>Green University Academic Portal</h3>
                    <p>Pioneering the future of education through innovative technology and academic excellence. Transforming how students and faculty interact with digital resources.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h4>Platform</h4>
                    <a href="#">Features</a>
                    <a href="#">Security</a>
                    <a href="#">Updates</a>
                    <a href="#">API</a>
                </div>
                
                <div class="footer-column">
                    <h4>Resources</h4>
                    <a href="#">Documentation</a>
                    <a href="#">Tutorials</a>
                    <a href="#">Support</a>
                    <a href="#">Community</a>
                </div>
                
                <div class="footer-column">
                    <h4>University</h4>
                    <a href="#">About GUB</a>
                    <a href="#">Admissions</a>
                    <a href="#">Faculty</a>
                    <a href="#">Research</a>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 Green University of Bangladesh. All rights reserved. | Transforming education through innovative technology solutions.</p>
            </div>
        </div>
    </footer>

    <script>
        // Modern Academic Portal JavaScript
        class AcademicPortal {
            constructor() {
                this.init();
            }

            init() {
                this.initCursor();
                this.initScrollEffects();
                this.initAnimations();
                this.initCounters();
                this.initSmoothScroll();
                this.initNavbar();
            }

            // Custom cursor
            initCursor() {
                const cursor = document.querySelector('.cursor');
                const follower = document.querySelector('.cursor-follower');
                let mouseX = 0, mouseY = 0;
                let cursorX = 0, cursorY = 0;

                document.addEventListener('mousemove', (e) => {
                    mouseX = e.clientX;
                    mouseY = e.clientY;
                });

                const animateCursor = () => {
                    cursorX += (mouseX - cursorX) * 0.1;
                    cursorY += (mouseY - cursorY) * 0.1;
                    
                    cursor.style.left = mouseX + 'px';
                    cursor.style.top = mouseY + 'px';
                    follower.style.left = cursorX + 'px';
                    follower.style.top = cursorY + 'px';
                    
                    requestAnimationFrame(animateCursor);
                };
                animateCursor();

                // Hover effects
                document.querySelectorAll('a, button, .btn, .file-item, .feature-card').forEach(el => {
                    el.addEventListener('mouseenter', () => {
                        cursor.style.transform = 'translate(-50%, -50%) scale(1.5)';
                        follower.style.transform = 'translate(-50%, -50%) scale(1.5)';
                    });
                    
                    el.addEventListener('mouseleave', () => {
                        cursor.style.transform = 'translate(-50%, -50%) scale(1)';
                        follower.style.transform = 'translate(-50%, -50%) scale(1)';
                    });
                });
            }

            // Scroll reveal animations
            initScrollEffects() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                });

                document.querySelectorAll('.scroll-reveal').forEach(el => {
                    observer.observe(el);
                });
            }

            // Counter animations
            initCounters() {
                const counters = document.querySelectorAll('[data-count]');
                
                const animateCounter = (counter) => {
                    const target = parseInt(counter.getAttribute('data-count'));
                    const increment = target / 100;
                    let current = 0;
                    
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        
                        if (target === 99.9) {
                            counter.textContent = current.toFixed(1);
                        } else {
                            counter.textContent = Math.floor(current);
                        }
                    }, 50);
                };

                const counterObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounter(entry.target);
                            counterObserver.unobserve(entry.target);
                        }
                    });
                });

                counters.forEach(counter => {
                    counterObserver.observe(counter);
                });
            }

            // Smooth scroll
            initSmoothScroll() {
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
            }

            // Navbar scroll effect
            initNavbar() {
                const navbar = document.getElementById('navbar');
                
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 100) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }

            // Initialize animations
            initAnimations() {
                // File item hover effects
                document.querySelectorAll('.file-item').forEach(item => {
                    item.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateX(15px) scale(1.02)';
                    });
                    
                    item.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateX(10px) scale(1)';
                    });
                });

                // Feature card magnetic effect
                document.querySelectorAll('.feature-card').forEach(card => {
                    card.addEventListener('mousemove', function(e) {
                        const rect = this.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;
                        const centerX = rect.width / 2;
                        const centerY = rect.height / 2;
                        const deltaX = (x - centerX) / centerX;
                        const deltaY = (y - centerY) / centerY;
                        
                        this.style.transform = `translateY(-15px) rotateX(${deltaY * 5}deg) rotateY(${deltaX * 5}deg) scale(1.02)`;
                    });
                    
                    card.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(-15px) rotateX(0deg) rotateY(0deg) scale(1)';
                    });
                });

                // Button magnetic effects
                document.querySelectorAll('.btn').forEach(btn => {
                    btn.addEventListener('mousemove', function(e) {
                        const rect = this.getBoundingClientRect();
                        const x = e.clientX - rect.left - rect.width / 2;
                        const y = e.clientY - rect.top - rect.height / 2;
                        
                        this.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px) translateY(-3px)`;
                    });
                    
                    btn.addEventListener('mouseleave', function() {
                        this.style.transform = 'translate(0px, 0px) translateY(0px)';
                    });
                });
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new AcademicPortal();
        });

        // Performance optimization
        let ticking = false;

        function updateAnimations() {
            // Update any continuous animations here
            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateAnimations);
                ticking = true;
            }
        }

        // Optimized scroll listener
        window.addEventListener('scroll', requestTick);

        // Add loading animation
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
            
            // Stagger animation for hero elements
            const heroElements = document.querySelectorAll('.hero-content > *');
            heroElements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('fade-in-up');
                }, index * 200);
            });
        });

        // Preload critical resources
        const preloadImages = [
            'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"%3E%3C/svg%3E'
        ];

        preloadImages.forEach(src => {
            const img = new Image();
            img.src = src;
        });

        console.log('🎓 Academic Portal Loaded Successfully');
    </script>
</body>
</html>