
document.addEventListener('DOMContentLoaded', function () {



    bankListedThroughNBFC();
    initializeProgressRing();
    saveChangesFunctionality();
    initialisedocumentsCount();
    initialiseProfileUpload();
    initialiseSeventhcolumn();
    initialiseSeventhAdditionalColumn();
    initialiseEightcolumn();
    initialiseNinthcolumn();
    initialiseTenthcolumn();
    loanStatusCount();
    passwordForgot();
    displayEducationDetails();



    // const sessionLogout = document.querySelector(".studentdashboardprofile-sidebarlists-bottom .logoutBtn");
    // if (sessionLogout) {
    //     sessionLogout.addEventListener('click', () => {
    //         console.log("Logout button clicked");
    //         sessionLogoutInitial();
    //     });
    // } else {
    //     console.warn("Logout button (.logoutBtn) not found in the DOM");
    // }

    // Fetch all URLs first
    Promise.all([
        initialiseProfileView(),
        initialiseAllViews(),
    ])
        .then(() => {

            initializeKycDocumentUpload();
            initializeMarksheetUpload();
            initializeSecuredAdmissionDocumentUpload();
            initializeWorkExperienceDocumentUpload();
            initializeCoBorrowerDocumentUpload();
            createAdminChatStudent();
        })
        .catch((error) => {
            console.error("Error during initialization:", error);
        });
    markAsRead();

    // logout function 
    // const sessionLogout = document.querySelector(".logoutBtn");
    // if (sessionLogout) {
    //     sessionLogout.addEventListener('click', () => {
    //         console.log("Logout button clicked");
    //         sessionLogoutInitial();
    //     });
    // } else {
    //     console.warn("Logout button (.logoutBtn) not found in the DOM");
    // }
    // Event delegation for dynamically loaded .logoutBtn
    document.addEventListener('click', (event) => {
        const logoutBtn = event.target.closest('.logoutBtn');
        if (logoutBtn) {
            // console.log('Dynamically detected logout button clicked');
            event.preventDefault();
            sessionLogoutInitial();
        }
    });


    const courseDetailsElement = document.getElementById('course-details-container');
    const courseDetails = JSON.parse(courseDetailsElement.getAttribute('data-course-details'));
    console.log(courseDetails)
    const firstItem = courseDetails[0];

    let selectedCountries = [];

    try {
        const raw = firstItem["plan-to-study"];

        if (Array.isArray(raw)) {
            selectedCountries = raw;
        } else if (typeof raw === 'string') {
            selectedCountries = raw.split(',').map(c => c.trim());
        } else {
            console.warn("Unexpected format for plan-to-study:", raw);
        }

        console.log("Selected countries:", selectedCountries);
    } catch (e) {
        console.error("Could not parse plan-to-study:", e);
    }


    // Set checkboxes
    document.querySelectorAll('input[name="study-location-edit"]').forEach(checkbox => {
        if (selectedCountries.includes(checkbox.value)) {
            checkbox.checked = true;
        }
    });

    const textInput = document.getElementById('plan-to-study-edit');
    if (textInput) {
        textInput.value = selectedCountries.join(', ');
    }


    if (selectedCountries.includes("Other")) {
        document.getElementById("other-checkbox-edit").checked = true;
        document.querySelector('.add-country-box-edit').style.display = 'block';
    } else {
        document.querySelector('.add-country-box-edit').style.display = 'none';
    }
    // const personalDetails = JSON.parse(courseDetailsElement.getAttribute('data-personal-details'));
    // const acceptTriggers = document.querySelectorAll(".user-accept-trigger");
    // const rejectTriggers = document.querySelectorAll(".bankmessage-buttoncontainer-reject");



    // document.querySelectorAll('input[name="study-location-edit"]').forEach(checkbox => {
    //     if (selectedCountries.includes(checkbox.value)) {
    //         checkbox.checked = true;
    //     }
    // });

    // const otherCheckbox = document.querySelector('#other-checkbox-edit');
    // const addCountryBox = document.querySelector('.add-country-box-edit');
    // const customCountryInput = document.querySelector('#country-edit');

    // if (selectedCountries.includes("Other")) {
    //     otherCheckbox.checked = true;
    //     addCountryBox.style.display = 'block';
    // } else {
    //     addCountryBox.style.display = 'none';
    // }

    // otherCheckbox.addEventListener('change', () => {
    //     if (otherCheckbox.checked) {
    //         addCountryBox.style.display = 'block';
    //     } else {
    //         addCountryBox.style.display = 'none';
    //         customCountryInput.value = '';
    //     }
    // });
    document.querySelector('.mailnbfcbutton').addEventListener('click', () => {
        sendDocumenttoEmail();
    });

    setInterval(() => {
        try {
            fetchUnreadCount();
        } catch (err) {
            console.error("fetchUnreadCount failed in setInterval:", err);
        }
    }, 3000);


});

async function displayEducationDetails() {
    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
    const userId = userIdElement ? userIdElement.textContent.trim() : "";

    try {
        const url = `/api/education?user_id=${encodeURIComponent(userId)}`;
        const response = await fetch(url, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' },
        });

        const data = await response.json();

        if (data.success) {
            const educationSection = document.querySelector('.studentdashboardprofile-educationeditsection');
            const secondRow = educationSection.querySelector('.educationeditsection-secondrow');
            const secondRowEdit = educationSection.querySelector('.educationeditsection-secondrow-edit');

            // View mode
            secondRow.innerHTML = `
                <p>Course: ${data.data.course_name || 'N/A'}</p>
                <p>University: ${data.data.university_school_name || 'N/A'}</p>
            `;

            // Edit mode inputs
            secondRowEdit.innerHTML = `
                <input type="text" class="course_name_input" value="${data.data.course_name || ''}" placeholder="Enter course name">
                <input type="text" class="university_name_input" value="${data.data.university_school_name || ''}" placeholder="Enter university/school name">
            `;
        } else {
            console.error('Failed to fetch education details:', data.error);
        }
    } catch (error) {
        console.error('Error fetching education details:', error);
    }
}



function handleIndividualCards(mode = 'index1') {
    const checkInterval = setInterval(() => {
        const individualCards = document.querySelectorAll('.indivudalloanstatus-cards');

        if (individualCards.length > 0) {

            clearInterval(checkInterval);

            individualCards.forEach((card) => {
                const triggeredMessageButton = card.querySelector('.individual-bankmessages .triggeredbutton');
                const groupButtonContainer = card.querySelector('.individual-bankmessages-buttoncontainer');
                const individualBankMessageInput = card.querySelector('.individual-bankmessage-input');

                if (mode === 'index1') {
                    // Inbox behavior (Index 1)
                    if (triggeredMessageButton && groupButtonContainer) {
                        triggeredMessageButton.style.display = "flex";
                        groupButtonContainer.style.display = "none";
                    }
                } else if (mode === 'index0') {
                    card.style.height = "fit-content";

                    if (individualBankMessageInput) {
                        individualBankMessageInput.style.display = "none";
                    }
                    if (triggeredMessageButton && groupButtonContainer) {
                        triggeredMessageButton.style.display = "none";
                        groupButtonContainer.style.display = "flex";
                    }
                }
            });
        } else {
            console.log(`Waiting for individual cards for ${mode}...`);
        }
    }, 50);
}




const initializeSideBarTabs = () => {
    const sideBarTopItems = document.querySelectorAll(
        ".studentdashboardprofile-sidebarlists-top li",
    );
    const lastTabHiddenDiv = document.querySelector(
        ".studentdashboardprofile-trackprogress",
    );
    const lastTabVisibleDiv = document.querySelector(
        ".studentdashboardprofile-myapplication",
    );
    const dynamicHeader = document.getElementById("loanproposals-header");
    const loanProposalsCount = document.getElementById("loanproposals-count");

    const communityJoinCard = document.querySelector(
        ".studentdashboardprofile-communityjoinsection",
    );
    const profileStatusCard = document.querySelector(
        ".personalinfo-profilestatus",
    );
    const profileImgEditIcon = document.querySelector(
        ".studentdashboardprofile-profilesection .fa-pen-to-square",
    );
    const educationEditSection = document.querySelector(
        ".studentdashboardprofile-educationeditsection",
    );
    const testScoresEditSection = document.querySelector(
        ".studentdashboardprofile-testscoreseditsection",
    );





    sideBarTopItems.forEach((item, index) => {
        item.addEventListener("click", () => {
            sideBarTopItems.forEach((i) => i.classList.remove("active"));
            item.classList.add("active");

            if (index === 1) {
                const personalDivContainer = document.querySelector(".personalinfo-secondrow");
                const personalDivContainerEdit = document.querySelector(".personalinfosecondrow-editsection");
                const academicsMarksDivEdit = document.querySelector(".testscoreseditsection-secondrow-editsection");
                const academicsMarksDiv = document.querySelector(".testscoreseditsection-secondrow");
                const adminMsgContainer = document.querySelector(".admin-msg-container");
                if (adminMsgContainer) {
                    adminMsgContainer.style.display = "block";
                }

                personalDivContainerEdit.style.display = "none";
                personalDivContainer.style.display = "flex";
                academicsMarksDivEdit.style.display = "none";
                academicsMarksDiv.style.display = "flex";


                lastTabHiddenDiv.style.display = "flex";
                lastTabVisibleDiv.style.display = "none";
                communityJoinCard.style.display = "flex";
                profileStatusCard.style.display = "block";
                profileImgEditIcon.style.display = "none";
                educationEditSection.style.display = "none";
                testScoresEditSection.style.display = "none";

                handleIndividualCards("index1");
                dynamicHeader.textContent = "Inbox";
                seenMessage();
            } else if (index === 0) {
                lastTabHiddenDiv.style.display = "flex";
                lastTabVisibleDiv.style.display = "none";
                communityJoinCard.style.display = "flex";
                profileStatusCard.style.display = "block";
                profileImgEditIcon.style.display = "none";
                educationEditSection.style.display = "none";
                testScoresEditSection.style.display = "none";
                const adminMsgContainer = document.querySelector(".admin-msg-container");
                if (adminMsgContainer) {
                    adminMsgContainer.style.display = "none";
                }

                const personalDivContainer = document.querySelector(".personalinfo-secondrow");
                const personalDivContainerEdit = document.querySelector(".personalinfosecondrow-editsection");
                const academicsMarksDivEdit = document.querySelector(".testscoreseditsection-secondrow-editsection");
                const academicsMarksDiv = document.querySelector(".testscoreseditsection-secondrow");



                personalDivContainerEdit.style.display = "none";
                personalDivContainer.style.display = "flex";
                academicsMarksDivEdit.style.display = "none";
                academicsMarksDiv.style.display = "flex";

                handleIndividualCards("index0");
                dynamicHeader.textContent = "Loan Proposals";


            } else if (index === 2) {


                const saveChangesButton = document.querySelector(".personalinfo-firstrow button");
                saveChangesButton.textContent = 'Edit';
                saveChangesButton.style.backgroundColor = "transparent";
                saveChangesButton.style.color = "#260254";

                lastTabHiddenDiv.style.display = "none";
                lastTabVisibleDiv.style.display = "flex";
                communityJoinCard.style.display = "none";
                profileStatusCard.style.display = "none";
                profileImgEditIcon.style.display = "block";
                educationEditSection.style.display = "flex";
                testScoresEditSection.style.display = "flex";
            }
        });
    });
}


function sendDocumenttoEmail(event) {
    // console.log(event);

    const uniqueIdElement = document.querySelector(".personal_info_id");
    const userId = uniqueIdElement
        ? uniqueIdElement.textContent || uniqueIdElement.innerHTML
        : null;



    const userNameElement = document.querySelector("#referenceNameId p");
    const name = userNameElement
        ? userNameElement.textContent || userNameElement.innerHTML
        : null;

    if (userId && name) {
        // console.log("Unique ID:", userId, "Email:", email, "Name:", name);
    } else {
        console.error("Error: Could not retrieve unique ID, email, or name.");
        return;
    }

    const sendDocumentsRequiredDetails = {
        userId: userId,
        name: name,
    };

    fetch("/send-documents", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify(sendDocumentsRequiredDetails),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(
                    "Network response was not ok " + response.statusText
                );
            }
            return response.json();
        })
        .then((data) => {
            console.log("Success:", data.message);
            alert(data.message);

            addUserToRequest(userId);
        })
        .catch((error) => {
            console.error("Error:", error);
        });

    // console.log("Sending Data:", sendDocumentsRequiredDetails);
}

function addUserToRequest(userId) {
    // console.log(userId);

    // Fetch request to send userId to the server
    fetch("/push-user-id-request", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ userId: userId.trim() }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                console.log("Success:", data);
            } else if (data.error) {
                console.log("Error:", data.error);
            }
        })
        .catch((e) => {
            console.error("Request failed:", e);
        });
}



// Global object to store document URLs

const endpoints = [
    { url: "/retrieve-file", selector: ".uploaded-aadhar-name", fileType: "aadhar-card-name" },
    { url: "/retrieve-file", selector: ".uploaded-pan-name", fileType: "pan-card-name" },
    { url: "/retrieve-file", selector: ".passport-name-selector", fileType: "passport-card-name" },
    { url: "/retrieve-file", selector: ".sslc-marksheet", fileType: "tenth-grade-name" },
    { url: "/retrieve-file", selector: ".hsc-marksheet", fileType: "twelfth-grade-name" },
    { url: "/retrieve-file", selector: ".graduation-marksheet", fileType: "graduation-grade-name" },
    { url: "/retrieve-file", selector: ".sslc-grade", fileType: "secured-tenth-name" },
    { url: "/retrieve-file", selector: ".hsc-grade", fileType: "secured-twelfth-name" },
    { url: "/retrieve-file", selector: ".graduation-grade", fileType: "secured-graduation-name" },
    { url: "/retrieve-file", selector: ".experience-letter", fileType: "work-experience-experience-letter" },
    { url: "/retrieve-file", selector: ".salary-slip", fileType: "work-experience-monthly-slip" },
    { url: "/retrieve-file", selector: ".office-id", fileType: "work-experience-office-id" },
    { url: "/retrieve-file", selector: ".joining-letter", fileType: "work-experience-joining-letter" },
    { url: "/retrieve-file", selector: ".coborrower-pancard", fileType: "co-pan-card-name" },
    { url: "/retrieve-file", selector: ".coborrower-aadharcard", fileType: "co-aadhar-card-name" },
    { url: "/retrieve-file", selector: ".coborrower-addressproof", fileType: "co-addressproof" },
];

const documentUrls = {}; // make sure this is declared in your script scope

const initialiseAllViews = () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");
    const userId = document.querySelector(".personalinfo-secondrow .personal_info_id")?.textContent.trim();

    if (!csrfToken || !userId) {
        console.error("CSRF token or User ID is missing");
        return Promise.reject("CSRF token or User ID is missing");
    }

    const fileTypes = endpoints.map(ep => ep.fileType);

    return fetch("/retrieve-file", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ userId, fileTypes }),
    })
        .then(res => res.json())
        .then(data => {
            const allFiles = data.staticFiles || data;
            let totalSizeBytes = 0;

            Object.entries(allFiles).forEach(([fileType, fileData]) => {
                if (fileData && fileData.url) {
                    const fileUrl = fileData.url;
                    const fileSizeBytes = fileData.size;
                    totalSizeBytes += fileSizeBytes;
                    const fileSizeMB = (fileSizeBytes / (1024 * 1024)).toFixed(2);
                    documentUrls[fileType] = fileUrl;

                    const fileName = fileUrl.split("/").pop();
                    const endpoint = endpoints.find(ep => ep.fileType === fileType);

                    if (endpoint) {
                        const nameElement = document.querySelector(endpoint.selector);
                        if (nameElement) {
                            // Update file name
                            nameElement.textContent = fileName;

                            // 👇 Update size nearby
                            const container = nameElement.closest(
                                ".individualkycdocuments, .individualmarksheetdocuments, .individual-secured-admission-documents, .individual-work-experiencecolumn-documents, .individual-coborrower-kyc-documents"
                            );
                            const statusSpan = container?.querySelector(".document-status");
                            if (statusSpan) {
                                statusSpan.textContent = `${fileSizeMB} MB uploaded`;
                            }
                        }
                    } else {
                        console.warn(`No endpoint match for fileType: ${fileType}`);
                    }

                    console.log(`File: ${fileType}, Size: ${fileSizeMB} MB`);
                }
            });

            // 👇 Optional: show total somewhere
            const totalMB = (totalSizeBytes / (1024 * 1024)).toFixed(2);
            const totalSizeElement = document.getElementById("total-uploaded-size");
            if (totalSizeElement) {
                totalSizeElement.textContent = `Total uploaded: ${totalMB} MB`;
            }
        })
        .catch(error => {
            console.error("Error fetching files:", error);
        });

        
};





