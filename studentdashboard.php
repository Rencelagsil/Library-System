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
                    <a href="#" class="menu-link active">
                        <div class="menu-icon">🏠</div>
                        <span>Dashboard</span>
                    </a>
                </li>
               
            </div>

            <div class="menu-section">
                <div class="section-title">My Books</div>
                 <li class="menu-item">
                    <a href="borrow_book.html" class="menu-link">
                        <div class="menu-icon">📤</div>
                        <span>Borrow Book</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="borrowing_history.html" class="menu-link">
                        <div class="menu-icon">📊</div>
                        <span>Borrowing History</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="return_book.html" class="menu-link">
                        <div class="menu-icon">📥</div>
                        <span>Return Book</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="overdue_books.html" class="menu-link">
                        <div class="menu-icon">⚠️</div>
                        <span>Overdue Books</span>
                    </a>
                </li>
            </div>

            <div class="menu-section">
                <div class="section-title">Account</div>
                <li class="menu-item">
                    <a href="profile.html" class="menu-link">
                        <div class="menu-icon">👤</div>
                        <span>My Profile</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div class="menu-icon">❓</div>
                        <span>Help & Support</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="login.php" class="menu-link">
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
                <div class="notifications">
                    <div style="font-size: 1.2rem;">🔔</div>
                    <div class="notification-badge">3</div>
                </div>
            
            </div>
        </div>

        <div class="content-grid">
            <div class="left-section">
                <div class="stats-grid">
                    <div class="stat-card borrowed-books" onclick="viewBorrowedBooks()">
                        <div class="stat-icon">📚</div>
                        <div class="stat-number">3</div>
                        <div class="stat-label">Books Borrowed</div>
                    </div>

                    <div class="stat-card overdue-books" onclick="viewOverdueBooks()">
                        <div class="stat-icon">⚠️</div>
                        <div class="stat-number">0</div>
                        <div class="stat-label">Overdue Books</div>
                    </div>

                    <div class="stat-card reserved-books" onclick="viewReservedBooks()">
                        <div class="stat-icon">📅</div>
                        <div class="stat-number">1</div>
                        <div class="stat-label">Books Reserved</div>
                    </div>

                    <div class="stat-card available-books" onclick="viewAvailableBooks()">
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
    </main>

    <script src="studentdash.js"></script>
</body>
</html>