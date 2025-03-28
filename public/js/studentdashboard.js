document.addEventListener('DOMContentLoaded', function () {
    bankListedThroughNBFC();
    initializeIndividualCards();
    initializeKycDocumentUpload();
    initializeMarksheetUpload();
    initializeProgressRing();
    saveChangesFunctionality();
    initialisedocumentsCount();
    initialiseProfileUpload();
    initialiseProfileView();


    initialiseSeventhcolumn();
    initialiseSeventhAdditionalColumn();
    initialiseEightcolumn();
    initialiseNinthcolumn();
    initialiseTenthcolumn();
    const courseDetailsElement = document.getElementById('course-details-container');
    const courseDetails = JSON.parse(courseDetailsElement.getAttribute('data-course-details'));
    const personalDetails = JSON.parse(courseDetailsElement.getAttribute('data-personal-details'));

    let planToStudy = courseDetails[0]['plan-to-study'].replace(/[\[\]"]/g, '');
    let selectedCountries = planToStudy.split(/\s*,\s*/);

    document.getElementById("plan-to-study-edit").value = planToStudy;

    document.querySelectorAll('input[name="study-location-edit"]').forEach(checkbox => {
        if (selectedCountries.includes(checkbox.value)) {
            checkbox.checked = true;
        }
    });

    const otherCheckbox = document.querySelector('#other-checkbox-edit');
    const addCountryBox = document.querySelector('.add-country-box-edit');
    const customCountryInput = document.querySelector('#country-edit');

    if (selectedCountries.includes("Other")) {
        otherCheckbox.checked = true;
        addCountryBox.style.display = 'block';
    } else {
        addCountryBox.style.display = 'none';
    }

    otherCheckbox.addEventListener('change', () => {
        if (otherCheckbox.checked) {
            addCountryBox.style.display = 'block';
        } else {
            addCountryBox.style.display = 'none';
            customCountryInput.value = '';
        }
    });
    document.querySelector('.mailnbfcbutton').addEventListener('click', () => {
        sendDocumenttoEmail();
    });




});


const initializeSideBarTabs = () => {
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

    console.log('Initializing sidebar tabs...');


    sideBarTopItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            console.log('Clicked item index:', index);
            sideBarTopItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            if (index === 1) {
                console.log('Inbox tab selected');
                lastTabHiddenDiv.style.display = "flex";
                lastTabVisibleDiv.style.display = "none";
                communityJoinCard.style.display = "flex";
                profileStatusCard.style.display = "block";
                profileImgEditIcon.style.display = "none";
                educationEditSection.style.display = "none";
                testScoresEditSection.style.display = "none";


                individualCards.forEach((card) => {
                    console.log('Updating individual card', card);
                    const triggeredMessageButton = card.querySelector('.individual-bankmessages .triggeredbutton');
                    const groupButtonContainer = card.querySelector('.individual-bankmessages-buttoncontainer');

                    if (triggeredMessageButton && groupButtonContainer) {
                        triggeredMessageButton.style.display = "flex";
                        groupButtonContainer.style.display = "none";
                    }
                });


                dynamicHeader.textContent = "Inbox";
            } else if (index === 0) {
                console.log('Loan Proposals tab selected');
                lastTabHiddenDiv.style.display = "flex";
                lastTabVisibleDiv.style.display = "none";
                communityJoinCard.style.display = "flex";
                profileStatusCard.style.display = "block";
                profileImgEditIcon.style.display = "none";
                educationEditSection.style.display = "none";
                testScoresEditSection.style.display = "none";

                individualCards.forEach((card) => {
                    console.log('Updating card for loan proposals', card);
                    const triggeredMessageButton = card.querySelector('.individual-bankmessages .triggeredbutton');
                    const groupButtonContainer = card.querySelector('.individual-bankmessages-buttoncontainer');
                    const individualBankMessageInput = card.querySelector('.individual-bankmessage-input');

                    card.style.height = "fit-content";
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
                console.log('My Application tab selected');
                initialiseAllViews()
                    .then(() => {
                        console.log("All URLs fetched successfully!");
                    })
                    .catch((error) => {
                        console.error("Error during initialization:", error);
                    });
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
    console.log(event);

    const uniqueIdElement = document.querySelector('.personal_info_id');
    const userId = uniqueIdElement ? uniqueIdElement.textContent || uniqueIdElement.innerHTML : null;

    const emailElement = document.querySelector("#referenceEmailId p");
    const email = emailElement ? emailElement.textContent || emailElement.innerHTML : null;

    const userNameElement = document.querySelector("#referenceNameId p");
    const name = userNameElement ? userNameElement.textContent || userNameElement.innerHTML : null;

    if (userId && email && name) {
        console.log("Unique ID:", userId, "Email:", email, "Name:", name);
    } else {
        console.error("Error: Could not retrieve unique ID, email, or name.");
        return;
    }

    const sendDocumentsRequiredDetails = {
        userId: userId,
        email: email,
        name: name
    };

    fetch('/send-documents', {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(sendDocumentsRequiredDetails)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {

            console.log("Success:", data.message);


            addUserToRequest(userId);

        })
        .catch(error => {
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
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ userId: userId.trim() })
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

const endpoints = [
    { url: '/retrieve-file', selector: ".uploaded-aadhar-name", fileType: "aadhar-card-name" },
    { url: '/retrieve-file', selector: ".uploaded-pan-name", fileType: "pan-card-name" },
    { url: '/retrieve-file', selector: ".passport-name-selector", fileType: "passport-name" },
    { url: '/retrieve-file', selector: ".sslc-marksheet", fileType: "tenth-grade-name" },
    { url: '/retrieve-file', selector: ".hsc-marksheet", fileType: "twelfth-grade-name" },
    { url: '/retrieve-file', selector: ".graduation-marksheet", fileType: "graduation-grade-name" },
    { url: '/retrieve-file', selector: ".sslc-grade", fileType: "secured-tenth-name" },
    { url: '/retrieve-file', selector: ".hsc-grade", fileType: "secured-twelfth-name" },
    { url: '/retrieve-file', selector: ".graduation-grade", fileType: "secured-graduation-name" },
    { url: '/retrieve-file', selector: ".experience-letter", fileType: "work-experience-experience-letter" },
    { url: '/retrieve-file', selector: ".salary-slip", fileType: "work-experience-monthly-slip" },
    { url: '/retrieve-file', selector: ".office-id", fileType: "work-experience-office-id" },
    { url: '/retrieve-file', selector: ".joining-letter", fileType: "work-experience-joining-letter" },
    { url: '/retrieve-file', selector: ".coborrower-pancard", fileType: "co-pan-card-name" },
    { url: '/retrieve-file', selector: ".coborrower-aadharcard", fileType: "co-aadhar-card-name" },
    { url: '/retrieve-file', selector: ".coborrower-addressproof", fileType: "co-addressproof" },


];

const initialiseAllViews = () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
    const userId = userIdElement ? userIdElement.textContent.trim() : '';

    if (!csrfToken || !userId) {
        console.error("CSRF token or User ID is missing");
        return Promise.reject("CSRF token or User ID is missing");
    }

    const fetchWithUrl = ({ url, selector, fileType }) => {
        return fetch(url, {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                userId: userId,
                fileType: fileType,
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.fileUrl) {
                    const fileName = data.fileUrl.split('/').pop();
                    const element = document.querySelector(selector);
                    if (element) {
                        element.textContent = fileName; // Update the element with the file name
                        console.log(`Fetched ${fileType}:`, data.fileUrl);
                    } else {
                        console.log(`Element not found for selector: ${selector}`);
                    }
                } else {
                    console.log(`No fileUrl returned for ${fileType}`, data);
                }
            })
            .catch(error => {
                console.error(`Error fetching ${fileType}:`, error);
            });
    };

    return Promise.all(endpoints.map(fetchWithUrl));
};


const triggerEditButton = () => {
    const disabledInputs = document.querySelectorAll('.studentdashboardprofile-myapplication input');
    const defaultDisabledInput = document.getElementById("plan-to-study-edit");
    disabledInputs.forEach(inputItems => {
        inputItems.removeAttribute('disabled');
    });
    defaultDisabledInput.setAttribute('disabled')

    const disabledRadios = document.querySelectorAll('.studentdashboardprofile-myapplication input[type="radio"][disabled]');
    disabledRadios.forEach(radio => {
        radio.removeAttribute('disabled');
    });

    const otherDegreeInput = document.getElementById("otherDegreeInput");
    if (otherDegreeInput && otherDegreeInput.disabled) {
        otherDegreeInput.removeAttribute('disabled');
    }
};



const initialiseProfileUpload = () => {
    const editIcon = document.querySelector('.studentdashboardprofile-profilesection .fa-pen-to-square');
    const profileImageInput = document.querySelector('.studentdashboardprofile-profilesection .profile-upload');

    if (editIcon && profileImageInput) {
        editIcon.addEventListener('click', function () {
            profileImageInput.click();
        });


        profileImageInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (!file) {
                console.error('No file selected');
                return;
            }
            const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");

            const userId = userIdElement ? userIdElement.textContent : '';

            const fileName = file.name;
            const fileType = file.type;
            console.log(fileType + "." + fileName);

            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(fileType)) {
                console.error('Invalid file type. Only jpg, png, and gif are allowed.');
                return;
            }

            const formDetailsData = new FormData();
            formDetailsData.append('file', file);
            formDetailsData.append('userId', userId);

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }

            fetch('/upload-profile-picture', {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formDetailsData,
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            throw new Error(errorData.error || 'Network response was not ok');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data) {
                        console.log("File uploaded successfully", data);
                        const imgElement = document.querySelector("#profile-photo-id");
                        imgElement.src = data.file_path;
                        const navImageElement = document.querySelector("#nav-profile-photo-id");
                        navImageElement.src = data.file_path;
                        console.log(data)
                    } else {
                        console.error("Error: No URL returned from the server", data);
                    }
                })
                .catch(error => {
                    console.error("Error uploading file", error);
                });

        });
    }
};