const triggerEditButton = () => {
    const disabledInputs = document.querySelectorAll('.studentdashboardprofile-myapplication input');
    const defaultDisabledInput = document.getElementById("plan-to-study-edit");
    disabledInputs.forEach(inputItems => {
        inputItems.removeAttribute('disabled');
    });
    // defaultDisabledInput.setAttribute('disabled')

    const disabledRadios = document.querySelectorAll('.studentdashboardprofile-myapplication input[type="radio"][disabled]');
    disabledRadios.forEach(radio => {
        radio.removeAttribute('disabled');
    });

    const otherDegreeInput = document.getElementById("otherDegreeInput");
    if (otherDegreeInput && otherDegreeInput.disabled) {
        otherDegreeInput.removeAttribute("disabled");
    }
};



const initialiseProfileUpload = () => {
    const editIcon = document.querySelector(
        ".studentdashboardprofile-profilesection .fa-pen-to-square"
    );
    const profileImageInput = document.querySelector(
        ".studentdashboardprofile-profilesection .profile-upload"
    );

    if (editIcon && profileImageInput) {
        editIcon.addEventListener("click", function () {
            profileImageInput.click();
        });




        profileImageInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (!file) {
                console.error("No file selected");
                return;
            }
            const userIdElement = document.querySelector(
                ".personalinfo-secondrow .personal_info_id"
            );

            const userId = userIdElement ? userIdElement.textContent : "";

            const fileName = file.name;
            const fileType = file.type;
            // console.log(fileType + "." + fileName);

            const allowedTypes = ["image/jpeg", "image/png", "image/gif"];
            if (!allowedTypes.includes(fileType)) {
                console.error(
                    "Invalid file type. Only jpg, png, and gif are allowed."
                );
                return;
            }

            const formDetailsData = new FormData();
            formDetailsData.append("file", file);
            formDetailsData.append("userId", userId);

            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            if (!csrfToken) {
                console.error("CSRF token not found");
                return;
            }

            fetch("/upload-profile-picture", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                },
                body: formDetailsData,
            })
                .then((response) => {
                    if (!response.ok) {
                        return response.json().then((errorData) => {
                            throw new Error(
                                errorData.error || "Network response was not ok"
                            );
                        });
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data) {
                        // console.log("File uploaded successfully", data);
                        const imgElement =
                            document.querySelector("#profile-photo-id");
                        imgElement.src = data.file_path;
                        const navImageElement = document.querySelector(
                            "#nav-profile-photo-id"
                        );
                        navImageElement.src = data.file_path;
                        // console.log(data);
                    } else {
                        console.error(
                            "Error: No URL returned from the server",
                            data
                        );
                    }
                })
                .catch((error) => {
                    console.error("Error uploading file", error);
                });
        });
    }
};


const initialiseEightcolumn = () => {
    const section = document.querySelector(".eightcolumn-firstsection");

    section.addEventListener("click", function () {
        if (section.style.height === "") {
            section.style.height = "fit-content";
        } else {
            section.style.height = "";
        }
    });
};
const initialiseSeventhcolumn = () => {
    const section = document.querySelector(".seventhcolum-firstsection");

    section.addEventListener("click", function () {
        if (section.style.height === "") {
            section.style.height = "fit-content";
        } else {
            section.style.height = "";
        }
    });
};
const initialiseSeventhAdditionalColumn = () => {
    const section = document.querySelector(
        ".seventhcolumn-additional-firstcolumn"
    );

    section.addEventListener("click", function () {
        if (section.style.height === "") {
            section.style.height = "fit-content";
        } else {
            section.style.height = "";
        }
    });
};
const initialiseNinthcolumn = () => {

    const section = document.querySelector('.ninthcolumn-firstsection');
    section.addEventListener('click', function () {
        if (section.style.height === '') {
            section.style.height = 'fit-content';
        } else {
            section.style.height = "";
        }
    });

}





const initialiseTenthcolumn = () => {
    const section = document.querySelector(".tenthcolumn-firstsection");
    section.addEventListener("click", function () {
        if (section.style.height === "") {
            section.style.height = "fit-content";
        } else {
            section.style.height = "";
        }
    });

}

window.adminFileStorage = window.adminFileStorage || {};

function initializeSimpleChat() {

    // console.log("inizializesimplechat")
    const chatContainers = document.querySelectorAll('.individual-bankmessage-input');

    // console.log(chatContainers)
    if (chatContainers.length === 0) return;

    chatContainers.forEach((chatContainer, index) => {

        const chatId = `loan-chat-${index}`;
        chatContainer.setAttribute('data-chat-id', chatId);

        const parentContainer = chatContainer.closest('.indivudalloanstatus-cards');
        const messageButton = parentContainer ? parentContainer.querySelector('.triggeredbutton') : null;

        // console.log(messageButton)

        chatContainer.style.display = 'none';

        let messagesWrapper = parentContainer ? parentContainer.querySelector(`.messages-wrapper[data-chat-id="${chatId}"]`) : null;

        if (!messagesWrapper) {
            messagesWrapper = document.createElement("div");
            messagesWrapper.classList.add("messages-wrapper");
            messagesWrapper.setAttribute('data-chat-id', chatId);
            messagesWrapper.style.cssText = `
        display: none;
        flex-direction: column;
        width: 100%;  
        font-size: 14px;
        color: #666;
        line-height: 1.5; 
        overflow-y: auto;
        max-height: 300px;
        background: #fff;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 10px;
    `;
            chatContainer.parentNode.insertBefore(messagesWrapper, chatContainer);
        }

        const clearButtonContainer = document.createElement("div");
        clearButtonContainer.style.cssText = `
            display: none;
            justify-content: flex-end;
            width: 100%;
            margin-bottom: 10px;
        `;

        const clearButton = document.createElement("button");
        clearButton.textContent = "Clear Chat";
        clearButton.style.cssText = `
            background-color: #f0f0f0;
            border: none;
            border-radius: 4px;
            padding: 6px 20px;
            font-size: 12px;
            color: #666;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        `;
        clearButton.addEventListener('click', function () {
            clearChat(chatId);
        });

        clearButtonContainer.appendChild(clearButton);
        messagesWrapper.parentNode.insertBefore(clearButtonContainer, messagesWrapper);
        // Get elements within the container
        const messageInput = chatContainer.querySelector("input[type='text']");
        const sendButton = chatContainer.querySelector(".send-img");
        const smileIcon = chatContainer.querySelector(".fa-face-smile");
        const paperclipIcon = chatContainer.querySelector(".fa-paperclip");

        // Object to store file references
        const fileStorage = {};

        // Function to show chat
        function showChat() {
            messagesWrapper.style.display = 'flex';
            chatContainer.style.display = 'flex';
            clearButtonContainer.style.display = 'flex';

            if (parentContainer) {
                parentContainer.style.height = "auto";
            }

            // Update button text if needed
            if (messageButton) {
                messageButton.textContent = "Close";

            }
        }

        // Function to hide chat
        function hideChat() {
            messagesWrapper.style.display = 'none';
            chatContainer.style.display = 'none';
            clearButtonContainer.style.display = 'none';

            if (parentContainer) {
                parentContainer.style.height = "fit-content";
            }

            if (messageButton) {
                messageButton.textContent = "Message";
            }
        }

        function removeMessage(messageElement, messageId) {
            if (messageElement && messagesWrapper.contains(messageElement)) {
                messagesWrapper.removeChild(messageElement);

                const messages = JSON.parse(localStorage.getItem(`messages-${chatId}`) || '[]');
                const fileMessages = JSON.parse(localStorage.getItem(`file-messages-${chatId}`) || '[]');

                if (messageId && fileStorage[messageId]) {
                    delete fileStorage[messageId];

                    const updatedFileMessages = fileMessages.filter(fm => fm.id !== messageId);
                    localStorage.setItem(`file-messages-${chatId}`, JSON.stringify(updatedFileMessages));
                }
            }
        }

        function clearChat(chatId) {
            while (messagesWrapper.firstChild) {
                messagesWrapper.removeChild(messagesWrapper.firstChild);
            }

            // Clear from localStorage
            localStorage.removeItem(`messages-${chatId}`);
            localStorage.removeItem(`file-messages-${chatId}`);

            // Clear file storage
            Object.keys(fileStorage).forEach(key => {
                delete fileStorage[key];
            });

            // Show confirmation message
            const confirmationMsg = document.createElement("div");
            confirmationMsg.style.cssText = `
                width: 100%;
                text-align: center;
                padding: 10px;
                color: #666;
                font-style: italic;
                font-size: 12px;
            `;
            confirmationMsg.textContent = "Chat history cleared";
            messagesWrapper.appendChild(confirmationMsg);

            // Remove confirmation after 3 seconds
            setTimeout(() => {
                if (messagesWrapper.contains(confirmationMsg)) {
                    messagesWrapper.removeChild(confirmationMsg);
                }
            }, 3000);
        }

        // Toggle chat visibility
        function toggleChat(student_id, messageInputNbfcids, messagesWrapper) {

            if (messagesWrapper.style.display === 'none') {
                viewChat(student_id, messageInputNbfcids);
            } else {
                hideChat(student_id, messageInputNbfcids);
            }
        }


        if (messageButton) {
            messageButton.addEventListener('click', function (e) {
                // console.log("code here ")
                // console.log(messagesWrapper)

                e.preventDefault();
                const student_id = document.querySelector(".personalinfo-secondrow .personal_info_id").textContent;
                var messageInputNbfcids = document.querySelectorAll(".messageinputnbfcids");

                messageInputNbfcids = messageInputNbfcids[index].textContent;


                toggleChat(student_id, messageInputNbfcids, messagesWrapper);
            });
        }

        function sendMessage(messageInput, messageInputNbfcids) {
            if (!messageInput) return;
            // console.log(messageInput.value);


            const content = messageInput.value.trim();
            if (content) {
                showChat();

                // const messageElement = document.createElement("div");
                // messageElement.style.cssText = `
                //     display: flex;
                //     justify-content: flex-end;
                //     width: 100%;
                //     margin-bottom: 10px;
                // `;

                // const messageContent = document.createElement("div");
                // messageContent.style.cssText = `
                //     max-width: 80%;
                //     padding: 8px 12px;
                //     border-radius: 8px;
                //     word-wrap: break-word;
                //     font-family: 'Poppins', sans-serif;
                // `;
                // messageContent.textContent = content;

                // messageElement.appendChild(messageContent);
                // messagesWrapper.appendChild(messageElement);

                messageInput.value = "";
                // messagesWrapper.scrollTop = messagesWrapper.scrollHeight;

                sendMessageToBackend(content, messageInputNbfcids);

            }
        }
        async function sendMessageToBackend(content, messageInputNbfcids) {
            const nbfcId = messageInputNbfcids;
            const receiverId = nbfcId;
            const student_id = document.querySelector(".personalinfo-secondrow .personal_info_id").textContent;

            if (!student_id) {
                console.error('User not found or invalid student_id');
                return;
            }

            const senderId = student_id;
            try {
                const payload = {
                    nbfc_id: nbfcId,
                    student_id: student_id,
                    sender_id: senderId,
                    receiver_id: receiverId,
                    message: content,
                    is_read: false,

                };

                const response = await fetch('/send-message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ""
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (response.ok) {
                    // console.log('Message sent successfully:', data.message);

                    //         const messageElement = document.createElement("div");
                    //         messageElement.style.cssText = `
                    //     display: flex;
                    //     justify-content: flex-end;
                    //     width: 100%;
                    //     margin-bottom: 10px;
                    // `;
                    //         const messageContent = document.createElement("div");
                    //         messageContent.style.cssText = `
                    //     max-width: 80%;
                    //     padding: 8px 12px;
                    //     border-radius: 8px;
                    //     background-color: #DCF8C6;
                    //     word-wrap: break-word;
                    //     font-family: 'Poppins', sans-serif;
                    //     box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                    // `;
                    //         messageContent.textContent = content;

                    //         messagesWrapper.appendChild(messageElement);

                    scrollToBottom();

                    viewChat(student_id, nbfcId);
                } else {
                    console.error('Failed to send message:', data.error || 'Unknown error');
                }
            } catch (error) {
                console.error('Error sending message:', error);
            }
        }






        if (messageInput) {
            messageInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    var messageInputNbfcids = document.querySelectorAll(".messageinputnbfcids");
                    // console.log(messageInputNbfcids[index].textContent);

                    messageInputNbfcids = messageInputNbfcids[index].textContent;


                    e.preventDefault();

                    sendMessage(messageInput, messageInputNbfcids);


                }
            });
        }


        // Add click event to send button
        if (sendButton) {

            sendButton.addEventListener('click', function (e) {
                e.preventDefault();
                var messageInputNbfcids = document.querySelectorAll(".messageinputnbfcids");
                // console.log(messageInputNbfcids[index].textContent);

                messageInputNbfcids = messageInputNbfcids[index].textContent;
                sendMessage(messageInput, messageInputNbfcids);
            });
        }

        if (smileIcon) {
            smileIcon.addEventListener('click', function (e) {
                e.stopPropagation();
                const emojis = ["😊", "👍", "😀", "🙂", "👋", "👌", "✨"];

                const existingPicker = document.querySelector(".emoji-picker");
                if (existingPicker) {
                    existingPicker.remove();
                    return;
                }

                const picker = document.createElement("div");
                picker.classList.add("emoji-picker");
                picker.style.cssText = `
                    position: absolute;
                    bottom: 100%;
                    right: 0;
                    background: white;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    padding: 5px;
                    display: flex;
                    flex-wrap: wrap;
                    gap: 5px;
                    z-index: 1000;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                `;

                emojis.forEach(emoji => {
                    const button = document.createElement("button");
                    button.textContent = emoji;
                    button.style.cssText = `
                        border: none;
                        background: none;
                        font-size: 20px;
                        cursor: pointer;
                        padding: 5px;
                    `;
                    button.onclick = (e) => {
                        e.stopPropagation();
                        messageInput.value += emoji;
                        picker.remove();
                        messageInput.focus();
                    };
                    picker.appendChild(button);
                });

                chatContainer.appendChild(picker);

                document.addEventListener("click", function closePicker(e) {
                    if (!picker.contains(e.target) && e.target !== smileIcon) {
                        picker.remove();
                        document.removeEventListener("click", closePicker);
                    }
                });
            });
        }

        // Initialize file attachment
        if (paperclipIcon) {
            paperclipIcon.addEventListener("click", function () {
                const fileInput = document.createElement("input");
                fileInput.type = "file";
                fileInput.accept = ".pdf,.doc,.docx,.txt";
                fileInput.style.display = "none";

                fileInput.onchange = (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        const formData = new FormData();
                        formData.append('file', file);
                        formData.append('chatId', chatId);

                        fetch('/upload-documents-chat', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                            },
                            body: formData
                        })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success && data.fileUrl) {
                                    const fileUrl = data.fileUrl;

                                    var messageInputNbfcids = document.querySelectorAll(".messageinputnbfcids");

                                    messageInputNbfcids = messageInputNbfcids[index].textContent;


                                    const fileName = file.name;
                                    const fileSize = (file.size / 1024 / 1024).toFixed(2);
                                    const fileId = `file-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
                                    if (!adminFileStorage[chatId]) adminFileStorage[chatId] = {};
                                    adminFileStorage[chatId][fileId] = file;

                                    sendMessageToBackend(fileUrl, messageInputNbfcids);



                                } else {
                                    alert("File upload failed.");
                                }
                            })
                            .catch(err => {
                                console.error("Upload error:", err);
                                alert("Something went wrong while uploading the file.");
                            });
                    }
                };

                document.body.appendChild(fileInput);
                fileInput.click();
                document.body.removeChild(fileInput);
            });
        }






        const savedMessages = JSON.parse(localStorage.getItem(`messages-${chatId}`) || '[]');
        // console.log(savedMessages)
        // if (savedMessages.length > 0) {
        //     savedMessages.forEach(content => {
        //         const messageElement = document.createElement("div");
        //         messageElement.style.cssText = `
        //             display: flex;
        //             justify-content: flex-end;
        //             width: 100%;
        //             margin-bottom: 10px;
        //         `;

        //         const messageContent = document.createElement("div");
        //         messageContent.style.cssText = `
        //             max-width: 80%;
        //             padding: 8px 12px;
        //             border-radius: 8px;

        //             word-wrap: break-word;
        //             font-family: 'Poppins', sans-serif;
        //         `;
        //         messageContent.textContent = content;

        //         messageElement.appendChild(messageContent);
        //         messagesWrapper.appendChild(messageElement);
        //     });
        // }
        function viewChat(student_id, messageInputNbfcids) {
            student_id = student_id.trim();

            const nbfc_id = messageInputNbfcids;
            const chatId = `${nbfc_id}-${student_id}`;
            const apiUrl = `/get-messages/${nbfc_id}/${student_id}`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    console.log('API response:', data); // Log the full response to check its structure
                    if (data && data.messages && data.messages.length > 0) {
                        data.messages.forEach(message => {
                            const existingMessage = messagesWrapper.querySelector(`[data-message-id="${message.id}"]`);
                            if (!existingMessage) {
                                const messageElement = document.createElement("div");
                                messageElement.setAttribute('data-message-id', message.id); // Unique message ID for checking duplicates
                                messageElement.style.cssText = `
                                        display: flex;
                                        justify-content: ${message.sender_id === student_id ? 'flex-end' : 'flex-start'};
                                        width: 100%;
                                        margin-bottom: 10px;
                                    `;
                                const messageContent = document.createElement("div");
                                messageContent.style.cssText = `
                                        max-width: 80%;
                                        padding: 8px 12px;
                                        border-radius: 8px;
                                        background-color: ${message.sender_id === student_id ? '#DCF8C6' : '#FFF'};
                                        word-wrap: break-word;
                                        font-family: 'Poppins', sans-serif;
                                        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                                        color:rgb(102, 102, 102);
                                    `;
                                if (message.message.match(/\.(pdf|docx?|txt)$/i)) {
                                    // Show file download style
                                    const downloadLink = document.createElement('a');
                                    downloadLink.href = message.message;
                                    downloadLink.target = '_blank';
                                    downloadLink.style.cssText = `
                                        display: flex;
                                        align-items: center;
                                        gap: 5px;
                                        color: #666;
                                        text-decoration: none;
                                    `;
                                    const fileName = message.message.split('/').pop();
                                    downloadLink.innerHTML = `
                                        <i class="fa-solid fa-file"></i>
                                        <span>${fileName}</span>
                                    `;
                                    messageContent.appendChild(downloadLink);
                                } else {
                                    // Regular text message
                                    messageContent.textContent = message.message;
                                }

                                messageElement.appendChild(messageContent);
                                messagesWrapper.appendChild(messageElement);

                                scrollToBottom();
                            }
                        });
                    } else {
                        console.log('No messages found');
                    }
                })
                .catch(error => {
                    console.error('Error fetching messages:', error);
                });

            messagesWrapper.style.display = 'flex';
            chatContainer.style.display = 'flex';
            clearButtonContainer.style.display = 'flex';

            if (parentContainer) {
                parentContainer.style.height = "auto";
            }

            if (messageButton) {
                messageButton.textContent = "Close";
            }
        }


        function scrollToBottom() {
            messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
        }

    });

}

