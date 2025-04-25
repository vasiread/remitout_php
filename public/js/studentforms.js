document.addEventListener("DOMContentLoaded", () => {
    // Function to get query parameter from URL
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Secret key for decryption (must match the key used in generateReferLinkPopup)
    const secretKey = "rJXU0e4lTP7G+KP9dH5V1pq9P7vP8d8sravZmzMGUKM="; // Replace with the exact key used for encryption

    // Extract ref from URL and decrypt it
    const refParam = getQueryParam("ref");
    const referralInput = document.getElementById("personal-info-referral");

    if (refParam && referralInput) {
        try {
            // Check if CryptoJS is available
            if (typeof CryptoJS === "undefined") {
                console.error(
                    "CryptoJS library is not loaded. Please include it in your HTML."
                );
                referralInput.value = refParam; // Fallback to encrypted value if CryptoJS is missing
            } else {
                // Decrypt the ref parameter
                const bytes = CryptoJS.AES.decrypt(
                    decodeURIComponent(refParam),
                    secretKey
                );
                const decryptedRef = bytes.toString(CryptoJS.enc.Utf8);

                if (decryptedRef) {
                    referralInput.value = decryptedRef; // Set the decrypted original ref ID
                } else {
                    console.error(
                        "Decryption failed: Invalid key or corrupted data"
                    );
                    referralInput.value = refParam; // Fallback to encrypted value
                }
            }
            // Disable the input field after setting the value
            referralInput.disabled = true;
        } catch (error) {
            console.error("Error decrypting ref parameter:", error);
            referralInput.value = refParam; // Fallback to encrypted value on error
            referralInput.disabled = true; // Disable even on error
        }
    }

    window.handleFileUpload = handleFileUpload;
    window.removeFile = removeFile;

    event.preventDefault();
    const prevButton = document.querySelector(".nav-button.prev");
    const nextButton = document.querySelector(".nav-button.next");
    const nextBreadcrumbButton = document.querySelector(".next-btn");
    const nextCourseButton = document.querySelector(".next-btn-course");
    const nextAcademicButton = document.querySelector(".next-btn-academic");
    const nextBorrowButton = document.querySelector(".next-btn-borrow");
    const nextKycButton = document.querySelector(".save-btn-kyc");
    const breadcrumbLinks = document.querySelectorAll(".breadcrumb a");

    window.onload = function () {
        if (window.location.hash === "#kyc-section-id") {
            document.getElementById("kyc-section-id").style.display = "block";
            alert("KYC");
        }
    };

    const breadcrumbSections = [
        [
            document.querySelector(".registration-form"),
            document.querySelector(".section-02-container"),
        ],
        [
            document.querySelector(".course-details"),
            document.querySelector(".course-degree"),
            document.querySelector(".course-duration-container"),
            document.querySelector(".detail-container-section"),
        ],
        [
            document.querySelector(".academic-container"),
            document.querySelector(".academic-details"),
            document.querySelector(".admit-form-container"),
        ],
        [
            document.querySelector(".borrow-container-section"),
            document.querySelector(".income-co-borrower"),
            document.querySelector(".monthly-liability-container"),
        ],
        [
            document.querySelector(".kyc-section-document"),
            document.querySelector(".kyc-section-marksheet"),
            document.querySelector(".kyc-section-Admission"),
            document.querySelector(".work-experience"),
            document.querySelector(".kyc-section-co-borrower"),
            document.querySelector(".salary-upload"),
        ],
    ];

    function updateMobileHeading(breadcrumbIndex) {
        const mobileHeading = document.getElementById("mobileHeading");
        const headings = {
            0: "Personal Information",
            1: "Course Details",
            2: "Academic Details",
            3: "Co-borrower Info",
            4: "Document Upload",
        };

        if (mobileHeading) {
            mobileHeading.textContent = headings[breadcrumbIndex] || "";
        }
    }

    // Make sure navigation function also updates heading
    function navigate(direction) {
        const currentContainers = breadcrumbSections[currentBreadcrumbIndex];
        currentContainers[currentContainerIndex].style.display = "none";

        if (direction === "prev") {
            if (currentContainerIndex > 0) {
                currentContainerIndex--;
            } else if (currentBreadcrumbIndex > 0) {
                currentBreadcrumbIndex--;
                currentContainerIndex =
                    breadcrumbSections[currentBreadcrumbIndex].length - 1;
            }
            updateMobileHeading(currentBreadcrumbIndex);
        } else if (direction === "next") {
            if (currentContainerIndex < currentContainers.length - 1) {
                currentContainerIndex++;
            } else if (currentBreadcrumbIndex < breadcrumbSections.length - 1) {
                currentBreadcrumbIndex++;
                currentContainerIndex = 0;
            }
            updateMobileHeading(currentBreadcrumbIndex);
        }

        const updatedContainers = breadcrumbSections[currentBreadcrumbIndex];
        updatedContainers[currentContainerIndex].style.display = "block";

        updateBreadcrumbNavigation();
        updateNavigationButtons();
        updateDots();
    }

    const breadcrumbDots = [2, 4, 3, 3, 6];

    let currentBreadcrumbIndex = 0;
    let currentContainerIndex = 0;

    // Dynamically add dots based on breadcrumb index
    function updateDots() {
        const dotContainer = document.querySelector(".nav-dots");
        dotContainer.innerHTML = "";

        const numberOfDots = breadcrumbDots[currentBreadcrumbIndex];

        for (let i = 0; i < numberOfDots; i++) {
            const dot = document.createElement("div");
            dot.classList.add("dot");
            if (i === currentContainerIndex) {
                dot.classList.add("active");
            }
            dotContainer.appendChild(dot);
        }
    }

    // Function to check if all required fields are filled
    function areFieldsFilled() {
        const currentContainers = breadcrumbSections[currentBreadcrumbIndex];
        const currentContainer = currentContainers[currentContainerIndex];

        const inputs = currentContainer.querySelectorAll(
            "input[required], select[required], textarea[required]"
        );

        for (const input of inputs) {
            if (!input.value.trim()) {
                return false;
            }
        }
        return true;
    }

    function updateNavigationButtons() {
        const isAtFirstContainer = currentContainerIndex === 0;
        const isAtLastContainer =
            currentContainerIndex ===
            breadcrumbSections[currentBreadcrumbIndex].length - 1;

        prevButton.disabled = isAtFirstContainer;
        nextButton.disabled = isAtLastContainer || !areFieldsFilled();

        nextBreadcrumbButton.disabled =
            currentContainerIndex !==
            breadcrumbSections[currentBreadcrumbIndex].length - 1;
    }

    function updateBreadcrumbNavigation() {
        breadcrumbLinks.forEach((link, index) => {
            link.classList.remove("active");
            link.style.color = "";

            if (index === currentBreadcrumbIndex) {
                link.classList.add("active");
                link.style.color = "#E98635";
            } else {
                link.style.color = "";
            }
        });
    }

    function navigate(direction) {
        const currentContainers = breadcrumbSections[currentBreadcrumbIndex];

        currentContainers[currentContainerIndex].style.display = "none";

        if (direction === "next") {
            if (currentContainerIndex < currentContainers.length - 1) {
                currentContainerIndex++;
            } else if (currentBreadcrumbIndex < breadcrumbSections.length - 1) {
                currentBreadcrumbIndex++;
                currentContainerIndex = 0;
            }
        } else if (direction === "prev") {
            if (currentContainerIndex > 0) {
                currentContainerIndex--;
            } else if (currentBreadcrumbIndex > 0) {
                currentBreadcrumbIndex--;
                currentContainerIndex =
                    breadcrumbSections[currentBreadcrumbIndex].length - 1;
            }
        }
        const updatedContainers = breadcrumbSections[currentBreadcrumbIndex];
        updatedContainers[currentContainerIndex].style.display = "block";

        updateBreadcrumbNavigation();
        updateNavigationButtons();
        updateDots();
        updateMobileHeading(currentBreadcrumbIndex);
    }

    // Add event listeners to buttons
    nextButton.addEventListener("click", () => {
        if (areFieldsFilled()) {
            navigate("next");
        }
    });

    function updateUserIds() {
        const personalInfoId = document.getElementById(
            "personal-info-userid"
        ).value;

        console.log(personalInfoId);

        fetch("/updatedetailsinfo", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ personalInfoId }),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data.message);
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }
    updateUserIds();

    function updateCoborrowerInfo(event) {
        event.preventDefault();

        // Modified getSelectedAnswer function to include callback for async handling
        function getSelectedAnswer(callback) {
            const selectedOption = document.querySelector(
                'input[name="borrow-relation"]:checked'
            );

            if (selectedOption && selectedOption.value !== "blood-relative") {
                return callback(selectedOption.value);
            } else if (
                selectedOption &&
                selectedOption.value === "blood-relative"
            ) {
                const dropdownRelative = document.querySelectorAll(
                    ".borrow-dropdown .borrow-dropdown-item"
                );

                dropdownRelative.forEach((item) => {
                    item.addEventListener("click", function () {
                        const relativeValue = item.dataset.value;
                        console.log("Selected blood relative:", relativeValue);

                        // Proceed with the final selection
                        callback(relativeValue);
                    });
                });

                // Return early since selection is pending
                return;
            } else {
                return callback("none selected here");
            }
        }

        // Call getSelectedAnswer with the callback to handle data submission
        getSelectedAnswer(function (answer) {
            console.log("Final selected answer:", answer);

            const personalInfoId = document.getElementById(
                "personal-info-userid"
            ).value;
            var incomeValue =
                document.getElementById("income-co-borrower").value;
            var selectedLiability = document.querySelector(
                'input[name="co-borrower-liability"]:checked'
            ).value;
            var emiAmount = document.querySelector(
                ".emi-content .emi-content-container"
            ).value;

            const coborrowerData = {
                personalInfoId,
                answer,
                incomeValue,
                selectedLiability,
                emiAmount,
            };
            console.log(coborrowerData);

            // Proceed with the fetch after answer selection
            fetch("/coborrowerData", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify(coborrowerData),
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);

                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An error occurred while updating your information.");
                });
        });
    }

    document
        .getElementById("personal-info-submit")
        .addEventListener("click", (event) => {
            updateUserPersonalInfo(event);
        });

    document
        .getElementById("course-info-submit")
        .addEventListener("click", (event) => {
            updateUserCourseInfo(event);
        });
    document
        .getElementById("academics-info-submit")
        .addEventListener("click", (event) => {
            updateAcademicsCourseInfo(event);
        });
    document
        .getElementById("coborrower-info-submit")
        .addEventListener("click", (event) => {
            updateCoborrowerInfo(event);
        });

    document
        .getElementById("saveandsubmit")
        .addEventListener("click", (event) => {
            window.location.href = "/student-dashboard";
        });

    function updateUserPersonalInfo(event) {
        event.preventDefault();

        // Getting values from form fields
        const personalInfoId = document.getElementById(
            "personal-info-userid"
        ).value;
        const personalInfoName =
            document.getElementById("personal-info-name").value;
        const personalInfoPhone = document.getElementById(
            "personal-info-phone"
        ).value;
        const personalInfoEmail = document.getElementById(
            "personal-info-email"
        ).value;
        const personalInfoCity =
            document.getElementById("personal-info-city").value;
        const personalInfoReferral = document.getElementById(
            "personal-info-referral"
        ).value;

        // Use the captured value from the custom dropdown
        const personalInfoFindOut = selectedValue;

        if (
            personalInfoName !== "" &&
            personalInfoPhone !== "" &&
            personalInfoEmail !== "" &&
            personalInfoCity !== "" &&
            personalInfoFindOut
        ) {
            const personalUpdateData = {
                personalInfoId,
                personalInfoName,
                personalInfoPhone,
                personalInfoEmail,
                personalInfoCity,
                personalInfoReferral,
                personalInfoFindOut,
            };

            console.log(personalUpdateData);

            // Sending the data with fetch
            fetch("/update-personalinfo", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify(personalUpdateData),
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);

                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An error occurred while updating your information.");
                });
        } else {
            alert(
                "Required fields Not Filled. Do you want to continue with that?"
            );
        }
    }

    function getSelectedExpenseType() {
        const selectedExpense = document.querySelector(
            'input[name="expense-type"]:checked'
        );
        console.log(
            "Selected Expense Type:",
            selectedExpense ? selectedExpense.value : "None"
        );
        return selectedExpense ? selectedExpense.value : null;
    }

    function getLoanAmount() {
        const loanAmount = document.getElementById("loan-amount").value;
        console.log("Loan Amount:", loanAmount.trim());
        return loanAmount.trim();
    }

    // Function to get the selected study locations (from the checkboxes)
    function getSelectedStudyLocations() {
        const checkboxes = document.querySelectorAll(
            '#selected-study-location input[type="checkbox"]:checked'
        );
        const selectedLocations = [];
        checkboxes.forEach((checkbox) => {
            selectedLocations.push(checkbox.value);
        });
        console.log("Selected Study Locations:", selectedLocations);
        return selectedLocations;
    }

    function updateUserCourseInfo(event) {
        event.preventDefault();
        const personalInfoId = document.getElementById(
            "personal-info-userid"
        ).value;

        const selectedDegreeType = document.querySelector(
            '#course-info-degreetype input[name="degree_type"]:checked'
        ).value;
        const expenseType = getSelectedExpenseType();
        const loanAmount = getLoanAmount();
        const courseDuration = getSelectedCourseDuration(); // Get the selected course duration
        const studyLocations = getSelectedStudyLocations();

        const courseInfoData = {
            personalInfoId,
            selectedDegreeType,
            expenseType,
            loanAmount,
            courseDuration,
            studyLocations,
        };

        console.log(courseInfoData);

        fetch("/update-courseinfo", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify(courseInfoData),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);

                if (data.success) {
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while updating your information.");
            });
    }

    function updateAcademicsCourseInfo(event) {
        const personalInfoId = document.getElementById(
            "personal-info-userid"
        ).value;

        const selectedAcademicGap = document.querySelector(
            'input[name="academics-gap"]:checked'
        ).value;
        const reasonForGap = document.querySelector(
            ".academic-reason textarea"
        ).value;
        const selectedAdmitOption = document.querySelector(
            'input[name="admit-option"]:checked'
        ).value;
        const selectedWorkOption = document.querySelector(
            'input[name="work-option"]:checked'
        ).value;
        const ieltsScore = document.getElementById("admit-ielts").value;

        const greScore = document.getElementById("admit-gre").value;
        const toeflScore = document.getElementById("admit-toefl").value;
        const otherExamName =
            document.getElementById("admit-others-name").value;
        const otherExamScore =
            document.getElementById("admit-others-score").value;
        const universityName =
            document.getElementById("universityschoolid").value;

        const courseName = document.getElementById("educationcourseid").value;

        const academicDetails = {
            personalInfoId,
            selectedAcademicGap,
            reasonForGap,
            selectedAdmitOption,
            selectedWorkOption,
            ieltsScore,
            greScore,
            toeflScore,
            others: { otherExamName, otherExamScore },
            universityName,
            courseName,
        };

        console.log(academicDetails);
        fetch("/update-academicsinfo", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify(academicDetails), // Sending the data as JSON in the request body
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);

                if (data.success) {
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while updating your information.");
            });
    }

    prevButton.addEventListener("click", () => navigate("prev"));
    nextBreadcrumbButton.addEventListener("click", () => {
        if (
            currentContainerIndex ===
            breadcrumbSections[currentBreadcrumbIndex].length - 1
        ) {
            if (currentBreadcrumbIndex < breadcrumbSections.length - 1) {
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container) => (container.style.display = "none")
                );
                currentBreadcrumbIndex++;
                currentContainerIndex = 0;

                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container, index) => {
                        container.style.display =
                            index === 0 ? "block" : "none";
                    }
                );

                updateBreadcrumbNavigation();
                updateNavigationButtons();
                updateDots();
                updateMobileHeading(currentBreadcrumbIndex);
            }
        }
    });

    if (nextCourseButton) {
        nextCourseButton.addEventListener("click", () => {
            if (currentBreadcrumbIndex === 1) {
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container) => (container.style.display = "none")
                );
                currentBreadcrumbIndex = 2;
                currentContainerIndex = 0;

                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container, index) => {
                        container.style.display =
                            index === 0 ? "block" : "none";
                    }
                );

                updateBreadcrumbNavigation();
                updateNavigationButtons();
                updateDots();
                updateMobileHeading(currentBreadcrumbIndex);
            }
        });
    }

    if (nextAcademicButton) {
        nextAcademicButton.addEventListener("click", () => {
            if (currentBreadcrumbIndex === 2) {
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container) => (container.style.display = "none")
                );
                currentBreadcrumbIndex = 3;
                currentContainerIndex = 0;

                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container, index) => {
                        container.style.display =
                            index === 0 ? "block" : "none";
                    }
                );

                updateBreadcrumbNavigation();
                updateNavigationButtons();
                updateDots();
                updateMobileHeading(currentBreadcrumbIndex);
            }
        });
    }

    if (nextBorrowButton) {
        nextBorrowButton.addEventListener("click", () => {
            if (currentBreadcrumbIndex === 3) {
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container) => (container.style.display = "none")
                );
                currentBreadcrumbIndex = 4;
                currentContainerIndex = 0;

                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container, index) => {
                        container.style.display =
                            index === 0 ? "block" : "none";
                    }
                );

                updateBreadcrumbNavigation();
                updateNavigationButtons();
                updateDots();
                updateMobileHeading(currentBreadcrumbIndex);
            }
        });
    }

    document
        .getElementById("personal-info-name")
        .addEventListener("input", function () {
            const personalInfoName =
                document.getElementById("personal-info-name");
            const errorMessage = document.getElementById(
                "personal-info-name-error"
            );
            const namePattern = /^[A-Za-z\s]+$/;

            if (!personalInfoName.value.match(namePattern)) {
                errorMessage.textContent = "Please enter full name.";
                errorMessage.style.display = "block";
            } else {
                errorMessage.style.display = "none";
            }
        });

    document
        .getElementById("personal-info-phone")
        .addEventListener("input", function () {
            const phone = document.getElementById("personal-info-phone");
            const errorMessage = document.getElementById(
                "personal-info-phone-error"
            );
            const phonePattern = /^[0-9]{10}$/;

            if (!phone.value.match(phonePattern)) {
                errorMessage.textContent =
                    "Please enter a valid 10-digit phone number.";
                errorMessage.style.display = "block";
            } else {
                errorMessage.style.display = "none";
            }
        });

    document
        .getElementById("personal-info-email")
        .addEventListener("input", function () {
            const email = document.getElementById("personal-info-email");
            const errorMessage = document.getElementById(
                "personal-info-email-error"
            );
            const emailPattern =
                /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

            if (!email.value.match(emailPattern)) {
                errorMessage.textContent =
                    "Please enter a valid email address.";
                errorMessage.style.display = "block";
            } else {
                errorMessage.style.display = "none";
            }
        });

    document
        .getElementById("personal-info-city")
        .addEventListener("input", function () {
            const city = document.getElementById("personal-info-city");
            const errorMessage = document.getElementById("city-error");

            if (city.value.trim() === "") {
                errorMessage.textContent = "Please enter the city.";
                errorMessage.style.display = "block";
            } else {
                errorMessage.style.display = "none";
            }
        });

    document
        .getElementById("personal-info-referral")
        .addEventListener("input", function () {
            const referralCode = document.getElementById(
                "personal-info-referral"
            );
            const errorMessage = document.getElementById("referralCode-error");

            if (!referralCode.value) {
                errorMessage.textContent = "Please enter the referral code";
                errorMessage.style.display = "block";
            } else {
                errorMessage.style.display = "none";
            }
        });

    breadcrumbSections.forEach((containers, breadcrumbIndex) => {
        containers.forEach((container, containerIndex) => {
            container.style.display =
                breadcrumbIndex === 0 && containerIndex === 0
                    ? "block"
                    : "none";
        });
    });

    // Add click event listeners to breadcrumb links
    breadcrumbLinks.forEach((link, index) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();

            if (index <= currentBreadcrumbIndex) {
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container) => (container.style.display = "none")
                );
                currentBreadcrumbIndex = index;
                currentContainerIndex = 0;

                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container, i) => {
                        container.style.display = i === 0 ? "block" : "none";
                    }
                );

                updateBreadcrumbNavigation();
                updateNavigationButtons();
                updateDots();
            }
        });
    });

    document.addEventListener("input", () => {
        updateNavigationButtons();
    });

    // Initial setup
    updateBreadcrumbNavigation();
    updateNavigationButtons();
    updateDots();
    updateMobileHeading(currentBreadcrumbIndex);

    const helpTriggers = document.querySelectorAll(".help-trigger");

    function toggleHelpContainer(event, targetClass) {
        const helpContainer = document.querySelector(`.${targetClass}`);
        if (helpContainer) {
            if (
                helpContainer.style.display === "none" ||
                !helpContainer.style.display
            ) {
                helpContainer.style.display = "block";
            } else {
                helpContainer.style.display = "none";
            }
        }
    }

    helpTriggers.forEach((trigger) => {
        trigger.addEventListener("click", (event) => {
            event.stopPropagation();
            const targetClass = trigger.getAttribute("data-target");
            toggleHelpContainer(event, targetClass);
        });
    });

    document.addEventListener("click", (event) => {
        const helpContainers = document.querySelectorAll(".help-container");
        helpContainers.forEach((container) => {
            if (
                container.style.display === "block" &&
                !container.contains(event.target)
            ) {
                container.style.display = "none";
            }
        });
    });

    function truncateFileName(fileName, maxLength = 25) {
        if (fileName.length <= maxLength) {
            return fileName;
        } else {
            const extension = fileName.slice(fileName.lastIndexOf("."));
            const truncatedName =
                fileName.slice(0, maxLength - extension.length - 3) + "...";
            return truncatedName + extension;
        }
    }

    async function handleFileUpload(
        event,
        fileNameId,
        uploadIconId,
        removeIconId,
        studentId = null
    ) {
        console.log(event, fileNameId, uploadIconId, removeIconId, studentId);
        const fileInput = event.target;
        const fileNameElement = document.getElementById(fileNameId);
        const uploadIcon = document.getElementById(uploadIconId);
        const removeIcon = document.getElementById(removeIconId);
        const file = fileInput.files[0];

        const helpTrigger =
            fileNameElement.parentElement.nextElementSibling.querySelector(
                ".help-trigger"
            );
        const formatInfo =
            fileNameElement.parentElement.nextElementSibling.querySelector(
                "span:last-child"
            );

        if (!file) {
            fileNameElement.textContent = "No file chosen";
            uploadIcon.style.display = "inline";
            removeIcon.style.display = "none";
            if (helpTrigger) helpTrigger.style.display = "inline";
            if (formatInfo) formatInfo.style.display = "inline";
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert("Error: File size exceeds 5MB limit.");
            fileInput.value = "";
            fileNameElement.textContent = "No file chosen";
            uploadIcon.style.display = "inline";
            removeIcon.style.display = "none";
            if (helpTrigger) helpTrigger.style.display = "inline";
            if (formatInfo) formatInfo.style.display = "inline";
            return;
        }

        // Validate file type
        const allowedExtensions = [".jpg", ".jpeg", ".png", ".pdf"];
        const fileExtension = file.name
            .slice(file.name.lastIndexOf("."))
            .toLowerCase();
        if (!allowedExtensions.includes(fileExtension)) {
            alert("Error: Only .jpg, .jpeg, .png, and .pdf files are allowed.");
            fileInput.value = ""; // Clear the file input
            fileNameElement.textContent = "No file chosen";
            uploadIcon.style.display = "inline";
            removeIcon.style.display = "none";
            if (helpTrigger) helpTrigger.style.display = "inline";
            if (formatInfo) formatInfo.style.display = "inline";
            return;
        }

        const fileSizeInKB = (file.size / 1024).toFixed(2);
        const fileSizeDisplay =
            fileSizeInKB > 1024
                ? `${(fileSizeInKB / 1024).toFixed(2)} MB`
                : `${fileSizeInKB} KB`;

        const truncatedFileName = truncateFileName(file.name);
        fileNameElement.textContent = truncatedFileName;
        uploadIcon.style.display = "none";
        removeIcon.style.display = "inline";

        if (helpTrigger) helpTrigger.style.display = "none";
        if (formatInfo) formatInfo.textContent = `${fileSizeDisplay} uploaded`;

        const fileIcon = document.createElement("img");
        fileIcon.style.width = "20px";
        fileIcon.style.height = "20px";
        fileIcon.style.marginRight = "10px";

        // Add the icon based on the file type
        if (
            fileExtension === ".jpg" ||
            fileExtension === ".jpeg" ||
            fileExtension === ".png"
        ) {
            fileIcon.src = "assets/images/image-upload.png";
        } else if (fileExtension === ".pdf") {
            fileIcon.src = "assets/images/image-pdf.png";
        }

        const existingIcon = fileNameElement.querySelector("img");
        if (existingIcon) {
            existingIcon.remove();
        }
        fileNameElement.insertBefore(fileIcon, fileNameElement.firstChild);

        document
            .querySelectorAll(".document-name")
            .forEach((documentElement) => {
                documentElement.style.display = "block"; // Display all document names
            });

        if (studentId === null) {
            const userId = document.getElementById(
                "personal-info-userid"
            ).value;
            await uploadFileToServer(file, userId, fileNameId);
        } else if (studentId !== null) {
            const userId = studentId;
            await uploadFileToServer(file, userId, fileNameId);
        }
    }

    function uploadFileToServer(file, userId, fileNameId) {
        fileNameId = fileNameId.replace(`-${userId}`, "");

        const formDetailsData = new FormData();
        formDetailsData.append("file", file);
        formDetailsData.append("userId", userId);
        formDetailsData.append("fileNameId", fileNameId);

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        if (!csrfToken) {
            console.error("CSRF token not found");
            return;
        }

        fetch("/upload-each-documents", {
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

        console.log(file, userId, fileNameId);
    }

    async function removeFile(
        fileInputId,
        fileNameId,
        uploadIconId,
        removeIconId,
        studentId = null
    ) {
        const fileInput = document.getElementById(fileInputId);
        const fileNameElement = document.getElementById(fileNameId);
        const uploadIcon = document.getElementById(uploadIconId);
        const removeIcon = document.getElementById(removeIconId);

        const helpTrigger =
            fileNameElement.parentElement.nextElementSibling.querySelector(
                ".help-trigger"
            );
        const formatInfo =
            fileNameElement.parentElement.nextElementSibling.querySelector(
                "span:last-child"
            );

        fileInput.value = "";
        fileNameElement.textContent = "No file chosen";

        uploadIcon.style.display = "inline";
        removeIcon.style.display = "none";

        if (helpTrigger) helpTrigger.style.display = "inline";
        if (formatInfo) formatInfo.textContent = "*jpg, png, pdf formats";

        const fileIcon = fileNameElement.querySelector("img");
        if (fileIcon) {
            fileIcon.remove();
        }
        if (studentId === null) {
            const userId = document.getElementById(
                "personal-info-userid"
            ).value;
            await deleteFileToServer(userId, fileNameId);
            console.log(fileNameId);
        } else if (studentId !== null) {
            const userId = studentId;
            await deleteFileToServer(userId, fileNameId);
            console.log(fileNameId);
        }
    }

    function deleteFileToServer(userId, fileNameId) {
        fileNameId = fileNameId.replace(`-${userId}`, "");

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        if (!csrfToken) {
            console.error("CSRF token not found");
            return;
        }

        const data = {
            userId: userId,
            fileNameId: fileNameId,
        };

        fetch("/remove-each-documents", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((errorData) => {
                        throw new Error(
                            errorData.message || "Network response was not ok"
                        );
                    });
                }
                return response.json(); // Parse the JSON response
            })
            .then((data) => {
                if (data) {
                    console.log("Files deleted successfully", data); // Handle success
                } else {
                    console.error(
                        "Error: No data returned from the server",
                        data
                    );
                }
            })
            .catch((error) => {
                console.error("Error deleting file", error); // Handle errors
            });
    }

    const borrowBloodRelative = document.querySelector(
        ".borrow-blood-relative"
    );
    const borrowOptionIcon = borrowBloodRelative.querySelector(
        ".borrow-option-icon"
    );
    const borrowDropdown =
        borrowBloodRelative.querySelector(".borrow-dropdown");
    const borrowBloodLabel = document.getElementById("borrow-blood-label");
    const bloodRelativeRadio = document.getElementById("borrow-blood-relative");

    // Toggle dropdown visibility on radio button or icon click
    function toggleDropdown() {
        borrowBloodRelative.classList.toggle("open");
        borrowDropdown.style.display = borrowBloodRelative.classList.contains(
            "open"
        )
            ? "flex"
            : "none";
    }

    // Toggle dropdown when the radio button or the icon is clicked
    bloodRelativeRadio.addEventListener("click", toggleDropdown);
    borrowOptionIcon.addEventListener("click", toggleDropdown);

    // Handle dropdown item selection
    borrowDropdown.addEventListener("click", function (e) {
        if (e.target.classList.contains("borrow-dropdown-item")) {
            // Update label text without changing color
            borrowBloodLabel.textContent = e.target.textContent;

            document
                .querySelectorAll(".borrow-dropdown-item")
                .forEach((item) => {
                    item.classList.remove("selected");
                });

            // Add 'selected' class to clicked item (for styling if needed)
            e.target.classList.add("selected");

            // Close dropdown
            borrowBloodRelative.classList.remove("open");
            borrowDropdown.style.display = "none";
        }
    });

    // Close dropdown on outside click
    document.addEventListener("click", function (event) {
        if (!borrowBloodRelative.contains(event.target)) {
            borrowBloodRelative.classList.remove("open");
            borrowDropdown.style.display = "none";
        }
    });

    //change start
    // upadted js Code
    const dropdown = document.querySelector(".dropdown-about");
    const dropdownLabel = dropdown.querySelector(".dropdown-label-about");
    const dropdownOptions = dropdown.querySelector(".dropdown-options-about");
    const options = dropdown.querySelectorAll(".dropdown-option-about-us");
    let selectedValue = ""; // Variable to hold the selected value

    // Toggle the dropdown visibility when clicked
    dropdown.addEventListener("click", function (event) {
        dropdown.classList.toggle("open");
        event.stopPropagation();
    });

    // Handle option selection
    options.forEach((option) => {
        option.addEventListener("click", function (event) {
            dropdownLabel.textContent = option.textContent;
            options.forEach((opt) => opt.classList.remove("selected"));
            option.classList.add("selected");
            selectedValue = option.getAttribute("data-value"); // Capture the selected value here
            dropdown.classList.remove("open");
            event.stopPropagation();
        });
    });

    // Close the dropdown if clicked outside
    document.addEventListener("click", function (event) {
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove("open");
        }
    });

    const dropdowns = document.querySelectorAll("#step-3 .dropdown");

    dropdowns.forEach((dropdown) => {
        const dropdownLabel = dropdown.querySelector(".dropdown-label");
        const dropdownOptions = dropdown.querySelector(".dropdown-options");
        const options = dropdown.querySelectorAll(".dropdown-option");

        // Toggle the dropdown visibility when clicked
        dropdown.addEventListener("click", function (event) {
            dropdown.classList.toggle("open");
            event.stopPropagation();
        });

        // Handle option selection
        options.forEach((option) => {
            option.addEventListener("click", function (event) {
                const selectedValue = option.getAttribute("data-value");
                dropdownLabel.textContent = option.textContent;
                dropdownLabel.setAttribute("data-selected", selectedValue); // Set the data-selected attribute

                options.forEach((opt) => opt.classList.remove("selected"));
                option.classList.add("selected");
                dropdown.classList.remove("open");
                event.stopPropagation();
            });
        });

        // Close the dropdown if clicked outside
        document.addEventListener("click", function (event) {
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove("open");
            }
        });
    });

    // Function to get the selected course duration
    function getSelectedCourseDuration() {
        const selectedOption = document
            .querySelector(".dropdown-label")
            .getAttribute("data-selected");
        console.log("Selected Course Duration:", selectedOption);
        return selectedOption;
    }

    const yesRadio = document.getElementById("academic-yes");
    const noRadio = document.getElementById("academic-no");
    const reasonContainer = document.getElementById("reason-container");

    // Function to handle radio button change
    function handleRadioChange(shouldShow) {
        if (shouldShow) {
            reasonContainer.classList.add("visible");
        } else {
            reasonContainer.classList.remove("visible");
        }
    }

    // Add event listeners
    yesRadio.addEventListener("change", () => {
        handleRadioChange(yesRadio.checked);
    });

    noRadio.addEventListener("change", () => {
        handleRadioChange(yesRadio.checked);
    });

    const inputField = document.getElementById("personal-info-city");
    const suggestionsContainer = document.getElementById("suggestions");

    inputField.addEventListener("input", handleInputChange);

    document.addEventListener("click", (event) => {
        if (!event.target.closest(".input-group")) {
            suggestionsContainer.style.display = "none";
        }
    });

    async function handleInputChange() {
        const inputValue = inputField.value.toLowerCase();

        const suggestion = await fetchLocationSuggestion(inputValue);
        displaySuggestion(suggestion);
    }

    async function fetchLocationSuggestion(query) {
        const topCities = [
            "mumbai",
            "delhi",
            "bangalore",
            "hyderabad",
            "chennai",
            "kolkata",
            "pune",
            "surat",
            "jaipur",
            "ahmedabad",
            "vijayawada",
            "indore",
            "visakhapatnam",
            "nagpur",
            "lucknow",
            "kanpur",
            "thane",
            "bhopal",
            "kochi",
            "coimbatore",
        ];

        const matchedCities = topCities.filter((city) => city.includes(query));

        if (matchedCities.length > 0) {
            switch (matchedCities[0]) {
                case "mum":
                    return "Mumbai";
                case "del":
                    return "Delhi";
                case "ban":
                    return "Bangalore";
                case "hyd":
                    return "Hyderabad";
                case "che":
                    return "Chennai";
                case "kol":
                    return "Kolkata";
                case "pun":
                    return "Pune";
                case "sur":
                    return "Surat";
                case "jai":
                    return "Jaipur";
                case "ahm":
                    return "Ahmedabad";
                case "vij":
                    return "Vijayawada";
                case "ind":
                    return "Indore";
                case "vis":
                    return "Visakhapatnam";
                case "nag":
                    return "Nagpur";
                case "luc":
                    return "Lucknow";
                case "kan":
                    return "Kanpur";
                case "tha":
                    return "Thane";
                case "bho":
                    return "Bhopal";
                case "koc":
                    return "Kochi";
                case "coi":
                    return "Coimbatore";
                default:
                    return query.charAt(0).toUpperCase() + query.slice(1);
            }
        } else {
            return "";
        }
    }

    function displaySuggestion(suggestion) {
        suggestionsContainer.innerHTML = "";

        if (suggestion) {
            const suggestionElement = document.createElement("div");
            suggestionElement.classList.add("suggestion");
            suggestionElement.textContent = suggestion;
            suggestionElement.addEventListener("click", () => {
                inputField.value = suggestion;
                suggestionsContainer.style.display = "none";
            });
            suggestionsContainer.appendChild(suggestionElement);
            suggestionsContainer.style.display = "block";
        } else {
            suggestionsContainer.style.display = "none";
        }
    }

    const otherCheckbox = document.querySelector("#other-checkbox");
    const addCountryBox = document.querySelector(".add-country-box");

    otherCheckbox.addEventListener("change", () => {
        if (otherCheckbox.checked) {
            addCountryBox.style.display = "block";
        } else {
            addCountryBox.style.display = "none";
        }
    });

    const othersRadio = document.getElementById("others");
    const otherDegreeInputContainer = document.querySelector(
        ".other-degree-input-container"
    );
    const otherDegreeInput = document.getElementById("other-degree");
    const degreeRadios = document.querySelectorAll('input[name="degree_type"]');

    let isOthersSelected = false; // Track the state of the "Others" radio button

    degreeRadios.forEach((radio) => {
        radio.addEventListener("click", () => {
            if (radio === othersRadio) {
                // Toggle the "Others" input field visibility
                isOthersSelected = !isOthersSelected;
                otherDegreeInputContainer.style.display = isOthersSelected
                    ? "flex"
                    : "none";

                if (!isOthersSelected) {
                    // Reset the "Others" radio button value and clear the text input
                    othersRadio.value = "others";
                    otherDegreeInput.value = "";
                }
            } else {
                // Hide the input field and reset state when other radio buttons are clicked
                isOthersSelected = false;
                otherDegreeInputContainer.style.display = "none";
                othersRadio.value = "others"; // Reset "Others" value
                otherDegreeInput.value = ""; // Clear the text input
            }
        });
    });

    // Update the "Others" radio value instantly when typing in the text input
    otherDegreeInput.addEventListener("input", () => {
        othersRadio.value = otherDegreeInput.value;
    });

    //validate
    document
        .getElementById("loan-amount")
        .addEventListener("input", function () {
            const loanAmount = document.getElementById("loan-amount");
            const errorMessage = document.getElementById("loan-error-message");

            if (
                !loanAmount.value ||
                isNaN(loanAmount.value) ||
                loanAmount.value <= 0
            ) {
                errorMessage.style.display = "block";
            } else {
                errorMessage.style.display = "none";
            }
        });

    //borrower container
    document
        .getElementById("income-co-borrower")
        .addEventListener("input", function () {
            const incomeInput = document.getElementById("income-co-borrower");
            const errorMessage = document.getElementById(
                "income-error-message"
            );

            // Check if the input is not a valid number or is empty
            if (isNaN(incomeInput.value) || incomeInput.value.trim() === "") {
                errorMessage.style.display = "block";
            } else {
                errorMessage.style.display = "none";
            }
        });

    document
        .getElementById("yes-liability")
        .addEventListener("change", function () {
            const emiInput = document.getElementById("emi-amount");
            emiInput.disabled = false;
        });

    document
        .getElementById("no-liability")
        .addEventListener("change", function () {
            const emiInput = document.getElementById("emi-amount");
            emiInput.disabled = true;
            emiInput.value = "";
            document.getElementById("emi-error-message").style.display = "none";
        });

    document
        .getElementById("emi-amount")
        .addEventListener("input", function () {
            const emiInput = document.getElementById("emi-amount");
            const errorMessage = document.getElementById("emi-error-message");

            // Check if the input is a valid number or not empty
            if (
                (emiInput.value && isNaN(emiInput.value)) ||
                emiInput.value.trim() === ""
            ) {
                errorMessage.style.display = "block";
            } else {
                errorMessage.style.display = "none";
            }
        });

    document
        .getElementById("city-input")
        .addEventListener("input", function () {
            const city = document.getElementById("city-input");
            const errorMessage = document.getElementById("city-error");

            if (city.value.trim() === "") {
                errorMessage.textContent = "Please enter the city.";
                errorMessage.style.display = "block";
            } else {
                errorMessage.style.display = "none";
            }
        });

   // Get the dropdown elements with gender prefix
  const genderDropdown = document.querySelector(".dropdown-gender");
  const genderHeader = genderDropdown?.querySelector(".dropdown-gender-header");
  const genderOptions = genderDropdown?.querySelector(".dropdown-options-gender");
  const genderLabel = genderDropdown?.querySelector(".dropdown-label-gender");
  const genderHiddenInput = genderDropdown?.querySelector('input[name="gender"]');
  const genderOptionItems = genderDropdown?.querySelectorAll(".dropdown-option-gender");

  // Log the dropdown elements to verify they are found
  console.log("genderDropdown:", genderDropdown);
  console.log("genderHeader:", genderHeader);
  console.log("genderOptions:", genderOptions);
  console.log("genderLabel:", genderLabel);
  console.log("genderHiddenInput:", genderHiddenInput);
  console.log("genderOptionItems:", genderOptionItems);

  // Check if critical elements exist
  if (!genderDropdown || !genderHeader || !genderOptions) {
    console.error("One or more dropdown elements not found. Check HTML structure or selectors.");
    return;
  }

  // Toggle dropdown visibility on header click
  genderHeader.addEventListener("click", () => {
    console.log("Header clicked. Current display:", genderOptions.style.display);
    genderOptions.style.display =
      genderOptions.style.display === "block" ? "none" : "block";
    console.log("New display:", genderOptions.style.display);
  });

  // Handle option selection
  genderOptionItems.forEach((option, index) => {
    option.addEventListener("click", () => {
      console.log(`Option ${index + 1} clicked. Data-value:`, option.getAttribute("data-value"));
      const selectedValue = option.getAttribute("data-value");
      const selectedText = option.querySelector("span")?.textContent;

      // Update the dropdown label and hidden input
      if (selectedText && genderLabel && genderHiddenInput) {
        genderLabel.textContent = selectedText;
        genderHiddenInput.value = selectedValue;
        console.log("Updated label:", selectedText, "Updated input value:", selectedValue);
      } else {
        console.error("Failed to update label or input. Check span or elements.");
      }

      // Close the dropdown
      genderOptions.style.display = "none";
      console.log("Dropdown closed. Display:", genderOptions.style.display);
    });
  });

  // Close dropdown when clicking outside
  document.addEventListener("click", (event) => {
    if (!genderDropdown.contains(event.target)) {
      console.log("Clicked outside dropdown. Closing dropdown.");
      genderOptions.style.display = "none";
      console.log("Dropdown display:", genderOptions.style.display);
    }
  });
}); //close addEventListener