const initialiseEightcolumn = () => {
    const section = document.querySelector('.eightcolumn-firstsection');

    section.addEventListener('click', function () {
        if (section.style.height === '') {
            section.style.height = 'fit-content';
        } else {
            section.style.height = '';
        }
    });
}
const initialiseSeventhcolumn = () => {
    const section = document.querySelector('.seventhcolum-firstsection');

    section.addEventListener('click', function () {
        if (section.style.height === '') {
            section.style.height = 'fit-content';
        } else {
            section.style.height = '';
        }
    });

}
const initialiseSeventhAdditionalColumn = () => {
    const section = document.querySelector('.seventhcolumn-additional-firstcolumn');

    section.addEventListener('click', function () {
        if (section.style.height === '') {
            section.style.height = 'fit-content';
        } else {
            section.style.height = '';
        }
    });

}
const initialiseNinthcolumn = () => {

    const section = document.querySelector('.ninthcolumn-firstsection');
    section.addEventListener('click', function () {
        if (section.style.height === '') {
            section.style.height = 'fit-content';
        } else {
            section.style.height = '';
        }
    });

}





const initialiseTenthcolumn = () => {
    const section = document.querySelector(".tenthcolumn-firstsection");
    section.addEventListener('click', function () {
        if (section.style.height === '') {
            section.style.height = 'fit-content';
        } else {
            section.style.height = '';
        }
    });

}

const initialiseProfileView = () => {

    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
    const userId = userIdElement ? userIdElement.textContent : '';

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (!csrfToken) {
        console.error('CSRF token not found');
        return;
    }

    fetch('/retrieve-profile-picture', {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ userId: userId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.fileUrl) {
                console.log("Profile Picture URL:", data.fileUrl);
                const imgElement = document.querySelector("#profile-photo-id");
                imgElement.src = data.fileUrl;
            } else {
                console.error("Error: No URL returned from the server", data);
            }
        })
        .catch(error => {
            console.error("Error retrieving profile picture", error);
        });
}


