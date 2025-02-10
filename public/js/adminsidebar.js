document.addEventListener('DOMContentLoaded', function () {
    initializeAdminSidebar();
});

const initializeAdminSidebar = () => {
    const adminSidebarItems = document.querySelectorAll("#commonsidebar-admin .commonsidebar-sidebarlists-top li");
    const triggeredSideBar = document.getElementById("commonsidebar-admin");
    const img = document.querySelector('#commonsidebar-admin img');
    const adminPropertyOne = document.querySelector(".admindashboard-container");
    const sidebarChevronUpDown = document.querySelector("#expand-icon-Student");
    const sidebarStudentCounsellorChevronUpDown = document.querySelector("#expand-icon-StudentCounsellor");
    const expandedStudentFromAdmin = document.getElementById("expanded-student-admin-side");
    const expandedStudentCounsellorFromAdmin = document.getElementById("expanded-studentcounsellor-admin-side");

    const studentFirstListChild = document.querySelector("#expanded-student-admin-side li:first-child");
    const studentCounsellorFirstListChild = document.querySelector("#expanded-studentcounsellor-admin-side li:first-child");

    const adminCounsellorAdd = document.querySelector(".add-studentcounsellor-adminside");
    const studentListContainer = document.querySelector(".student-listcontainer");

    // Hide sections initially
    hideSections();

    adminSidebarItems.forEach((item, index) => {
        item.addEventListener("click", () => {

            // Handle mobile sidebar toggle
            if (window.innerWidth <= 640 && triggeredSideBar) {
                triggeredSideBar.style.display = "none";
                if (img && img.src.includes("close_icon.png")) {
                    img.src = 'assets/images/Icons/menu.png';
                }
            }

            // Remove active state from all items
            adminSidebarItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            // Reset sections visibility
            hideSections();

            // Toggle based on index
            switch (index) {
                case 0:
                    showAdminDashboard();
                    break;
                case 1:
                    hideAdminDashboard();
                    break;
                case 2:
                case 3:
                case 4:
                    showStudentSection(index === 4);
                    break;
                case 5:
                case 6:
                case 7:
                case 8:
                    showCounsellorSection(index === 8);
                    break;
                case 9:
                case 10:
                case 11:
                default:
                    resetDisplay();
                    break;
            }
        });
    });

    function hideSections() {
        if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
        if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
        if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
        if (studentListContainer) studentListContainer.style.display = "none";
    }

    function showAdminDashboard() {
        if (adminPropertyOne) adminPropertyOne.style.display = "flex";
        toggleChevronDown();
    }

    function hideAdminDashboard() {
        if (adminPropertyOne) adminPropertyOne.style.display = "none";
        if (showCounsellorSection) showCounsellorSection.style.display = "none";
        toggleChevronDown();
    }

    function showStudentSection(showStudentList) {
        if (adminPropertyOne) adminPropertyOne.style.display = "none";
        toggleChevronUp(sidebarChevronUpDown);
        if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "flex";
        if (showStudentList && studentListContainer) studentListContainer.style.display = "flex";
    }

    function showCounsellorSection(showAddCounsellor) {
        toggleChevronUp(sidebarStudentCounsellorChevronUpDown);
        if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "flex";
        if (showAddCounsellor && adminCounsellorAdd) adminCounsellorAdd.style.display = "flex";
    }

    function resetDisplay() {
        toggleChevronDown();
        if (adminCounsellorAdd) adminCounsellorAdd.style.display = "flex";
    }

    function toggleChevronUp(chevronElement) {
        if (chevronElement) {
            chevronElement.classList.remove("fa-chevron-down");
            chevronElement.classList.add("fa-chevron-up");
        }
    }

    function toggleChevronDown() {
        if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
        if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-down");
    }
};
