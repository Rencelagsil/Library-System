<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="studentdash.css">
</head>
<body>
    <button class="burger-menu" onclick="toggleSidebar()" id="burgerBtn">☰</button>

    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-title">
                <div class="sidebar-icon">📚</div>
                <span>Lathoug's Library</span>
            </div>
        </div>
        <ul class="sidebar-menu">
            <div class="menu-section">
                <div class="section-title">Main</div>
                <li class="menu-item">
                    <a href="#" class="menu-link active" onclick="showSection('dashboard'); setActiveMenu(this); return false;">
                        <div class="menu-icon">🏠</div>
                        <span>Dashboard</span>
                    </a>
                </li>
            </div>

            <div class="menu-section">
                <div class="section-title">My Books</div>
                <li class="menu-item">
                    <a href="#" class="menu-link" onclick="showSection('borrow-book'); setActiveMenu(this); return false;">
                        <div class="menu-icon">📤</div>
                        <span>Borrow Book</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" onclick="showSection('borrowing-history'); setActiveMenu(this); return false;">
                        <div class="menu-icon">📊</div>
                        <span>Borrowing History</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" onclick="showSection('return-book'); setActiveMenu(this); return false;">
                        <div class="menu-icon">📥</div>
                        <span>Return Book</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" onclick="showSection('overdue-books'); setActiveMenu(this); return false;">
                        <div class="menu-icon">⚠️</div>
                        <span>Overdue Books</span>
                    </a>
                </li>
            </div>

            <div class="menu-section">
                <div class="section-title">Account</div>
                <li class="menu-item">
                    <a href="#" class="menu-link" onclick="showSection('profile'); setActiveMenu(this); return false;">
                        <div class="menu-icon">👤</div>
                        <span>My Profile</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" onclick="showSection('help'); setActiveMenu(this); return false;">
                        <div class="menu-icon">❓</div>
                        <span>Help & Support</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" onclick="logout(); return false;">
                        <div class="menu-icon">🚪</div>
                        <span>Logout</span>
                    </a>
                </li>
            </div>
        </ul>
    </nav>

    <main class="main-content" id="mainContent">
        <div class="top-bar">
            <div>
                <h1 class="page-title">📊 Student Dashboard</h1>
                <div class="breadcrumb">Home</div>
            </div>
            <div class="user-section">
                <div class="notifications" onclick="showNotifications()">
                    <div style="font-size: 1.2rem;">🔔</div>
                    <div class="notification-badge">3</div>
                </div>
            </div>
        </div>

        <!-- Dashboard Section -->
        <div id="dashboard" class="content-section active">
            <div class="content-grid">
                <div class="left-section">
                    <div class="stats-grid">
                        <div class="stat-card borrowed-books" onclick="showSection('borrowing-history')">
                            <div class="stat-icon">📚</div>
                            <div class="stat-number">3</div>
                            <div class="stat-label">Books Borrowed</div>
                        </div>

                        <div class="stat-card overdue-books" onclick="showSection('overdue-books')">
                            <div class="stat-icon">⚠️</div>
                            <div class="stat-number">1</div>
                            <div class="stat-label">Overdue Books</div>
                        </div>

                        <div class="stat-card reserved-books">
                            <div class="stat-icon">📅</div>
                            <div class="stat-number">1</div>
                            <div class="stat-label">Books Reserved</div>
                        </div>

                        <div class="stat-card available-books" onclick="showSection('borrow-book')">
                            <div class="stat-icon">📖</div>
                            <div class="stat-number">1,247</div>
                            <div class="stat-label">Available Books</div>
                        </div>
                    </div>

                    <div class="chart-section">
                        <div class="chart-header">
                            <h3 class="chart-title">📈 My Reading Activity</h3>
                            <div class="chart-legend">
                                <div class="legend-item">
                                    <div class="legend-dot legend-borrow"></div>
                                    <span>Borrowed</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-dot legend-return"></div>
                                    <span>Returned</span>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container">
                            <div class="chart-bar" style="height: 60px;">
                                <div class="chart-month">Jan</div>
                            </div>
                            <div class="chart-bar" style="height: 80px;">
                                <div class="chart-month">Feb</div>
                            </div>
                            <div class="chart-bar" style="height: 120px;">
                                <div class="chart-month">Mar</div>
                            </div>
                            <div class="chart-bar" style="height: 90px;">
                                <div class="chart-month">Apr</div>
                            </div>
                            <div class="chart-bar" style="height: 110px;">
                                <div class="chart-month">May</div>
                            </div>
                            <div class="chart-bar" style="height: 70px;">
                                <div class="chart-month">Jun</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right-section">
                    <div class="progress-section">
                        <h3 class="progress-title">📚 Reading Progress & Goals</h3>
                        
                        <div class="progress-item">
                            <div class="progress-label">
                                <span>Monthly Reading Goal</span>
                                <span>75%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill progress-goal" style="width: 75%;"></div>
                            </div>
                        </div>

                        <div class="progress-item">
                            <div class="progress-label">
                                <span>Books Completed</span>
                                <span>60%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill progress-reading" style="width: 60%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="promo-section">
                        <h3 class="promo-title">📖 Keep Reading!</h3>
                        <p class="promo-text">
                            You're doing great! Keep up your reading streak and discover new worlds through books.
                        </p>
                        <div class="promo-icon">⭐</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Borrow Book Section -->
        <div id="borrow-book" class="content-section">
            <div class="section-content">
                <div class="section-header">
                    <h2 class="section-title-main">📤 Borrow Book</h2>
                    <p class="section-subtitle">Search and borrow available books from our library</p>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Search Books</label>
                    <input type="text" class="form-input" placeholder="Enter book title, author, or ISBN..." onkeyup="searchBooks(this.value)">
                </div>

                <div class="book-grid" id="bookGrid">
                    <div class="book-card">
                        <div class="book-title">Introduction to Programming</div>
                        <div class="book-details">
                            Author: John Smith<br>
                            ISBN: 978-0123456789<br>
                            Available: 5 copies
                        </div>
                        <button class="action-btn" onclick="borrowBook('978-0123456789')">Borrow Book</button>
                    </div>
                    <div class="book-card">
                        <div class="book-title">Database Systems</div>
                        <div class="book-details">
                            Author: Maria Garcia<br>
                            ISBN: 978-0987654321<br>
                            Available: 3 copies
                        </div>
                        <button class="action-btn" onclick="borrowBook('978-0987654321')">Borrow Book</button>
                    </div>
                    <div class="book-card">
                        <div class="book-title">Web Development Guide</div>
                        <div class="book-details">
                            Author: Alex Johnson<br>
                            ISBN: 978-0456789123<br>
                            Available: 7 copies
                        </div>
                        <button class="action-btn" onclick="borrowBook('978-0456789123')">Borrow Book</button>
                    </div>
                    <div class="book-card">
                        <div class="book-title">Data Science Fundamentals</div>
                        <div class="book-details">
                            Author: Sarah Williams<br>
                            ISBN: 978-0789123456<br>
                            Available: 4 copies
                        </div>
                        <button class="action-btn" onclick="borrowBook('978-0789123456')">Borrow Book</button>
                    </div>
                    <div class="book-card">
                        <div class="book-title">Mobile App Development</div>
                        <div class="book-details">
                            Author: Mike Chen<br>
                            ISBN: 978-0321654987<br>
                            Available: 6 copies
                        </div>
                        <button class="action-btn" onclick="borrowBook('978-0321654987')">Borrow Book</button>
                    </div>
                    <div class="book-card">
                        <div class="book-title">Artificial Intelligence</div>
                        <div class="book-details">
                            Author: Dr. Emily Johnson<br>
                            ISBN: 978-0654789321<br>
                            Available: 2 copies
                        </div>
                        <button class="action-btn" onclick="borrowBook('978-0654789321')">Borrow Book</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Borrowing History Section -->
        <div id="borrowing-history" class="content-section">
            <div class="section-content">
                <div class="section-header">
                    <h2 class="section-title-main">📊 Borrowing History</h2>
                    <p class="section-subtitle">View your complete borrowing history</p>
                </div>
                
                <div class="book-grid">
                    <div class="book-card">
                        <div class="book-title">Python Programming</div>
                        <div class="book-details">
                            Borrowed: March 15, 2024<br>
                            Returned: March 29, 2024<br>
                            Status: <span style="color: #27ae60;">Returned</span>
                        </div>
                    </div>
                    <div class="book-card">
                        <div class="book-title">Data Structures</div>
                        <div class="book-details">
                            Borrowed: April 2, 2024<br>
                            Due: April 16, 2024<br>
                            Status: <span style="color: #3498db;">Currently Borrowed</span>
                        </div>
                    </div>
                    <div class="book-card">
                        <div class="book-title">Algorithm Design</div>
                        <div class="book-details">
                            Borrowed: February 10, 2024<br>
                            Returned: February 24, 2024<br>
                            Status: <span style="color: #27ae60;">Returned</span>
                        </div>
                    </div>
                    <div class="book-card">
                        <div class="book-title">Machine Learning Basics</div>
                        <div class="book-details">
                            Borrowed: April 5, 2024<br>
                            Due: April 19, 2024<br>
                            Status: <span style="color: #3498db;">Currently Borrowed</span>
                        </div>
                    </div>
                    <div class="book-card">
                        <div class="book-title">Software Engineering</div>
                        <div class="book-details">
                            Borrowed: January 20, 2024<br>
                            Returned: February 3, 2024<br>
                            Status: <span style="color: #27ae60;">Returned</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Return Book Section -->
        <div id="return-book" class="content-section">
            <div class="section-content">
                <div class="section-header">
                    <h2 class="section-title-main">📥 Return Book</h2>
                    <p class="section-subtitle">Return your currently borrowed books</p>
                </div>
                
                <div class="book-grid">
                    <div class="book-card">
                        <div class="book-title">Data Structures</div>
                        <div class="book-details">
                            Borrowed: April 2, 2024<br>
                            Due: April 16, 2024<br>
                            Status: <span style="color: #f39c12;">Due Soon</span>
                        </div>
                        <button class="action-btn" onclick="returnBook('data-structures')">Return Book</button>
                    </div>
                    <div class="book-card">
                        <div class="book-title">Machine Learning Basics</div>
                        <div class="book-details">
                            Borrowed: April 5, 2024<br>
                            Due: April 19, 2024<br>
                            Status: <span style="color: #3498db;">Currently Borrowed</span>
                        </div>
                        <button class="action-btn" onclick="returnBook('ml-basics')">Return Book</button>
                    </div>
                    <div class="book-card">
                        <div class="book-title">Network Security</div>
                        <div class="book-details">
                            Borrowed: April 8, 2024<br>
                            Due: April 22, 2024<br>
                            Status: <span style="color: #3498db;">Currently Borrowed</span>
                        </div>
                        <button class="action-btn" onclick="returnBook('network-security')">Return Book</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overdue Books Section -->
        <div id="overdue-books" class="content-section">
            <div class="section-content">
                <div class="section-header">
                    <h2 class="section-title-main">⚠️ Overdue Books</h2>
                    <p class="section-subtitle">Please return these books as soon as possible</p>
                </div>
                
                <div class="book-grid">
                    <div class="book-card" style="border-left: 4px solid #e74c3c;">
                        <div class="book-title">Advanced Algorithms</div>
                        <div class="book-details">
                            Borrowed: March 10, 2024<br>
                            Due: March 24, 2024<br>
                            Overdue by: <span style="color: #e74c3c; font-weight: bold;">18 days</span><br>
                            Fine: <span style="color: #e74c3c; font-weight: bold;">$9.00</span>
                        </div>
                        <button class="action-btn" style="background: #e74c3c;" onclick="returnBook('advanced-algorithms')">Return Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Section -->
        <div id="profile" class="content-section">
            <div class="section-content">
                <div class="section-header">
                    <h2 class="section-title-main">👤 My Profile</h2>
                    <p class="section-subtitle">Manage your account information</p>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-input" value="John Doe" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Student ID</label>
                    <input type="text" class="form-input" value="STU-2024-001" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-input" value="john.doe@university.edu">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" class="form-input" value="+1 (555) 123-4567">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Department</label>
                    <input type="text" class="form-input" value="Computer Science" readonly>
                </div>
                
                <button class="action-btn" onclick="updateProfile()">Update Profile</button>
            </div>
        </div>

        <!-- Help Section -->
        <div id="help" class="content-section">
            <div class="section-content">
                <div class="section-header">
                    <h2 class="section-title-main">❓ Help & Support</h2>
                    <p class="section-subtitle">Get help and support for using the library system</p>
                </div>
                
                <div class="book-grid">
                    <div class="help-card">
                        <div class="help-icon">📚</div>
                        <div class="help-title">How to Borrow Books</div>
                        <div class="help-description">
                            Learn how to search for and borrow books from our digital library system.
                        </div>
                        <button class="action-btn" onclick="showHelp('borrow')">Learn More</button>
                    </div>
                    
                    <div class="help-card">
                        <div class="help-icon">📅</div>
                        <div class="help-title">Due Dates & Renewals</div>
                        <div class="help-description">
                            Understand due dates, renewal policies, and how to avoid overdue fines.
                        </div>
                        <button class="action-btn" onclick="showHelp('dues')">Learn More</button>
                    </div>
                    
                    <div class="help-card">
                        <div class="help-icon">💬</div>
                        <div class="help-title">Contact Support</div>
                        <div class="help-description">
                            Need personal assistance? Contact our library support team directly.
                        </div>
                        <button class="action-btn" onclick="contactSupport()">Contact Us</button>
                    </div>
                    
                    <div class="help-card">
                        <div class="help-icon">❓</div>
                        <div class="help-title">FAQ</div>
                        <div class="help-description">
                            Find answers to frequently asked questions about the library system.
                        </div>
                        <button class="action-btn" onclick="showFAQ()">View FAQ</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Notification Popup -->
    <div class="notification-popup" id="notificationPopup">
        <div class="notification-header">
            <div class="notification-title">📢 Notifications</div>
            <button class="close-btn" onclick="hideNotifications()">&times;</button>
        </div>
        <div class="notification-list">
            <div class="notification-item">
                <div class="notification-text">Your book "Data Structures" is due in 2 days</div>
                <div class="notification-time">2 hours ago</div>
            </div>
            <div class="notification-item">
                <div class="notification-text">New book "AI Fundamentals" is now available</div>
                <div class="notification-time">1 day ago</div>
            </div>
            <div class="notification-item">
                <div class="notification-text">You have successfully returned "Python Programming"</div>
                <div class="notification-time">3 days ago</div>
            </div>
        </div>
    </div>

    <script src="studentdash.js"></script>
</body>
</html>