    let staffData = {
        totalStudents: 1247,
        activeLoans: 340,
        overdueItems: 24,
        totalBooks: 5280
    };

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');
    }
function showSection(section) {
    const content = document.getElementById("mainContent");

if (section === 'dashboard') {
    content.innerHTML = `
        <div class="top-bar">
            <div>
                <h1 class="page-title">🛠️ Staff Dashboard</h1>
                <div class="breadcrumb">Home</div>
            </div>
            <div class="user-section">
                <div class="notifications" onclick="showNotifications()">
                    <div style="font-size: 1.2rem;">🔔</div>
                    <div class="notification-badge">5</div>
                </div>
            </div>
        </div>

        <div class="content-grid">
            <div class="left-section">
                <div class="stats-grid">
                    <div class="stat-card total-students" onclick="showSection('students')">
                        <div class="stat-icon">👥</div>
                        <div class="stat-number">${staffData.totalStudents}</div>
                        <div class="stat-label">Total Students</div>
                    </div>

                    <div class="stat-card active-loans" onclick="showSection('returns')">
                        <div class="stat-icon">📤</div>
                        <div class="stat-number">${staffData.activeLoans}</div>
                        <div class="stat-label">Return Book</div>
                    </div>

                    <div class="stat-card overdue-items" onclick="showSection('history')">
                        <div class="stat-icon">⚠️</div>
                        <div class="stat-number">${staffData.overdueItems}</div>
                        <div class="stat-label">History</div>
                    </div>

                    <div class="stat-card total-books" onclick="showSection('books')">
                        <div class="stat-icon">📚</div>
                        <div class="stat-number">${staffData.totalBooks}</div>
                        <div class="stat-label">Total Books</div>
                    </div>
                </div>

                <div class="chart-section">
                    <div class="chart-header">
                        <h3 class="chart-title">📈 Library Activity Overview</h3>
                        <div class="chart-legend">
                            <div class="legend-item">
                                <div class="legend-dot legend-issued"></div>
                                <span>Issued</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-dot legend-returned"></div>
                                <span>Returned</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-dot legend-overdue"></div>
                                <span>Overdue</span>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <div class="chart-bar" style="height: 120px;">
                            <div class="chart-month">Jan</div>
                        </div>
                        <div class="chart-bar" style="height: 150px;">
                            <div class="chart-month">Feb</div>
                        </div>
                        <div class="chart-bar" style="height: 180px;">
                            <div class="chart-month">Mar</div>
                        </div>
                        <div class="chart-bar" style="height: 140px;">
                            <div class="chart-month">Apr</div>
                        </div>
                        <div class="chart-bar" style="height: 170px;">
                            <div class="chart-month">May</div>
                        </div>
                        <div class="chart-bar" style="height: 110px;">
                            <div class="chart-month">Jun</div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="right-section">
                <div class="quick-actions">
                    <h3 class="actions-title">⚡ Quick Actions</h3>
                    <button class="action-btn danger" onclick="showSection('books')">All Books</button>
                    <button class="action-btn" onclick="showSection('add-book')">📖 Add New Book</button>
                    <button class="action-btn success" onclick="showSection('returns')">📥 Return Book</button>
                    <button class="action-btn" onclick="showSection('history')">📤 History</button>
                    <button class="action-btn" onclick="showSection('students')">👤 Student List</button>
                      
                </div>

                <div class="recent-activity">
                    <h3 class="activity-title">🕒 Recent Activity</h3>
                    <!-- put your recent activity items here -->
                </div>

                <div class="announcements">
                    <h3 class="announcements-title">📢 System Announcements</h3>
                    <!-- put your announcements here -->
                </div>
            </div>
        </div>
    `;
    return;
}


    // existing switch-case for other sections
    let page = '';
    switch(section) {
        case 'books':
            page = 'book_list.php';
            break;
        case 'add-book':
            page = 'book_management.php';
            break;
        case 'history':
            page = 'borrowing_history.html';
            break;
        case 'returns':
            page = 'return_book.html';
            break;
        case 'students':
            page = 'student_list.php';
            break;
        case 'approval':
            page = 'approval.php';
            break;
        case 'overdue':
            page = 'overdue-management.html';
            break;
        case 'reports':
            page = 'reports.html';
            break;
        case 'settings':
            page = 'settings.html';
            break;
        default:
            content.innerHTML = "<h2>Section not found.</h2>";
            return;
    }

    fetch(page)
        .then(response => response.text())
        .then(html => {
            content.innerHTML = html;
        })
        .catch(err => {
            content.innerHTML = "<h2>Failed to load section.</h2>";
            console.error(err);
        });
}

