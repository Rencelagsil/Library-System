// Student Dashboard JavaScript Functions

// Sidebar toggle functionality
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const burgerBtn = document.getElementById('burgerBtn');
    
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('expanded');
    
    // Change burger icon
    if (sidebar.classList.contains('collapsed')) {
        burgerBtn.innerHTML = '☰';
    } else {
        burgerBtn.innerHTML = '✕';
    }
}

// Show different sections
function showSection(sectionId) {
    // Hide all sections
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.classList.remove('active');
    });
    
    // Show selected section
    const targetSection = document.getElementById(sectionId);
    if (targetSection) {
        targetSection.classList.add('active');
    }
    
    // Update page title and breadcrumb
    updatePageHeader(sectionId);
    
    // Close sidebar on mobile after selection
    if (window.innerWidth <= 768) {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        sidebar.classList.add('collapsed');
        mainContent.classList.add('expanded');
    }
}

// Set active menu item
function setActiveMenu(element) {
    // Remove active class from all menu links
    const menuLinks = document.querySelectorAll('.menu-link');
    menuLinks.forEach(link => {
        link.classList.remove('active');
    });
    
    // Add active class to clicked menu item
    element.classList.add('active');
}

// Update page header based on section
function updatePageHeader(sectionId) {
    const pageTitle = document.querySelector('.page-title');
    const breadcrumb = document.querySelector('.breadcrumb');
    
    const sectionTitles = {
        'dashboard': '📊 Student Dashboard',
        'borrow-book': '📤 Borrow Book',
        'borrowing-history': '📊 Borrowing History',
        'return-book': '📥 Return Book',
        'overdue-books': '⚠️ Overdue Books',
        'profile': '👤 My Profile',
        'help': '❓ Help & Support'
    };
    
    const breadcrumbs = {
        'dashboard': 'Home',
        'borrow-book': 'Home > Borrow Book',
        'borrowing-history': 'Home > Borrowing History',
        'return-book': 'Home > Return Book',
        'overdue-books': 'Home > Overdue Books',
        'profile': 'Home > My Profile',
        'help': 'Home > Help & Support'
    };
    
    if (pageTitle && sectionTitles[sectionId]) {
        pageTitle.textContent = sectionTitles[sectionId];
    }
    
    if (breadcrumb && breadcrumbs[sectionId]) {
        breadcrumb.textContent = breadcrumbs[sectionId];
    }
}

