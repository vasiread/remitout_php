document.addEventListener("DOMContentLoaded", function () {
    // Initialize UI components that don't depend on documentUrls
    initializeSideBarTabs();
    initializeIndividualCards();
    initializeProgressRing();
    saveChangesFunctionality();
    initialisedocumentsCount();
    initialiseProfileUpload();
    initialiseSeventhcolumn();
    initialiseSeventhAdditionalColumn();
    initialiseEightcolumn();
    initialiseNinthcolumn();
    initialiseTenthcolumn();
    initializeSimpleChat();

    // Fetch all URLs first
    Promise.all([initialiseProfileView(), initialiseAllViews()])
        .then(() => {
            console.log("All URLs fetched successfully!", documentUrls);

            // Initialize document upload/preview functions after URLs are fetched
            initializeKycDocumentUpload();
            initializeMarksheetUpload();
            initializeSecuredAdmissionDocumentUpload();
            initializeWorkExperienceDocumentUpload();
            initializeCoBorrowerDocumentUpload();
        })
        .catch((error) => {
            console.error("Error during initialization:", error);
        });

    const courseDetailsElement = document.getElementById(
        "course-details-container"
    );
    const courseDetails = JSON.parse(
        courseDetailsElement.getAttribute("data-course-details")
    );
    const personalDetails = JSON.parse(
        courseDetailsElement.getAttribute("data-personal-details")
    );

    // Now you can use courseDetails and personalDetails in your JS
    console.log(courseDetails, personalDetails);

    let planToStudy = courseDetails[0]["plan-to-study"].replace(/[\[\]"]/g, "");
    let selectedCountries = planToStudy.split(/\s*,\s*/);

    document.getElementById("plan-to-study-edit").value = planToStudy;

    document
        .querySelectorAll('input[name="study-location-edit"]')
        .forEach((checkbox) => {
            if (selectedCountries.includes(checkbox.value)) {
                checkbox.checked = true;
            }
        });

    const otherCheckbox = document.querySelector("#other-checkbox-edit");
    const addCountryBox = document.querySelector(".add-country-box-edit");
    const customCountryInput = document.querySelector("#country-edit");

    if (selectedCountries.includes("Other")) {
        otherCheckbox.checked = true;
        addCountryBox.style.display = "block";
    } else {
        addCountryBox.style.display = "none";
    }

    otherCheckbox.addEventListener("change", () => {
        if (otherCheckbox.checked) {
            addCountryBox.style.display = "block";
        } else {
            addCountryBox.style.display = "none";
            customCountryInput.value = "";
        }
    });
    document.querySelector(".mailnbfcbutton").addEventListener("click", () => {
        sendDocumenttoEmail();
    });
});

const initializeSideBarTabs = () => {
    const sideBarTopItems = document.querySelectorAll(
        ".studentdashboardprofile-sidebarlists-top li"
    );
    const lastTabHiddenDiv = document.querySelector(
        ".studentdashboardprofile-trackprogress"
    );
    const lastTabVisibleDiv = document.querySelector(
        ".studentdashboardprofile-myapplication"
    );
    const dynamicHeader = document.getElementById("loanproposals-header");
    const individualCards = document.querySelectorAll(
        ".indivudalloanstatus-cards"
    );
    const communityJoinCard = document.querySelector(
        ".studentdashboardprofile-communityjoinsection"
    );
    const profileStatusCard = document.querySelector(
        ".personalinfo-profilestatus"
    );
    const profileImgEditIcon = document.querySelector(
        ".studentdashboardprofile-profilesection .fa-pen-to-square"
    );
    const educationEditSection = document.querySelector(
        ".studentdashboardprofile-educationeditsection"
    );
    const testScoresEditSection = document.querySelector(
        ".studentdashboardprofile-testscoreseditsection"
    );

    sideBarTopItems.forEach((item, index) => {
        item.addEventListener("click", () => {
            sideBarTopItems.forEach((i) => i.classList.remove("active"));
            item.classList.add("active");

            if (index === 1) {
                lastTabHiddenDiv.style.display = "flex";
                lastTabVisibleDiv.style.display = "none";
                communityJoinCard.style.display = "flex";
                profileStatusCard.style.display = "block";
                profileImgEditIcon.style.display = "none";
                educationEditSection.style.display = "none";
                testScoresEditSection.style.display = "none";

                individualCards.forEach((card) => {
                    const triggeredMessageButton = card.querySelector(
                        ".individual-bankmessages .triggeredbutton"
                    );
                    const groupButtonContainer = card.querySelector(
                        ".individual-bankmessages-buttoncontainer"
                    );

                    if (triggeredMessageButton && groupButtonContainer) {
                        triggeredMessageButton.style.display = "flex";
                        groupButtonContainer.style.display = "none";
                    }
                });
                dynamicHeader.textContent = "Inbox";
            } else if (index === 0) {
                lastTabHiddenDiv.style.display = "flex";
                lastTabVisibleDiv.style.display = "none";
                communityJoinCard.style.display = "flex";
                profileStatusCard.style.display = "block";
                profileImgEditIcon.style.display = "none";
                educationEditSection.style.display = "none";
                testScoresEditSection.style.display = "none";

                individualCards.forEach((card) => {
                    const triggeredMessageButton = card.querySelector(
                        ".individual-bankmessages .triggeredbutton"
                    );
                    const groupButtonContainer = card.querySelector(
                        ".individual-bankmessages-buttoncontainer"
                    );
                    const individualBankMessageInput = card.querySelector(
                        ".individual-bankmessage-input"
                    );

                    card.style.height = "95px";
                    if (individualBankMessageInput) {
                        individualBankMessageInput.style.display = "none";
                    }
                    if (triggeredMessageButton && groupButtonContainer) {
                        triggeredMessageButton.style.display = "none";
                        groupButtonContainer.style.display = "flex";
                    }
                });
                dynamicHeader.textContent = "Loan Proposals";
            } else if (index === 2) {
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
};

function sendDocumenttoEmail(event) {
    console.log(event);

    const uniqueIdElement = document.querySelector(".personal_info_id");
    const userId = uniqueIdElement
        ? uniqueIdElement.textContent || uniqueIdElement.innerHTML
        : null;

    const emailElement = document.querySelector("#referenceEmailId p");
    const email = emailElement
        ? emailElement.textContent || emailElement.innerHTML
        : null;

    const userNameElement = document.querySelector("#referenceNameId p");
    const name = userNameElement
        ? userNameElement.textContent || userNameElement.innerHTML
        : null;

    if (userId && email && name) {
        console.log("Unique ID:", userId, "Email:", email, "Name:", name);
    } else {
        console.error("Error: Could not retrieve unique ID, email, or name.");
        return;
    }

    const sendDocumentsRequiredDetails = {
        userId: userId,
        email: email,
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

            addUserToRequest(userId);
        })
        .catch((error) => {
            console.error("Error:", error);
        });

    console.log("Sending Data:", sendDocumentsRequiredDetails);
}

function addUserToRequest(userId) {
    console.log(userId);

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
const documentUrls = {};

const endpoints = [
    {
        url: "/retrieve-file",
        selector: ".uploaded-aadhar-name",
        fileType: "aadhar-card-name",
    },
    {
        url: "/retrieve-file",
        selector: ".uploaded-pan-name",
        fileType: "pan-card-name",
    },
    {
        url: "/retrieve-file",
        selector: ".passport-name-selector",
        fileType: "passport-card-name",
    },
    {
        url: "/retrieve-file",
        selector: ".sslc-marksheet",
        fileType: "tenth-grade-name",
    },
    {
        url: "/retrieve-file",
        selector: ".hsc-marksheet",
        fileType: "twelfth-grade-name",
    },
    {
        url: "/retrieve-file",
        selector: ".graduation-marksheet",
        fileType: "graduation-grade-name",
    },
    {
        url: "/retrieve-file",
        selector: ".sslc-grade",
        fileType: "secured-tenth-name",
    },
    {
        url: "/retrieve-file",
        selector: ".hsc-grade",
        fileType: "secured-twelfth-name",
    },
    {
        url: "/retrieve-file",
        selector: ".graduation-grade",
        fileType: "secured-graduation-name",
    },
    {
        url: "/retrieve-file",
        selector: ".experience-letter",
        fileType: "work-experience-experience-letter",
    },
    {
        url: "/retrieve-file",
        selector: ".salary-slip",
        fileType: "work-experience-monthly-slip",
    },
    {
        url: "/retrieve-file",
        selector: ".office-id",
        fileType: "work-experience-office-id",
    },
    {
        url: "/retrieve-file",
        selector: ".joining-letter",
        fileType: "work-experience-joining-letter",
    },
    {
        url: "/retrieve-file",
        selector: ".coborrower-pancard",
        fileType: "co-pan-card-name",
    },
    {
        url: "/retrieve-file",
        selector: ".coborrower-aadharcard",
        fileType: "co-aadhar-card-name",
    },
    {
        url: "/retrieve-file",
        selector: ".coborrower-addressproof",
        fileType: "co-addressproof",
    },
];

const initialiseAllViews = () => {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    const userIdElement = document.querySelector(
        ".personalinfo-secondrow .personal_info_id"
    );
    const userId = userIdElement ? userIdElement.textContent.trim() : "";

    if (!csrfToken || !userId) {
        console.error("CSRF token or User ID is missing");
        return Promise.reject("CSRF token or User ID is missing");
    }

    const fetchWithUrl = ({ url, selector, fileType }) => {
        return fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                userId: userId,
                fileType: fileType,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.fileUrl) {
                    // Store the URL in documentUrls
                    documentUrls[fileType] = data.fileUrl;
                    console.log(`Stored ${fileType}: ${data.fileUrl}`);

                    // Update the UI with the file name
                    const fileName = data.fileUrl.split("/").pop();
                    const element = document.querySelector(selector);
                    if (element) {
                        element.textContent = fileName;
                        console.log(`Updated UI for ${fileType}: ${fileName}`);
                    } else {
                        console.log(
                            `Element not found for selector: ${selector}`
                        );
                    }
                } else {
                    console.log(`No fileUrl returned for ${fileType}`, data);
                }
            })
            .catch((error) => {
                console.error(`Error fetching ${fileType}:`, error);
            });
    };

    return Promise.all(endpoints.map(fetchWithUrl)).then(() => {
        console.log(
            "All document URLs fetched and stored successfully!",
            documentUrls
        );
    });
};

const triggerEditButton = () => {
    const disabledInputs = document.querySelectorAll(
        ".studentdashboardprofile-myapplication input[disabled]"
    );
    disabledInputs.forEach((inputItems) => {
        inputItems.removeAttribute("disabled");
    });

    // Enable custom radio buttons (if disabled)
    const disabledRadios = document.querySelectorAll(
        '.studentdashboardprofile-myapplication input[type="radio"][disabled]'
    );
    disabledRadios.forEach((radio) => {
        radio.removeAttribute("disabled");
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

        profileImageInput.addEventListener("change", function (event) {
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
            console.log(fileType + "." + fileName);

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
                        console.log("File uploaded successfully", data);
                        const imgElement =
                            document.querySelector("#profile-photo-id");
                        imgElement.src = data.file_path;
                        const navImageElement = document.querySelector(
                            "#nav-profile-photo-id"
                        );
                        navImageElement.src = data.file_path;
                        console.log(data);
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
    const section = document.querySelector(".ninthcolumn-firstsection");

    section.addEventListener("click", function () {
        if (section.style.height === "") {
            section.style.height = "fit-content";
        } else {
            section.style.height = "";
        }
    });
};
const initialiseTenthcolumn = () => {
    const section = document.querySelector(".tenthcolumn-firstsection");
    section.addEventListener("click", function () {
        if (section.style.height === "") {
            section.style.height = "fit-content";
        } else {
            section.style.height = "";
        }
    });
};

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
                console.log("Profile Picture URL:", data.fileUrl);
                const imgElement = document.querySelector("#profile-photo-id");
                imgElement.src = data.fileUrl;
            } else {
                console.error("Error: No URL returned from the server", data);
            }
        })
        .catch((error) => {
            console.error("Error retrieving profile picture", error);
        });
};

const initializeIndividualCards = () => {
    const individualCards = document.querySelectorAll(
        ".indivudalloanstatus-cards"
    );

    individualCards.forEach((card) => {
        const triggeredMessageButton = card.querySelector(
            ".individual-bankmessages .triggeredbutton"
        );
        const individualBankMessageInput = card.querySelector(
            ".individual-bankmessage-input"
        );

        if (triggeredMessageButton) {
            triggeredMessageButton.addEventListener("click", () => {
                const isExpanded = card.style.height === "95px";

                individualCards.forEach((otherCard) => {
                    otherCard.style.height = "fit-content";
                    const otherMessageInput = otherCard.querySelector(
                        ".individual-bankmessage-input"
                    );
                    if (otherMessageInput) {
                        otherMessageInput.style.display = "none";
                    }
                });

                if (isExpanded) {
                    card.style.height = "95px";
                    individualBankMessageInput.style.display = "none";
                } else {
                    card.style.height = "fit-content";
                    individualBankMessageInput.style.display = "flex";
                }
            });
        }
    });
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
                .replace("-card", ""); // e.g., "aadhar-card"
            const fileTypeKey = `${documentType}-card-name`;
            const fileUrl = documentUrls[fileTypeKey];
            const fileNameElement = card.querySelector(
                `.uploaded-${documentType}-name`
            );
            const fileName = fileNameElement
                ? fileNameElement.textContent
                : "Document.pdf";

            console.log(`Previewing ${documentType}: ${fileUrl}`);

            // Check if a preview is already active
            if (eyeIcon.classList.contains("preview-active")) {
                const previewWrapper = document.querySelector(
                    ".pdf-preview-wrapper"
                );
                const overlay = document.querySelector(".pdf-preview-overlay");
                if (previewWrapper) previewWrapper.remove();
                if (overlay) overlay.remove();
                eyeIcon.classList.remove("preview-active");
                eyeIcon.src = "/assets/images/visibility.png"; // Update with your actual path
                return;
            }

            // If no file URL, show an alert
            if (!fileUrl) {
                alert("No document found to preview.");
                return;
            }

            // Create the preview modal
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
                eyeIcon.src = "/assets/images/visibility.png"; // Update with your actual path
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
            eyeIcon.src = "/assets/images/close.png"; // Update with your actual path
        });
    });
};

