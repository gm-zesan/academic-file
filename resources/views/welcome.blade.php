<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic File Management - Green University of Bangladesh</title>

    {{-- favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/swe-logo.svg') }}" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    

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
                <div class="" style="display:flex;align-items:center;gap:12px;">
                    <!-- University logo -->
                    <img src="{{ asset('images/gublogo.jpg') }}" alt="GUB Logo" class="site-logo" style="height:56px;object-fit:contain;" />
                    <!-- Department / SWE logo -->
                    <img src="{{ asset('images/swe-logo.svg') }}" alt="SWE Logo" class="dept-logo" style="height:44px;object-fit:contain;" />
                </div>
                <div class="logo-text">
                    <h1>Course File Management  System</h1>
                    <p>Department of Software Engineering</p>
                </div>
            </div>
            <div class="nav-links">
                {{-- <a href="#home" class="nav-link">Home</a>
                <a href="#features" class="nav-link">Features</a> --}}
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link login-btn"><span>Dashboard</span></a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link login-btn"><span>Login</span></a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link login-btn"><span>Register</span></a>
                        @endif
                    @endauth
                @endif
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
                    <h3>Course File Management  System</h3>
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
            
            <div class="footer-bottom text-center">
                <p>
                    &copy; {{ date('Y') }} Green University of Bangladesh. All rights reserved. 
                    | Transforming education through innovative technology solutions.
                </p>
                <p>
                    Developed by <strong>G.M. Zesan</strong>, Batch <strong>213</strong>, Department of <strong>CSE</strong>, 
                    <strong>Green University of Bangladesh</strong>.
                </p>
            </div>

        </div>
    </footer>

    <!-- Custom JS -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

</body>
</html>