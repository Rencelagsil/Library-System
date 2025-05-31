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
