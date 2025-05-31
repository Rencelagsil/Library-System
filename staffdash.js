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

        let page = '';
        switch(section) {
            case 'books':
                page = 'book_list.html';
                
                break;
            case 'add-book':
                page = 'book_management.html';
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
            case 'add-student':
                page = 'student_registration.php';
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