const initializeIndividualCards = () => {
    const individualCards = document.querySelectorAll('.indivudalloanstatus-cards');

    individualCards.forEach((card) => {
        const triggeredMessageButton = card.querySelector('.individual-bankmessages .triggeredbutton');
        const individualBankMessageInput = card.querySelector('.individual-bankmessage-input');

        if (triggeredMessageButton) {
            triggeredMessageButton.addEventListener('click', () => {
                const isExpanded = card.style.height === "95px";
                console.log(triggeredMessageButton)


                individualCards.forEach((otherCard) => {
                    otherCard.style.height = "fit-content";
                    const otherMessageInput = otherCard.querySelector('.individual-bankmessage-input');
                    if (otherMessageInput) {
                        otherMessageInput.style.display = "none";
                    }
                });

                if (isExpanded) {
                    card.style.height = "fit-content";
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
    const individualKycDocumentsUpload = document.querySelectorAll(".individualkycdocuments");

    individualKycDocumentsUpload.forEach((card) => {
        let uploadedFile = null;

        card.querySelector('.inputfilecontainer').addEventListener('click', function () {
            card.querySelector('#inputfilecontainer-real').click();
        });

        card.querySelector('#inputfilecontainer-real').addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (!file) return;

            console.log("Selected file: ", file);  // Debug log

            // Allowed file types
            const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
            const fileExtension = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();

            // Validate file type
            if (!allowedExtensions.includes(fileExtension)) {
                alert("Error: Only .jpg, .jpeg, .png, and .pdf files are allowed.");
                event.target.value = ''; // Clear the file input
                card.querySelector('.inputfilecontainer p').textContent = 'No file chosen';
                return;
            }

            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert("Error: File size exceeds 5MB limit.");
                event.target.value = ''; // Clear the file input
                card.querySelector('.inputfilecontainer p').textContent = 'No file chosen';
                return;
            }

            // Store the file and update UI
            uploadedFile = file;
            const truncatedFileName = truncateFileName(file.name);
            card.querySelector('.inputfilecontainer p').textContent = truncatedFileName;

            const fileSize = file.size < 1024 * 1024
                ? (file.size / 1024).toFixed(2) + ' KB'
                : (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            card.querySelector('.document-status').textContent = `${fileSize} Uploaded`;

            console.log("File uploaded:", uploadedFile);  // Debug log
        });



        card.querySelector('.fa-eye').addEventListener('click', function (event) {
            event.stopPropagation();
            const previewContainer = card.querySelector('.inputfilecontainer');
            const eyeIcon = this;

            if (eyeIcon.classList.contains('preview-active')) {
                const previewWrapper = document.querySelector('.pdf-preview-wrapper');
                if (previewWrapper) previewWrapper.remove();
                const overlay = document.querySelector('.pdf-preview-overlay');
                if (overlay) overlay.remove();
                eyeIcon.classList.remove('preview-active');
                eyeIcon.classList.replace('fa-times', 'fa-eye');
            } else {
                if (uploadedFile && uploadedFile.type === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create wrapper for the preview
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'pdf-preview-wrapper';
                        previewWrapper.style.cssText = `
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 90%;
                    height: 90vh;
                    background-color: white;
                    display: flex;
                    flex-direction: column;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    z-index: 1000;
                `;

                        // Add overlay
                        const overlay = document.createElement('div');
                        overlay.className = 'pdf-preview-overlay';
                        overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                `;

                        // Create header
                        const header = document.createElement('div');
                        header.style.cssText = `
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 8px 16px;
                    background-color: #1a1a1a;
                    color: white;
                    height: 40px;
                `;

                        // Left section with filename
                        const fileNameSection = document.createElement('div');
                        fileNameSection.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 8px;
                `;

                        const fileName = document.createElement('span');
                        fileName.textContent = uploadedFile.name;
                        fileName.style.cssText = `
                    color: white;
                    font-size: 14px;
                `;
                        fileNameSection.appendChild(fileName);

                        // Middle section with zoom controls
                        const zoomControls = document.createElement('div');
                        zoomControls.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                `;

                        const zoomOut = document.createElement('button');
                        zoomOut.innerHTML = '&#8722;';
                        const zoomIn = document.createElement('button');
                        zoomIn.innerHTML = '&#43;';

                        [zoomOut, zoomIn].forEach(btn => {
                            btn.style.cssText = `
                        background: none;
                        border: none;
                        color: white;
                        font-size: 18px;
                        cursor: pointer;
                        padding: 4px 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    `;
                        });

                        zoomControls.appendChild(zoomOut);
                        zoomControls.appendChild(zoomIn);

                        // Close button
                        const closeButton = document.createElement('button');
                        closeButton.innerHTML = '&#10005;';
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
                `;

                        const closePreview = () => {
                            previewWrapper.remove();
                            overlay.remove();
                            eyeIcon.classList.remove('preview-active');
                            eyeIcon.classList.replace('fa-times', 'fa-eye');
                        };

                        closeButton.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Assemble header
                        header.appendChild(fileNameSection);
                        header.appendChild(zoomControls);
                        header.appendChild(closeButton);

                        // Create iframe for PDF content
                        const iframe = document.createElement('iframe');
                        iframe.src = event.target.result;
                        iframe.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    border: none;
                    background-color: white;
                `;

                        // Assemble the preview
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(iframe);

                        // Add to document body
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);

                        // Add zoom functionality
                        let currentZoom = 100;
                        zoomIn.addEventListener('click', () => {
                            currentZoom += 10;
                            iframe.style.transform = `scale(${currentZoom / 100})`;
                            iframe.style.transformOrigin = 'top center';
                        });

                        zoomOut.addEventListener('click', () => {
                            currentZoom = Math.max(currentZoom - 10, 50);
                            iframe.style.transform = `scale(${currentZoom / 100})`;
                            iframe.style.transformOrigin = 'top center';
                        });

                        // Add keyboard shortcut for closing
                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closePreview();
                            }
                        });
                    };
                    reader.readAsDataURL(uploadedFile);
                    eyeIcon.classList.add('preview-active');
                    eyeIcon.classList.replace('fa-eye', 'fa-times');
                } else {
                    alert('Please upload a valid PDF file to preview.');
                }
            }
        });
    });
};

const initializeMarksheetUpload = () => {
    const individualMarksheetDocumentsUpload = document.querySelectorAll(".individualmarksheetdocuments");

    individualMarksheetDocumentsUpload.forEach((card) => {
        let uploadedFile = null;

        card.querySelector('.inputfilecontainer-marksheet').addEventListener('click', function () {
            card.querySelector('#inputfilecontainer-real-marksheet').click();
        });

        card.querySelector('#inputfilecontainer-real-marksheet').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                uploadedFile = file;
                card.querySelector('.inputfilecontainer-marksheet p').textContent = file.name;
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                const filesizeviewer = card.querySelector('.document-status');
                filesizeviewer.textContent = `${fileSizeMB} MB Uploaded`;
            }
        });

        card.querySelector('.fa-eye').addEventListener('click', function (event) {
            event.stopPropagation();
            const previewContainer = card.querySelector('.inputfilecontainer-marksheet');
            const eyeIcon = this;

            if (eyeIcon.classList.contains('preview-active')) {
                const previewWrapper = previewContainer.querySelector('.pdf-preview-wrapper');
                if (previewWrapper) previewWrapper.remove();
                eyeIcon.classList.remove('preview-active');
                eyeIcon.classList.replace('fa-times', 'fa-eye');
            } else {
                if (uploadedFile && uploadedFile.type === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create wrapper for the preview
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'pdf-preview-wrapper';
                        previewWrapper.style.cssText = `
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 90%;
                    height: 90vh;
                    background-color: white;
                    display: flex;
                    flex-direction: column;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    z-index: 1000;
                `;

                        // Add overlay
                        const overlay = document.createElement('div');
                        overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                `;

                        // Create header
                        const header = document.createElement('div');
                        header.style.cssText = `
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 8px 16px;
                    background-color: #1a1a1a;
                    color: white;
                    height: 40px;
                `;

                        // Left section with filename
                        const fileNameSection = document.createElement('div');
                        fileNameSection.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 8px;
                `;

                        const fileName = document.createElement('span');
                        fileName.textContent = uploadedFile.name;
                        fileName.style.cssText = `
                    color: white;
                    font-size: 14px;
                `;
                        fileNameSection.appendChild(fileName);

                        // Middle section with zoom controls
                        const zoomControls = document.createElement('div');
                        zoomControls.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                `;

                        const zoomOut = document.createElement('button');
                        zoomOut.innerHTML = '&#8722;';
                        const zoomIn = document.createElement('button');
                        zoomIn.innerHTML = '&#43;';

                        [zoomOut, zoomIn].forEach(btn => {
                            btn.style.cssText = `
                        background: none;
                        border: none;
                        color: white;
                        font-size: 18px;
                        cursor: pointer;
                        padding: 4px 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    `;
                        });

                        zoomControls.appendChild(zoomOut);
                        zoomControls.appendChild(zoomIn);

                        // Close button
                        const closeButton = document.createElement('button');
                        closeButton.innerHTML = '&#10005;';
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
                `;

                        const closePreview = () => {
                            previewWrapper.remove();
                            overlay.remove();
                            eyeIcon.classList.remove('preview-active');
                            eyeIcon.classList.replace('fa-times', 'fa-eye');
                        };

                        closeButton.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Assemble header
                        header.appendChild(fileNameSection);
                        header.appendChild(zoomControls);
                        header.appendChild(closeButton);

                        // Create iframe for PDF content
                        const iframe = document.createElement('iframe');
                        iframe.src = event.target.result;
                        iframe.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    border: none;
                    background-color: white;
                `;

                        // Assemble the preview
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(iframe);

                        // Add to document body
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);

                        // Add zoom functionality
                        let currentZoom = 100;
                        zoomIn.addEventListener('click', () => {
                            currentZoom += 10;
                            iframe.style.transform = `scale(${currentZoom / 100})`;
                            iframe.style.transformOrigin = 'top center';
                        });

                        zoomOut.addEventListener('click', () => {
                            currentZoom = Math.max(currentZoom - 10, 50);
                            iframe.style.transform = `scale(${currentZoom / 100})`;
                            iframe.style.transformOrigin = 'top center';
                        });

                        // Add keyboard shortcut for closing
                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closePreview();
                            }
                        });
                    };
                    reader.readAsDataURL(uploadedFile);
                    eyeIcon.classList.add('preview-active');
                    eyeIcon.classList.replace('fa-eye', 'fa-times');
                } else {
                    alert('Please upload a valid PDF file to preview.');
                }
            }
        });


    });
};

