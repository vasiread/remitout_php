function initializeAdminSidebar() {
    const adminSidebarItems = document.querySelectorAll("#commonsidebar-admin .commonsidebar-sidebarlists-top li");
    const triggeredSideBar = document.getElementById("commonsidebar-admin");
    const img = document.querySelector("#commonsidebar-admin img");
    const adminPropertyOne = document.querySelector(".admindashboard-container");
    const sidebarChevronUpDown = document.querySelector("#expand-icon-Student");
    const sidebarStudentCounsellorChevronUpDown = document.querySelector("#expand-icon-StudentCounsellor");
    const manageStudentSwitch = document.getElementById("manage-student-admindashboard");
    const manageStudentSwitchMob = document.getElementById("manage-student-admindashboard-mobile");
    const expandedStudentFromAdmin = document.getElementById(
        "expanded-student-admin-side"
    );

    const expandedStudentCounsellorFromAdmin = document.getElementById(
        "expanded-studentcounsellor-admin-side"
    );
    const studentFirstListChild = document.querySelector(
        "#expanded-student-admin-side li:first-child"
    );
    const studentCounsellorFirstListChild = document.querySelector(
        "#expanded-studentcounsellor-admin-side li:first-child"
    );

    const adminCounsellorAdd = document.querySelector(
        ".add-studentcounsellor-adminside"
    );
    const studentListContainer = document.querySelector(
        ".student-listcontainer"
    );
    const studentApplication = document.querySelector(
        "#admin-student-form-edit-container"
    );
    const editContainerAdmin = document.querySelector(
        "#edit-content-main-section"
    );

    const studentCounsellorList = document.querySelector(
        ".studentcounsellorlist-adminside"
    );

    const studentNBFCList = document.querySelector(".nbfclist-adminside");
    const studentIndexAdmin = document.querySelector("#index-section-admin-id");
    const studentEditIndex = document.querySelector("#edit-content-container-id");
    const studentTicketRaised = document.querySelector("#ticket-raised-container-admin-id");
    const adminManageStudent = document.querySelector("#manage-student-main-admin-report-container-id");
    const adminRoleManagement = document.querySelector("#role-management-container-admin-id");
    const adminPromotionalEmail = document.querySelector("#promotional-composer-main-section-id");
    const nbfcAdminsideAddAuthority = document.querySelector(".add-nbfc-datasection");
    const studentProfileContainerAdminSide = document.getElementById("studentprofile-section-adminsideview");
    const addCounsellorModelTrigger = document.getElementById("switch-addcounsellor");
    const adminsideScDashboard = document.querySelector("#scdashboard-profile-adminside");

     function handleSidebarVisibility() {
        if (triggeredSideBar) {
            if (window.innerWidth > 768) {
                triggeredSideBar.style.display = "block"; 
                if (img && img.src.includes("close_icon.png")) {
                    img.src = "assets/images/Icons/menu.png"; 
                }
            } else {
                triggeredSideBar.style.display = "none"; 
            }
        }
    }

    // Call on initial load
    handleSidebarVisibility();

    // Add resize event listener to handle switching between mobile and desktop
    window.addEventListener("resize", handleSidebarVisibility);

    // Existing event listeners for addCounsellorModelTrigger
    if (addCounsellorModelTrigger && !addCounsellorModelTrigger.dataset.listenerAdded) {
        addCounsellorModelTrigger.addEventListener('click', () => {
            if (adminCounsellorAdd) adminCounsellorAdd.style.display = "flex";
            if (studentTicketRaised) studentTicketRaised.style.display = "none";
            if (adminManageStudent) adminManageStudent.style.display = "none";
            if (studentEditIndex) studentEditIndex.style.display = "none";
            if (adminRoleManagement) adminRoleManagement.style.display = "none";
            if (adminPromotionalEmail) adminPromotionalEmail.style.display = "none";
            if (studentListContainer) studentListContainer.style.display = "none";
            if (studentCounsellorList) studentCounsellorList.style.display = "none";
            if (studentApplication) studentApplication.style.display = "none";
            adminSidebarItems.forEach(item => item.classList.remove("active"));
            if (adminSidebarItems[8]) {
                adminSidebarItems[8].classList.add("active");
            }
        });
        addCounsellorModelTrigger.dataset.listenerAdded = "true";
    }

    // Existing event listener for manageStudentSwitch
    if (manageStudentSwitch) {
        manageStudentSwitch.addEventListener('click', () => {
            if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";

            if (studentTicketRaised) studentTicketRaised.style.display = "none";
            if (adminManageStudent) adminManageStudent.style.display = "flex";
            if (studentEditIndex) studentEditIndex.style.display = "none";
            if (adminRoleManagement) adminRoleManagement.style.display = "none";
            if (adminPromotionalEmail) adminPromotionalEmail.style.display = "none";
            if (studentListContainer) studentListContainer.style.display = "none";
            if (studentCounsellorList) studentCounsellorList.style.display = "none";
            if (studentApplication) studentApplication.style.display = "none";
            if (adminPropertyOne) adminPropertyOne.style.display = "none";
            adminSidebarItems.forEach(item => item.classList.remove("active"));
            if (adminSidebarItems[10]) {
                adminSidebarItems[10].classList.add("active");
            }



        });
    }







    if (expandedStudentFromAdmin)
        expandedStudentFromAdmin.style.display = "none";
    if (expandedStudentCounsellorFromAdmin)
        expandedStudentCounsellorFromAdmin.style.display = "none";

    adminSidebarItems.forEach((item, index) => {
        item.addEventListener("click", () => {
            if (window.innerWidth <= 768 && triggeredSideBar) {
                triggeredSideBar.style.display = "none";
                if (img && img.src.includes("close_icon.png")) {
                    img.src = "assets/images/Icons/menu.png";
                }
            }

            adminSidebarItems.forEach((i) => i.classList.remove("active"));
            item.classList.remove("active");

            if (index === 2) {
                item.style.backgroundColor = "transparent";
                studentCounsellorFirstListChild.classList.remove("active");
                studentFirstListChild.classList.add("active");
            } else if (index === 5) {
                item.style.backgroundColor = "transparent";
                studentFirstListChild.classList.remove("active");
                studentCounsellorFirstListChild.classList.add("active");
            } else {
                item.classList.add("active");
            }

             if (index === 0) {
                if (adminPropertyOne) adminPropertyOne.style.display = "flex";
                if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-down");
                if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                if (studentCounsellorList) studentCounsellorList.style.display = "none";
                if (studentNBFCList) studentNBFCList.style.display = "none";
                if (studentIndexAdmin) studentIndexAdmin.style.display = "none";
                if (studentEditIndex) studentEditIndex.style.display = "none";
                if (studentTicketRaised) studentTicketRaised.style.display = "none";
                if (studentListContainer) studentListContainer.style.display = "none";
                if (adminManageStudent) adminManageStudent.style.display = "none";
                if (adminRoleManagement) adminRoleManagement.style.display = "none";
                if (adminPromotionalEmail) adminPromotionalEmail.style.display = "none";
                if (nbfcAdminsideAddAuthority) nbfcAdminsideAddAuthority.style.display = "none";
                if (editContainerAdmin) editContainerAdmin.style.display = "none";
                if (studentApplication) studentApplication.style.display = "none";
                if (adminsideScDashboard) adminsideScDashboard.style.display = "none";
                if (studentProfileContainerAdminSide) studentProfileContainerAdminSide.style.display = "none";
            } else if (index === 1) {
                if (studentIndexAdmin) studentIndexAdmin.style.display = "flex";
                if (adminPropertyOne) adminPropertyOne.style.display = "none";
                if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-down");
                if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                if (studentListContainer) studentListContainer.style.display = "none";
                if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                if (studentCounsellorList) studentCounsellorList.style.display = "none";
                if (studentNBFCList) studentNBFCList.style.display = "none";
                if (studentEditIndex) studentEditIndex.style.display = "none";
                if (studentTicketRaised) studentTicketRaised.style.display = "none";
                if (adminManageStudent) adminManageStudent.style.display = "none";
                if (adminRoleManagement) adminRoleManagement.style.display = "none";
                if (adminPromotionalEmail) adminPromotionalEmail.style.display = "none";
                if (editContainerAdmin) editContainerAdmin.style.display = "none";
                if (nbfcAdminsideAddAuthority) nbfcAdminsideAddAuthority.style.display = "none";
                if (studentApplication) studentApplication.style.display = "none";
                if (adminsideScDashboard) adminsideScDashboard.style.display = "none";
                if (studentProfileContainerAdminSide) studentProfileContainerAdminSide.style.display = "none";
            } else if (index === 2 || index === 3 || index === 4) {
                if (adminPropertyOne) adminPropertyOne.style.display = "none";
                if (sidebarChevronUpDown) {
                    sidebarChevronUpDown.classList.remove("fa-chevron-down");
                    sidebarChevronUpDown.classList.add("fa-chevron-up");
                }
                if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-down");
                if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "flex";
                if (studentApplication) studentApplication.style.display = "none";
                if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                if (studentCounsellorList) studentCounsellorList.style.display = "none";
                if (studentNBFCList) studentNBFCList.style.display = "none";
                if (studentIndexAdmin) studentIndexAdmin.style.display = "none";
                if (studentEditIndex) studentEditIndex.style.display = "none";
                if (studentTicketRaised) studentTicketRaised.style.display = "none";
                if (adminManageStudent) adminManageStudent.style.display = "none";
                if (adminRoleManagement) adminRoleManagement.style.display = "none";
                if (adminPromotionalEmail) adminPromotionalEmail.style.display = "none";
                if (studentListContainer) studentListContainer.style.display = "none";
                if (nbfcAdminsideAddAuthority) nbfcAdminsideAddAuthority.style.display = "none";
                if (adminsideScDashboard) adminsideScDashboard.style.display = "none";
                if (studentProfileContainerAdminSide) studentProfileContainerAdminSide.style.display = "none";
                if (index === 2 || index === 3) {
                    if (studentListContainer) studentListContainer.style.display = "flex";
                }
                if (index === 4) {
                    if (studentApplication) studentApplication.style.display = "flex";
                }
            } else if (index === 5 || index === 6 || index === 7 || index === 8) {
                if (sidebarStudentCounsellorChevronUpDown) {
                    sidebarStudentCounsellorChevronUpDown.classList.remove("fa-chevron-down");
                    sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-up");
                }
                if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                if (adminPropertyOne) adminPropertyOne.style.display = "none";
                if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "flex";
                if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                if (studentListContainer) studentListContainer.style.display = "none";
                if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                if (studentCounsellorList) studentCounsellorList.style.display = "none";
                if (studentNBFCList) studentNBFCList.style.display = "none";
                if (editContainerAdmin) editContainerAdmin.style.display = "none";
                if (studentTicketRaised) studentTicketRaised.style.display = "none";
                if (adminManageStudent) adminManageStudent.style.display = "none";
                if (adminRoleManagement) adminRoleManagement.style.display = "none";
                if (adminPromotionalEmail) adminPromotionalEmail.style.display = "none";
                if (studentIndexAdmin) studentIndexAdmin.style.display = "none";
                if (studentApplication) studentApplication.style.display = "none";
                if (adminsideScDashboard) adminsideScDashboard.style.display = "none";
                if (studentProfileContainerAdminSide) studentProfileContainerAdminSide.style.display = "none";
                if (index === 5 || index === 6) {
                    if (studentCounsellorList) studentCounsellorList.style.display = "flex";
                    if (studentApplication) studentApplication.style.display = "none";
                }
                if (index === 7) {
                    if (studentTicketRaised) studentTicketRaised.style.display = "flex";
                    if (studentApplication) studentApplication.style.display = "none";
                }
                if (index === 8) {
                    if (adminCounsellorAdd) adminCounsellorAdd.style.display = "flex";
                    if (studentTicketRaised) studentTicketRaised.style.display = "none";
                    if (adminManageStudent) adminManageStudent.style.display = "none";
                    if (studentEditIndex) studentEditIndex.style.display = "none";
                    if (adminRoleManagement) adminRoleManagement.style.display = "none";
                    if (adminPromotionalEmail) adminPromotionalEmail.style.display = "none";
                    if (studentListContainer) studentListContainer.style.display = "none";
                    if (studentCounsellorList) studentCounsellorList.style.display = "none";
                    if (studentApplication) studentApplication.style.display = "none";
                    if (studentProfileContainerAdminSide) studentProfileContainerAdminSide.style.display = "none";
                }
            } else if (index === 9) {
                if (studentNBFCList) studentNBFCList.style.display = "flex";
                if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                if (studentCounsellorList) studentCounsellorList.style.display = "none";
                if (studentTicketRaised) studentTicketRaised.style.display = "none";
                if (adminManageStudent) adminManageStudent.style.display = "none";
                if (studentEditIndex) studentEditIndex.style.display = "none";
                if (adminRoleManagement) adminRoleManagement.style.display = "none";
                if (adminPromotionalEmail) adminPromotionalEmail.style.display = "none";
                if (studentListContainer) studentListContainer.style.display = "none";
                if (studentIndexAdmin) studentIndexAdmin.style.display = "none";
                if (studentApplication) studentApplication.style.display = "none";
                if (adminsideScDashboard) adminsideScDashboard.style.display = "none";
                if (studentProfileContainerAdminSide) studentProfileContainerAdminSide.style.display = "none";
            } else if (index === 10) {
                if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                if (studentListContainer) studentListContainer.style.display = "none";
                if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                if (studentCounsellorList) studentCounsellorList.style.display = "none";
                if (studentNBFCList) studentNBFCList.style.display = "none";
                if (editContainerAdmin) editContainerAdmin.style.display = "none";
                if (adminRoleManagement) adminRoleManagement.style.display = "none";
                if (studentIndexAdmin) studentIndexAdmin.style.display = "none";
                if (nbfcAdminsideAddAuthority) nbfcAdminsideAddAuthority.style.display = "none";
                if (adminManageStudent) adminManageStudent.style.display = "flex";
                if (adminPromotionalEmail) adminPromotionalEmail.style.display = "none";
                if (adminPropertyOne) adminPropertyOne.style.display = "none";
                if (studentApplication) studentApplication.style.display = "none";
                if (adminsideScDashboard) adminsideScDashboard.style.display = "none";
                if (studentProfileContainerAdminSide) studentProfileContainerAdminSide.style.display = "none";
            } else if (index === 11) {
                if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                if (studentListContainer) studentListContainer.style.display = "none";
                if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                if (studentCounsellorList) studentCounsellorList.style.display = "none";
                if (studentNBFCList) studentNBFCList.style.display = "none";
                if (editContainerAdmin) editContainerAdmin.style.display = "none";
                if (adminRoleManagement) adminRoleManagement.style.display = "flex";
                if (studentIndexAdmin) studentIndexAdmin.style.display = "none";
                if (nbfcAdminsideAddAuthority) nbfcAdminsideAddAuthority.style.display = "none";
                if (adminManageStudent) adminManageStudent.style.display = "none";
                if (adminPromotionalEmail) adminPromotionalEmail.style.display = "none";
                if (adminPropertyOne) adminPropertyOne.style.display = "none";
                if (studentApplication) studentApplication.style.display = "none";
                if (adminsideScDashboard) adminsideScDashboard.style.display = "none";
                if (studentProfileContainerAdminSide) studentProfileContainerAdminSide.style.display = "none";
            } else if (index === 12) {
                if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                if (studentListContainer) studentListContainer.style.display = "none";
                if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                if (studentCounsellorList) studentCounsellorList.style.display = "none";
                if (studentNBFCList) studentNBFCList.style.display = "none";
                if (editContainerAdmin) editContainerAdmin.style.display = "flex";
                if (adminRoleManagement) adminRoleManagement.style.display = "none";
                if (studentIndexAdmin) studentIndexAdmin.style.display = "none";
                if (nbfcAdminsideAddAuthority) nbfcAdminsideAddAuthority.style.display = "none";
                if (adminPromotionalEmail) adminPromotionalEmail.style.display = "none";
                if (adminManageStudent) adminManageStudent.style.display = "none";
                if (adminPropertyOne) adminPropertyOne.style.display = "none";
                if (studentApplication) studentApplication.style.display = "none";
                if (adminsideScDashboard) adminsideScDashboard.style.display = "none";
                if (studentProfileContainerAdminSide) studentProfileContainerAdminSide.style.display = "none";
            } else if (index === 13) {
                if (adminPropertyOne) adminPropertyOne.style.display = "none";
                if (studentIndexAdmin) studentIndexAdmin.style.display = "none";
                if (studentEditIndex) studentEditIndex.style.display = "none";
                if (studentTicketRaised) studentTicketRaised.style.display = "none";
                if (adminManageStudent) adminManageStudent.style.display = "none";
                if (adminRoleManagement) adminRoleManagement.style.display = "none";
                if (adminPromotionalEmail) adminPromotionalEmail.style.display = "flex";
                if (editContainerAdmin) editContainerAdmin.style.display = "none";
                if (studentApplication) studentApplication.style.display = "none";
                if (adminsideScDashboard) adminsideScDashboard.style.display = "none";
                if (studentListContainer) studentListContainer.style.display = "none";
                if (studentProfileContainerAdminSide) studentProfileContainerAdminSide.style.display = "none";
                if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initializeAdminSidebar();
});