const initializeMarksheetUpload = () => {
    const individualMarksheetDocumentsUpload = document.querySelectorAll(
        ".individualmarksheetdocuments"
    );

    individualMarksheetDocumentsUpload.forEach((card) => {
        const eyeIcon = card.querySelector(".fa-eye");

        if (!eyeIcon) {
            console.error("Eye icon not found in card:", card);
            return;
        }

        eyeIcon.addEventListener("click", function (event) {
            event.stopPropagation();

            // Get the document type from the eye icon's ID
            const documentType = eyeIcon.id
                .replace("view-", "")
                .replace("-card", "");

            // Construct the fileType key used in documentUrls based on the class name
            let fileTypeKey;
            if (card.querySelector(".sslc-marksheet")) {
                fileTypeKey = "tenth-grade-name";
            } else if (card.querySelector(".hsc-marksheet")) {
                fileTypeKey = "twelfth-grade-name";
            } else if (card.querySelector(".graduation-marksheet")) {
                fileTypeKey = "graduation-grade-name";
            }

            // Get the URL from documentUrls
            const fileUrl = documentUrls[fileTypeKey];
            const fileNameElement = card.querySelector(
                `.${fileTypeKey.replace("-name", "-marksheet")}`
            );
            const fileName = fileNameElement
                ? fileNameElement.textContent
                : "Document.pdf";

            console.log(`Previewing marksheet (${fileTypeKey}):`, fileUrl);

            if (eyeIcon.classList.contains("preview-active")) {
                const previewWrapper = document.querySelector(
                    ".pdf-preview-wrapper"
                );
                const overlay = document.querySelector(".pdf-preview-overlay");
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

            // Create the preview modal
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

//  document.addEventListener('DOMContentLoaded', function () {
//     initializeSecuredAdmissionDocumentUpload();
// });

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

// Helper function to truncate file names
function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;

    const extension = fileName.slice(fileName.lastIndexOf("."));
    const name = fileName.slice(0, fileName.lastIndexOf("."));

    return name.slice(0, 16) + "..." + extension;
}

// Initialize the document uploads when the page loads
// document.addEventListener('DOMContentLoaded', function () {
//     initializeWorkExperienceDocumentUpload();
// });

//co-borrower document
const initializeCoBorrowerDocumentUpload = () => {
    const coBorrowerDocuments = document.querySelectorAll(
        ".individual-coborrower-kyc-documents"
    );

    coBorrowerDocuments.forEach((card) => {
        const eyeIcon = card.querySelector(".fa-eye");

        if (!eyeIcon) {
            console.error("Eye icon not found in card:", card);
            return;
        }

        eyeIcon.addEventListener("click", function (event) {
            event.stopPropagation();

            // Determine document type based on which element exists
            let fileTypeKey;
            if (card.querySelector(".coborrower-pancard")) {
                fileTypeKey = "co-pan-card-name";
            } else if (card.querySelector(".coborrower-aadharcard")) {
                fileTypeKey = "co-aadhar-card-name";
            } else if (card.querySelector(".coborrower-addressproof")) {
                fileTypeKey = "co-addressproof";
            }

            // Get the URL from documentUrls
            const fileUrl = documentUrls[fileTypeKey];
            const fileNameElement = card.querySelector(
                `.${fileTypeKey
                    .replace("co-", "coborrower-")
                    .replace("-name", "")}`
            );
            const fileName = fileNameElement
                ? fileNameElement.textContent
                : "Document.pdf";

            console.log(
                `Previewing co-borrower document (${fileTypeKey}):`,
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

// Helper function to truncate file names
function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;

    const extension = fileName.slice(fileName.lastIndexOf("."));
    const name = fileName.slice(0, fileName.lastIndexOf("."));

    return name.slice(0, 16) + "..." + extension;
}

// Initialize the document uploads when the page loads
// document.addEventListener('DOMContentLoaded', function () {
//     initializeCoBorrowerDocumentUpload();
// });

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
    const radius = 52;
    const circumference = 2 * Math.PI * radius;
    const percentage = 0.01;
    const offset = circumference * (1 - percentage);
    const progressRingFill = document.querySelector(".progress-ring-fill");
    const progressText = document.querySelector(".progress-ring-text");

    progressRingFill.style.strokeDasharray = `${circumference} ${circumference}`;
    progressRingFill.style.strokeDashoffset = offset;
    progressText.textContent = `${Math.round(percentage * 100)}%`;
};

const initialisedocumentsCount = () => {
    const userIdElement = document.querySelector(
        ".personalinfo-secondrow .personal_info_id"
    );

    const userId = userIdElement ? userIdElement.textContent : "";

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
        .then((response) => response.json())
        .then((data) => {
            if (data) {
                console.log(data.documentscount);
                const documentCountText = document.querySelector(
                    ".profilestatus-graph-secondsection .profilestatus-noofdocuments-section p"
                );
                // if(data.documentscount<10){
                if (
                    data.documentscount < 10 &&
                    data.documentscound >= 0 &&
                    documentCountText &&
                    data &&
                    data.documentscount !== undefined
                ) {
                    documentCountText.textContent = "0" + data.documentscount;
                } else if (data.documentscount < 0) {
                    documentCountText.textContent = "00";
                } else if (
                    data.documentscount >= 10 &&
                    documentCountText &&
                    data &&
                    data.documentscount !== undefined
                ) {
                    documentCountText.textContent = data.documentscount;
                } else {
                    console.error("Element not found or data is invalid");
                }

                // }
                // else{
                // documentCountText.textContent = "0" + data.documentscount;

                // }
            } else if (data.error) {
                console.error(data.error);
            }
        })
        .catch((error) => {
            console.error(error);
        });
};

const triggerSave = (event) => {
    console.log(event);
};
document.querySelectorAll('input[name="education-level"]').forEach((radio) => {
    radio.addEventListener("change", function () {
        var otherInput = document.getElementById("otherDegreeInput");
        if (this.value === "Others" && this.checked) {
            otherInput.disabled = false;
        } else {
            otherInput.disabled = true;
        }
    });
});

const saveChangesFunctionality = () => {
    let isEditing = false;
    const saveChangesButton = document.querySelector(
        ".personalinfo-firstrow button"
    );
    const savedMsg = document.querySelector(
        ".studentdashboardprofile-myapplication .myapplication-firstcolumn .personalinfo-firstrow .saved-msg"
    );
    const personalDivContainer = document.querySelector(
        ".personalinfo-secondrow"
    );
    const personalDivContainerEdit = document.querySelector(
        ".personalinfosecondrow-editsection"
    );
    const academicsMarksDivEdit = document.querySelector(
        ".testscoreseditsection-secondrow-editsection"
    );
    const academicsMarksDiv = document.querySelector(
        ".testscoreseditsection-secondrow"
    );

    const planToStudy = document.getElementById("plan-to-study-edit");

    const toggleSaveState = () => {
        isEditing = true;

        saveChangesButton.textContent = "Save";
        saveChangesButton.style.backgroundColor = "rgba(111, 37, 206, 1)";
        saveChangesButton.style.color = "#fff";

        personalDivContainerEdit.style.display = "flex";
        personalDivContainer.style.display = "none";
        academicsMarksDivEdit.style.display = "flex";
        academicsMarksDiv.style.display = "none";
    };

    if (saveChangesButton) {
        saveChangesButton.textContent = "Edit";
        saveChangesButton.style.backgroundColor = "transparent";
        saveChangesButton.style.color = "#260254";

        saveChangesButton.addEventListener("click", (event) => {
            isEditing = !isEditing;

            if (isEditing) {
                toggleSaveState(); // Call toggleSaveState function when entering edit mode
            } else {
                saveChangesButton.textContent = "Edit";
                saveChangesButton.style.backgroundColor = "transparent";
                saveChangesButton.style.color = "#260254";
                personalDivContainer.style.display = "flex";
                personalDivContainerEdit.style.display = "none";
                academicsMarksDivEdit.style.display = "none";
                academicsMarksDiv.style.display = "flex";

                const editedName = document.querySelector(
                    ".personalinfosecondrow-editsection .personal_info_name input"
                ).value;
                const editedPhone = document.querySelector(
                    ".personalinfosecondrow-editsection .personal_info_phone input"
                ).value;
                const editedEmail = document.querySelector(
                    ".personalinfosecondrow-editsection .personal_info_email input"
                ).value;
                const editedState = document.querySelector(
                    ".personalinfosecondrow-editsection .personal_info_state input"
                ).value;
                const iletsScore = document.querySelector(
                    ".testscoreseditsection-secondrow-editsection .ilets_score"
                ).value;
                const greScore = document.querySelector(
                    ".testscoreseditsection-secondrow-editsection .gre_score"
                ).value;
                const tofelScore = document.querySelector(
                    ".testscoreseditsection-secondrow-editsection .tofel_score"
                ).value;

                // Fetch old values of "Plan to Study"
                const oldPlanToStudy =
                    document.getElementById("plan-to-study-edit").value;
                const oldPlanToStudyArray = oldPlanToStudy
                    ? oldPlanToStudy.split(",").map((item) => item.trim())
                    : [];

                // Get current values from checkboxes (selected options)
                const checkboxes = document.querySelectorAll(
                    'input[name="study-location-edit"]:checked'
                );
                let selectedCountries = Array.from(checkboxes).map(
                    (checkbox) => checkbox.value
                );

                // Check if there's a custom country input and add it to the selected countries
                const customCountry = document
                    .getElementById("country-edit")
                    .value.trim();
                if (customCountry) {
                    selectedCountries.push(customCountry);
                }

                selectedCountries = selectedCountries.filter(
                    (item) => item.toLowerCase() !== "others"
                );

                // Filter out 'Others' (case-insensitive) from oldPlanToStudyArray
                const finalPlanToStudy = oldPlanToStudyArray.filter(
                    (item) => item.toLowerCase() !== "others"
                );

                // Merge old and new arrays, ensuring no duplicates
                let mergedPlanToStudy = [
                    ...new Set([...finalPlanToStudy, ...selectedCountries]),
                ];

                // Filter out 'Others' (case-insensitive) again from the final merged array
                mergedPlanToStudy = mergedPlanToStudy.filter(
                    (item) => item.toLowerCase() !== "other"
                );

                const courseDuration = document.querySelector(
                    ".myapplication-fourthcolumn-additional input"
                ).value;
                const loanAmount = document.querySelector(
                    ".myapplication-fourthcolumn input"
                ).value;
                const referralCode = document.querySelector(
                    ".myapplication-fifthcolumn input"
                ).value;

                const userIdElement = document.querySelector(
                    ".personalinfo-secondrow .personal_info_id"
                );
                const userId = userIdElement ? userIdElement.textContent : "";

                console.log(
                    editedName,
                    editedPhone,
                    editedEmail,
                    editedState,
                    userId
                );

                const selectedDegree = document.querySelector(
                    'input[name="education-level"]:checked'
                ).value;
                const otherDegreeInput =
                    document.getElementById("otherDegreeInput").value;

                const updatedDegreeType =
                    selectedDegree === "Others"
                        ? otherDegreeInput
                        : selectedDegree;

                const updatedData = {
                    degreeType: updatedDegreeType,
                };

                // Updated data object, including the merged "Plan to Study" values
                const updatedInfos = {
                    editedName: editedName,
                    editedPhone: editedPhone,
                    editedEmail: editedEmail,
                    editedState: editedState,
                    iletsScore: iletsScore,
                    greScore: greScore,
                    tofelScore: tofelScore,
                    planToStudy: mergedPlanToStudy, // Final merged old and new values
                    courseDuration: courseDuration,
                    loanAmount: loanAmount,
                    referralCode: referralCode,
                    degreeType: updatedData.degreeType,
                    userId: userId,
                };

                console.log(updatedInfos);

                fetch("/from-profileupdate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify(updatedInfos),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log("Response Data:", data);
                        if (editedName) {
                            document.querySelector(
                                "#referenceNameId p"
                            ).textContent = editedName;
                            document.getElementById(
                                "personal_state_id"
                            ).textContent = editedState;
                        }

                        if (data.errors) {
                            console.error("Validation errors:", data.errors);
                        } else {
                            console.log("Success", data);
                        }
                    })
                    .catch((error) => {
                        console.error("Error", error);
                    });
            }
        });
    }

    const degreeRadioButtons = document.querySelectorAll(
        'input[name="education-level"]'
    );
    degreeRadioButtons.forEach((button) => {
        button.addEventListener("change", toggleSaveState);
    });
};

//chat functionality

function initializeSimpleChat() {
    // Select all chat containers
    const chatContainers = document.querySelectorAll(
        ".individual-bankmessage-input"
    );

    if (chatContainers.length === 0) return;

    chatContainers.forEach((chatContainer, index) => {
        // Create unique identifier for this chat instance
        const chatId = `loan-chat-${index}`;
        chatContainer.setAttribute("data-chat-id", chatId);

        // Find parent container
        const parentContainer = chatContainer.closest(
            ".indivudalloanstatus-cards"
        );
        const messageButton = parentContainer
            ? parentContainer.querySelector(".triggeredbutton")
            : null;

        // Hide chat input by default
        chatContainer.style.display = "none";

        // Create messages wrapper if it doesn't exist
        let messagesWrapper = parentContainer
            ? parentContainer.querySelector(
                  `.messages-wrapper[data-chat-id="${chatId}"]`
              )
            : null;

        if (!messagesWrapper) {
            messagesWrapper = document.createElement("div");
            messagesWrapper.classList.add("messages-wrapper");
            messagesWrapper.setAttribute("data-chat-id", chatId);
            messagesWrapper.style.cssText = `
                display: none;
                flex-direction: column;
                width: 100%;  
                font-size: 14px;
                color: #666;
                line-height: 1.5; 
                overflow-y: auto;
                max-height: auto;
                background: #fff;
                font-family: 'Poppins', sans-serif;
                margin-bottom: 10px;
            `;
            chatContainer.parentNode.insertBefore(
                messagesWrapper,
                chatContainer
            );
        }

        // Create clear button
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
        clearButton.addEventListener("click", function () {
            clearChat(chatId);
        });

        clearButtonContainer.appendChild(clearButton);
        messagesWrapper.parentNode.insertBefore(
            clearButtonContainer,
            messagesWrapper
        );

        // Get elements within the container
        const messageInput = chatContainer.querySelector("input[type='text']");
        const sendButton = chatContainer.querySelector(".send-img");
        const smileIcon = chatContainer.querySelector(".fa-face-smile");
        const paperclipIcon = chatContainer.querySelector(".fa-paperclip");

        // Object to store file references
        const fileStorage = {};

        // Function to show chat
        function showChat() {
            messagesWrapper.style.display = "flex";
            chatContainer.style.display = "flex";
            clearButtonContainer.style.display = "flex";

            // Adjust parent container height if needed
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
            messagesWrapper.style.display = "none";
            chatContainer.style.display = "none";
            clearButtonContainer.style.display = "none";

            // Reset parent container height if needed
            if (parentContainer) {
                parentContainer.style.height = "95px";
            }

            // Update button text if needed
            if (messageButton) {
                messageButton.textContent = "Message";
            }
        }

        // Function to remove a specific message
        function removeMessage(messageElement, messageId) {
            if (messageElement && messagesWrapper.contains(messageElement)) {
                messagesWrapper.removeChild(messageElement);

                // Remove from localStorage if needed
                const messages = JSON.parse(
                    localStorage.getItem(`messages-${chatId}`) || "[]"
                );
                const fileMessages = JSON.parse(
                    localStorage.getItem(`file-messages-${chatId}`) || "[]"
                );

                // Remove file from storage
                if (messageId && fileStorage[messageId]) {
                    delete fileStorage[messageId];

                    // Remove from file messages storage
                    const updatedFileMessages = fileMessages.filter(
                        (fm) => fm.id !== messageId
                    );
                    localStorage.setItem(
                        `file-messages-${chatId}`,
                        JSON.stringify(updatedFileMessages)
                    );
                }
            }
        }

        // Function to clear chat
        function clearChat(chatId) {
            // Clear messages from UI
            while (messagesWrapper.firstChild) {
                messagesWrapper.removeChild(messagesWrapper.firstChild);
            }

            // Clear from localStorage
            localStorage.removeItem(`messages-${chatId}`);
            localStorage.removeItem(`file-messages-${chatId}`);

            // Clear file storage
            Object.keys(fileStorage).forEach((key) => {
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
        function toggleChat() {
            if (messagesWrapper.style.display === "none") {
                showChat();
            } else {
                hideChat();
            }
        }

        // Add click event to message button
        if (messageButton) {
            messageButton.addEventListener("click", function (e) {
                e.preventDefault();
                toggleChat();
            });
        }

        // Send message function
        function sendMessage() {
            if (!messageInput) return;

            const content = messageInput.value.trim();
            if (content) {
                showChat(); // Show chat when sending message

                // Create message element
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
                `;
                messageContent.textContent = content;

                messageElement.appendChild(messageContent);
                messagesWrapper.appendChild(messageElement);

                // Clear input and scroll to bottom
                messageInput.value = "";
                messagesWrapper.scrollTop = messagesWrapper.scrollHeight;

                // Save message
                saveMessage(content, chatId);
            }
        }

        // Event listeners for input
        if (messageInput) {
            messageInput.addEventListener("keypress", function (e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                    sendMessage();
                }
            });
        }

        // Add click event to send button
        if (sendButton) {
            sendButton.addEventListener("click", function (e) {
                e.preventDefault();
                sendMessage();
            });
        }

        // Initialize emoji picker
        if (smileIcon) {
            smileIcon.addEventListener("click", function (e) {
                e.stopPropagation();
                const emojis = ["😊", "👍", "😀", "🙂", "👋", "❤️", "👌", "✨"];

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

                emojis.forEach((emoji) => {
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
                fileInput.accept = ".pdf,.jpeg,.png,.jpg";
                fileInput.style.display = "none";

                fileInput.onchange = (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        showChat();
                        const fileName = file.name;
                        const fileSize = (file.size / 1024 / 1024).toFixed(2);
                        const fileId = `file-${Date.now()}-${Math.random()
                            .toString(36)
                            .substr(2, 9)}`;

                        // Store file reference for later download
                        fileStorage[fileId] = file;

                        // Create message element
                        const messageElement = document.createElement("div");
                        messageElement.setAttribute("data-file-id", fileId);
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
                            <span>${fileName} (${fileSize} MB)</span>
                        `;
                        downloadLink.addEventListener("click", function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            // Create download link for the file
                            const url = URL.createObjectURL(
                                fileStorage[fileId]
                            );
                            const tempLink = document.createElement("a");
                            tempLink.href = url;
                            tempLink.download = fileName;
                            document.body.appendChild(tempLink);
                            tempLink.click();
                            document.body.removeChild(tempLink);
                            URL.revokeObjectURL(url);
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
                        removeButton.addEventListener("click", function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            removeMessage(messageElement, fileId);
                        });

                        fileContent.appendChild(downloadLink);
                        fileContent.appendChild(removeButton);
                        messageElement.appendChild(fileContent);
                        messagesWrapper.appendChild(messageElement);
                        messagesWrapper.scrollTop =
                            messagesWrapper.scrollHeight;

                        // Save file message with ID
                        saveFileMessage(
                            {
                                id: fileId,
                                name: fileName,
                                size: fileSize,
                            },
                            chatId
                        );
                    }
                };

                document.body.appendChild(fileInput);
                fileInput.click();
                document.body.removeChild(fileInput);
            });
        }

        // Load saved messages
        const savedMessages = JSON.parse(
            localStorage.getItem(`messages-${chatId}`) || "[]"
        );
        if (savedMessages.length > 0) {
            savedMessages.forEach((content) => {
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
                `;
                messageContent.textContent = content;

                messageElement.appendChild(messageContent);
                messagesWrapper.appendChild(messageElement);
            });
        }
    });
}

function saveMessage(content, chatId) {
    const messages = JSON.parse(
        localStorage.getItem(`messages-${chatId}`) || "[]"
    );
    messages.push(content);
    localStorage.setItem(`messages-${chatId}`, JSON.stringify(messages));
}

// Initialize the chat when the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    initializeSimpleChat();
});

// Add this function to properly save file messages
function saveFileMessage(fileData, chatId) {
    const fileMessages = JSON.parse(
        localStorage.getItem(`file-messages-${chatId}`) || "[]"
    );
    fileMessages.push(fileData);
    localStorage.setItem(
        `file-messages-${chatId}`,
        JSON.stringify(fileMessages)
    );
}

// Modify the load saved messages section in initializeSimpleChat() function
// Replace the existing "Load saved messages" section with this:
function loadSavedMessages() {
    // Load text messages
    const savedMessages = JSON.parse(
        localStorage.getItem(`messages-${chatId}`) || "[]"
    );

    // Load file messages
    const savedFileMessages = JSON.parse(
        localStorage.getItem(`file-messages-${chatId}`) || "[]"
    );

    // If there are any saved messages, we'll automatically show the chat area
    if (savedMessages.length > 0 || savedFileMessages.length > 0) {
        // Don't actually show the chat yet, just prepare to show it if user clicks
        if (messageButton) {
            messageButton.textContent = "Message";
        }
    }

    // Add text messages to UI
    if (savedMessages.length > 0) {
        savedMessages.forEach((content) => {
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
            `;
            messageContent.textContent = content;

            messageElement.appendChild(messageContent);
            messagesWrapper.appendChild(messageElement);
        });
    }

    // Add file messages to UI
    if (savedFileMessages.length > 0) {
        savedFileMessages.forEach((fileData) => {
            const messageElement = document.createElement("div");
            messageElement.setAttribute("data-file-id", fileData.id);
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
            downloadLink.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();

                // Alert user that the file needs to be re-uploaded after page refresh
                alert(
                    "File attachments cannot be retrieved after page refresh. Please re-upload the file if needed."
                );
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
            removeButton.addEventListener("click", function (e) {
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

// Call this function at the end of the chatContainer.forEach loop
loadSavedMessages();
