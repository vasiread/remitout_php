// resources/js/adminsidebar.js

document.addEventListener('DOMContentLoaded', function () {
    initializeAdminSidebar();
});

const initializeAdminSidebar = () => {
    const adminSidebarItems = document.querySelectorAll("#commonsidebar-admin .commonsidebar-sidebarlists-top li");
    const triggeredSideBar = document.getElementById("commonsidebar-admin");  
    const img = document.querySelector('#commonsidebar-admin img'); 

    adminSidebarItems.forEach((item, index) => {
        item.addEventListener("click", () => {

            if (window.innerWidth <= 640) {
                triggeredSideBar.style.display = "none";
                if (img.src.includes("close_icon.png")) {
                    img.src = 'assets/images/Icons/menu.png';
                }
            }

             adminSidebarItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            if (index === 0) {
                 console.log("sdf")
                const adminPropertyOne = document.querySelector("#adminindexnumberone");
                if (adminPropertyOne) {
                    adminPropertyOne.style.display = "block";

                }
            } else if (index === 1) {
             }
        });
    });
};