// Search books functionality
function searchBooks(query) {
    const bookGrid = document.getElementById('bookGrid');
    const bookCards = bookGrid.querySelectorAll('.book-card');
    
    if (!query.trim()) {
        // Show all books if search is empty
        bookCards.forEach(card => {
            card.style.display = 'block';
        });
        return;
    }
    
    bookCards.forEach(card => {
        const title = card.querySelector('.book-title').textContent.toLowerCase();
        const details = card.querySelector('.book-details').textContent.toLowerCase();
        
        if (title.includes(query.toLowerCase()) || details.includes(query.toLowerCase())) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Borrow book functionality
function borrowBook(isbn) {
    // Simulate borrowing process
    const confirmation = confirm(`Are you sure you want to borrow this book (ISBN: ${isbn})?`);
    
    if (confirmation) {
        // Show success message
        showMessage('success', 'Book borrowed successfully! Check your borrowing history for details.');
        
        // Update statistics (simulate)
        updateBorrowedBooksCount();
        
        // You could also update the available count for the specific book here
        updateBookAvailability(isbn);
    }
}

// Return book functionality
function returnBook(bookId) {
    const confirmation = confirm('Are you sure you want to return this book?');
    
    if (confirmation) {
        // Find and remove the book card from return section
        const bookCard = event.target.closest('.book-card');
        if (bookCard) {
            bookCard.style.animation = 'fadeOut 0.5s ease-out';
            setTimeout(() => {
                bookCard.remove();
            }, 500);
        }
        
        showMessage('success', 'Book returned successfully! Thank you for returning on time.');
        
        // Update statistics
        updateReturnedBooksCount();
    }
}

// Update borrowed books count
function updateBorrowedBooksCount() {
    const borrowedStat = document.querySelector('.borrowed-books .stat-number');
    if (borrowedStat) {
        const current = parseInt(borrowedStat.textContent);
        borrowedStat.textContent = current + 1;
    }
}

// Update returned books count and borrowed count
function updateReturnedBooksCount() {
    const borrowedStat = document.querySelector('.borrowed-books .stat-number');
    if (borrowedStat) {
        const current = parseInt(borrowedStat.textContent);
        if (current > 0) {
            borrowedStat.textContent = current - 1;
        }
    }
}

// Update book availability
function updateBookAvailability(isbn) {
    const bookCards = document.querySelectorAll('.book-card');
    bookCards.forEach(card => {
        const details = card.querySelector('.book-details');
        if (details && details.textContent.includes(isbn)) {
            const availableText = details.textContent;
            const availableMatch = availableText.match(/Available: (\d+) copies/);
            if (availableMatch) {
                const currentCount = parseInt(availableMatch[1]);
                if (currentCount > 0) {
                    const newText = availableText.replace(/Available: \d+ copies/, `Available: ${currentCount - 1} copies`);
                    details.innerHTML = newText.replace(/\n/g, '<br>');
                }
            }
        }
    });
}

// Show/hide notifications
function showNotifications() {
    const popup = document.getElementById('notificationPopup');
    popup.style.display = 'block';
    setTimeout(() => {
        popup.classList.add('show');
    }, 10);
}

function hideNotifications() {
    const popup = document.getElementById('notificationPopup');
    popup.classList.remove('show');
    setTimeout(() => {
        popup.style.display = 'none';
    }, 300);
}

// Update profile functionality
function updateProfile() {
    const emailInput = document.querySelector('input[type="email"]');
    const phoneInput = document.querySelector('input[type="tel"]');
    
    // Basic validation
    if (!emailInput.value || !phoneInput.value) {
        showMessage('error', 'Please fill in all required fields.');
        return;
    }
    
    if (!isValidEmail(emailInput.value)) {
        showMessage('error', 'Please enter a valid email address.');
        return;
    }
    
    showMessage('success', 'Profile updated successfully!');
}

// Email validation helper
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Help section functions
function showHelp(topic) {
    const helpContent = {
        'borrow': 'To borrow a book:\n1. Go to "Borrow Book" section\n2. Search for your desired book\n3. Click "Borrow Book" button\n4. Confirm your selection\n\nBooks are typically due in 2 weeks.',
        'dues': 'Due dates and renewals:\n• Books are due 14 days after borrowing\n• You can renew once if no one is waiting\n• Overdue fines are $0.50 per day\n• Check your dashboard for due dates'
    };
    
    if (helpContent[topic]) {
        alert(helpContent[topic]);
    }
}

function contactSupport() {
    alert('Contact Library Support:\n\nEmail: library@university.edu\nPhone: (555) 123-BOOK\nHours: Mon-Fri 8AM-8PM\n\nFor urgent issues, visit the main desk on Level 1.');
}

function showFAQ() {
    const faqWindow = window.open('', 'FAQ', 'width=600,height=400,scrollbars=yes');
    faqWindow.document.write(`
        <html>
        <head><title>Library FAQ</title></head>
        <body style="font-family: Arial, sans-serif; padding: 20px;">
        <h2>Frequently Asked Questions</h2>
        <h3>Q: How long can I borrow a book?</h3>
        <p>A: Books can be borrowed for 2 weeks, with one renewal possible.</p>
        
        <h3>Q: What are the overdue fines?</h3>
        <p>A: Overdue fines are $0.50 per day per book.</p>
        
        <h3>Q: How many books can I borrow at once?</h3>
        <p>A: Students can borrow up to 5 books at a time.</p>
        
        <h3>Q: Can I reserve books?</h3>
        <p>A: Yes, you can reserve books that are currently borrowed by others.</p>
        
        <button onclick="window.close()" style="margin-top: 20px; padding: 10px 20px;">Close</button>
        </body>
        </html>
    `);
}

// Logout functionality
function logout() {
    const confirmation = confirm('Are you sure you want to logout?');
    if (confirmation) {
        showMessage('info', 'Logging out...');
        // Simulate logout delay
        setTimeout(() => {
            alert('You have been logged out successfully.');
            // In a real application, you would redirect to login page
            window.location.reload();
        }, 1500);
    }
}

// Show message function
function showMessage(type, message) {
    // Create message element
    const messageDiv = document.createElement('div');
    messageDiv.className = `message message-${type}`;
    messageDiv.textContent = message;
    
    // Style the message
    Object.assign(messageDiv.style, {
        position: 'fixed',
        top: '20px',
        right: '20px',
        padding: '15px 20px',
        borderRadius: '5px',
        color: 'white',
        fontWeight: 'bold',
        zIndex: '10000',
        maxWidth: '300px',
        boxShadow: '0 4px 6px rgba(0,0,0,0.1)'
    });
    
    // Set background color based on type
    const colors = {
        'success': '#27ae60',
        'error': '#e74c3c',
        'info': '#3498db',
        'warning': '#f39c12'
    };
    messageDiv.style.backgroundColor = colors[type] || colors.info;
    
    // Add to page
    document.body.appendChild(messageDiv);
    
    // Animate in
    messageDiv.style.transform = 'translateX(100%)';
    messageDiv.style.transition = 'transform 0.3s ease-out';
    setTimeout(() => {
        messageDiv.style.transform = 'translateX(0)';
    }, 10);
    
    // Remove after delay
    setTimeout(() => {
        messageDiv.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(messageDiv);
        }, 300);
    }, 3000);
}

// Initialize dashboard on page load
document.addEventListener('DOMContentLoaded', function() {
    // Set initial active section
    showSection('dashboard');
    
    // Add responsive behavior
    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        
        if (window.innerWidth > 768) {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('expanded');
        }
    });
    
    // Close notification popup when clicking outside
    document.addEventListener('click', function(event) {
        const popup = document.getElementById('notificationPopup');
        const notificationBtn = document.querySelector('.notifications');
        
        if (!popup.contains(event.target) && !notificationBtn.contains(event.target)) {
            if (popup.classList.contains('show')) {
                hideNotifications();
            }
        }
    });
    
    // Add fade-out animation styles
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeOut {
            from { opacity: 1; transform: scale(1); }
            to { opacity: 0; transform: scale(0.8); }
        }
        
        .message {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }
    `;
    document.head.appendChild(style);
    
    console.log('Student Dashboard initialized successfully!');
});