let studentData = {
    id: "2311600102",
    name: "Lowrence Lagsil",
    borrowedBooks: 3,
    overdueBooks: 0,
    reservedBooks: 1,
    availableBooks: 1247
};

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    
    // Toggle collapsed state
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('collapsed');
}

function toggleMobileMenu() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('open');
}

function viewBorrowedBooks() {
    window.location.href = 'borrowing_history.html';
}

function viewOverdueBooks() {
    if (studentData.overdueBooks === 0) {
        alert('Great! You have no overdue books. 🎉');
    } else {
        window.location.href = 'overdue_books.html';
    }
}

function viewReservedBooks() {
    alert('📅 Reserved books feature coming soon!');
}

function viewAvailableBooks() {
    window.location.href = 'borrow_book.html';
}

// Enhanced animations on load
document.addEventListener('DOMContentLoaded', function() {
    // Animate stat cards
    const cards = document.querySelectorAll('.stat-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 150 + 300);
    });

    // Animate chart bars
    setTimeout(() => {
        const chartBars = document.querySelectorAll('.chart-bar');
        chartBars.forEach((bar, index) => {
            const originalHeight = bar.style.height;
            bar.style.height = '0px';
            bar.style.transition = 'height 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
            
            setTimeout(() => {
                bar.style.height = originalHeight;
            }, index * 100 + 800);
        });
    }, 500);

    // Animate progress bars
    setTimeout(() => {
        const progressBars = document.querySelectorAll('.progress-fill');
        progressBars.forEach((bar, index) => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, index * 200 + 1200);
        });
    }, 500);

    // Menu hover effects
    const menuLinks = document.querySelectorAll('.menu-link');
    menuLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.paddingLeft = '2rem';
        });
        
        link.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                this.style.paddingLeft = '1.5rem';
            }
        });
    });
});

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const toggle = document.querySelector('.burger-menu');
    
    if (window.innerWidth <= 768) {
        if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
            sidebar.classList.remove('open');
        }
    }
});