const initializeSecuredAdmissionDocumentUpload = () => {
    const securedAdmissionDocuments = document.querySelectorAll(".individual-secured-admission-documents");

    securedAdmissionDocuments.forEach((card, index) => {
        let uploadedFile = null;
        const inputId = card.querySelector('input[type="file"]').id;
        const documentTypeText = card.querySelector('.document-name').textContent.trim();

        // Get the specific preview icon
        const previewIconId = card.querySelector('.fa-eye').id;

        // Trigger file input when the container is clicked
        card.querySelector('.inputfilecontainer-secured-admission').addEventListener('click', function (event) {
            // Prevent triggering if clicking on the eye icon
            if (!event.target.classList.contains('fa-eye') && !event.target.id.startsWith('view-')) {
                card.querySelector(`#${inputId}`).click();
            }
        });

        // Handle file selection and validation
        card.querySelector(`#${inputId}`).addEventListener('change', function (event) {
            const file = event.target.files[0];

            // Ensure file is selected
            if (!file) return;

            console.log(`Selected file for ${documentTypeText}:`, file);

            const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
            const fileExtension = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();

            if (!allowedExtensions.includes(fileExtension)) {
                alert("Error: Only .jpg, .jpeg, .png, and .pdf files are allowed.");
                event.target.value = ''; // Clear the file input

                const documentTypeElement = getDocumentTypeElement(card);
                if (documentTypeElement) {
                    documentTypeElement.textContent = getOriginalText(documentTypeElement);
                }

                return;
            }

            if (file.size > 5 * 1024 * 1024) {
                alert("Error: File size exceeds 5MB limit.");
                event.target.value = ''; // Clear the file input

                // Reset the text inside the respective document type element
                const documentTypeElement = getDocumentTypeElement(card);
                if (documentTypeElement) {
                    documentTypeElement.textContent = getOriginalText(documentTypeElement);
                }

                return;
            }

            uploadedFile = file;

            const documentTypeElement = getDocumentTypeElement(card);
            if (documentTypeElement) {
                documentTypeElement.textContent = truncateFileName(file.name);
            }

            const fileSize = file.size < 1024 * 1024
                ? (file.size / 1024).toFixed(2) + ' KB'
                : (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            card.querySelector('.document-status').textContent = `${fileSize} Uploaded`;

            console.log(`File uploaded for ${documentTypeText}:`, uploadedFile);  // Debug log
        });

        // Helper function to get the correct document type element
        function getDocumentTypeElement(card) {
            if (card.querySelector('.sslc-grade')) return card.querySelector('.sslc-grade');
            if (card.querySelector('.hsc-grade')) return card.querySelector('.hsc-grade');
            if (card.querySelector('.graduation-grade')) return card.querySelector('.graduation-grade');
            return null;
        }

        function getOriginalText(element) {
            if (element.classList.contains('sslc-grade')) return 'SSLC Grade';
            if (element.classList.contains('hsc-grade')) return 'HSC Grade';
            if (element.classList.contains('graduation-grade')) return 'Graduation';
            return 'No file chosen';
        }

        // Handle preview functionality
        card.querySelector(`#${previewIconId}`).addEventListener('click', function (event) {
            event.stopPropagation();

            // Reference to preview icon
            const eyeIcon = this;

            if (eyeIcon.classList.contains('preview-active')) {
                const previewWrapper = document.querySelector('.pdf-preview-wrapper');
                if (previewWrapper) previewWrapper.remove();
                const overlay = document.querySelector('.pdf-preview-overlay');
                if (overlay) overlay.remove();
                eyeIcon.classList.remove('preview-active');
            } else {
                if (uploadedFile && uploadedFile.type === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create wrapper for the preview
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'pdf-preview-wrapper';
                        previewWrapper.style.cssText = `
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 90%;
                            height: 90vh;
                            background-color: white;
                            display: flex;
                            flex-direction: column;
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                            z-index: 1000;
                        `;

                        // Add overlay
                        const overlay = document.createElement('div');
                        overlay.className = 'pdf-preview-overlay';
                        overlay.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 999;
                        `;

                        // Create header
                        const header = document.createElement('div');
                        header.style.cssText = `
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 8px 16px;
                            background-color: #1a1a1a;
                            color: white;
                            height: 40px;
                        `;

                        // Left section with filename
                        const fileNameSection = document.createElement('div');
                        fileNameSection.style.cssText = `
                            display: flex;
                            align-items: center;
                            gap: 8px;
                        `;

                        const fileName = document.createElement('span');
                        fileName.textContent = uploadedFile.name;
                        fileName.style.cssText = `
                            color: white;
                            font-size: 14px;
                        `;
                        fileNameSection.appendChild(fileName);

                        // Middle section with zoom controls
                        const zoomControls = document.createElement('div');
                        zoomControls.style.cssText = `
                            display: flex;
                            align-items: center;
                            gap: 12px;
                            position: absolute;
                            left: 50%;
                            transform: translateX(-50%);
                        `;

                        const zoomOut = document.createElement('button');
                        zoomOut.innerHTML = '&#8722;';
                        const zoomIn = document.createElement('button');
                        zoomIn.innerHTML = '&#43;';

                        [zoomOut, zoomIn].forEach(btn => {
                            btn.style.cssText = `
                                background: none;
                                border: none;
                                color: white;
                                font-size: 18px;
                                cursor: pointer;
                                padding: 4px 8px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            `;
                        });

                        zoomControls.appendChild(zoomOut);
                        zoomControls.appendChild(zoomIn);

                        // Close button
                        const closeButton = document.createElement('button');
                        closeButton.innerHTML = '&#10005;';
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
                        `;

                        const closePreview = () => {
                            previewWrapper.remove();
                            overlay.remove();
                            eyeIcon.classList.remove('preview-active');
                        };

                        closeButton.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Assemble header
                        header.appendChild(fileNameSection);
                        header.appendChild(zoomControls);
                        header.appendChild(closeButton);

                        // Create iframe for PDF content
                        const iframe = document.createElement('iframe');
                        iframe.src = event.target.result;
                        iframe.style.cssText = `
                            width: 100%;
                            height: calc(100% - 40px);
                            border: none;
                            background-color: white;
                        `;

                        // Assemble the preview
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(iframe);

                        // Add to document body
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);

                        // Add zoom functionality
                        let currentZoom = 100;
                        zoomIn.addEventListener('click', () => {
                            currentZoom += 10;
                            iframe.style.transform = `scale(${currentZoom / 100})`;
                            iframe.style.transformOrigin = 'top center';
                        });

                        zoomOut.addEventListener('click', () => {
                            currentZoom = Math.max(currentZoom - 10, 50);
                            iframe.style.transform = `scale(${currentZoom / 100})`;
                            iframe.style.transformOrigin = 'top center';
                        });

                        // Add keyboard shortcut for closing
                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closePreview();
                            }
                        });
                    };
                    reader.readAsDataURL(uploadedFile);
                    eyeIcon.classList.add('preview-active');
                } else if (uploadedFile && (uploadedFile.type.startsWith('image/'))) {
                    // Image preview
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create wrapper for the preview
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'image-preview-wrapper';
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
                        `;

                        // Add overlay
                        const overlay = document.createElement('div');
                        overlay.className = 'image-preview-overlay';
                        overlay.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 999;
                        `;

                        // Create header
                        const header = document.createElement('div');
                        header.style.cssText = `
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 8px 16px;
                            background-color: #1a1a1a;
                            color: white;
                            height: 40px;
                        `;

                        // Left section with filename
                        const fileNameSection = document.createElement('div');
                        fileNameSection.style.cssText = `
                            display: flex;
                            align-items: center;
                            gap: 8px;
                        `;

                        const fileName = document.createElement('span');
                        fileName.textContent = uploadedFile.name;
                        fileName.style.cssText = `
                            color: white;
                            font-size: 14px;
                        `;
                        fileNameSection.appendChild(fileName);

                        // Close button
                        const closeButton = document.createElement('button');
                        closeButton.innerHTML = '&#10005;';
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
                        `;

                        const closePreview = () => {
                            previewWrapper.remove();
                            overlay.remove();
                            eyeIcon.classList.remove('preview-active');
                        };

                        closeButton.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Assemble header
                        header.appendChild(fileNameSection);
                        header.appendChild(closeButton);

                        // Create image element
                        const imageContainer = document.createElement('div');
                        imageContainer.style.cssText = `
                            width: 100%;
                            height: calc(100% - 40px);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            overflow: auto;
                            padding: 20px;
                            background-color: #f0f0f0;
                        `;

                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.style.cssText = `
                            max-width: 100%;
                            max-height: 80vh;
                            object-fit: contain;
                        `;

                        imageContainer.appendChild(img);

                        // Assemble the preview
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(imageContainer);

                        // Add to document body
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);

                        // Add keyboard shortcut for closing
                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closePreview();
                            }
                        });
                    };
                    reader.readAsDataURL(uploadedFile);
                    eyeIcon.classList.add('preview-active');
                } else {
                    alert('Please upload a valid PDF or image file to preview.');
                }
            }
        });
    });
};

function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;

    const extension = fileName.slice(fileName.lastIndexOf('.'));
    const name = fileName.slice(0, fileName.lastIndexOf('.'));

    return name.slice(0, 16) + '...' + extension;
}

document.addEventListener('DOMContentLoaded', function () {
    initializeSecuredAdmissionDocumentUpload();
});



const initializeWorkExperienceDocumentUpload = () => {
    const workExperienceDocuments = document.querySelectorAll(".individual-work-experiencecolumn-documents");

    workExperienceDocuments.forEach((card) => {
        let uploadedFile = null;
        const inputId = card.querySelector('input[type="file"]').id;
        const documentTypeText = card.querySelector('.document-name').textContent.trim();

        // Get the specific preview icon
        const previewIconId = card.querySelector('.fa-eye').id;

        // Trigger file input when the container is clicked
        card.querySelector('.inputfilecontainer-work-experiencecolumn').addEventListener('click', function (event) {
            // Prevent triggering if clicking on the eye icon
            if (!event.target.classList.contains('fa-eye') && !event.target.id.startsWith('view-')) {
                card.querySelector(`#${inputId}`).click();
            }
        });

        // Handle file selection and validation
        card.querySelector(`#${inputId}`).addEventListener('change', function (event) {
            const file = event.target.files[0];

            // Ensure file is selected
            if (!file) return;

            console.log(`Selected file for ${documentTypeText}:`, file);  // Debug log

            // Allowed file types
            const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
            const fileExtension = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();

            // Validate file type
            if (!allowedExtensions.includes(fileExtension)) {
                alert("Error: Only .jpg, .jpeg, .png, and .pdf files are allowed.");
                event.target.value = ''; // Clear the file input

                // Reset the text inside the respective document type element
                const documentTypeElement = getDocumentTypeElement(card);
                if (documentTypeElement) {
                    documentTypeElement.textContent = getOriginalText(documentTypeElement);
                }

                return;
            }

            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert("Error: File size exceeds 5MB limit.");
                event.target.value = ''; // Clear the file input

                // Reset the text inside the respective document type element
                const documentTypeElement = getDocumentTypeElement(card);
                if (documentTypeElement) {
                    documentTypeElement.textContent = getOriginalText(documentTypeElement);
                }

                return;
            }

            // Store the file and update UI
            uploadedFile = file;

            // Update the text in the specific document type element
            const documentTypeElement = getDocumentTypeElement(card);
            if (documentTypeElement) {
                documentTypeElement.textContent = truncateFileName(file.name);
            }

            const fileSize = file.size < 1024 * 1024
                ? (file.size / 1024).toFixed(2) + ' KB'
                : (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            card.querySelector('.document-status').textContent = `${fileSize} Uploaded`;

            console.log(`File uploaded for ${documentTypeText}:`, uploadedFile);  // Debug log
        });

        // Helper function to get the correct document type element
        function getDocumentTypeElement(card) {
            if (card.querySelector('.experience-letter')) return card.querySelector('.experience-letter');
            if (card.querySelector('.salary-slip')) return card.querySelector('.salary-slip');
            if (card.querySelector('.office-id')) return card.querySelector('.office-id');
            if (card.querySelector('.joining-letter')) return card.querySelector('.joining-letter');
            return null;
        }

        // Helper function to get original text
        function getOriginalText(element) {
            if (element.classList.contains('experience-letter')) return 'Experience Letter';
            if (element.classList.contains('salary-slip')) return '3 month salary slip';
            if (element.classList.contains('office-id')) return 'Office ID';
            if (element.classList.contains('joining-letter')) return 'Joining Letter';
            return 'No file chosen';
        }

        // Handle preview functionality
        card.querySelector(`#${previewIconId}`).addEventListener('click', function (event) {
            event.stopPropagation();

            // Reference to preview icon
            const eyeIcon = this;

            if (eyeIcon.classList.contains('preview-active')) {
                const previewWrapper = document.querySelector('.pdf-preview-wrapper');
                if (previewWrapper) previewWrapper.remove();
                const overlay = document.querySelector('.pdf-preview-overlay');
                if (overlay) overlay.remove();
                eyeIcon.classList.remove('preview-active');
            } else {
                if (uploadedFile && uploadedFile.type === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create wrapper for the preview
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'pdf-preview-wrapper';
                        previewWrapper.style.cssText = `
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 90%;
                            height: 90vh;
                            background-color: white;
                            display: flex;
                            flex-direction: column;
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                            z-index: 1000;
                        `;

                        // Add overlay
                        const overlay = document.createElement('div');
                        overlay.className = 'pdf-preview-overlay';
                        overlay.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 999;
                        `;

                        // Create header
                        const header = document.createElement('div');
                        header.style.cssText = `
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 8px 16px;
                            background-color: #1a1a1a;
                            color: white;
                            height: 40px;
                        `;

                        // Left section with filename
                        const fileNameSection = document.createElement('div');
                        fileNameSection.style.cssText = `
                            display: flex;
                            align-items: center;
                            gap: 8px;
                        `;

                        const fileName = document.createElement('span');
                        fileName.textContent = uploadedFile.name;
                        fileName.style.cssText = `
                            color: white;
                            font-size: 14px;
                        `;
                        fileNameSection.appendChild(fileName);

                        // Middle section with zoom controls
                        const zoomControls = document.createElement('div');
                        zoomControls.style.cssText = `
                            display: flex;
                            align-items: center;
                            gap: 12px;
                            position: absolute;
                            left: 50%;
                            transform: translateX(-50%);
                        `;

                        const zoomOut = document.createElement('button');
                        zoomOut.innerHTML = '&#8722;';
                        const zoomIn = document.createElement('button');
                        zoomIn.innerHTML = '&#43;';

                        [zoomOut, zoomIn].forEach(btn => {
                            btn.style.cssText = `
                                background: none;
                                border: none;
                                color: white;
                                font-size: 18px;
                                cursor: pointer;
                                padding: 4px 8px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            `;
                        });

                        zoomControls.appendChild(zoomOut);
                        zoomControls.appendChild(zoomIn);

                        // Close button
                        const closeButton = document.createElement('button');
                        closeButton.innerHTML = '&#10005;';
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
                        `;

                        const closePreview = () => {
                            previewWrapper.remove();
                            overlay.remove();
                            eyeIcon.classList.remove('preview-active');
                        };

                        closeButton.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Assemble header
                        header.appendChild(fileNameSection);
                        header.appendChild(zoomControls);
                        header.appendChild(closeButton);

                        // Create iframe for PDF content
                        const iframe = document.createElement('iframe');
                        iframe.src = event.target.result;
                        iframe.style.cssText = `
                            width: 100%;
                            height: calc(100% - 40px);
                            border: none;
                            background-color: white;
                        `;

                        // Assemble the preview
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(iframe);

                        // Add to document body
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);

                        // Add zoom functionality
                        let currentZoom = 100;
                        zoomIn.addEventListener('click', () => {
                            currentZoom += 10;
                            iframe.style.transform = `scale(${currentZoom / 100})`;
                            iframe.style.transformOrigin = 'top center';
                        });

                        zoomOut.addEventListener('click', () => {
                            currentZoom = Math.max(currentZoom - 10, 50);
                            iframe.style.transform = `scale(${currentZoom / 100})`;
                            iframe.style.transformOrigin = 'top center';
                        });

                        // Add keyboard shortcut for closing
                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closePreview();
                            }
                        });
                    };
                    reader.readAsDataURL(uploadedFile);
                    eyeIcon.classList.add('preview-active');
                } else if (uploadedFile && (uploadedFile.type.startsWith('image/'))) {
                    // Image preview
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create wrapper for the preview
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'image-preview-wrapper';
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
                        `;

                        // Add overlay
                        const overlay = document.createElement('div');
                        overlay.className = 'image-preview-overlay';
                        overlay.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 999;
                        `;

                        // Create header
                        const header = document.createElement('div');
                        header.style.cssText = `
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 8px 16px;
                            background-color: #1a1a1a;
                            color: white;
                            height: 40px;
                        `;

                        // Left section with filename
                        const fileNameSection = document.createElement('div');
                        fileNameSection.style.cssText = `
                            display: flex;
                            align-items: center;
                            gap: 8px;
                        `;

                        const fileName = document.createElement('span');
                        fileName.textContent = uploadedFile.name;
                        fileName.style.cssText = `
                            color: white;
                            font-size: 14px;
                        `;
                        fileNameSection.appendChild(fileName);

                        // Close button
                        const closeButton = document.createElement('button');
                        closeButton.innerHTML = '&#10005;';
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
                        `;

                        const closePreview = () => {
                            previewWrapper.remove();
                            overlay.remove();
                            eyeIcon.classList.remove('preview-active');
                        };

                        closeButton.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Assemble header
                        header.appendChild(fileNameSection);
                        header.appendChild(closeButton);

                        // Create image element
                        const imageContainer = document.createElement('div');
                        imageContainer.style.cssText = `
                            width: 100%;
                            height: calc(100% - 40px);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            overflow: auto;
                            padding: 20px;
                            background-color: #f0f0f0;
                        `;

                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.style.cssText = `
                            max-width: 100%;
                            max-height: 80vh;
                            object-fit: contain;
                        `;

                        imageContainer.appendChild(img);

                        // Assemble the preview
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(imageContainer);

                        // Add to document body
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);

                        // Add keyboard shortcut for closing
                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closePreview();
                            }
                        });
                    };
                    reader.readAsDataURL(uploadedFile);
                    eyeIcon.classList.add('preview-active');
                } else {
                    alert('Please upload a valid PDF or image file to preview.');
                }
            }
        });
    });
};
const bankListedThroughNBFC = async () => {



    const nbfcContainer = document.querySelector(".loanproposals-loanstatuscards");

    if (nbfcContainer) {
        const nbfcNames = nbfcContainer.querySelectorAll(".indivudalloanstatus-cards .individual-bankname h1");

        fetch("/getnbfcdata", {
            method: "GET",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        })
            .then(response => response.json())
            .then(async data => {
                if (data.success) {
                    console.log("Data retrieved successfully");
                    const container = document.querySelector(".loanproposals-loanstatuscards");

                    console.log(data);
                    const finalData = data.receivedData;

                    finalData.forEach((items, index) => {
                        const eachCards = document.createElement('div');
                        eachCards.classList.add("indivudalloanstatus-cards");


                        const insideCard = document.createElement('div');
                        insideCard.classList.add("individual-bankname");
                        const header = document.createElement("h1");
                        const messageInputNbfcids = document.createElement("p");
                        messageInputNbfcids.classList.add("messageinputnbfcids");
                        messageInputNbfcids.textContent = items.nbfc_id;



                        header.textContent = items.nbfc_name;
                        insideCard.append(header, messageInputNbfcids);



                        const insideSecond = document.createElement("div");
                        insideSecond.classList.add("individual-bankmessages");
                        const buttonContainer = document.createElement("div");
                        buttonContainer.classList.add('individual-bankmessages-buttoncontainer');






                        const firstButton = document.createElement("button");
                        const secondButton = document.createElement("button");
                        const thirdButton = document.createElement("button");
                        const fourthButton = document.createElement("button");



                        firstButton.textContent = "View";
                        secondButton.textContent = "Accept";
                        thirdButton.textContent = "Reject";
                        thirdButton.classList.add("bankmessage-buttoncontainer-reject");


                        fourthButton.textContent = "Message";
                        fourthButton.classList.add("triggeredbutton");

                        const bankMessage = document.createElement("p");
                        bankMessage.textContent = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut";
                        insideSecond.append(bankMessage);
                        buttonContainer.append(firstButton, secondButton, thirdButton)
                        insideSecond.append(buttonContainer, fourthButton);


                        const bankMessageContainer = document.createElement("div");

                        bankMessageContainer.classList.add("individual-bankmessage-input");

                        const messageInput = document.createElement("input");
                        messageInput.placeholder = "Send message";
                        messageInput.type = "text";

                        const sendIcon = document.createElement("img");
                        sendIcon.classList.add("send-img");
                        sendIcon.src = 'assets/images/send.png';

                        const documentAttach = document.createElement("i");
                        const smileAttach = document.createElement("i");

                        documentAttach.classList.add("fa-solid", "fa-paperclip");
                        smileAttach.classList.add("fa-regular", "fa-face-smile");


                        bankMessageContainer.append(messageInput, sendIcon, documentAttach, smileAttach);







                        eachCards.append(insideCard);
                        eachCards.append(insideSecond);
                        eachCards.append(bankMessageContainer);





                        container.append(eachCards);




                    })

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
document.addEventListener('DOMContentLoaded', function () {
    initializeWorkExperienceDocumentUpload();
});




const initializeCoBorrowerDocumentUpload = () => {
    const coBorrowerDocuments = document.querySelectorAll(".individual-coborrower-kyc-documents");

    coBorrowerDocuments.forEach((card) => {
        let uploadedFile = null;
        const inputId = card.querySelector('input[type="file"]').id;
        const documentTypeText = card.querySelector('.document-name').textContent.trim();

        // Get the specific preview icon
        const previewIconId = card.querySelector('.fa-eye').id;

        // Trigger file input when the container is clicked
        card.querySelector('.inputfilecontainer-coborrower-kyccolumn').addEventListener('click', function (event) {
            if (!event.target.classList.contains('fa-eye') && !event.target.id.startsWith('view-')) {
                card.querySelector(`#${inputId}`).click();
            }
        });

        // Handle file selection and validation
        card.querySelector(`#${inputId}`).addEventListener('change', function (event) {
            const file = event.target.files[0];

            // Ensure file is selected
            if (!file) return;

            console.log(`Selected file for ${documentTypeText}:`, file);  // Debug log

            // Allowed file types
            const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
            const fileExtension = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();

            // Validate file type
            if (!allowedExtensions.includes(fileExtension)) {
                alert("Error: Only .jpg, .jpeg, .png, and .pdf files are allowed.");
                event.target.value = ''; // Clear the file input

                // Reset the text inside the respective document type element
                const documentTypeElement = getDocumentTypeElement(card);
                if (documentTypeElement) {
                    documentTypeElement.textContent = getOriginalText(documentTypeElement);
                }

                return;
            }

            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert("Error: File size exceeds 5MB limit.");
                event.target.value = ''; // Clear the file input

                // Reset the text inside the respective document type element
                const documentTypeElement = getDocumentTypeElement(card);
                if (documentTypeElement) {
                    documentTypeElement.textContent = getOriginalText(documentTypeElement);
                }

                return;
            }

            // Store the file and update UI
            uploadedFile = file;

            // Update the text in the specific document type element
            const documentTypeElement = getDocumentTypeElement(card);
            if (documentTypeElement) {
                documentTypeElement.textContent = truncateFileName(file.name);
            }

            const fileSize = file.size < 1024 * 1024
                ? (file.size / 1024).toFixed(2) + ' KB'
                : (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            card.querySelector('.document-status').textContent = `${fileSize} Uploaded`;

            console.log(`File uploaded for ${documentTypeText}:`, uploadedFile);  // Debug log
        });

        // Helper function to get the correct document type element
        function getDocumentTypeElement(card) {
            if (card.querySelector('.coborrower-pancard')) return card.querySelector('.coborrower-pancard');
            if (card.querySelector('.coborrower-aadharcard')) return card.querySelector('.coborrower-aadharcard');
            if (card.querySelector('.coborrower-addressproof')) return card.querySelector('.coborrower-addressproof');
            return null;
        }

        // Helper function to get original text
        function getOriginalText(element) {
            if (element.classList.contains('coborrower-pancard')) return 'Pan Card';
            if (element.classList.contains('coborrower-aadharcard')) return 'Aadhar Card';
            if (element.classList.contains('coborrower-addressproof')) return 'Address Proof';
            return 'No file chosen';
        }

        // Handle preview functionality
        card.querySelector(`#${previewIconId}`).addEventListener('click', function (event) {
            event.stopPropagation();

            // Reference to preview icon
            const eyeIcon = this;

            if (eyeIcon.classList.contains('preview-active')) {
                const previewWrapper = document.querySelector('.pdf-preview-wrapper, .image-preview-wrapper');
                if (previewWrapper) previewWrapper.remove();
                const overlay = document.querySelector('.pdf-preview-overlay, .image-preview-overlay');
                if (overlay) overlay.remove();
                eyeIcon.classList.remove('preview-active');
            } else {
                if (uploadedFile && uploadedFile.type === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create wrapper for the preview
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'pdf-preview-wrapper';
                        previewWrapper.style.cssText = `
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 90%;
                            height: 90vh;
                            background-color: white;
                            display: flex;
                            flex-direction: column;
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                            z-index: 1000;
                        `;

                        // Add overlay
                        const overlay = document.createElement('div');
                        overlay.className = 'pdf-preview-overlay';
                        overlay.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 999;
                        `;

                        // Create header
                        const header = document.createElement('div');
                        header.style.cssText = `
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 8px 16px;
                            background-color: #1a1a1a;
                            color: white;
                            height: 40px;
                        `;

                        // Left section with filename
                        const fileNameSection = document.createElement('div');
                        fileNameSection.style.cssText = `
                            display: flex;
                            align-items: center;
                            gap: 8px;
                        `;

                        const fileName = document.createElement('span');
                        fileName.textContent = uploadedFile.name;
                        fileName.style.cssText = `
                            color: white;
                            font-size: 14px;
                        `;
                        fileNameSection.appendChild(fileName);

                        // Middle section with zoom controls
                        const zoomControls = document.createElement('div');
                        zoomControls.style.cssText = `
                            display: flex;
                            align-items: center;
                            gap: 12px;
                            position: absolute;
                            left: 50%;
                            transform: translateX(-50%);
                        `;

                        const zoomOut = document.createElement('button');
                        zoomOut.innerHTML = '&#8722;';
                        const zoomIn = document.createElement('button');
                        zoomIn.innerHTML = '&#43;';

                        [zoomOut, zoomIn].forEach(btn => {
                            btn.style.cssText = `
                                background: none;
                                border: none;
                                color: white;
                                font-size: 18px;
                                cursor: pointer;
                                padding: 4px 8px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            `;
                        });

                        zoomControls.appendChild(zoomOut);
                        zoomControls.appendChild(zoomIn);

                        // Close button
                        const closeButton = document.createElement('button');
                        closeButton.innerHTML = '&#10005;';
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
                        `;

                        const closePreview = () => {
                            previewWrapper.remove();
                            overlay.remove();
                            eyeIcon.classList.remove('preview-active');
                        };

                        closeButton.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Assemble header
                        header.appendChild(fileNameSection);
                        header.appendChild(zoomControls);
                        header.appendChild(closeButton);

                        // Create iframe for PDF content
                        const iframe = document.createElement('iframe');
                        iframe.src = event.target.result;
                        iframe.style.cssText = `
                            width: 100%;
                            height: calc(100% - 40px);
                            border: none;
                            background-color: white;
                        `;

                        // Assemble the preview
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(iframe);

                        // Add to document body
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);

                        // Add zoom functionality
                        let currentZoom = 100;
                        zoomIn.addEventListener('click', () => {
                            currentZoom += 10;
                            iframe.style.transform = `scale(${currentZoom / 100})`;
                            iframe.style.transformOrigin = 'top center';
                        });

                        zoomOut.addEventListener('click', () => {
                            currentZoom = Math.max(currentZoom - 10, 50);
                            iframe.style.transform = `scale(${currentZoom / 100})`;
                            iframe.style.transformOrigin = 'top center';
                        });

                        // Add keyboard shortcut for closing
                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closePreview();
                            }
                        });
                    };
                    reader.readAsDataURL(uploadedFile);
                    eyeIcon.classList.add('preview-active');
                } else if (uploadedFile && (uploadedFile.type.startsWith('image/'))) {
                    // Image preview
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create wrapper for the preview
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'image-preview-wrapper';
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
                        `;

                        // Add overlay
                        const overlay = document.createElement('div');
                        overlay.className = 'image-preview-overlay';
                        overlay.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 999;
                        `;

                        // Create header
                        const header = document.createElement('div');
                        header.style.cssText = `
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 8px 16px;
                            background-color: #1a1a1a;
                            color: white;
                            height: 40px;
                        `;

                        // Left section with filename
                        const fileNameSection = document.createElement('div');
                        fileNameSection.style.cssText = `
                            display: flex;
                            align-items: center;
                            gap: 8px;
                        `;

                        const fileName = document.createElement('span');
                        fileName.textContent = uploadedFile.name;
                        fileName.style.cssText = `
                            color: white;
                            font-size: 14px;
                        `;
                        fileNameSection.appendChild(fileName);

                        // Close button
                        const closeButton = document.createElement('button');
                        closeButton.innerHTML = '&#10005;';
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
                        `;

                        const closePreview = () => {
                            previewWrapper.remove();
                            overlay.remove();
                            eyeIcon.classList.remove('preview-active');
                        };

                        closeButton.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Assemble header
                        header.appendChild(fileNameSection);
                        header.appendChild(closeButton);

                        // Create image element
                        const imageContainer = document.createElement('div');
                        imageContainer.style.cssText = `
                            width: 100%;
                            height: calc(100% - 40px);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            overflow: auto;
                            padding: 20px;
                            background-color: #f0f0f0;
                        `;

                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.style.cssText = `
                            max-width: 100%;
                            max-height: 80vh;
                            object-fit: contain;
                        `;

                        imageContainer.appendChild(img);

                        // Assemble the preview
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(imageContainer);

                        // Add to document body
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);

                        // Add keyboard shortcut for closing
                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closePreview();
                            }
                        });
                    };
                    reader.readAsDataURL(uploadedFile);
                    eyeIcon.classList.add('preview-active');
                } else {
                    alert('Please upload a valid PDF or image file to preview.');
                }
            }
        });
    });
};

function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;

    const extension = fileName.slice(fileName.lastIndexOf('.'));
    const name = fileName.slice(0, fileName.lastIndexOf('.'));

    return name.slice(0, 16) + '...' + extension;
}

document.addEventListener('DOMContentLoaded', function () {
    initializeCoBorrowerDocumentUpload();
});

function toggleOtherDegreeInput(event) {
    const otherDegreeInput = document.getElementById('otherDegreeInput');

    if (event && event.target && event.target.value) {
        if (event.target.value === 'Others') {
            otherDegreeInput.disabled = false;
            otherDegreeInput.placeholder = 'Enter here';
            otherDegreeInput.value = '';
        } else {
            otherDegreeInput.disabled = true;
            otherDegreeInput.value = event.target.value; // Set the value to Bachelors or Masters
            otherDegreeInput.placeholder = 'Enter degree type'; // Reset placeholder if needed
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
    const progressRingFill = document.querySelector('.progress-ring-fill');
    const progressText = document.querySelector('.progress-ring-text');

    progressRingFill.style.strokeDasharray = `${circumference} ${circumference}`;
    progressRingFill.style.strokeDashoffset = offset;
    progressText.textContent = `${Math.round(percentage * 100)}%`;
};

const initialisedocumentsCount = () => {
    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");

    const userId = userIdElement ? userIdElement.textContent : '';

    fetch("/count-documents", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ userId })
    })
        .then((response) => response.json())
        .then((data) => {
            if (data) {
                console.log(data.documentscount);
                const documentCountText = document.querySelector(".profilestatus-graph-secondsection .profilestatus-noofdocuments-section p");
                // if(data.documentscount<10){
                if (data.documentscount < 10 && data.documentscound >= 0 && documentCountText && data && data.documentscount !== undefined) {
                    documentCountText.textContent = "0" + data.documentscount;
                }
                else if (data.documentscount < 0) {
                    documentCountText.textContent = "00";


                }
                else if (data.documentscount >= 10 && documentCountText && data && data.documentscount !== undefined) {
                    documentCountText.textContent = data.documentscount;

                } else {
                    console.error('Element not found or data is invalid');


                }



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
    };

    if (saveChangesButton) {
        saveChangesButton.textContent = 'Edit';
        saveChangesButton.style.backgroundColor = "transparent";
        saveChangesButton.style.color = "#260254";

        saveChangesButton.addEventListener('click', (event) => {

            isEditing = !isEditing;

            if (isEditing) {
                toggleSaveState(); // Call toggleSaveState function when entering edit mode
            }
            else {
                saveChangesButton.textContent = 'Edit';
                saveChangesButton.style.backgroundColor = "transparent";
                saveChangesButton.style.color = "#260254";
                personalDivContainer.style.display = "flex";
                personalDivContainerEdit.style.display = "none";
                academicsMarksDivEdit.style.display = "none";
                academicsMarksDiv.style.display = "flex";

                const editedName = document.querySelector(".personalinfosecondrow-editsection .personal_info_name input").value;
                const editedPhone = document.querySelector(".personalinfosecondrow-editsection .personal_info_phone input").value;
                const editedEmail = document.querySelector(".personalinfosecondrow-editsection .personal_info_email input").value;
                const editedState = document.querySelector(".personalinfosecondrow-editsection .personal_info_state input").value;
                const iletsScore = document.querySelector(".testscoreseditsection-secondrow-editsection .ilets_score").value;
                const greScore = document.querySelector(".testscoreseditsection-secondrow-editsection .gre_score").value;
                const tofelScore = document.querySelector(".testscoreseditsection-secondrow-editsection .tofel_score").value;

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
                const referralCode = document.querySelector(".myapplication-fifthcolumn input").value;

                const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
                const userId = userIdElement ? userIdElement.textContent : '';

                console.log(editedName, editedPhone, editedEmail, editedState, userId);

                const selectedDegree = document.querySelector('input[name="education-level"]:checked').value;
                const otherDegreeInput = document.getElementById('otherDegreeInput').value;

                const updatedDegreeType = selectedDegree === 'Others' ? otherDegreeInput : selectedDegree;

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
                    referralCode: referralCode,
                    degreeType: updatedData.degreeType,
                    userId: userId
                };

                console.log(updatedInfos);




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
                        if (editedName) {
                            document.querySelector("#referenceNameId p").textContent = editedName;
                            document.getElementById("personal_state_id").textContent = editedState;
                        }

                        if (data.errors) {
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



function initializeSimpleChat() {
    const chatContainers = document.querySelectorAll('.individual-bankmessage-input');

    if (chatContainers.length === 0) return;

    chatContainers.forEach((chatContainer, index) => {

        const chatId = `loan-chat-${index}`;
        chatContainer.setAttribute('data-chat-id', chatId);

        const parentContainer = chatContainer.closest('.indivudalloanstatus-cards');
        const messageButton = parentContainer ? parentContainer.querySelector('.triggeredbutton') : null;

        // Hide chat input by default
        chatContainer.style.display = 'none';

        // Create messages wrapper if it doesn't exist
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
        function toggleChat(student_id, messageInputNbfcids) {





            if (messagesWrapper.style.display === 'none') {
                viewChat(student_id, messageInputNbfcids);
            } else {
                hideChat(student_id, messageInputNbfcids);
            }
        }

        // Add click event to message button
        if (messageButton) {
            messageButton.addEventListener('click', function (e) {
                e.preventDefault();
                const student_id = document.querySelector(".personalinfo-secondrow .personal_info_id").textContent;
                var messageInputNbfcids = document.querySelectorAll(".messageinputnbfcids");

                messageInputNbfcids = messageInputNbfcids[index].textContent;


                toggleChat(student_id, messageInputNbfcids);
            });
        }

        function sendMessage(messageInput, messageInputNbfcids) {
            if (!messageInput) return;
            console.log(messageInput.value);


            const content = messageInput.value.trim();
            if (content) {
                showChat();

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
                // messagesWrapper.appendChild(messageElement);

                 messageInput.value = "";
                messagesWrapper.scrollTop = messagesWrapper.scrollHeight;

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
                    message: content
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
                    console.log('Message sent successfully:', data.message);

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
                background-color: #DCF8C6;
                word-wrap: break-word;
                font-family: 'Poppins', sans-serif;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            `;
                    messageContent.textContent = content; 

                     messagesWrapper.appendChild(messageElement);

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
                    console.log(messageInputNbfcids[index].textContent);

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
                console.log(messageInputNbfcids[index].textContent);

                messageInputNbfcids = messageInputNbfcids[index].textContent;
                sendMessage(messageInput, messageInputNbfcids);
             });
        }

         if (smileIcon) {
            smileIcon.addEventListener('click', function (e) {
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
            paperclipIcon.addEventListener('click', function () {
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
                        const fileId = `file-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;

                        // Store file reference for later download
                        fileStorage[fileId] = file;

                        // Create message element
                        const messageElement = document.createElement("div");
                        messageElement.setAttribute('data-file-id', fileId);
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
                        downloadLink.addEventListener('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            // Create download link for the file
                            const url = URL.createObjectURL(fileStorage[fileId]);
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
                        removeButton.addEventListener('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            removeMessage(messageElement, fileId);
                        });

                        fileContent.appendChild(downloadLink);
                        fileContent.appendChild(removeButton);
                        messageElement.appendChild(fileContent);
                        messagesWrapper.appendChild(messageElement);
                        messagesWrapper.scrollTop = messagesWrapper.scrollHeight;

                        // Save file message with ID
                        saveFileMessage({
                            id: fileId,
                            name: fileName,
                            size: fileSize
                        }, chatId);
                    }
                };

                document.body.appendChild(fileInput);
                fileInput.click();
                document.body.removeChild(fileInput);
            });
        }


        const savedMessages = JSON.parse(localStorage.getItem(`messages-${chatId}`) || '[]');
        console.log(savedMessages)
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
                    console.log('API response:', data);  
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
                        `;
                                messageContent.textContent = message.message; // Display the message content

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

            // Ensure the chat container stays visible without being reset
            messagesWrapper.style.display = 'flex';
            chatContainer.style.display = 'flex';
            clearButtonContainer.style.display = 'flex';

            // Adjust parent container height if needed
            if (parentContainer) {
                parentContainer.style.height = "auto";
            }

            // Update button text if needed
            if (messageButton) {
                messageButton.textContent = "Close";
            }
        }

        // Function to scroll to the bottom of the messagesWrapper
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

// Modify the load saved messages section in initializeSimpleChat() function
// Replace the existing "Load saved messages" section with this:
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

loadSavedMessages();