function saveMessage(content, chatId) {
    const messages = JSON.parse(localStorage.getItem(`messages-${chatId}`) || '[]');
    messages.push(content);
    localStorage.setItem(`messages-${chatId}`, JSON.stringify(messages));
}


// Add this function to properly save file messages
function saveFileMessage(fileData, chatId) {
    const fileMessages = JSON.parse(localStorage.getItem(`file-messages-${chatId}`) || '[]');
    fileMessages.push(fileData);
    localStorage.setItem(`file-messages-${chatId}`, JSON.stringify(fileMessages));
}

const initialiseProfileView = () => {
    const userIdElement = document.querySelector(
        ".personalinfo-secondrow .personal_info_id"
    );
    const userId = userIdElement ? userIdElement.textContent : "";

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    if (!csrfToken) {
        console.error("CSRF token not found");
        return;
    }

    fetch("/retrieve-profile-picture", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ userId: userId }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.fileUrl) {
                // console.log("Profile Picture URL:", data.fileUrl);
                const imgElement = document.querySelector("#profile-photo-id");
                imgElement.src = data.fileUrl;
            } else {
                console.error("Error: No URL returned from the server", data);
            }
        })
        .catch((error) => {
            console.error("Error retrieving profile picture", error);
        });
}
const checkUserStatusCount = () => {
    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
    const userId = userIdElement ? userIdElement.textContent.trim() : '';

    return fetch('/count-user-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ""
        },
        body: JSON.stringify({ userId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // console.log("Successfully retrieved count");
                const finalCounting = data.count;
                return finalCounting - 1; // <-- this will now resolve correctly
            } else {
                throw new Error("Failed to retrieve count");
            }
        });
};

const waitForCards = () => {
    return new Promise(resolve => {
        const observer = new MutationObserver(async (mutations, obs) => {
            const cards = document.querySelectorAll('.indivudalloanstatus-cards');

            const retrieveCount = await checkUserStatusCount();


            if (cards.length > retrieveCount) {

                obs.disconnect();
                resolve(cards);
            }
        });

        observer.observe(document.body, { childList: true, subtree: true });
    });
};

const initializeIndividualCards = () => {
    let checkInterval;
    let isInitialized = false;

    const cleanup = () => {
        if (checkInterval) {
            clearInterval(checkInterval);
        }
    };

    const handleCardClick = (card, messageInput, index) => {
        return () => {
            const computedStyle = window.getComputedStyle(messageInput);
            const isInputVisible = computedStyle.display === 'flex';

            console.log(`Card ${index} clicked, input currently ${isInputVisible ? 'visible' : 'hidden'}`);

            // Collapse all other inputs
            document.querySelectorAll('.individual-bankmessage-input').forEach(input => {
                if (input !== messageInput) {
                    input.style.display = 'none';
                    const parentCard = input.closest('.individual-card');
                    if (parentCard) {
                        parentCard.style.height = 'fit-content';
                    }
                }
            });

            // Toggle the clicked input
            messageInput.style.display = isInputVisible ? 'none' : 'flex';
            card.style.height = 'fit-content';



            // e.preventDefault();
            const student_id = document.querySelector(".personalinfo-secondrow .personal_info_id").textContent;
            var messageInputNbfcids = document.querySelectorAll(".messageinputnbfcids");

            messageInputNbfcids = messageInputNbfcids[index].textContent;






        };
    };

    const initCards = async () => {
        try {
            const individualCards = await waitForCards();

            if (individualCards.length > 0 && !isInitialized) {
                cleanup();
                isInitialized = true;
                console.log("Cards loaded. Binding click listeners...");
                console.log("----------------------------");

                individualCards.forEach((card, index) => {
                    // console.log(`Initializing card ${index}:`, card);

                    const triggeredMessageButton = card.querySelector('.individual-bankmessages .triggeredbutton');
                    const messageInput = card.querySelector('.individual-bankmessage-input');

                    if (triggeredMessageButton && messageInput) {
                        // Clone and replace button to avoid duplicate listeners
                        const newButton = triggeredMessageButton.cloneNode(true);
                        triggeredMessageButton.replaceWith(newButton);

                        newButton.addEventListener('click', handleCardClick(card, messageInput, index));
                    }
                });
                await initializeSimpleChat();

                return true;
            }
            return false;
        } catch (error) {
            console.error("Error initializing cards:", error);
            return false;
        }
    };

    // Initial check
    initCards().then(initialized => {
        if (!initialized) {
            checkInterval = setInterval(async () => {
                const initialized = await initCards();
                if (initialized) {
                    cleanup();
                }
            }, 500);
        }
    });

    // Return cleanup function for external management
    return cleanup;
};


const initializeKycDocumentUpload = () => {
    const individualKycDocumentsUpload = document.querySelectorAll(
        ".individualkycdocuments"
    );

    individualKycDocumentsUpload.forEach((card) => {
        const eyeIcon = card.querySelector(".fa-eye");

        if (!eyeIcon) {
            console.error("Eye icon not found in card:", card);
            return;
        }

        eyeIcon.addEventListener("click", function (event) {
            event.stopPropagation();

            const documentType = eyeIcon.id
                .replace("view-", "")
                .replace("-card", "");
            const fileTypeKey = `${documentType}-card-name`;
            const fileUrl = documentUrls[fileTypeKey];
            const fileNameElement = card.querySelector(
                `.uploaded-${documentType}-name`
            );
            const fileName = fileNameElement
                ? fileNameElement.textContent
                : "Document";

            if (eyeIcon.classList.contains("preview-active")) {
                document.querySelector(".pdf-preview-wrapper")?.remove();
                document.querySelector(".image-preview-wrapper")?.remove();
                document.querySelector(".pdf-preview-overlay")?.remove();
                document.querySelector(".image-preview-overlay")?.remove();
                eyeIcon.classList.remove("preview-active");
                eyeIcon.src = "/assets/images/visibility.png";
                return;
            }

            if (!fileUrl) {
                alert("No document found to preview.");
                return;
            }

            const isPDF = fileUrl.toLowerCase().endsWith(".pdf");
            const isImage = [".jpg", ".jpeg", ".png"].some(ext =>
                fileUrl.toLowerCase().endsWith(ext)
            );

            const overlay = document.createElement("div");
            overlay.className = isPDF ? "pdf-preview-overlay" : "image-preview-overlay";
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            `;

            const previewWrapper = document.createElement("div");
            previewWrapper.className = isPDF ? "pdf-preview-wrapper" : "image-preview-wrapper";
            previewWrapper.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: ${isPDF ? "60%" : "90%"};
                max-width: 800px;
                height: ${isPDF ? "80vh" : "auto"};
                max-height: 90vh;
                background-color: white;
                display: flex;
                flex-direction: column;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1000;
                border-radius: 8px;
                overflow: hidden;
            `;

            const header = document.createElement("div");
            header.style.cssText = `
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 16px;
                background-color: #1a1a1a;
                color: white;
                height: 40px;
                font-family: 'Poppins', sans-serif;
                position: relative;
            `;

            const fileNameSpan = document.createElement("span");
            fileNameSpan.textContent = fileName;
            fileNameSpan.style.cssText = `
                font-size: 14px;
                color: white;
            `;

            const closeButton = document.createElement("button");
            closeButton.innerHTML = "✕";
            closeButton.style.cssText = `
                background: none;
                border: none;
                color: white;
                font-size: 18px;
                cursor: pointer;
                font-family: 'Poppins', sans-serif;
            `;

            const closePreview = () => {
                previewWrapper.remove();
                overlay.remove();
                eyeIcon.classList.remove("preview-active");
                eyeIcon.src = "/assets/images/visibility.png";
            };

            closeButton.addEventListener("click", closePreview);
            overlay.addEventListener("click", closePreview);

            header.appendChild(fileNameSpan);
            header.appendChild(closeButton);

            // Zoom controls (PDF only)
            let currentZoom = 1;
            if (isPDF) {
                const zoomControls = document.createElement("div");
                zoomControls.style.cssText = `
                    display: flex;
                    gap: 12px;
                    align-items: center;
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                `;

                const zoomOut = document.createElement("button");
                const zoomIn = document.createElement("button");
                zoomOut.textContent = "−";
                zoomIn.textContent = "+";

                [zoomOut, zoomIn].forEach(btn => {
                    btn.style.cssText = `
                        background: none;
                        border: 1px solid #fff;
                        border-radius: 4px;
                        color: white;
                        font-size: 16px;
                        padding: 2px 8px;
                        cursor: pointer;
                        font-family: 'Poppins', sans-serif;
                    `;
                    zoomControls.appendChild(btn);
                });

                header.insertBefore(zoomControls, closeButton);
            }

            previewWrapper.appendChild(header);

            if (isPDF) {
                const iframeContainer = document.createElement("div");
                iframeContainer.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    overflow: auto;
                    background-color: white;
                    position: relative;
                `;

                const iframe = document.createElement("iframe");
                iframe.src = fileUrl;
                iframe.style.cssText = `
                    width: 100%;
                    height: 100%;
                    border: none;
                    transform-origin: top center;
                    transition: transform 0.2s ease;
                `;

                iframeContainer.appendChild(iframe);
                previewWrapper.appendChild(iframeContainer);

                header.querySelectorAll("button")[1]?.addEventListener("click", () => {
                    currentZoom += 0.1;
                    iframe.style.transform = `scale(${currentZoom})`;
                });

                header.querySelectorAll("button")[0]?.addEventListener("click", () => {
                    currentZoom = Math.max(currentZoom - 0.1, 0.5);
                    iframe.style.transform = `scale(${currentZoom})`;
                });

            } else if (isImage) {
                const imgContainer = document.createElement("div");
                imgContainer.style.cssText = `
                    padding: 20px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: #f0f0f0;
                `;

                const img = document.createElement("img");
                img.src = fileUrl;
                img.style.cssText = `
                    max-width: 100%;
                    max-height: 80vh;
                    object-fit: contain;
                `;
                imgContainer.appendChild(img);
                previewWrapper.appendChild(imgContainer);
            } else {
                alert("Unsupported file type. Only PDFs and images (JPG, PNG, JPEG) are supported.");
                return;
            }

            document.body.appendChild(overlay);
            document.body.appendChild(previewWrapper);
            document.addEventListener("keydown", e => {
                if (e.key === "Escape") closePreview();
            });

            eyeIcon.classList.add("preview-active");
            eyeIcon.src = "/assets/images/close.png";
        });
    });
};

const initializeMarksheetUpload = () => {
    const cards = document.querySelectorAll(".individualmarksheetdocuments");

    cards.forEach((card) => {
        const eyeIcon = card.querySelector(".fa-eye");

        if (!eyeIcon) {
            console.error("Eye icon not found in card:", card);
            return;
        }

        eyeIcon.addEventListener("click", function (event) {
            event.stopPropagation();

            if (eyeIcon.classList.contains("preview-active")) {
                document.querySelector(".pdf-preview-wrapper")?.remove();
                document.querySelector(".image-preview-wrapper")?.remove();
                document.querySelector(".pdf-preview-overlay")?.remove();
                document.querySelector(".image-preview-overlay")?.remove();
                eyeIcon.classList.remove("preview-active");
                eyeIcon.src = "/assets/images/visibility.png";
                return;
            }

            let fileTypeKey = null;
            if (card.querySelector(".sslc-marksheet")) {
                fileTypeKey = "tenth-grade-name";
            } else if (card.querySelector(".hsc-marksheet")) {
                fileTypeKey = "twelfth-grade-name";
            } else if (card.querySelector(".graduation-marksheet")) {
                fileTypeKey = "graduation-grade-name";
            }

            if (!fileTypeKey || !documentUrls[fileTypeKey]) {
                alert("No document found to preview.");
                return;
            }

            const fileUrl = documentUrls[fileTypeKey];
            const fileNameElement = card.querySelector(`.${fileTypeKey.replace("-name", "-marksheet")}`);
            const fileName = fileNameElement?.textContent || "Document";

            const isPDF = fileUrl.toLowerCase().endsWith(".pdf");
            const isImage = [".jpg", ".jpeg", ".png"].some(ext =>
                fileUrl.toLowerCase().endsWith(ext)
            );

            const overlay = document.createElement("div");
            overlay.className = isPDF ? "pdf-preview-overlay" : "image-preview-overlay";
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            `;

            const previewWrapper = document.createElement("div");
            previewWrapper.className = isPDF ? "pdf-preview-wrapper" : "image-preview-wrapper";
            previewWrapper.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: ${isPDF ? "60%" : "90%"};
                max-width: 800px;
                height: ${isPDF ? "80vh" : "auto"};
                max-height: 90vh;
                background-color: white;
                display: flex;
                flex-direction: column;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1000;
                border-radius: 8px;
                overflow: hidden;
            `;

            const header = document.createElement("div");
            header.style.cssText = `
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 16px;
                background-color: #1a1a1a;
                color: white;
                height: 40px;
                font-family: 'Poppins', sans-serif;
            `;

            const fileNameSpan = document.createElement("span");
            fileNameSpan.textContent = fileName;
            fileNameSpan.style.cssText = `
                font-size: 14px;
                color: white;
            `;

            const closeButton = document.createElement("button");
            closeButton.innerHTML = "✕";
            closeButton.style.cssText = `
                background: none;
                border: none;
                color: white;
                font-size: 18px;
                cursor: pointer;
                font-family: 'Poppins', sans-serif;
            `;

            const closePreview = () => {
                previewWrapper.remove();
                overlay.remove();
                eyeIcon.classList.remove("preview-active");
                eyeIcon.src = "/assets/images/visibility.png";
            };

            closeButton.addEventListener("click", closePreview);
            overlay.addEventListener("click", closePreview);

            header.appendChild(fileNameSpan);
            header.appendChild(closeButton);

            // Zoom controls (for PDF)
            if (isPDF) {
                const zoomControls = document.createElement("div");
                zoomControls.style.cssText = `
                    display: flex;
                    gap: 12px;
                    align-items: center;
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                `;

                const zoomOut = document.createElement("button");
                const zoomIn = document.createElement("button");
                zoomOut.textContent = "−";
                zoomIn.textContent = "+";

                [zoomOut, zoomIn].forEach(btn => {
                    btn.style.cssText = `
                        background: none;
                        border: 1px solid #fff;
                        border-radius: 4px;
                        color: white;
                        font-size: 16px;
                        padding: 2px 8px;
                        cursor: pointer;
                        font-family: 'Poppins', sans-serif;
                    `;
                    zoomControls.appendChild(btn);
                });

                header.insertBefore(zoomControls, closeButton);
            }

            previewWrapper.appendChild(header);

            if (isPDF) {
                const iframe = document.createElement("iframe");
                iframe.src = fileUrl;
                iframe.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    border: none;
                    background-color: white;
                    transform: scale(1);
                    transform-origin: top center;
                    transition: transform 0.2s ease-in-out;
                `;

                previewWrapper.appendChild(iframe);

                let currentZoom = 1;

                header.querySelectorAll("button")[1]?.addEventListener("click", () => {
                    currentZoom += 0.1;
                    iframe.style.transform = `scale(${currentZoom})`;
                });

                header.querySelectorAll("button")[0]?.addEventListener("click", () => {
                    currentZoom = Math.max(currentZoom - 0.1, 0.5);
                    iframe.style.transform = `scale(${currentZoom})`;
                });

            } else if (isImage) {
                const imgContainer = document.createElement("div");
                imgContainer.style.cssText = `
                    padding: 20px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: #f0f0f0;
                `;

                const img = document.createElement("img");
                img.src = fileUrl;
                img.style.cssText = `
                    max-width: 100%;
                    max-height: 80vh;
                    object-fit: contain;
                `;
                imgContainer.appendChild(img);
                previewWrapper.appendChild(imgContainer);
            } else {
                alert("Unsupported file type. Only PDFs and images (JPG, PNG, JPEG) are supported.");
                return;
            }

            document.body.appendChild(overlay);
            document.body.appendChild(previewWrapper);

            document.addEventListener("keydown", e => {
                if (e.key === "Escape") closePreview();
            });

            eyeIcon.classList.add("preview-active");
            eyeIcon.src = "/assets/images/close.png";
        });
    });
};





