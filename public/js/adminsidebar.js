
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

    const studentListContainer = document.querySelector(".student-listcontainer");
    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";

    adminSidebarItems.forEach((item, index) => {
        item.addEventListener("click", () => {

            if (window.innerWidth <= 640 && triggeredSideBar) {
                triggeredSideBar.style.display = "none";
                if (img && img.src.includes("close_icon.png")) {
                    img.src = 'assets/images/Icons/menu.png';
                }
            }

            adminSidebarItems.forEach(i => i.classList.remove('active'));
            item.classList.remove('active');

            if (index === 2) {
                item.style.backgroundColor = "transparent";
                studentCounsellorFirstListChild.classList.remove('active');
                studentFirstListChild.classList.add('active');


            }

            else if (index === 5) {
                item.style.backgroundColor = "transparent";

                studentFirstListChild.classList.remove('active');
                studentCounsellorFirstListChild.classList.add('active');


            }
            else {
                item.classList.add('active');


            }

            if (index === 0) {
                if (adminPropertyOne) adminPropertyOne.style.display = "flex";
                if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-down");
                if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";

            } else if (index === 1) {
                if (adminPropertyOne) adminPropertyOne.style.display = "none";
                if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-down");
                if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                if (studentListContainer) studentListContainer.style.display = "none"


            } else if (index === 2 || index == 3 || index == 4) {
                if (adminPropertyOne) adminPropertyOne.style.display = "none";
                if (sidebarChevronUpDown) {
                    sidebarChevronUpDown.classList.remove("fa-chevron-down");
                    sidebarChevronUpDown.classList.add("fa-chevron-up");
                }
                if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-down");
                if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "flex";
                if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                if (index !== 4) {
                    if (studentListContainer) studentListContainer.style.display = "flex"

                }
                else {
                    if (studentListContainer) studentListContainer.style.display = "none"


                }


            } else if (index === 5 || index === 6 || index === 7 || index === 8) {
                if (sidebarStudentCounsellorChevronUpDown) {
                    sidebarStudentCounsellorChevronUpDown.classList.remove("fa-chevron-down");
                    sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-up");
                }
                if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "flex";
                if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                if (studentListContainer) studentListContainer.style.display = "none"


            } else {
                if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-down");
                if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                if (studentListContainer) studentListContainer.style.display = "none"

            }
        });
    });
};