const initializeSecuredAdmissionDocumentUpload = () => {
    const securedAdmissionDocuments = document.querySelectorAll(
        ".individual-secured-admission-documents"
    );

    securedAdmissionDocuments.forEach((card) => {
        const eyeIcon = card.querySelector(".fa-eye");

        if (!eyeIcon) {
            console.error("Eye icon not found in card:", card);
            return;
        }

        eyeIcon.addEventListener("click", function (event) {
            event.stopPropagation();

            // Determine document type based on which element exists
            let fileTypeKey;
            if (card.querySelector(".sslc-grade")) {
                fileTypeKey = "secured-tenth-name";
            } else if (card.querySelector(".hsc-grade")) {
                fileTypeKey = "secured-twelfth-name";
            } else if (card.querySelector(".graduation-grade")) {
                fileTypeKey = "secured-graduation-name";
            }

            // Get the URL from documentUrls
            const fileUrl = documentUrls[fileTypeKey];
            const fileNameElement = card.querySelector(
                `.${fileTypeKey.replace("-name", "-grade")}`
            );
            const fileName = fileNameElement
                ? fileNameElement.textContent
                : "Document.pdf";

            console.log(
                `Previewing secured admission (${fileTypeKey}):`,
                fileUrl
            );

            if (eyeIcon.classList.contains("preview-active")) {
                const previewWrapper = document.querySelector(
                    ".pdf-preview-wrapper, .image-preview-wrapper"
                );
                const overlay = document.querySelector(
                    ".pdf-preview-overlay, .image-preview-overlay"
                );
                if (previewWrapper) previewWrapper.remove();
                if (overlay) overlay.remove();
                eyeIcon.classList.remove("preview-active");
                eyeIcon.src = "/assets/images/visibility.png";
                return;
            }

            if (!fileUrl) {
                alert("No document found to preview.");
                return;
            }

            // Check if it's a PDF or image based on file extension
            const isPDF = fileUrl.toLowerCase().endsWith(".pdf");
            const isImage = [".jpg", ".jpeg", ".png"].some((ext) =>
                fileUrl.toLowerCase().endsWith(ext)
            );

            if (isPDF) {
                // PDF Preview
                const previewWrapper = document.createElement("div");
                previewWrapper.className = "pdf-preview-wrapper";
                previewWrapper.style.cssText = `
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 60%;
                    height: 80vh;
                    background-color: white;
                    display: flex;
                    flex-direction: column;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    z-index: 1000;
                    border-radius: 8px;
                `;

                const overlay = document.createElement("div");
                overlay.className = "pdf-preview-overlay";
                overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                `;

                const header = document.createElement("div");
                header.style.cssText = `
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 8px 16px;
                    background-color: #1a1a1a;
                    color: white;
                    height: 40px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                `;

                const fileNameSection = document.createElement("div");
                fileNameSection.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 8px;
                `;

                const fileNameSpan = document.createElement("span");
                fileNameSpan.textContent = fileName;
                fileNameSpan.style.cssText = `
                    color: white;
                    font-size: 14px;
                    font-family: 'Poppins', sans-serif;
                `;
                fileNameSection.appendChild(fileNameSpan);

                const zoomControls = document.createElement("div");
                zoomControls.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                `;

                const zoomOut = document.createElement("button");
                zoomOut.innerHTML = "−";
                const zoomIn = document.createElement("button");
                zoomIn.innerHTML = "+";

                [zoomOut, zoomIn].forEach((btn) => {
                    btn.style.cssText = `
                        background: none;
                        border: 1px solid #fff;
                        border-radius: 4px;
                        color: white;
                        font-size: 16px;
                        cursor: pointer;
                        padding: 2px 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-family: 'Poppins', sans-serif;
                    `;
                });

                zoomControls.appendChild(zoomOut);
                zoomControls.appendChild(zoomIn);

                const closeButton = document.createElement("button");
                closeButton.innerHTML = "✕";
                closeButton.style.cssText = `
                    background: none;
                    border: none;
                    color: white;
                    font-size: 18px;
                    cursor: pointer;
                    padding: 4px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-family: 'Poppins', sans-serif;
                `;

                const closePreview = () => {
                    previewWrapper.remove();
                    overlay.remove();
                    eyeIcon.classList.remove("preview-active");
                    eyeIcon.src = "/assets/images/visibility.png";
                };

                closeButton.addEventListener("click", closePreview);
                overlay.addEventListener("click", closePreview);

                header.appendChild(fileNameSection);
                header.appendChild(zoomControls);
                header.appendChild(closeButton);

                const iframe = document.createElement("iframe");
                iframe.src = fileUrl;
                iframe.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    border: none;
                    background-color: white;
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                `;

                previewWrapper.appendChild(header);
                previewWrapper.appendChild(iframe);

                document.body.appendChild(overlay);
                document.body.appendChild(previewWrapper);

                let currentZoom = 1;
                zoomIn.addEventListener("click", () => {
                    currentZoom += 0.1;
                    iframe.style.transform = `scale(${currentZoom})`;
                    iframe.style.transformOrigin = "top center";
                });

                zoomOut.addEventListener("click", () => {
                    currentZoom = Math.max(currentZoom - 0.1, 0.5);
                    iframe.style.transform = `scale(${currentZoom})`;
                    iframe.style.transformOrigin = "top center";
                });

                document.addEventListener("keydown", function (e) {
                    if (e.key === "Escape") {
                        closePreview();
                    }
                });

                eyeIcon.classList.add("preview-active");
                eyeIcon.src = "/assets/images/close.png";
            } else if (isImage) {
                // Image Preview
                const previewWrapper = document.createElement("div");
                previewWrapper.className = "image-preview-wrapper";
                previewWrapper.style.cssText = `
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 90%;
                    max-width: 800px;
                    max-height: 90vh;
                    background-color: white;
                    display: flex;
                    flex-direction: column;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    z-index: 1000;
                    border-radius: 8px;
                `;

                const overlay = document.createElement("div");
                overlay.className = "image-preview-overlay";
                overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                `;

                const header = document.createElement("div");
                header.style.cssText = `
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 8px 16px;
                    background-color: #1a1a1a;
                    color: white;
                    height: 40px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                `;

                const fileNameSection = document.createElement("div");
                fileNameSection.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 8px;
                `;

                const fileNameSpan = document.createElement("span");
                fileNameSpan.textContent = fileName;
                fileNameSpan.style.cssText = `
                    color: white;
                    font-size: 14px;
                    font-family: 'Poppins', sans-serif;
                `;
                fileNameSection.appendChild(fileNameSpan);

                const closeButton = document.createElement("button");
                closeButton.innerHTML = "✕";
                closeButton.style.cssText = `
                    background: none;
                    border: none;
                    color: white;
                    font-size: 18px;
                    cursor: pointer;
                    padding: 4px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-family: 'Poppins', sans-serif;
                `;

                const closePreview = () => {
                    previewWrapper.remove();
                    overlay.remove();
                    eyeIcon.classList.remove("preview-active");
                    eyeIcon.src = "/assets/images/visibility.png";
                };

                closeButton.addEventListener("click", closePreview);
                overlay.addEventListener("click", closePreview);

                header.appendChild(fileNameSection);
                header.appendChild(closeButton);

                const imageContainer = document.createElement("div");
                imageContainer.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: auto;
                    padding: 20px;
                    background-color: #f0f0f0;
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                `;

                const img = document.createElement("img");
                img.src = fileUrl;
                img.style.cssText = `
                    max-width: 100%;
                    max-height: 80vh;
                    object-fit: contain;
                `;

                imageContainer.appendChild(img);
                previewWrapper.appendChild(header);
                previewWrapper.appendChild(imageContainer);

                document.body.appendChild(overlay);
                document.body.appendChild(previewWrapper);

                document.addEventListener("keydown", function (e) {
                    if (e.key === "Escape") {
                        closePreview();
                    }
                });

                eyeIcon.classList.add("preview-active");
                eyeIcon.src = "/assets/images/close.png";
            } else {
                alert(
                    "Unsupported file type. Only PDF and images (JPG, PNG, JPEG) are supported."
                );
            }
        });
    });
};

function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;

    const extension = fileName.slice(fileName.lastIndexOf("."));
    const name = fileName.slice(0, fileName.lastIndexOf("."));

    return name.slice(0, 16) + "..." + extension;
}




const initializeWorkExperienceDocumentUpload = () => {
    const workExperienceDocuments = document.querySelectorAll(
        ".individual-work-experiencecolumn-documents"
    );

    workExperienceDocuments.forEach((card) => {
        const eyeIcon = card.querySelector(".fa-eye");

        if (!eyeIcon) {
            console.error("Eye icon not found in card:", card);
            return;
        }

        eyeIcon.addEventListener("click", function (event) {
            event.stopPropagation();

            // Determine document type based on which element exists
            let fileTypeKey;
            if (card.querySelector(".experience-letter")) {
                fileTypeKey = "work-experience-experience-letter";
            } else if (card.querySelector(".salary-slip")) {
                fileTypeKey = "work-experience-monthly-slip";
            } else if (card.querySelector(".office-id")) {
                fileTypeKey = "work-experience-office-id";
            } else if (card.querySelector(".joining-letter")) {
                fileTypeKey = "work-experience-joining-letter";
            }

            // Get the URL from documentUrls
            const fileUrl = documentUrls[fileTypeKey];
            const fileNameElement = card.querySelector(
                `.${fileTypeKey.split("-").slice(2).join("-")}`
            );
            const fileName = fileNameElement
                ? fileNameElement.textContent
                : "Document.pdf";

            console.log(
                `Previewing work experience (${fileTypeKey}):`,
                fileUrl
            );

            if (eyeIcon.classList.contains("preview-active")) {
                const previewWrapper = document.querySelector(
                    ".pdf-preview-wrapper, .image-preview-wrapper"
                );
                const overlay = document.querySelector(
                    ".pdf-preview-overlay, .image-preview-overlay"
                );
                if (previewWrapper) previewWrapper.remove();
                if (overlay) overlay.remove();
                eyeIcon.classList.remove("preview-active");
                eyeIcon.src = "/assets/images/visibility.png";
                return;
            }

            if (!fileUrl) {
                alert("No document found to preview.");
                return;
            }

            // Check if it's a PDF or image based on file extension
            const isPDF = fileUrl.toLowerCase().endsWith(".pdf");
            const isImage = [".jpg", ".jpeg", ".png"].some((ext) =>
                fileUrl.toLowerCase().endsWith(ext)
            );

            if (isPDF) {
                // PDF Preview
                const previewWrapper = document.createElement("div");
                previewWrapper.className = "pdf-preview-wrapper";
                previewWrapper.style.cssText = `
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 60%;
                    height: 80vh;
                    background-color: white;
                    display: flex;
                    flex-direction: column;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    z-index: 1000;
                    border-radius: 8px;
                `;

                const overlay = document.createElement("div");
                overlay.className = "pdf-preview-overlay";
                overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                `;

                const header = document.createElement("div");
                header.style.cssText = `
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 8px 16px;
                    background-color: #1a1a1a;
                    color: white;
                    height: 40px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                `;

                const fileNameSection = document.createElement("div");
                fileNameSection.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 8px;
                `;

                const fileNameSpan = document.createElement("span");
                fileNameSpan.textContent = fileName;
                fileNameSpan.style.cssText = `
                    color: white;
                    font-size: 14px;
                    font-family: 'Poppins', sans-serif;
                `;
                fileNameSection.appendChild(fileNameSpan);

                const zoomControls = document.createElement("div");
                zoomControls.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                `;

                const zoomOut = document.createElement("button");
                zoomOut.innerHTML = "−";
                const zoomIn = document.createElement("button");
                zoomIn.innerHTML = "+";

                [zoomOut, zoomIn].forEach((btn) => {
                    btn.style.cssText = `
                        background: none;
                        border: 1px solid #fff;
                        border-radius: 4px;
                        color: white;
                        font-size: 16px;
                        cursor: pointer;
                        padding: 2px 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-family: 'Poppins', sans-serif;
                    `;
                });

                zoomControls.appendChild(zoomOut);
                zoomControls.appendChild(zoomIn);

                const closeButton = document.createElement("button");
                closeButton.innerHTML = "✕";
                closeButton.style.cssText = `
                    background: none;
                    border: none;
                    color: white;
                    font-size: 18px;
                    cursor: pointer;
                    padding: 4px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-family: 'Poppins', sans-serif;
                `;

                const closePreview = () => {
                    previewWrapper.remove();
                    overlay.remove();
                    eyeIcon.classList.remove("preview-active");
                    eyeIcon.src = "/assets/images/visibility.png";
                };

                closeButton.addEventListener("click", closePreview);
                overlay.addEventListener("click", closePreview);

                header.appendChild(fileNameSection);
                header.appendChild(zoomControls);
                header.appendChild(closeButton);

                const iframe = document.createElement("iframe");
                iframe.src = fileUrl;
                iframe.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    border: none;
                    background-color: white;
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                `;

                previewWrapper.appendChild(header);
                previewWrapper.appendChild(iframe);

                document.body.appendChild(overlay);
                document.body.appendChild(previewWrapper);

                let currentZoom = 1;
                zoomIn.addEventListener("click", () => {
                    currentZoom += 0.1;
                    iframe.style.transform = `scale(${currentZoom})`;
                    iframe.style.transformOrigin = "top center";
                });

                zoomOut.addEventListener("click", () => {
                    currentZoom = Math.max(currentZoom - 0.1, 0.5);
                    iframe.style.transform = `scale(${currentZoom})`;
                    iframe.style.transformOrigin = "top center";
                });

                document.addEventListener("keydown", function (e) {
                    if (e.key === "Escape") {
                        closePreview();
                    }
                });

                eyeIcon.classList.add("preview-active");
                eyeIcon.src = "/assets/images/close.png";
            } else if (isImage) {
                // Image Preview
                const previewWrapper = document.createElement("div");
                previewWrapper.className = "image-preview-wrapper";
                previewWrapper.style.cssText = `
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 90%;
                    max-width: 800px;
                    max-height: 90vh;
                    background-color: white;
                    display: flex;
                    flex-direction: column;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    z-index: 1000;
                    border-radius: 8px;
                `;

                const overlay = document.createElement("div");
                overlay.className = "image-preview-overlay";
                overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                `;

                const header = document.createElement("div");
                header.style.cssText = `
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 8px 16px;
                    background-color: #1a1a1a;
                    color: white;
                    height: 40px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                `;

                const fileNameSection = document.createElement("div");
                fileNameSection.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 8px;
                `;

                const fileNameSpan = document.createElement("span");
                fileNameSpan.textContent = fileName;
                fileNameSpan.style.cssText = `
                    color: white;
                    font-size: 14px;
                    font-family: 'Poppins', sans-serif;
                `;
                fileNameSection.appendChild(fileNameSpan);

                const closeButton = document.createElement("button");
                closeButton.innerHTML = "✕";
                closeButton.style.cssText = `
                    background: none;
                    border: none;
                    color: white;
                    font-size: 18px;
                    cursor: pointer;
                    padding: 4px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-family: 'Poppins', sans-serif;
                `;

                const closePreview = () => {
                    previewWrapper.remove();
                    overlay.remove();
                    eyeIcon.classList.remove("preview-active");
                    eyeIcon.src = "/assets/images/visibility.png";
                };

                closeButton.addEventListener("click", closePreview);
                overlay.addEventListener("click", closePreview);

                header.appendChild(fileNameSection);
                header.appendChild(closeButton);

                const imageContainer = document.createElement("div");
                imageContainer.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: auto;
                    padding: 20px;
                    background-color: #f0f0f0;
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                `;

                const img = document.createElement("img");
                img.src = fileUrl;
                img.style.cssText = `
                    max-width: 100%;
                    max-height: 80vh;
                    object-fit: contain;
                `;

                imageContainer.appendChild(img);
                previewWrapper.appendChild(header);
                previewWrapper.appendChild(imageContainer);

                document.body.appendChild(overlay);
                document.body.appendChild(previewWrapper);

                document.addEventListener("keydown", function (e) {
                    if (e.key === "Escape") {
                        closePreview();
                    }
                });

                eyeIcon.classList.add("preview-active");
                eyeIcon.src = "/assets/images/close.png";
            } else {
                alert(
                    "Unsupported file type. Only PDF and images (JPG, PNG, JPEG) are supported."
                );
            }
        });
    });
};

const initializeCoBorrowerDocumentUpload = () => {
    const coBorrowerDocuments = document.querySelectorAll(".individual-coborrower-kyc-documents");

    coBorrowerDocuments.forEach((card) => {
        const eyeIcon = card.querySelector(".fa-eye");
        if (!eyeIcon) {
            console.error("Eye icon not found in card:", card);
            return;
        }

        eyeIcon.addEventListener("click", function (event) {
            event.stopPropagation();

            let fileTypeKey = null;
            if (card.querySelector(".coborrower-pancard")) {
                fileTypeKey = "co-pan-card-name";
            } else if (card.querySelector(".coborrower-aadharcard")) {
                fileTypeKey = "co-aadhar-card-name";
            } else if (card.querySelector(".coborrower-addressproof")) {
                fileTypeKey = "co-addressproof";
            }

            const fileUrl = documentUrls[fileTypeKey];
            const fileNameElement = card.querySelector(`.${fileTypeKey?.replace("-name", "-grade")}`);
            const rawFileName = fileNameElement ? fileNameElement.textContent.trim() : "Document";
            const fileName = typeof truncateFileName === "function" ? truncateFileName(rawFileName) : rawFileName;

            const closePreview = () => {
                document.querySelector(".pdf-preview-wrapper")?.remove();
                document.querySelector(".image-preview-wrapper")?.remove();
                document.querySelector(".pdf-preview-overlay")?.remove();
                document.querySelector(".image-preview-overlay")?.remove();
                eyeIcon.classList.remove("preview-active");
                eyeIcon.src = "/assets/images/visibility.png";
                document.removeEventListener("keydown", keydownHandler);
            };

            const keydownHandler = (e) => {
                if (e.key === "Escape") closePreview();
            };

            if (eyeIcon.classList.contains("preview-active")) {
                closePreview();
                return;
            }

            if (!fileUrl) {
                alert("No document found to preview.");
                return;
            }

            const isPDF = fileUrl.toLowerCase().endsWith(".pdf");
            const isImage = [".jpg", ".jpeg", ".png"].some(ext => fileUrl.toLowerCase().endsWith(ext));

            const overlay = document.createElement("div");
            overlay.className = isPDF ? "pdf-preview-overlay" : "image-preview-overlay";
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            `;

            const previewWrapper = document.createElement("div");
            previewWrapper.className = isPDF ? "pdf-preview-wrapper" : "image-preview-wrapper";
            previewWrapper.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: ${isPDF ? "60%" : "90%"};
                max-width: 800px;
                height: ${isPDF ? "80vh" : "auto"};
                max-height: 90vh;
                background-color: white;
                display: flex;
                flex-direction: column;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1000;
                border-radius: 8px;
                overflow: hidden;
            `;

            const header = document.createElement("div");
            header.style.cssText = `
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 16px;
                background-color: #1a1a1a;
                color: white;
                height: 40px;
                font-family: 'Poppins', sans-serif;
            `;

            const fileNameSpan = document.createElement("span");
            fileNameSpan.textContent = fileName;
            fileNameSpan.style.cssText = `
                font-size: 14px;
                color: white;
            `;

            const closeButton = document.createElement("button");
            closeButton.innerHTML = "✕";
            closeButton.style.cssText = `
                background: none;
                border: none;
                color: white;
                font-size: 18px;
                cursor: pointer;
                font-family: 'Poppins', sans-serif;
            `;

            closeButton.addEventListener("click", closePreview);
            overlay.addEventListener("click", closePreview);
            header.appendChild(fileNameSpan);

            if (isPDF) {
                const zoomControls = document.createElement("div");
                zoomControls.style.cssText = `
                    display: flex;
                    gap: 12px;
                    align-items: center;
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                `;

                const zoomOut = document.createElement("button");
                const zoomIn = document.createElement("button");
                zoomOut.textContent = "−";
                zoomIn.textContent = "+";

                [zoomOut, zoomIn].forEach(btn => {
                    btn.style.cssText = `
                        background: none;
                        border: 1px solid #fff;
                        border-radius: 4px;
                        color: white;
                        font-size: 16px;
                        padding: 2px 8px;
                        cursor: pointer;
                        font-family: 'Poppins', sans-serif;
                    `;
                    zoomControls.appendChild(btn);
                });

                header.insertBefore(zoomControls, closeButton);
            }

            header.appendChild(closeButton);
            previewWrapper.appendChild(header);

            if (isPDF) {
                const iframe = document.createElement("iframe");
                iframe.src = fileUrl;
                iframe.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    border: none;
                    background-color: white;
                `;

                previewWrapper.appendChild(iframe);

                let currentZoom = 1;
                header.querySelectorAll("button")[1]?.addEventListener("click", () => {
                    currentZoom += 0.1;
                    iframe.style.transform = `scale(${currentZoom})`;
                    iframe.style.transformOrigin = "top center";
                });

                header.querySelectorAll("button")[0]?.addEventListener("click", () => {
                    currentZoom = Math.max(currentZoom - 0.1, 0.5);
                    iframe.style.transform = `scale(${currentZoom})`;
                    iframe.style.transformOrigin = "top center";
                });

            } else if (isImage) {
                const imgContainer = document.createElement("div");
                imgContainer.style.cssText = `
                    padding: 20px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: #f0f0f0;
                `;

                const img = document.createElement("img");
                img.src = fileUrl;
                img.style.cssText = `
                    max-width: 100%;
                    max-height: 80vh;
                    object-fit: contain;
                `;

                imgContainer.appendChild(img);
                previewWrapper.appendChild(imgContainer);
            } else {
                alert("Unsupported file type. Only PDFs and images (JPG, PNG, JPEG) are supported.");
                return;
            }

            document.body.appendChild(overlay);
            document.body.appendChild(previewWrapper);
            document.addEventListener("keydown", keydownHandler);

            eyeIcon.classList.add("preview-active");
            eyeIcon.src = "/assets/images/close.png";
        });
    });
};


const bankListedThroughNBFC = async () => {

    // console.log("_______")

    const nbfcContainer = document.querySelector(".loanproposals-loanstatuscards");

    if (nbfcContainer) {
        // consle.log("______")

        const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
        const userId = userIdElement ? userIdElement.textContent : '';

        fetch("/getnbfcdata-proposals", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ userId })
        })
            .then(response => response.json())
            .then(async data => {
                if (data.success) {
                    console.log(data)
                    const finalData = data.result;


                    // if (!finalData) {
                    //     const noDataMessage = document.createElement("p");
                    //     noDataMessage.textContent = "No Proposals Yet";
                    //     noDataMessage.classList.add("no-proposals-message");
                    //     nbfcContainer.append(noDataMessage);
                    //     return;
                    // }



                    if (finalData) {
                        finalData.forEach(async (items) => {
                            const eachCards = document.createElement('div');
                            eachCards.classList.add("indivudalloanstatus-cards");

                            const insideCard = document.createElement('div');
                            insideCard.classList.add("individual-bankname");

                            const header = document.createElement("h1");
                            header.textContent = items.nbfc_name;

                            const messageInputNbfcids = document.createElement("p");
                            messageInputNbfcids.classList.add("messageinputnbfcids");
                            messageInputNbfcids.textContent = items.nbfc_id;




                            insideCard.append(header, messageInputNbfcids);





                            const insideSecond = document.createElement("div");
                            insideSecond.classList.add("individual-bankmessages");

                            const bankMessage = document.createElement("p");
                            bankMessage.textContent = "Lorem ipsum dolor sit amet...";
                            insideSecond.append(bankMessage);

                            await fetchStatus(items.nbfc_id, insideSecond, items);




                            const buttonContainer = document.createElement("div");
                            buttonContainer.classList.add('individual-bankmessages-buttoncontainer');
                            const bankMessageContainer = document.createElement("div");
                            bankMessageContainer.classList.add("individual-bankmessage-input");

                            const messageInput = document.createElement("input");
                            messageInput.placeholder = "Send message";
                            messageInput.type = "text";

                            const sendIcon = document.createElement("img");
                            sendIcon.classList.add("send-img");
                            sendIcon.src = 'assets/images/send.png';

                            const documentAttach = document.createElement("i");
                            documentAttach.classList.add("fa-solid", "fa-paperclip");

                            const smileAttach = document.createElement("i");
                            smileAttach.classList.add("fa-regular", "fa-face-smile");

                            bankMessageContainer.append(messageInput, sendIcon, documentAttach, smileAttach);

                            eachCards.append(insideCard, insideSecond, bankMessageContainer);
                            nbfcContainer.append(eachCards);
                        });

                        bindAcceptRejectButtons(finalData);


                    }



                    await initializeSideBarTabs();
                    await initializeIndividualCards();
                    await initializeSimpleChat();

                } else if (data.error) {
                    console.error("Error: ", data.error);
                }
            })
            .catch((error) => {
                console.error("Error caused in server: ", error);
            });
    }

};

// Helper function to truncate file names
function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;

    const extension = fileName.slice(fileName.lastIndexOf('.'));
    const name = fileName.slice(0, fileName.lastIndexOf('.'));

    return name.slice(0, 16) + '...' + extension;
}

// Initialize the document uploads when the page loads
// document.addEventListener('DOMContentLoaded', function () {
//     initializeWorkExperienceDocumentUpload();
// });






function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;

    const extension = fileName.slice(fileName.lastIndexOf("."));
    const name = fileName.slice(0, fileName.lastIndexOf("."));

    return name.slice(0, 16) + "..." + extension;
}



function toggleOtherDegreeInput(event) {
    const otherDegreeInput = document.getElementById("otherDegreeInput");

    if (event && event.target && event.target.value) {
        if (event.target.value === "Others") {
            otherDegreeInput.disabled = false;
            otherDegreeInput.placeholder = "Enter here";
            otherDegreeInput.value = "";
        } else {
            otherDegreeInput.disabled = true;
            otherDegreeInput.value = event.target.value; // Set the value to Bachelors or Masters
            otherDegreeInput.placeholder = "Enter degree type"; // Reset placeholder if needed
        }

        // Trigger the "Save" state on degree type change
        toggleSaveState();
    } else {
        console.error("Error: Event or target value is undefined.");
    }
}

const initializeProgressRing = () => {
    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
    const userId = userIdElement ? userIdElement.textContent.trim() : '';
    let percentage = 0;

    fetch("/getprofilecompletionpercentage", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ userId }),
    })
        .then(response => response.json())
        .then(data => {
            if (data) {
                console.log("Overall Completion:", data);
                percentage = data.overall_completion_percentage / 100;

                const radius = 52;
                const circumference = 2 * Math.PI * radius;
                const offset = circumference * (1 - percentage);
                const progressRingFill = document.querySelector(".progress-ring-fill");
                const progressText = document.querySelector(".progress-ring-text");

                progressRingFill.style.strokeDasharray = `${circumference} ${circumference}`;
                progressRingFill.style.strokeDashoffset = offset;
                progressText.textContent = `${Math.round(percentage * 100)}%`;
            } else if (data.error) {
                console.error("Server Error:", data.error);
            } else {
                console.error("Unexpected response format:", data);
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
        });
};

const initialisedocumentsCount = () => {

    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
    const userId = userIdElement ? userIdElement.textContent.trim() : '';
    const documentCountText = document.querySelector(".profilestatus-graph-secondsection .profilestatus-noofdocuments-section p");
    const overAll = document.querySelector(".profilestatus-graph-secondsection .profilestatus-noofdocuments-section span");

    if (!userId || !documentCountText) {
        console.error("User ID or count element not found.");
        return;
    }

    fetch("/count-documents", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ userId }),
    })
        .then(response => response.json())
        .then(data => {
            if (data && typeof data.documentscount === 'number') {
                const count = data.documentscount;
                const totalDoc = data.totalDocuments;

                // 🔹 Set formatted document count
                if (count >= 0 && count < 10) {
                    documentCountText.textContent = "0" + count;
                } else if (count >= 10) {
                    documentCountText.textContent = count;
                } else {
                    documentCountText.textContent = "00";
                }

                // 🔹 Set total documents value
                if (typeof totalDoc === 'number') {
                    overAll.textContent = "/" + totalDoc;
                } else {
                    overAll.textContent = "00"; // fallback
                }
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
        });
};




const triggerSave = (event) => {
    console.log(event);

}

document.querySelectorAll('input[name="education-level"]').forEach(radio => {
    radio.addEventListener('change', function () {
        var otherInput = document.getElementById('otherDegreeInput');
        if (this.value === 'Others' && this.checked) {
            otherInput.disabled = false;
        } else {
            otherInput.disabled = true;
        }
    });
});






const saveChangesFunctionality = () => {
    let isEditing = false;
    const saveChangesButton = document.querySelector(".personalinfo-firstrow button");
    const savedMsg = document.querySelector(".studentdashboardprofile-myapplication .myapplication-firstcolumn .personalinfo-firstrow .saved-msg");
    const personalDivContainer = document.querySelector(".personalinfo-secondrow");
    const personalDivContainerEdit = document.querySelector(".personalinfosecondrow-editsection");
    const academicsMarksDivEdit = document.querySelector(".testscoreseditsection-secondrow-editsection");
    const academicsMarksDiv = document.querySelector(".testscoreseditsection-secondrow");
    const otherExamName = document.querySelector(".other_exam_name_input")?.value || '';
    const otherExamScore = document.querySelector(".other_exam_score_input")?.value || '';



    const planToStudy = document.getElementById("plan-to-study-edit");

    const toggleSaveState = () => {
        isEditing = true;

        saveChangesButton.textContent = 'Save';
        saveChangesButton.style.backgroundColor = "rgba(111, 37, 206, 1)";
        saveChangesButton.style.color = "#fff";
        personalDivContainerEdit.style.display = "flex";
        personalDivContainer.style.display = "none";
        academicsMarksDivEdit.style.display = "flex";
        academicsMarksDiv.style.display = "none";
        document.querySelector(".educationeditsection-secondrow").style.display = "none";
        document.querySelector(".educationeditsection-secondrow-edit").style.display = "flex";

        document.getElementById("plan-to-study-edit").disabled = false;
        document.getElementById("country-edit").disabled = false;

        document.querySelectorAll('input[name="study-location-edit"]').forEach(cb => cb.disabled = false);
        document.querySelectorAll('input[name="education-level"]').forEach(rb => rb.disabled = false);

        document.getElementById("otherDegreeInput").disabled = false;

        document.querySelector(".myapplication-fourthcolumn-additional input").disabled = false;
        document.querySelector(".myapplication-fourthcolumn input").disabled = false;

        document.querySelector(".myapplication-fifthcolumn input").disabled = false;


    };

    if (saveChangesButton) {
        saveChangesButton.textContent = 'Edit';
        saveChangesButton.style.backgroundColor = "transparent";
        saveChangesButton.style.color = "#260254";

        saveChangesButton.addEventListener('click', (event) => {

            isEditing = !isEditing;

            if (isEditing) {
                toggleSaveState();
            }
            else {
                Loader.show();
                saveChangesButton.textContent = 'Edit';
                saveChangesButton.style.backgroundColor = "transparent";
                saveChangesButton.style.color = "#260254";
                personalDivContainer.style.display = "flex";
                personalDivContainerEdit.style.display = "none";
                academicsMarksDivEdit.style.display = "none";
                academicsMarksDiv.style.display = "flex";
                document.querySelector(".educationeditsection-secondrow").style.display = "flex";
                document.querySelector(".educationeditsection-secondrow-edit").style.display = "none";


                const editedName = document.querySelector(".personalinfosecondrow-editsection .personal_info_name input").value;
                const editedPhone = document.querySelector(".personalinfosecondrow-editsection .personal_info_phone input").value;
                const editedEmail = document.querySelector(".personalinfosecondrow-editsection .personal_info_email input").value;
                const editedState = document.querySelector(".personalinfosecondrow-editsection .personal_info_state input").value;
                const iletsScore = document.querySelector(".testscoreseditsection-secondrow-editsection .ilets_score").value;
                const greScore = document.querySelector(".testscoreseditsection-secondrow-editsection .gre_score").value;
                const tofelScore = document.querySelector(".testscoreseditsection-secondrow-editsection .tofel_score").value;
                const otherExamName = document.querySelector('.other_exam_name_input')?.value;
                const otherExamScore = document.querySelector('.other_exam_score_input')?.value;

                const oldPlanToStudy = document.getElementById("plan-to-study-edit").value;
                const oldPlanToStudyArray = oldPlanToStudy ? oldPlanToStudy.split(',').map(item => item.trim()) : [];

                const checkboxes = document.querySelectorAll('input[name="study-location-edit"]:checked');
                let selectedCountries = Array.from(checkboxes).map(checkbox => checkbox.value);

                const customCountry = document.getElementById('country-edit').value.trim();
                if (customCountry) {
                    selectedCountries.push(customCountry);
                }

                selectedCountries = selectedCountries.filter(item => item.toLowerCase() !== 'others');

                const finalPlanToStudy = oldPlanToStudyArray.filter(item => item.toLowerCase() !== 'others');

                let mergedPlanToStudy = [...new Set([...finalPlanToStudy, ...selectedCountries])];

                mergedPlanToStudy = mergedPlanToStudy.filter(item => item.toLowerCase() !== 'other');



                const courseDuration = document.querySelector(".myapplication-fourthcolumn-additional input").value;
                const loanAmount = document.querySelector(".myapplication-fourthcolumn input").value;

                const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
                const userId = userIdElement ? userIdElement.textContent : '';

                console.log(editedName, editedPhone, editedEmail, editedState, userId);

                const selectedDegree = document.querySelector('input[name="education-level"]:checked').value;
                const otherDegreeInput = document.getElementById('otherDegreeInput').value;

                const updatedDegreeType = selectedDegree === 'Others' ? otherDegreeInput : selectedDegree;
                const editedCourseName = document.querySelector(".educationeditsection-secondrow-edit .course_name_input")?.value || '';
                const editedUniversityName = document.querySelector(".educationeditsection-secondrow-edit .university_name_input")?.value || '';
                const updatedScRef = document.querySelector(".myapplication-fifthcolumn input")?.value || '';


                const updatedData = {
                    degreeType: updatedDegreeType
                };

                const updatedInfos = {
                    editedName: editedName,
                    editedPhone: editedPhone,
                    editedEmail: editedEmail,
                    editedState: editedState,
                    iletsScore: iletsScore,
                    greScore: greScore,
                    tofelScore: tofelScore,
                    planToStudy: mergedPlanToStudy,
                    courseDuration: courseDuration,
                    loanAmount: loanAmount,
                    referralCode: updatedScRef,
                    degreeType: updatedData.degreeType,
                    userId: userId,
                    courseName: editedCourseName,
                    universitySchoolName: editedUniversityName,
                    others: {
                        otherExamName: otherExamName,
                        otherExamScore: otherExamScore
                    }
                };





                fetch('/from-profileupdate', {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(updatedInfos)
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Response Data:", data);

                        alert("Student Details Updated Successfully");
                        Loader.hide();
                        if (editedName) {
                            document.querySelector("#referenceNameId p").textContent = editedName;
                            document.getElementById("personal_state_id").textContent = editedState;
                            if (editedName) {
                                document.querySelector("#referenceNameId p").textContent = editedName;
                            }
                            if (editedState) {
                                document.getElementById("personal_state_id").textContent = editedState;
                            }

                            // ✅ Update academic info section dynamically
                            if (editedCourseName) {
                                document.querySelector(".educationeditsection-secondrow p:nth-child(2)").textContent = `2. ${editedCourseName}`;
                            }
                            if (editedUniversityName) {
                                document.querySelector(".educationeditsection-secondrow p:nth-child(1)").textContent = `1. ${editedUniversityName}`;
                            }

                            // ✅ Exit edit mode
                            isEditing = false;

                            saveChangesButton.textContent = 'Edit';
                            saveChangesButton.style.backgroundColor = "transparent";
                            saveChangesButton.style.color = "#260254";

                            personalDivContainer.style.display = "flex";
                            personalDivContainerEdit.style.display = "none";
                            academicsMarksDivEdit.style.display = "none";
                            academicsMarksDiv.style.display = "flex";
                            document.querySelector(".educationeditsection-secondrow").style.display = "flex";
                            document.querySelector(".educationeditsection-secondrow-edit").style.display = "none";
                            const scoresContainer = document.querySelector(".testscoreseditsection-secondrow");
                            // Disable inputs again after saving
                            document.getElementById("plan-to-study-edit").disabled = true;
                            document.getElementById("country-edit").disabled = true;

                            document.querySelectorAll('input[name="study-location-edit"]').forEach(cb => cb.disabled = true);
                            document.querySelectorAll('input[name="education-level"]').forEach(rb => rb.disabled = true);

                            document.getElementById("otherDegreeInput").disabled = true;

                            document.querySelector(".myapplication-fourthcolumn-additional input").disabled = true;
                            document.querySelector(".myapplication-fourthcolumn input").disabled = true;

                            document.querySelector(".myapplication-fifthcolumn input").disabled = true;


                            // Clear existing scores
                            // Clear existing scores
                            scoresContainer.innerHTML = "";

                            let scoreCounter = 1;

                            // IELTS
                            if (iletsScore && !isNaN(iletsScore)) {
                                scoresContainer.innerHTML += `<p>${scoreCounter++}. IELTS <span class="ilets_score">${iletsScore}</span></p>`;
                            }

                            // GRE
                            if (greScore && !isNaN(greScore)) {
                                scoresContainer.innerHTML += `<p>${scoreCounter++}. GRE <span class="gre_score">${greScore}</span></p>`;
                            }

                            // TOEFL
                            if (tofelScore && !isNaN(tofelScore)) {
                                scoresContainer.innerHTML += `<p>${scoreCounter++}. TOEFL <span class="tofel_score">${tofelScore}</span></p>`;
                            }

                            // ✅ Other Exam
                            if (otherExamName && otherExamScore && !isNaN(otherExamScore)) {
                                scoresContainer.innerHTML += `<p>${scoreCounter++}. ${otherExamName} <span>${otherExamScore}</span></p>`;
                            }






                        }


                        if (data.errors) {
                            Loader.hide();
                            console.error('Validation errors:', data.errors);
                        } else {
                            console.log("Success", data);
                        }
                    })
                    .catch(error => {
                        console.error("Error", error);
                    });
            }
        });
    }

    const degreeRadioButtons = document.querySelectorAll('input[name="education-level"]');
    degreeRadioButtons.forEach(button => {
        button.addEventListener('change', toggleSaveState);
    });
};




function loadSavedMessages() {

    // Load text messages
    const savedMessages = JSON.parse(localStorage.getItem(`messages-${chatId}`) || '[]');

    // Load file messages
    const savedFileMessages = JSON.parse(localStorage.getItem(`file-messages-${chatId}`) || '[]');

    // If there are any saved messages, we'll automatically show the chat area
    if (savedMessages.length > 0 || savedFileMessages.length > 0) {
        // Don't actually show the chat yet, just prepare to show it if user clicks
        if (messageButton) {
            messageButton.textContent = "Message";
        }
    }

    // Add text messages to UI
    if (savedMessages.length > 0) {
        savedMessages.forEach(content => {
            const messageElement = document.createElement("div");
            messageElement.style.cssText = `
                display: flex;
                justify-content: flex-end;
                width: 100%;
                margin-bottom: 10px;
            `;

            const messageContent = document.createElement("div");
            messageContent.style.cssText = `
                max-width: 80%;
                padding: 8px 12px;
                border-radius: 8px;
                word-wrap: break-word;
                font-family: 'Poppins', sans-serif;
                color:rgb(102, 102, 102);
            `;
            messageContent.textContent = content;

            messageElement.appendChild(messageContent);
            messagesWrapper.appendChild(messageElement);
        });
    }

    // Add file messages to UI
    if (savedFileMessages.length > 0) {
        savedFileMessages.forEach(fileData => {
            const messageElement = document.createElement("div");
            messageElement.setAttribute('data-file-id', fileData.id);
            messageElement.style.cssText = `
                display: flex;
                justify-content: flex-end;
                width: 100%;
                margin-bottom: 10px;
            `;

            const fileContent = document.createElement("div");
            fileContent.style.cssText = `
                max-width: 80%;
                padding: 8px 12px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                gap: 8px;
                position: relative;
                color:rgb(102, 102, 102);
            `;

            // Create download link for the file
            const downloadLink = document.createElement("a");
            downloadLink.href = "#";
            downloadLink.style.cssText = `
                display: flex;
                align-items: center;
                gap: 5px;
                color: #666;
                text-decoration: none;
            `;
            downloadLink.innerHTML = `
                <i class="fa-solid fa-file"></i>
                <span>${fileData.name} (${fileData.size} MB)</span>
            `;
            downloadLink.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                // Alert user that the file needs to be re-uploaded after page refresh
                alert("File attachments cannot be retrieved after page refresh. Please re-upload the file if needed.");
            });

            // Create remove button
            const removeButton = document.createElement("button");
            removeButton.innerHTML = `<i class="fa-solid fa-times"></i>`;
            removeButton.style.cssText = `
                background: none;
                border: none;
                color: #999;
                font-size: 12px;
                cursor: pointer;
                padding: 2px 5px;
                margin-left: 5px;
            `;
            removeButton.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                removeMessage(messageElement, fileData.id);
            });

            fileContent.appendChild(downloadLink);
            fileContent.appendChild(removeButton);
            messageElement.appendChild(fileContent);
            messagesWrapper.appendChild(messageElement);
        });
    }
}

// loadSavedMessages();
function fetchUnreadCount() {
    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
    const userId = userIdElement ? userIdElement.textContent.trim() : '';
    const receiverId = userId;

    if (!receiverId) return;

    fetch('/unread-message-count', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ receiverId })
    })
        .then(res => res.json())
        .then(data => {
            const countNotify = document.querySelector(".unread-notify-container p");
            if (data.success && data.count > 0 && countNotify) {
                countNotify.style.display = "flex";
                countNotify.textContent = data.count;
            } else if (countNotify) {
                countNotify.style.display = "none";
            }
        })
        .catch(error => {
            console.error('Error fetching unread count:', error);
        });
}

function sessionLogoutInitial() {
    const logoutUrl = '/logout'; // Hardcoded logout endpoint
    const loginUrl = '/login';  // Hardcoded login page
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Check for CSRF token
    if (!csrfToken) {
        console.error('CSRF token not found');
        return;
    }

    fetch(logoutUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
        .then(response => {
            if (response.ok) {
                console.log('Logout successful', response);
                window.location.href = loginUrl;
            } else {
                console.error('Logout failed:', response.status, response.statusText);
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
}


function seenMessage() {
    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
    const userId = userIdElement ? userIdElement.textContent.trim() : '';
    fetch('/messages/mark-all-read', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ userId })
    })
        .then(response => response.json())
        .then(data => {
            console.log('Messages marked as read:', data);
        })
        .catch(error => {
            console.error('Error marking messages as read:', error);
        });
}


function markAsRead() {
    const notifyContainer = document.querySelector(".nav-searchnotificationbars .unread-notify");
    const sideBarTopItems = document.querySelectorAll('.studentdashboardprofile-sidebarlists-top li');
    const lastTabHiddenDiv = document.querySelector(".studentdashboardprofile-trackprogress");
    const lastTabVisibleDiv = document.querySelector(".studentdashboardprofile-myapplication");
    const dynamicHeader = document.getElementById('loanproposals-header');

    const individualCards = document.querySelectorAll('.loanproposals-loanstatuscards .indivudalloanstatus-cards');
    const communityJoinCard = document.querySelector('.studentdashboardprofile-communityjoinsection');
    const profileStatusCard = document.querySelector(".personalinfo-profilestatus");
    const profileImgEditIcon = document.querySelector(".studentdashboardprofile-profilesection .fa-pen-to-square");
    const educationEditSection = document.querySelector(".studentdashboardprofile-educationeditsection");
    const testScoresEditSection = document.querySelector(".studentdashboardprofile-testscoreseditsection");

    if (notifyContainer && sideBarTopItems.length > 1) {
        notifyContainer.addEventListener('click', () => {
            sideBarTopItems.forEach(i => i.classList.remove('active'));
            sideBarTopItems[1].classList.add('active');
            console.log('Inbox tab selected and activated');

            if (lastTabHiddenDiv) lastTabHiddenDiv.style.display = "flex";
            if (lastTabVisibleDiv) lastTabVisibleDiv.style.display = "none";
            if (communityJoinCard) communityJoinCard.style.display = "flex";
            if (profileStatusCard) profileStatusCard.style.display = "block";
            if (profileImgEditIcon) profileImgEditIcon.style.display = "none";
            if (educationEditSection) educationEditSection.style.display = "none";
            if (testScoresEditSection) testScoresEditSection.style.display = "none";
            const buttonGroups = document.querySelectorAll(".individual-bankmessages-buttoncontainer");
            const triggeredMessageButton = document.querySelectorAll('.individual-bankmessages .triggeredbutton');

            if (buttonGroups) {
                buttonGroups.forEach((buttonGroups, index) => {
                    buttonGroups.style.display = "none";
                    triggeredMessageButton[index].style.display = "flex";

                })
            }



            if (dynamicHeader) dynamicHeader.textContent = "Inbox";

            const currentScroll = window.scrollY;

            if (currentScroll !== 300) {
                window.scrollTo({
                    top: 300,
                    left: 0,
                    behavior: 'smooth'
                });
            }
            seenMessage();
        });
    }
}



function unReadDots() {
    const messageInputNbfcids = document.querySelectorAll(".messageinputnbfcids");

    if (messageInputNbfcids.length > 0) {
        console.log(messageInputNbfcids);
    }

    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
    const userId = userIdElement ? userIdElement.textContent.trim() : '';

    if (userId) {
        messageInputNbfcids.forEach((item) => {
            const nbfc_id = item.getAttribute('data-nbfc-id');
            const student_id = item.getAttribute('data-student-id');

            if (nbfc_id && student_id) {
                fetch(`/get-messages-byconversations/${nbfc_id}/${student_id}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({})
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(`Messages for NBFC ${nbfc_id} and student ${student_id}:`, data);
                        if (data.unreadCount && data.unreadCount > 0) {
                            const triggeredButton = document.querySelector('.triggeredbutton');
                            if (triggeredButton) {
                                triggeredButton.classList.add('has-unread');
                                console.log(triggeredButton);
                            }
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching messages:", error);
                    });
            }
        });
    }
}


async function bindAcceptRejectButtons(finalData) {
    // console.log("Binding buttons for:", finalData);

    finalData.forEach((item) => {
        const { acceptButton, rejectButton, user_id, nbfc_id } = item;

        if (acceptButton && acceptButton.textContent === "Accept") {
            acceptButton.addEventListener("click", async () => {
                const data = {
                    user_id,
                    nbfc_id,
                    proposal_accept: true
                };

                try {
                    const response = await fetch('/proposalcompletion', {
                        method: "POST",
                        headers: {
                            'Content-Type': "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();
                    console.log("✅ Accepted:", item);
                    console.log("✅ Server Response:", result);

                    acceptButton.style.backgroundColor = "transparent";
                    acceptButton.style.color = "#4CAF50";
                    acceptButton.textContent = "Accepted";
                    acceptButton.style.width = "82px";
                    acceptButton.style.border = "none";

                    if (rejectButton) {
                        rejectButton.style.display = "none";
                    }
                } catch (error) {
                    console.error("Error during fetch (Accept):", error);
                }
            });
        }

        if (rejectButton && rejectButton.textContent === "Reject") {
            rejectButton.addEventListener("click", async () => {
                const data = {
                    user_id,
                    nbfc_id,
                    proposal_accept: false
                };

                try {
                    const response = await fetch('/proposalcompletion', {
                        method: "POST",
                        headers: {
                            'Content-Type': "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();
                    console.log("❌ Rejected:", item);
                    console.log("❌ Server Response:", result);

                    rejectButton.style.backgroundColor = "transparent";
                    rejectButton.style.color = "#dc3545";
                    rejectButton.textContent = "Rejected";
                    rejectButton.style.width = "82px";
                    rejectButton.style.border = "none";

                    if (acceptButton) {
                        acceptButton.style.display = "none";
                    }
                } catch (error) {
                    console.error("Error during fetch (Reject):", error);
                }
            });
        }
    });


}






const findOutAcceptedOrNot = async () => {
    fetch('/proposalcompletion', {
        method: "POST",
        headers: {
            'Content-Type': "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(result => {
            console.log("✅ Accepted:", proposal);
            console.log("✅ Server Response:", result);
            if (btn && rejectButtons) {
                btn.style.backgroundColor = "transparent";
                btn.style.color = "#4CAF50";
                btn.textContent = "Accepted"
                btn.style.width = "82px"
                btn.style.border = "none"
                rejectButtons[index].style.display = "none"
            }
        })
        .catch(error => {
            console.error("❌ Error during fetch (Accept):", error);
        });



}





async function fetchStatus(nbfcId = null, insideSecond = null, currentItem = null) {
    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
    const userId = userIdElement ? userIdElement.textContent.trim() : '';
    let statusCount = 0;

    try {
        const response = await fetch("/check_userid", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ user_id: userId, nbfc_id: nbfcId })
        });

        if (!response.ok) throw new Error("Network response was not ok");
        const result = await response.json();
        console.log(result);

        const data = result?.data;
        const proposal_accept_update = data?.proposal_accept;
        const itemsNeedingButtons = [];

        // Create button container
        const buttonContainer = document.createElement("div");
        buttonContainer.classList.add('individual-bankmessages-buttoncontainer');

        // Always create the "View" button
        const firstButton = document.createElement("button");
        firstButton.classList.add("view-proposal");
        firstButton.textContent = "View";

        firstButton.addEventListener("click", async () => {
            try {
                const response = await fetch('/getproposalfileurl', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ userId, nbfcId })
                });

                const data = await response.json();
                if (data.file_path) {
                    const fileName = data.file_path.split("/").pop(); // Extract filename from URL
                    showDocumentPreview(data.file_path, fileName);     // Show the document
                } else {
                    alert("No document found to preview.");
                    console.error('No file found:', data.message);
                }
            } catch (error) {
                alert("Error fetching document. Please try again.");
                console.error('Error fetching file URL:', error);
            }
        });

        if (!data) {
            // Case: No data returned (initial state)
            const secondButton = document.createElement("button");
            secondButton.textContent = "Accept";
            secondButton.classList.add('user-accept-trigger');

            const thirdButton = document.createElement("button");
            thirdButton.textContent = "Reject";
            thirdButton.classList.add("bankmessage-buttoncontainer-reject");

            const fourthButton = document.createElement("button");
            fourthButton.textContent = "Message";
            fourthButton.classList.add("triggeredbutton");

            buttonContainer.append(firstButton, secondButton, thirdButton);
            insideSecond.append(buttonContainer, fourthButton);

            itemsNeedingButtons.push({
                user_id: userId,
                nbfc_id: nbfcId,
                element: currentItem,
                acceptButton: secondButton,
                rejectButton: thirdButton
            });
        } else if (proposal_accept_update) {
            // Case: Proposal accepted
            const secondButton = document.createElement("button");
            secondButton.textContent = "Accepted";
            secondButton.classList.add('user-accept-trigger');
            secondButton.style.backgroundColor = "transparent";
            secondButton.style.color = "#4CAF50";
            secondButton.style.width = "82px";
            secondButton.style.border = "none";

            const fourthButton = document.createElement("button");
            fourthButton.textContent = "Message";
            fourthButton.classList.add("triggeredbutton");

            buttonContainer.append(firstButton, secondButton);
            insideSecond.append(buttonContainer, fourthButton);

            itemsNeedingButtons.push({
                user_id: userId,
                nbfc_id: nbfcId,
                element: currentItem,
                acceptButton: secondButton,
                rejectButton: null
            });

            statusCount++;
        } else {
            // Case: Proposal rejected
            const thirdButton = document.createElement("button");
            thirdButton.textContent = "Rejected";
            thirdButton.classList.add("bankmessage-buttoncontainer-reject");
            thirdButton.style.backgroundColor = "transparent";
            thirdButton.style.color = "#dc3545";
            thirdButton.style.width = "82px";
            thirdButton.style.border = "none";

            const fourthButton = document.createElement("button");
            fourthButton.textContent = "Message";
            fourthButton.classList.add("triggeredbutton");

            buttonContainer.append(firstButton, thirdButton);
            insideSecond.append(buttonContainer, fourthButton);

            itemsNeedingButtons.push({
                user_id: userId,
                nbfc_id: nbfcId,
                element: currentItem,
                acceptButton: null,
                rejectButton: thirdButton
            });

            statusCount++;
        }

        bindAcceptRejectButtons(itemsNeedingButtons);
        return statusCount;

    } catch (error) {
        console.error("Error checking user ID:", error);
    }
}



const showDocumentPreview = (fileUrl, fileName, eyeIcon = null) => {
    if (!fileUrl) {
        alert("No document found to preview.");
        return;
    }

    const isPDF = fileUrl.toLowerCase().endsWith(".pdf");
    const isImage = [".jpg", ".jpeg", ".png"].some((ext) =>
        fileUrl.toLowerCase().endsWith(ext)
    );

    const truncatedFileName = truncateFileName(fileName || "Document.pdf");

    if (isPDF) {
        // PDF Preview
        const previewWrapper = document.createElement("div");
        previewWrapper.className = "pdf-preview-wrapper";
        previewWrapper.style.cssText = `
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            height: 80vh;
            background-color: white;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            border-radius: 8px;
        `;

        const overlay = document.createElement("div");
        overlay.className = "pdf-preview-overlay";
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        `;

        const header = document.createElement("div");
        header.style.cssText = `
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 16px;
            background-color: #1a1a1a;
            color: white;
            height: 40px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        `;

        const fileNameSection = document.createElement("div");
        fileNameSection.style.cssText = `
            display: flex;
            align-items: center;
            gap: 8px;
        `;

        const fileNameSpan = document.createElement("span");
        fileNameSpan.textContent = truncatedFileName;
        fileNameSpan.style.cssText = `
            color: white;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        `;
        fileNameSection.appendChild(fileNameSpan);

        // Add Download Button
        const downloadButton = document.createElement("button");
        downloadButton.innerHTML = "⬇"; // Download icon (or change to "Download" if preferred)
        downloadButton.title = "Download File";
        downloadButton.style.cssText = `
            background: none;
            border: 1px solid #fff;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            padding: 2px 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        `;

        downloadButton.addEventListener("click", async () => {
            try {
                console.log("Attempting to download:", fileUrl); // Debug URL
                const response = await fetch(fileUrl, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': isPDF ? 'application/pdf' : 'image/*'
                    },
                    credentials: 'include' // Include cookies for authentication
                });

                console.log("Response status:", response.status); // Debug response
                if (!response.ok) throw new Error(`HTTP error ${response.status}`);

                const blob = await response.blob();
                console.log("Blob size:", blob.size, "type:", blob.type); // Debug blob

                if (blob.size === 0) throw new Error("Empty file received");

                const url = window.URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = fileName || (isPDF ? "document.pdf" : "document.png");
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            } catch (error) {
                console.error("Download error:", error);
                alert("Error downloading file. Please try again.");

                // Fallback: Attempt to trigger download via iframe URL
                console.log("Attempting fallback download...");
                const a = document.createElement("a");
                a.href = fileUrl;
                a.download = fileName || (isPDF ? "document.pdf" : "document.png");
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }
        });

        const zoomControls = document.createElement("div");
        zoomControls.style.cssText = `
            display: flex;
            align-items: center;
            gap: 12px;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        `;

        const zoomOut = document.createElement("button");
        zoomOut.innerHTML = "−";
        const zoomIn = document.createElement("button");
        zoomIn.innerHTML = "+";

        [zoomOut, zoomIn].forEach((btn) => {
            btn.style.cssText = `
                background: none;
                border: 1px solid #fff;
                border-radius: 4px;
                color: white;
                font-size: 16px;
                cursor: pointer;
                padding: 2px 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Poppins', sans-serif;
            `;
        });

        zoomControls.appendChild(zoomOut);
        zoomControls.appendChild(zoomIn);

        const closeButton = document.createElement("button");
        closeButton.innerHTML = "✕";
        closeButton.style.cssText = `
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        `;

        const closePreview = () => {
            previewWrapper.remove();
            overlay.remove();
            if (eyeIcon) {
                eyeIcon.classList.remove("preview-active");
                eyeIcon.src = "/assets/images/visibility.png";
            }
        };

        closeButton.addEventListener("click", closePreview);
        overlay.addEventListener("click", closePreview);

        header.appendChild(fileNameSection);
        header.appendChild(downloadButton);
        header.appendChild(zoomControls);
        header.appendChild(closeButton);

        const iframe = document.createElement("iframe");
        iframe.src = fileUrl;
        iframe.style.cssText = `
            width: 100%;
            height: calc(100% - 40px);
            border: none;
            background-color: white;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        `;

        previewWrapper.appendChild(header);
        previewWrapper.appendChild(iframe);

        document.body.appendChild(overlay);
        document.body.appendChild(previewWrapper);

        let currentZoom = 1;
        zoomIn.addEventListener("click", () => {
            currentZoom += 0.1;
            iframe.style.transform = `scale(${currentZoom})`;
            iframe.style.transformOrigin = "top center";
        });

        zoomOut.addEventListener("click", () => {
            currentZoom = Math.max(currentZoom - 0.1, 0.5);
            iframe.style.transform = `scale(${currentZoom})`;
            iframe.style.transformOrigin = "top center";
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                closePreview();
            }
        });

        if (eyeIcon) {
            eyeIcon.classList.add("preview-active");
            eyeIcon.src = "/assets/images/close.png";
        }
    } else if (isImage) {
        // Image Preview
        const previewWrapper = document.createElement("div");
        previewWrapper.className = "image-preview-wrapper";
        previewWrapper.style.cssText = `
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            background-color: white;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            border-radius: 8px;
        `;

        const overlay = document.createElement("div");
        overlay.className = "image-preview-overlay";
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        `;

        const header = document.createElement("div");
        header.style.cssText = `
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 16px;
            background-color: #1a1a1a;
            color: white;
            height: 40px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        `;

        const fileNameSection = document.createElement("div");
        fileNameSection.style.cssText = `
            display: flex;
            align-items: center;
            gap: 8px;
        `;

        const fileNameSpan = document.createElement("span");
        fileNameSpan.textContent = truncatedFileName;
        fileNameSection.appendChild(fileNameSpan);

        // Add Download Button
        const downloadButton = document.createElement("button");
        downloadButton.innerHTML = "⬇"; // Download icon
        downloadButton.title = "Download File";
        downloadButton.style.cssText = `
            background: none;
            border: 1px solid #fff;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            padding: 2px 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        `;

        downloadButton.addEventListener("click", async () => {
            try {
                console.log("Attempting to download:", fileUrl); // Debug URL
                const response = await fetch(fileUrl, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': isPDF ? 'application/pdf' : 'image/*'
                    },
                    credentials: 'include' // Include cookies for authentication
                });

                console.log("Response status:", response.status); // Debug response
                if (!response.ok) throw new Error(`HTTP error ${response.status}`);

                const blob = await response.blob();
                console.log("Blob size:", blob.size, "type:", blob.type); // Debug blob

                if (blob.size === 0) throw new Error("Empty file received");

                const url = window.URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = fileName || (isPDF ? "document.pdf" : "document.png");
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            } catch (error) {
                console.error("Download error:", error);
                alert("Error downloading file. Please try again.");

                // Fallback: Attempt to trigger download via direct URL
                console.log("Attempting fallback download...");
                const a = document.createElement("a");
                a.href = fileUrl;
                a.download = fileName || (isPDF ? "document.pdf" : "document.png");
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }
        });

        const closeButton = document.createElement("button");
        closeButton.innerHTML = "✕";
        closeButton.style.cssText = `
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        `;

        const closePreview = () => {
            previewWrapper.remove();
            overlay.remove();
            if (eyeIcon) {
                eyeIcon.classList.remove("preview-active");
                eyeIcon.src = "/assets/images/visibility.png";
            }
        };

        closeButton.addEventListener("click", closePreview);
        overlay.addEventListener("click", closePreview);

        header.appendChild(fileNameSection);
        header.appendChild(downloadButton);
        header.appendChild(closeButton);

        const imageContainer = document.createElement("div");
        imageContainer.style.cssText = `
            width: 100%;
            height: calc(100% - 40px);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: auto;
            padding: 20px;
            background-color: #f0f0f0;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        `;

        const img = document.createElement("img");
        img.src = fileUrl;
        img.style.cssText = `
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
        `;

        imageContainer.appendChild(img);
        previewWrapper.appendChild(header);
        previewWrapper.appendChild(imageContainer);

        document.body.appendChild(overlay);
        document.body.appendChild(previewWrapper);

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                closePreview();
            }
        });

        if (eyeIcon) {
            eyeIcon.classList.add("preview-active");
            eyeIcon.src = "/assets/images/close.png";
        }
    } else {
        alert("Unsupported file type. Only PDF and images (JPG, PNG, JPEG) are supported.");
    }
};
const loanStatusCount = () => {
    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
    const userId = userIdElement ? userIdElement.textContent.trim() : '';

    if (!userId) {
        console.error("User ID not found.");
        return;
    }

    fetch('/loanstatuscount', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ user_id: userId })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log("Loan Status Data:", data);

            const formatCount = (num) => num.toString().padStart(2, '0');

            document.querySelector(".leftsection-detailsinfo .loan-receivedsection h1").textContent = formatCount(data.received_proposals);
            document.querySelector("#studentdashboardprofile-loanproposals-id .loanproposal-headerstudentside p").textContent = formatCount(data.received_proposals);
            document.querySelector(".leftsection-detailsinfo .loan-onholdsection h1").textContent = formatCount(data.hold_requests);

            let rejectedTotal = 0;
            if (Array.isArray(data.rejected_by_nbfc)) {
                rejectedTotal = data.rejected_by_nbfc.reduce((sum, item) => sum + (item.count || 0), 0);
            }

            document.querySelector(".leftsection-detailsinfo .loan-rejectedsection h1").textContent = formatCount(rejectedTotal);
        })
        .catch(error => {
            console.error("Error fetching loan status:", error);

        });
};



const passwordForgot = () => {
    const forgotMailTrigger = document.querySelector(".footer-passwordchange p");

    if (forgotMailTrigger) {
        forgotMailTrigger.addEventListener('click', () => {

            const email = document.querySelector("#referenceEmailId p").textContent;



            fetch("/forgot-passwordmailsent", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ email: email })
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.message) {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("There was an error while sending the email.");
                });
        });
    }
}

async function createAdminChatStudent() {
    const container = document.querySelector('.adminmessage-inboxnbfc');
    if (!container) return;

    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
    const student_id = userIdElement ? userIdElement.textContent.trim() : "";
    const admin_id = 'admin001';

    if (document.querySelector('.admin-msg-container')) return;

    const adminMsgContainer = document.createElement('div');
    adminMsgContainer.classList.add('admin-msg-container');
    adminMsgContainer.style.cssText = `
        border: 1px solid #ddd;
        display:none;
        border-radius: 10px;
        margin: 20px 0;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
    `;

    const header = document.createElement('div');
    header.style.cssText = `
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: transparent;
        padding: 12px 16px;
        border-bottom: 1px solid #eee;
    `;

    const title = document.createElement('div');
    title.innerHTML = `Admin<br><p style="color:rgba(144, 144, 144, 1)">Support & Communication Desk</p>`;
    title.style.cssText = `font-size: 14px; color: rgba(93, 92, 92, 1)`;

    const btnGroup = document.createElement('div');

    const toggleBtn = document.createElement('button');
    toggleBtn.textContent = 'Message';
    toggleBtn.style.cssText = `
        background-color: #6f25ce;
        color: white;
        border: none;
        padding: 7px 22px;
        border-radius: 4px;
        cursor: pointer;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        transition: background-color 0.3s ease;
     `;

    btnGroup.append(toggleBtn);
    header.append(title, btnGroup);

    const chatWrapper = document.createElement('div');
    chatWrapper.classList.add('admin-chat-wrapper');
    chatWrapper.style.cssText = `
        display: none;
        flex-direction: column;
        padding: 15px;
        max-height: 300px;
        overflow-y: auto;
        background: white;
    `;

    const inputContainer = document.createElement('div');
    inputContainer.style.cssText = `
        display: none;
        align-items: center;
        padding: 10px;
        background: #fafafa;
        border-top: 1px solid #eee;
        position: relative;
    `;

    const input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'Send message';
    input.classList.add('nbfc-message-input');
    input.style.cssText = `
        flex: 1;
        padding: 8px 12px;
        border-radius: 20px;
        border: 1px solid #ccc;
        margin-right: 10px;
    `;

    const emoji = document.createElement('i');
    emoji.classList.add('fa-regular', 'fa-face-smile');
    emoji.style.cssText = `font-size: 18px; margin-right: 8px; color: #888; cursor: pointer;`;

    const paperclip = document.createElement('i');
    paperclip.classList.add('fa-solid', 'fa-paperclip');
    paperclip.style.cssText = `font-size: 18px; margin-right: 8px; color: #888; cursor: pointer;`;

    const sendIcon = document.createElement('img');
    sendIcon.src = 'assets/images/send-nbfc.png';
    sendIcon.alt = 'send icon';
    sendIcon.style.cssText = `width: 22px; height: 22px; cursor: pointer;`;

    const emojiPicker = document.createElement('div');
    emojiPicker.style.cssText = `
        position: absolute;
        bottom: 45px;
        left: 10px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        display: none;
        max-width: 200px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    `;

    inputContainer.append(emoji, paperclip, input, sendIcon, emojiPicker);
    // Emoji Picker Integration
    emoji.addEventListener('click', function (e) {
        e.stopPropagation();

        const emojis = ["😊", "👍", "😀", "🙂", "👋", "👌", "✨"];
        const existingPicker = document.querySelector(".emoji-picker");
        if (existingPicker) {
            existingPicker.remove();
            return;
        }

        const picker = document.createElement("div");
        picker.classList.add("emoji-picker");
        picker.style.cssText = `
        position: absolute;
        bottom: 45px;
        left: 10px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        z-index: 1000;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    `;

        emojis.forEach(emojiChar => {
            const button = document.createElement("button");
            button.textContent = emojiChar;
            button.style.cssText = `
            border: none;
            background: none;
            font-size: 18px;
            cursor: pointer;
            padding: 4px;
        `;
            button.addEventListener('click', function (e) {
                e.stopPropagation();
                input.value += emojiChar;
                picker.remove();
                input.focus();
            });
            picker.appendChild(button);
        });

        inputContainer.appendChild(picker);

        document.addEventListener("click", function closePicker(ev) {
            if (!picker.contains(ev.target) && ev.target !== emoji) {
                picker.remove();
                document.removeEventListener("click", closePicker);
            }
        });
    });
    // Paperclip File Upload
    paperclip.addEventListener("click", function () {
        const fileInput = document.createElement("input");
        fileInput.type = "file";
        fileInput.accept = ".pdf,.doc,.docx,.txt";
        fileInput.style.display = "none";
        const chatId = `${student_id}_${admin_id}`; // or fetch from backend


        fileInput.onchange = async (e) => {
            const file = e.target.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('file', file);
            formData.append('chatId', chatId);


            try {
                const res = await fetch('/upload-documents-chat', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: formData
                });

                const data = await res.json();

                if (data.success && data.fileUrl) {
                    const fileUrl = data.fileUrl;
                    console.log(data.fileUrl)

                    const payload = {
                        id: student_id,
                        admin_id: admin_id,
                        sender_id: student_id,
                        receiver_id: admin_id,
                        message: fileUrl, // This is the URL sent
                        is_read: false
                    };

                    const messageRes = await fetch('/send-message-from-adminstudent', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                        body: JSON.stringify(payload)
                    });

                    if (!messageRes.ok) throw new Error("Failed to send file message");

                    await loadMessages(student_id, admin_id);
                } else {
                    alert("File upload failed.");
                }
            } catch (err) {
                console.error("Upload error:", err);
                alert("Something went wrong while uploading the file.");
            }
        };

        document.body.appendChild(fileInput);
        fileInput.click();
        document.body.removeChild(fileInput);
    });


    adminMsgContainer.append(header, chatWrapper, inputContainer);
    container.appendChild(adminMsgContainer);

    async function loadMessages(student_id, admin_id) {
        const chatWrapper = document.querySelector('.admin-chat-wrapper');
        if (!chatWrapper) return;

        const apiUrl = `/get-messages-adminstudent/${student_id}/${admin_id}`;

        try {
            const res = await fetch(apiUrl);
            if (!res.ok) throw new Error('Failed to fetch messages');

            const data = await res.json();
            const messages = Array.isArray(data.messages) ? data.messages : [];

            chatWrapper.innerHTML = '';

            messages.forEach(msg => {
                const messageDiv = document.createElement('div');
                messageDiv.style.cssText = `
                    display: flex;
                    justify-content: ${msg.sender_id === admin_id ? 'flex-start' : 'flex-end'};
                    margin-bottom: 10px;
                    width: 100%;
                `;

                const bubble = document.createElement('div');
                bubble.style.cssText = `
                    max-width: 80%;
                    padding: 10px 14px;
                    border-radius: 12px;
                    background-color: ${msg.sender_id === admin_id ? '#f0f0f0' : '#DCF8C6'};
                    font-size: 14px;
                    word-wrap: break-word;
                    font-family: 'Poppins', sans-serif;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                    color:rgb(102, 102, 102);
                `;

                let isFileUrl = false;
                try {
                    const url = new URL(msg.message, window.location.origin);
                    const fileExts = ['pdf', 'doc', 'docx', 'txt'];
                    const path = url.pathname.toLowerCase();
                    isFileUrl = fileExts.some(ext => path.endsWith(`.${ext}`));
                } catch {
                    isFileUrl = false;
                }

                if (isFileUrl) {
                    const fileName = msg.message.split('/').pop().split('?')[0];
                    const link = document.createElement('a');
                    link.href = msg.message;
                    link.target = "_blank";
                    link.innerHTML = `<i class="fa-solid fa-file"></i> ${fileName}`;
                    link.style.cssText = `color: rgb(102, 102, 102); text-decoration: none;`;
                    bubble.appendChild(link);
                } else {
                    bubble.textContent = msg.message;
                }

                messageDiv.appendChild(bubble);
                chatWrapper.appendChild(messageDiv);
            });

            chatWrapper.scrollTop = chatWrapper.scrollHeight;

        } catch (err) {
            console.error('Error loading messages:', err);
            chatWrapper.innerHTML = `<div style="color: red; text-align:center;">Failed to load messages</div>`;
        }
    }

    async function sendMessageAdmin() {
        const input = document.querySelector('.nbfc-message-input');
        if (!input) return;

        const messageText = input.value.trim();
        if (!messageText) return;

        const studentIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
        const student_id = studentIdElement ? studentIdElement.textContent.trim() : "";



        if (!student_id) {
            alert("Student ID not found");
            return;
        }

        const payload = {
            student_id: student_id,
            admin_id: admin_id,
            sender_id: student_id,
            receiver_id: admin_id,
            message: messageText,
            is_read: false
        };

        try {
            const res = await fetch('/send-message-from-adminstudent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify(payload)
            });

            if (!res.ok) throw new Error('Failed to send message');

            input.value = '';
            await loadMessages(student_id, admin_id);
        } catch (err) {
            console.error('Error sending message:', err);
            alert('Failed to send message. Please try again.');
        }
    }

    let isChatOpen = false;

    toggleBtn.addEventListener('click', async () => {
        if (!isChatOpen) {
            chatWrapper.style.display = 'flex';
            inputContainer.style.display = 'flex';
            toggleBtn.textContent = 'Close';
            toggleBtn.style.border = '1px solid #6f25ce';
            toggleBtn.style.background = 'transparent';
            toggleBtn.style.color = '#6f25ce';
            isChatOpen = true;
            await loadMessages(student_id, admin_id);
        } else {
            chatWrapper.style.display = 'none';
            inputContainer.style.display = 'none';
            toggleBtn.textContent = 'Message';
            toggleBtn.style.background = '#6f25ce';
            toggleBtn.style.color = '#fff';
            toggleBtn.style.border = "none";
            emojiPicker.style.display = 'none';
            isChatOpen = false;
        }
    });

    sendIcon.addEventListener('click', sendMessageAdmin);
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            sendMessageAdmin();
        }
    });
}
