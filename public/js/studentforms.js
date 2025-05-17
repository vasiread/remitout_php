document.addEventListener("DOMContentLoaded", () => {
    const studentFormMenuIcon = document.getElementById(
        "student-form-menu-icon",
    );
    const studentFormNavLinks = document.getElementById(
        "student-form-nav-links",
    );

    studentFormMenuIcon.addEventListener("click", () => {
        studentFormMenuIcon.classList.toggle("active");
        studentFormNavLinks.classList.toggle("active");
    });

    function showToast(message, duration = 3000) {
        const toastContainer = document.getElementById("toast-container");
        const toast = document.createElement("div");
        toast.className = "toast";
        toast.textContent = message;
        toastContainer.appendChild(toast);
        setTimeout(() => {
            toast.classList.add("show");
        }, 100);
        setTimeout(() => {
            toast.classList.remove("show");
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, duration);
    }

    const style = document.createElement("style");
    style.textContent = `
        .toast-container { position: fixed; top: 20px; right: 20px; z-index: 1000; }
        .toast {   background-color: #f47b20;  font-family: 'Poppins', sans-serif; color: white; padding: 12px 20px; margin-bottom: 10px; border-radius: 4px; opacity: 0; transition: opacity 0.3s ease; }
        .toast.show { opacity: 1; }
    `;
    document.head.appendChild(style);

    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    const secretKey = "rJXU0e4lTP7G+KP9dH5V1pq9P7vP8d8sravZmzMGUKM=";
    const refParam = getQueryParam("ref");
    const referralInput = document.getElementById("personal-info-referral");

    if (refParam && referralInput) {
        try {
            if (typeof CryptoJS === "undefined") {
                console.error(
                    "CryptoJS library is not loaded. Please include it in your HTML.",
                );
                referralInput.value = refParam;
            } else {
                const bytes = CryptoJS.AES.decrypt(
                    decodeURIComponent(refParam),
                    secretKey,
                );
                const decryptedRef = bytes.toString(CryptoJS.enc.Utf8);
                if (decryptedRef) {
                    referralInput.value = decryptedRef;
                } else {
                    console.error(
                        "Decryption failed: Invalid key or corrupted data",
                    );
                    referralInput.value = refParam;
                }
            }
            referralInput.disabled = true;
        } catch (error) {
            console.error("Error decrypting ref parameter:", error);
            referralInput.value = refParam;
            referralInput.disabled = true;
        }
    }

    window.handleFileUpload = handleFileUpload;
    window.removeFile = removeFile;

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
            showToast("KYC section loaded");
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

    const breadcrumbDots = [2, 4, 3, 3, 6];
    let currentBreadcrumbIndex = 0;
    let currentContainerIndex = 0;

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

    function areFieldsFilled() {
        const currentContainers = breadcrumbSections[currentBreadcrumbIndex];
        const currentContainer = currentContainers[currentContainerIndex];
        const inputs = currentContainer.querySelectorAll(
            "input[required], select[required], textarea[required]",
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

    let isNavigating = false; // Add navigation lock

    function navigate(direction) {
        if (isNavigating) {
            console.log("Navigation blocked: already navigating");
            return;
        }
        isNavigating = true;
        console.log("Before navigation:", {
            currentBreadcrumbIndex,
            currentContainerIndex,
        });

        const currentContainers = breadcrumbSections[currentBreadcrumbIndex];
        currentContainers[currentContainerIndex].style.display = "none";

        if (direction === "next") {
            if (currentContainerIndex < currentContainers.length - 1) {
                currentContainerIndex++;
            } else if (currentBreadcrumbIndex < breadcrumbSections.length - 1) {
                currentBreadcrumbIndex++;
                currentContainerIndex = 0; // Reset to first container
                // Hide all containers in the new section
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container) => (container.style.display = "none"),
                );
                showToast("Details have been saved successfully");
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
        console.log(
            "Displaying container:",
            updatedContainers[currentContainerIndex].className,
        );
        updatedContainers[currentContainerIndex].style.display = "block";

        updateBreadcrumbNavigation();
        updateNavigationButtons();
        updateDots();
        updateMobileHeading(currentBreadcrumbIndex);

        console.log("After navigation:", {
            currentBreadcrumbIndex,
            currentContainerIndex,
        });
        isNavigating = false;
    }

    nextButton.addEventListener("click", () => {
        if (areFieldsFilled()) {
            navigate("next");
        }
    });

    function updateUserIds() {
        const personalInfoId = document.getElementById(
            "personal-info-userid",
        ).value;
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
                console.error("Error updating user IDs:", error);
            });
    }
    updateUserIds();

    function updateCoborrowerInfo(event) {
        event.preventDefault();
        function getSelectedAnswer(callback) {
            const selectedOption = document.querySelector(
                'input[name="borrow-relation"]:checked',
            );
            if (selectedOption && selectedOption.value !== "blood-relative") {
                return callback(selectedOption.value);
            } else if (
                selectedOption &&
                selectedOption.value === "blood-relative"
            ) {
                const dropdownRelative = document.querySelectorAll(
                    ".borrow-dropdown .borrow-dropdown-item",
                );
                dropdownRelative.forEach((item) => {
                    item.addEventListener("click", function () {
                        const relativeValue = item.dataset.value;
                        callback(relativeValue);
                    });
                });
                return;
            } else {
                return callback("none selected here");
            }
        }
        getSelectedAnswer(function (answer) {
            const personalInfoId = document.getElementById(
                "personal-info-userid",
            ).value;
            var incomeValue =
                document.getElementById("income-co-borrower").value;
            var selectedLiability = document.querySelector(
                'input[name="co-borrower-liability"]:checked',
            ).value;
            var emiAmount = document.querySelector(
                ".emi-content .emi-content-container",
            ).value;
            const coborrowerData = {
                personalInfoId,
                answer,
                incomeValue,
                selectedLiability,
                emiAmount,
            };
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
                    if (data.success) {
                        showToast("Details have been saved successfully");
                    } else {
                        console.error(
                            "Failed to update co-borrower info:",
                            data.message,
                        );
                    }
                })
                .catch((error) => {
                    console.error("Error updating co-borrower info:", error);
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
            showToast("Details have been saved successfully");
            window.location.href = "/student-dashboard";
        });

    function updateUserPersonalInfo(event) {
        event.preventDefault();

        const personalInfoId = document.getElementById("personal-info-userid").value;
        const personalInfoName = document.getElementById("personal-info-name").value;
        const personalInfoPhone = document.getElementById("personal-info-phone").value;
        const personalInfoEmail = document.getElementById("personal-info-email").value;
        const personalInfoCity = document.getElementById("personal-info-city").value;
        const personalInfoReferral = document.getElementById("personal-info-referral").value;
        const personalInfoState = document.getElementById("personal-info-state").value;
        const personalInfoDob = document.getElementById("personal-info-dob").value;
        const genderOptions = document.getElementById("gender-personal-info").value;
        const personalInfoFindOut = selectedValue; // assuming selectedValue is defined globally

        // ✅ Collect dynamic fields
        const dynamicFields = {};
        document.querySelectorAll('input[name^="dynamic_fields["]').forEach((input) => {
            const name = input.getAttribute("name"); // e.g., "dynamic_fields[5]"
            const match = name.match(/^dynamic_fields\[(\d+)\]$/);
            if (match) {
                const fieldId = match[1];
                dynamicFields[fieldId] = input.value;
            }
        });

        // ✅ Validate required fields (as you already do)
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
                genderOptions,
                personalInfoDob,
                personalInfoCity,
                personalInfoState,
                personalInfoReferral,
                personalInfoFindOut,
                dynamic_fields: dynamicFields 
            };

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
                    if (data.success) {
                        showToast("Details have been saved successfully");
                        navigate("next");
                    } else {
                        console.error("Failed to update personal info:", data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error updating personal info:", error);
                });
        }
    }

    function getSelectedExpenseType() {
        const selectedExpense = document.querySelector(
            'input[name="expense-type"]:checked',
        );
        return selectedExpense ? selectedExpense.value : null;
    }

    function getLoanAmount() {
        const loanAmount = document.getElementById("loan-amount").value;
        return loanAmount.trim();
    }

    function getSelectedStudyLocations() {
        const checkboxes = document.querySelectorAll(
            '#selected-study-location input[type="checkbox"]:checked',
        );
        const selectedLocations = [];
        checkboxes.forEach((checkbox) => {
            selectedLocations.push(checkbox.value);
        });
        return selectedLocations;
    }

    function updateUserCourseInfo(event) {
        event.preventDefault();
        const personalInfoId = document.getElementById(
            "personal-info-userid",
        ).value;
        const selectedDegreeType = document.querySelector(
            '#course-info-degreetype input[name="degree_type"]:checked',
        ).value;
        const expenseType = getSelectedExpenseType();
        const loanAmount = getLoanAmount();
        const courseDuration = getSelectedCourseDuration();
        const studyLocations = getSelectedStudyLocations();
        const courseInfoData = {
            personalInfoId,
            selectedDegreeType,
            expenseType,
            loanAmount,
            courseDuration,
            studyLocations,
        };
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
                if (data.success) {
                    showToast("Details have been saved successfully");
                    navigate("next");
                } else {
                    console.error(
                        "Failed to update course info:",
                        data.message,
                    );
                }
            })
            .catch((error) => {
                console.error("Error updating course info:", error);
            });
    }

    // Function to validate a single score field and update its error message
    function validateScore(fieldId, scoreValue, minScore, errorMessagePrefix) {
        const errorElement = document.getElementById(`${fieldId}-error`);
        errorElement.textContent = "";

        if (scoreValue) {
            const scoreNum = parseFloat(scoreValue);
            if (isNaN(scoreNum)) {
                errorElement.textContent = `${errorMessagePrefix} score must be a valid number`;
                return false;
            } else if (scoreNum < minScore) {
                errorElement.textContent = `${errorMessagePrefix} score must be at least ${minScore}`;
                return false;
            }
        }
        return true;
    }

    // Function to validate all scores (used on submission)
    function validateAllScores(ieltsScore, greScore, toeflScore) {
        let isValid = true;

        // Validate IELTS
        if (!validateScore("ielts", ieltsScore, 6.5, "IELTS")) {
            isValid = false;
        }

        // Validate GRE
        if (!validateScore("gre", greScore, 280, "GRE")) {
            isValid = false;
        }

        // Validate TOEFL
        if (!validateScore("toefl", toeflScore, 90, "TOEFL")) {
            isValid = false;
        }

        return isValid;
    }

    // Add real-time validation for each field
    const ieltsInput = document.getElementById("admit-ielts");
    const greInput = document.getElementById("admit-gre");
    const toeflInput = document.getElementById("admit-toefl");

    ieltsInput.addEventListener("input", () => {
        validateScore("ielts", ieltsInput.value.trim(), 6.5, "IELTS");
    });

    greInput.addEventListener("input", () => {
        validateScore("gre", greInput.value.trim(), 280, "GRE");
    });

    toeflInput.addEventListener("input", () => {
        validateScore("toefl", toeflInput.value.trim(), 90, "TOEFL");
    });

    // Optional: Add blur event for validation when the user leaves the field
    ieltsInput.addEventListener("blur", () => {
        validateScore("ielts", ieltsInput.value.trim(), 6.5, "IELTS");
    });

    greInput.addEventListener("blur", () => {
        validateScore("gre", greInput.value.trim(), 280, "GRE");
    });

    toeflInput.addEventListener("blur", () => {
        validateScore("toefl", toeflInput.value.trim(), 90, "TOEFL");
    });

    function updateAcademicsCourseInfo(event) {
        event.preventDefault();
        const personalInfoId = document.getElementById(
            "personal-info-userid",
        ).value;
        const selectedAcademicGap = document.querySelector(
            'input[name="academics-gap"]:checked',
        ).value;
        const reasonForGap = document.querySelector(
            ".academic-reason textarea",
        ).value;
        const selectedAdmitOption = document.querySelector(
            'input[name="admit-option"]:checked',
        ).value;
        const selectedWorkOption = document.querySelector(
            'input[name="work-option"]:checked',
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

        // Final validation before submission
        if (!validateAllScores(ieltsScore, greScore, toeflScore)) {
            return; // Stop submission if validation fails
        }

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
        fetch("/update-academicsinfo", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify(academicDetails),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    showToast("Details have been saved successfully");
                    navigate("next");
                } else {
                    console.error(
                        "Failed to update academic info:",
                        data.message,
                    );
                }
            })
            .catch((error) => {
                console.error("Error updating academic info:", error);
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
                    (container) => (container.style.display = "none"),
                );
                currentBreadcrumbIndex++;
                currentContainerIndex = 0;
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container, index) => {
                        container.style.display =
                            index === 0 ? "block" : "none";
                    },
                );
                updateBreadcrumbNavigation();
                updateNavigationButtons();
                updateDots();
                updateMobileHeading(currentBreadcrumbIndex);
                showToast("Details have been saved successfully");
            }
        }
    });

    if (nextCourseButton) {
        nextCourseButton.addEventListener("click", () => {
            if (currentBreadcrumbIndex === 1) {
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container) => (container.style.display = "none"),
                );
                currentBreadcrumbIndex = 2;
                currentContainerIndex = 0;
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container, index) => {
                        container.style.display =
                            index === 0 ? "block" : "none";
                    },
                );
                updateBreadcrumbNavigation();
                updateNavigationButtons();
                updateDots();
                updateMobileHeading(currentBreadcrumbIndex);
                showToast("Details have been saved successfully");
            }
        });
    }

    if (nextAcademicButton) {
        nextAcademicButton.addEventListener("click", () => {
            if (currentBreadcrumbIndex === 2) {
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container) => (container.style.display = "none"),
                );
                currentBreadcrumbIndex = 3;
                currentContainerIndex = 0;
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container, index) => {
                        container.style.display =
                            index === 0 ? "block" : "none";
                    },
                );
                updateBreadcrumbNavigation();
                updateNavigationButtons();
                updateDots();
                updateMobileHeading(currentBreadcrumbIndex);
                showToast("Details have been saved successfully");
            }
        });
    }

    if (nextBorrowButton) {
        nextBorrowButton.addEventListener("click", () => {
            if (currentBreadcrumbIndex === 3) {
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container) => (container.style.display = "none"),
                );
                currentBreadcrumbIndex = 4;
                currentContainerIndex = 0;
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container, index) => {
                        container.style.display =
                            index === 0 ? "block" : "none";
                    },
                );
                updateBreadcrumbNavigation();
                updateNavigationButtons();
                updateDots();
                updateMobileHeading(currentBreadcrumbIndex);
                showToast("Details have been saved successfully");
            }
        });
    }

    document
        .getElementById("personal-info-name")
        .addEventListener("input", function () {
            const personalInfoName =
                document.getElementById("personal-info-name");
            const errorMessage = document.getElementById(
                "personal-info-name-error",
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
                "personal-info-phone-error",
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
                "personal-info-email-error",
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
        .getElementById("personal-info-state")
        .addEventListener("input", function () {
            const state = document.getElementById("personal-info-state");
            const errorMessage = document.getElementById("state-error");
            if (state.value.trim() === "") {
                errorMessage.textContent = "Please enter the state.";
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
                "personal-info-referral",
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

    breadcrumbLinks.forEach((link, index) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            if (index <= currentBreadcrumbIndex) {
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container) => (container.style.display = "none"),
                );
                currentBreadcrumbIndex = index;
                currentContainerIndex = 0;
                breadcrumbSections[currentBreadcrumbIndex].forEach(
                    (container, i) => {
                        container.style.display = i === 0 ? "block" : "none";
                    },
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
        clearName=null,       

        studentId = null,
    ) {
        const fileInput = event.target;
        const fileNameElement = document.getElementById(fileNameId);
        const uploadIcon = document.getElementById(uploadIconId);
        const removeIcon = document.getElementById(removeIconId);
        const file = fileInput.files[0];
        const helpTrigger =
            fileNameElement.parentElement.nextElementSibling.querySelector(
                ".help-trigger",
            );
        const formatInfo =
            fileNameElement.parentElement.nextElementSibling.querySelector(
                "span:last-child",
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
            showToast("File size exceeds 5MB limit.");
            fileInput.value = "";
            fileNameElement.textContent = "No file chosen";
            uploadIcon.style.display = "inline";
            removeIcon.style.display = "none";
            if (helpTrigger) helpTrigger.style.display = "inline";
            if (formatInfo) formatInfo.style.display = "inline";
            return;
        }
        const allowedExtensions = [".jpg", ".jpeg", ".png", ".pdf"];
        const fileExtension = file.name
            .slice(file.name.lastIndexOf("."))
            .toLowerCase();
        if (!allowedExtensions.includes(fileExtension)) {
            showToast("Only .jpg, .jpeg, .png, and .pdf files are allowed.");
            fileInput.value = "";
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
                documentElement.style.display = "block";
            });
        alert(studentId)
        if (studentId === null) {
            const userId = document.getElementById(
                "personal-info-userid",
            ).value;
            alert(userId)
            await uploadFileToServer(file, userId, fileNameId, clearName);
        } else if (studentId !== null) {
            const userId = studentId;
            await uploadFileToServer(file, userId, fileNameId, clearName);
        }
    }

    function uploadFileToServer(file, userId, fileNameId, clearName) {
        fileNameId = fileNameId.replace(`-${userId}`, "");
        const formDetailsData = new FormData();
        formDetailsData.append("file", file);
        formDetailsData.append("userId", userId);
        formDetailsData.append("fileNameId", fileNameId);
        formDetailsData.append("clearName", clearName);  // send clearName here

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
                            errorData.error || "Network response was not ok",
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
                        data,
                    );
                }
            })
            .catch((error) => {
                console.error("Error uploading file:", error);
            });
    }

    async function removeFile(
        fileInputId,
        fileNameId,
        uploadIconId,
        removeIconId,
        studentId = null,
    ) {
        const fileInput = document.getElementById(fileInputId);
        const fileNameElement = document.getElementById(fileNameId);
        const uploadIcon = document.getElementById(uploadIconId);
        const removeIcon = document.getElementById(removeIconId);
        const helpTrigger =
            fileNameElement.parentElement.nextElementSibling.querySelector(
                ".help-trigger",
            );
        const formatInfo =
            fileNameElement.parentElement.nextElementSibling.querySelector(
                "span:last-child",
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
                "personal-info-userid",
            ).value;
            await deleteFileToServer(userId, fileNameId);
        } else if (studentId !== null) {
            const userId = studentId;
            await deleteFileToServer(userId, fileNameId);
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
                            errorData.message || "Network response was not ok",
                        );
                    });
                }
                return response.json();
            })
            .then((data) => {
                if (data) {
                    console.log("Files deleted successfully", data);
                } else {
                    console.error(
                        "Error: No data returned from the server",
                        data,
                    );
                }
            })
            .catch((error) => {
                console.error("Error deleting file:", error);
            });
    }

    const borrowBloodRelative = document.querySelector(
        ".borrow-blood-relative",
    );
    const borrowOptionIcon = borrowBloodRelative.querySelector(
        ".borrow-option-icon",
    );
    const borrowDropdown =
        borrowBloodRelative.querySelector(".borrow-dropdown");
    const borrowBloodLabel = document.getElementById("borrow-blood-label");
    const bloodRelativeRadio = document.getElementById("borrow-blood-relative");

    function toggleDropdown() {
        borrowBloodRelative.classList.toggle("open");
        borrowDropdown.style.display = borrowBloodRelative.classList.contains(
            "open",
        )
            ? "flex"
            : "none";
    }

    bloodRelativeRadio.addEventListener("click", toggleDropdown);
    borrowOptionIcon.addEventListener("click", toggleDropdown);

    borrowDropdown.addEventListener("click", function (e) {
        if (e.target.classList.contains("borrow-dropdown-item")) {
            borrowBloodLabel.textContent = e.target.textContent;
            document
                .querySelectorAll(".borrow-dropdown-item")
                .forEach((item) => {
                    item.classList.remove("selected");
                });
            e.target.classList.add("selected");
            borrowBloodRelative.classList.remove("open");
            borrowDropdown.style.display = "none";
        }
    });

    document.addEventListener("click", function (event) {
        if (!borrowBloodRelative.contains(event.target)) {
            borrowBloodRelative.classList.remove("open");
            borrowDropdown.style.display = "none";
        }
    });

    const dropdown = document.querySelector(".dropdown-about");
    const dropdownLabel = dropdown.querySelector(".dropdown-label-about");
    const dropdownOptions = dropdown.querySelector(".dropdown-options-about");
    const options = dropdown.querySelectorAll(".dropdown-option-about-us");
    let selectedValue = "";

    dropdown.addEventListener("click", function (event) {
        dropdown.classList.toggle("open");
        event.stopPropagation();
    });

    options.forEach((option) => {
        option.addEventListener("click", function (event) {
            dropdownLabel.textContent = option.textContent;
            options.forEach((opt) => opt.classList.remove("selected"));
            option.classList.add("selected");
            selectedValue = option.getAttribute("data-value");
            dropdown.classList.remove("open");
            event.stopPropagation();
        });
    });

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
        dropdown.addEventListener("click", function (event) {
            dropdown.classList.toggle("open");
            event.stopPropagation();
        });
        options.forEach((option) => {
            option.addEventListener("click", function (event) {
                const selectedValue = option.getAttribute("data-value");
                dropdownLabel.textContent = option.textContent;
                dropdownLabel.setAttribute("data-selected", selectedValue);
                options.forEach((opt) => opt.classList.remove("selected"));
                option.classList.add("selected");
                dropdown.classList.remove("open");
                event.stopPropagation();
            });
        });
        document.addEventListener("click", function (event) {
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove("open");
            }
        });
    });

    function getSelectedCourseDuration() {
        const selectedOption = document
            .querySelector(".dropdown-label")
            .getAttribute("data-selected");
        return selectedOption;
    }

    const yesRadio = document.getElementById("academic-yes");
    const noRadio = document.getElementById("academic-no");
    const reasonContainer = document.getElementById("reason-container");

    function handleRadioChange(shouldShow) {
        if (shouldShow) {
            reasonContainer.classList.add("visible");
        } else {
            reasonContainer.classList.remove("visible");
        }
    }

    yesRadio.addEventListener("change", () => {
        handleRadioChange(yesRadio.checked);
    });

    noRadio.addEventListener("change", () => {
        handleRadioChange(yesRadio.checked);
    });

    const stateInput = document.getElementById("personal-info-state");
    const cityInput = document.getElementById("personal-info-city");
    const stateSuggestionsContainer =
        document.getElementById("suggestions-state");
    const citySuggestionsContainer =
        document.getElementById("suggestions-city");

    const states = [
        "Andhra Pradesh",
        "Arunachal Pradesh",
        "Assam",
        "Bihar",
        "Chhattisgarh",
        "Goa",
        "Gujarat",
        "Haryana",
        "Himachal Pradesh",
        "Jharkhand",
        "Karnataka",
        "Kerala",
        "Madhya Pradesh",
        "Maharashtra",
        "Manipur",
        "Meghalaya",
        "Mizoram",
        "Nagaland",
        "Odisha",
        "Punjab",
        "Rajasthan",
        "Sikkim",
        "Tamil Nadu",
        "Telangana",
        "Tripura",
        "Uttar Pradesh",
        "Uttarakhand",
        "West Bengal",
    ];

    const stateCityMap = {
        "Andhra Pradesh": [
            "Visakhapatnam",
            "Vijayawada",
            "Guntur",
            "Nellore",
            "Kurnool",
            "Rajahmundry",
            "Tirupati",
            "Kadapa",
            "Anantapur",
            "Eluru",
            "Ongole",
            "Srikakulam",
            "Machilipatnam",
            "Tenali",
            "Chittoor",
            "Vizianagaram",
            "Proddatur",
            "Adoni",
            "Madanapalle",
            "Hindupur",
            "Bhimavaram",
            "Tadepalligudem",
            "Guntakal",
            "Dharmavaram",
            "Gudivada",
            "Narasaraopet",
            "Tadipatri",
            "Chilakaluripet",
            "Amaravati",
        ],
        "Arunachal Pradesh": [
            "Itanagar",
            "Naharlagun",
            "Tawang",
            "Pasighat",
            "Bomdila",
            "Ziro",
            "Aalo",
            "Tezu",
            "Roing",
            "Daporijo",
            "Along",
            "Yingkiong",
            "Changlang",
            "Namsai",
            "Khonsa",
            "Anini",
            "Seppa",
            "Basar",
            "Jairampur",
            "Deomali",
        ],
        Assam: [
            "Guwahati",
            "Silchar",
            "Dibrugarh",
            "Jorhat",
            "Nagaon",
            "Tinsukia",
            "Tezpur",
            "Bongaigaon",
            "Karimganj",
            "Dhubri",
            "Sivasagar",
            "Goalpara",
            "Barpeta",
            "Lakhimpur",
            "Hailakandi",
            "Golaghat",
            "Diphu",
            "Kokrajhar",
            "North Lakhimpur",
            "Mangaldoi",
            "Biswanath Chariali",
            "Hojai",
            "Morigaon",
            "Dhemaji",
            " Pathsala",
        ],
        Bihar: [
            "Patna",
            "Gaya",
            "Bhagalpur",
            "Muzaffarpur",
            "Darbhanga",
            "Purnia",
            "Arrah",
            "Begusarai",
            "Katihar",
            "Munger",
            "Chapra",
            "Bettiah",
            "Motihari",
            "Siwan",
            "Samastipur",
            "Hajipur",
            "Sasaram",
            "Dehri",
            "Sitamarhi",
            "Nawada",
            "Aurangabad",
            "Buxar",
            "Jehanabad",
            "Madhubani",
            "Jamui",
            "Supaul",
            "Kishanganj",
            "Araria",
            "Sheikhpura",
            "Lakhisarai",
        ],
        Chhattisgarh: [
            "Raipur",
            "Bhilai",
            "Durg",
            "Bilaspur",
            "Korba",
            "Jagdalpur",
            "Raigarh",
            "Ambikapur",
            "Dhamtari",
            "Mahasamund",
            "Rajnandgaon",
            "Kanker",
            "Narayanpur",
            "Sukma",
            "Kondagaon",
            "Janjgir",
            "Mungeli",
            "Balod",
            "Bemetara",
            "Baloda Bazar",
            "Gariaband",
            "Surajpur",
            "Jashpur",
            "Koriya",
            "Balrampur",
        ],
        Goa: [
            "Panaji",
            "Margao",
            "Vasco da Gama",
            "Mapusa",
            "Ponda",
            "Bicholim",
            "Curchorem",
            "Sanguem",
            "Valpoi",
            "Canacona",
            "Cuncolim",
            "Quepem",
            "Sanquelim",
            "Chaudi",
            "Pernem",
        ],
        Gujarat: [
            "Ahmedabad",
            "Surat",
            "Vadodara",
            "Rajkot",
            "Gandhinagar",
            "Bhavnagar",
            "Jamnagar",
            "Junagadh",
            "Anand",
            "Bharuch",
            "Nadiad",
            "Mehsana",
            "Porbandar",
            "Navsari",
            "Valsad",
            "Gandhidham",
            "Vapi",
            "Ankleshwar",
            "Godhra",
            "Palanpur",
            "Patan",
            "Morbi",
            "Surendranagar",
            "Veraval",
            "Botad",
            "Amreli",
            "Deesa",
            "Jetpur",
            "Dahod",
            "Himmatnagar",
        ],
        Haryana: [
            "Gurgaon",
            "Faridabad",
            "Panipat",
            "Ambala",
            "Hisar",
            "Karnal",
            "Rohtak",
            "Yamunanagar",
            "Sonipat",
            "Panchkula",
            "Rewari",
            "Sirsa",
            "Bhiwani",
            "Jind",
            "Kurukshetra",
            "Kaithal",
            "Palwal",
            "Fatehabad",
            "Mahendragarh",
            "Jhajjar",
            "Charkhi Dadri",
            "Nuh",
            "Gohana",
            "Hansi",
            "Bahadurgarh",
        ],
        "Himachal Pradesh": [
            "Shimla",
            "Dharamshala",
            "Solan",
            "Mandi",
            "Kullu",
            "Manali",
            "Una",
            "Hamirpur",
            "Bilaspur",
            "Chamba",
            "Nahan",
            "Palampur",
            "Kangra",
            "Sundernagar",
            "Keylong",
            "Paonta Sahib",
            "Nurpur",
            "Rampur",
            "Jogindernagar",
            "Dalhousie",
            "Theog",
            "Arki",
            "Baddi",
            "Parwanoo",
            "Nalagarh",
        ],
        Jharkhand: [
            "Ranchi",
            "Jamshedpur",
            "Dhanbad",
            "Bokaro",
            "Deoghar",
            "Hazaribagh",
            "Giridih",
            "Ramgarh",
            "Phusro",
            "Medininagar",
            "Dumka",
            "Chaibasa",
            "Sahibganj",
            "Gumla",
            "Lohardaga",
            "Jhumri Tilaiya",
            "Pakur",
            "Godda",
            "Simdega",
            "Jamtara",
            "Garhwa",
            "Khunti",
            "Latehar",
            "Koderma",
            "Chatra",
        ],
        Karnataka: [
            "Bangalore",
            "Mysore",
            "Hubli",
            "Mangalore",
            "Belgaum",
            "Dharwad",
            "Davanagere",
            "Bellary",
            "Bijapur",
            "Gulbarga",
            "Shimoga",
            "Tumkur",
            "Udupi",
            "Hassan",
            "Raichur",
            "Chitradurga",
            "Kolar",
            "Mandya",
            "Bagalkot",
            "Haveri",
            "Chikmagalur",
            "Bidar",
            "Gadag",
            "Koppal",
            "Yadgir",
            "Chamarajanagar",
            "Karwar",
            "Hospet",
            "Sagar",
            "Dandeli",
            "Chikkaballapur",
            "Ramanagara",
            "Madikeri",
            "Bhadravati",
            "Robertsonpet",
        ],
        Kerala: [
            "Thiruvananthapuram",
            "Kochi",
            "Kozhikode",
            "Thrissur",
            "Kollam",
            "Kannur",
            "Palakkad",
            "Alappuzha",
            "Malappuram",
            "Kasaragod",
            "Kottayam",
            "Pathanamthitta",
            "Idukki",
            "Wayanad",
            "Ernakulam",
            "Ponnani",
            "Tirur",
            "Neyyattinkara",
            "Kayamkulam",
            "Kothamangalam",
            "Nedumangad",
            "Thodupuzha",
            "Perinthalmanna",
            "Varkala",
            "Muvattupuzha",
        ],
        "Madhya Pradesh": [
            "Bhopal",
            "Indore",
            "Jabalpur",
            "Gwalior",
            "Ujjain",
            "Sagar",
            "Dewas",
            "Satna",
            "Ratlam",
            "Rewa",
            "Katni",
            "Singrauli",
            "Burhanpur",
            "Khandwa",
            "Morena",
            "Chhindwara",
            "Damoh",
            "Mandsaur",
            "Neemuch",
            "Hoshangabad",
            "Itarsi",
            "Sehore",
            "Vidisha",
            "Shivpuri",
            "Chhatarpur",
            "Betul",
            "Seoni",
            "Datia",
            "Shahdol",
            "Dhar",
        ],
        Maharashtra: [
            "Mumbai",
            "Pune",
            "Nagpur",
            "Thane",
            "Nashik",
            "Aurangabad",
            "Solapur",
            "Kolhapur",
            "Amravati",
            "Navi Mumbai",
            "Sangli",
            "Nanded",
            "Jalna",
            "Latur",
            "Akola",
            "Dhule",
            "Ahmednagar",
            "Chandrapur",
            "Parbhani",
            "Jalgaon",
            "Bhiwandi",
            "Kalyan",
            "Vasai-Virar",
            "Malegaon",
            "Wardha",
            "Satara",
            "Beed",
            "Yavatmal",
            "Gondia",
            "Baramati",
            "Ichalkaranji",
            "Osmanabad",
            "Nandurbar",
            "Hinganghat",
            "Udgir",
        ],
        Manipur: [
            "Imphal",
            "Thoubal",
            "Bishnupur",
            "Churachandpur",
            "Ukhrul",
            "Senapati",
            "Tamenglong",
            "Jiribam",
            "Kakching",
            "Moreh",
            "Lilong",
            "Mayang Imphal",
            "Nambol",
            "Moirang",
            "Wangjing",
            "Andro",
            "Heirok",
            "Sugnu",
            "Lamai",
            "Yairipok",
        ],
        Meghalaya: [
            "Shillong",
            "Tura",
            "Jowai",
            "Nongstoin",
            "Williamnagar",
            "Baghmara",
            "Nongpoh",
            "Mairang",
            "Resubelpara",
            "Khliehriat",
            "Amlarem",
            "Sohra",
            "Mawkyrwat",
            "Dawki",
            "Byrnihat",
            "Pynursla",
            "Umroi",
            "Shangpung",
            "Mawngap",
            "Laitumkhrah",
        ],
        Mizoram: [
            "Aizawl",
            "Lunglei",
            "Saiha",
            "Champhai",
            "Kolasib",
            "Serchhip",
            "Lawngtlai",
            "Mamit",
            "Hnahthial",
            "Khawzawl",
            "Vairengte",
            "Biate",
            "Sairang",
            "Thenzawl",
            "North Vanlaiphai",
            "Tlabung",
            "Zawlnuam",
            "Lengpui",
            "Saitual",
            "Darlawn",
        ],
        Nagaland: [
            "Kohima",
            "Dimapur",
            "Mokokchung",
            "Tuensang",
            "Wokha",
            "Zunheboto",
            "Mon",
            "Phek",
            "Kiphire",
            "Longleng",
            "Peren",
            "Chumukedima",
            "Tseminyu",
            "Noklak",
            "Jalukie",
            "Mangkolemba",
            "Tuli",
            "Chozuba",
            "Pfutsero",
            "Meluri",
        ],
        Odisha: [
            "Bhubaneswar",
            "Cuttack",
            "Rourkela",
            "Berhampur",
            "Sambalpur",
            "Puri",
            "Balasore",
            "Bhadrak",
            "Baripada",
            "Jharsuguda",
            "Jeypore",
            "Angul",
            "Dhenkanal",
            "Keonjhar",
            "Paradip",
            "Bargarh",
            "Rayagada",
            "Balangir",
            "Koraput",
            "Malkangiri",
            "Phulbani",
            "Nabarangpur",
            "Bhawanipatna",
            "Sundargarh",
            "Talcher",
        ],
        Punjab: [
            "Ludhiana",
            "Amritsar",
            "Jalandhar",
            "Patiala",
            "Bathinda",
            "Mohali",
            "Hoshiarpur",
            "Pathankot",
            "Moga",
            "Firozpur",
            "Kapurthala",
            "Faridkot",
            "Gurdaspur",
            "Rupnagar",
            "Sangrur",
            "Muktsar",
            "Tarn Taran",
            "Fazilka",
            "Malerkotla",
            "Khanna",
            "Phagwara",
            "Barnala",
            "Abohar",
            "Rajpura",
            "Nabha",
        ],
        Rajasthan: [
            "Jaipur",
            "Jodhpur",
            "Udaipur",
            "Kota",
            "Ajmer",
            "Bikaner",
            "Bhilwara",
            "Alwar",
            "Sikar",
            "Pali",
            "Sriganganagar",
            "Barmer",
            "Jaisalmer",
            "Nagaur",
            "Churu",
            "Bharatpur",
            "Dausa",
            "Dholpur",
            "Hanumangarh",
            "Jhunjhunu",
            "Karauli",
            "Sawai Madhopur",
            "Tonk",
            "Bundi",
            "Baran",
            "Chittorgarh",
            "Dungarpur",
            "Jalore",
            "Pratapgarh",
            "Rajsamand",
        ],
        Sikkim: [
            "Gangtok",
            "Namchi",
            "Gyalshing",
            "Mangan",
            "Jorethang",
            "Ravangla",
            "Singtam",
            "Pakyong",
            "Soreng",
            "Rongli",
            "Rhenock",
            "Melli",
            "Yuksom",
            "Dentam",
            "Naya Bazar",
        ],
        "Tamil Nadu": [
            "Chennai",
            "Coimbatore",
            "Madurai",
            "Tiruchirappalli",
            "Salem",
            "Tirunelveli",
            "Erode",
            "Vellore",
            "Thoothukudi",
            "Dindigul",
            "Thanjavur",
            "Karur",
            "Cuddalore",
            "Kanyakumari",
            "Namakkal",
            "Tiruppur",
            "Kanchipuram",
            "Nagercoil",
            "Hosur",
            "Pollachi",
            "Rajapalayam",
            "Sivakasi",
            "Pudukkottai",
            "Neyveli",
            "Nagapattinam",
            "Viluppuram",
            "Tiruvannamalai",
            "Perambalur",
            "Dharmapuri",
            "Krishnagiri",
        ],
        Telangana: [
            "Hyderabad",
            "Warangal",
            "Nizamabad",
            "Karimnagar",
            "Khammam",
            "Ramagundam",
            "Mahbubnagar",
            "Nalgonda",
            "Adilabad",
            "Siddipet",
            "Miryalaguda",
            "Suryapet",
            "Jagtial",
            "Mancherial",
            "Wanaparthy",
            "Bhongir",
            "Kamareddy",
            "Jangaon",
            "Kothagudem",
            "Gadwal",
            "Vikarabad",
            "Nagarkurnool",
            "Sangareddy",
            "Medak",
            "Medchal",
        ],
        Tripura: [
            "Agartala",
            "Udaipur",
            "Dharmanagar",
            "Kailasahar",
            "Belonia",
            "Khowai",
            "Ambassa",
            "Sabroom",
            "Sonamura",
            "Teliamura",
            "Amarpur",
            "Kumarghat",
            "Santirbazar",
            "Kamalpur",
            "Ranirbazar",
            "Bishalgarh",
            "Melaghar",
            "Mohanpur",
            "Jirania",
            "Panisagar",
        ],
        "Uttar Pradesh": [
            "Lucknow",
            "Kanpur",
            "Ghaziabad",
            "Agra",
            "Varanasi",
            "Meerut",
            "Allahabad",
            "Noida",
            "Bareilly",
            "Moradabad",
            "Aligarh",
            "Saharanpur",
            "Gorakhpur",
            "Faizabad",
            "Jhansi",
            "Muzaffarnagar",
            "Mathura",
            "Shahjahanpur",
            "Rampur",
            "Mau",
            "Firozabad",
            "Hapur",
            "Etah",
            "Budaun",
            "Amroha",
            "Sambhal",
            "Bahraich",
            "Azamgarh",
            "Sultanpur",
            "Bijnor",
            "Bulandshahr",
            "Raebareli",
            "Gonda",
            "Mainpuri",
            "Sitapur",
        ],
        Uttarakhand: [
            "Dehradun",
            "Haridwar",
            "Roorkee",
            "Haldwani",
            "Rudrapur",
            "Kashipur",
            "Rishikesh",
            "Nainital",
            "Pithoragarh",
            "Almora",
            "Mussoorie",
            "Pauri",
            "Srinagar",
            "Tehri",
            "Bageshwar",
            "Champawat",
            "Udham Singh Nagar",
            "Kotdwar",
            "Vikasnagar",
            "Manglaur",
            "Jaspur",
            "Kichha",
            "Ramnagar",
            "Ranikhet",
            "Khatima",
        ],
        "West Bengal": [
            "Kolkata",
            "Howrah",
            "Durgapur",
            "Siliguri",
            "Asansol",
            "Bardhaman",
            "Malda",
            "Berhampore",
            "Habra",
            "Kharagpur",
            "English Bazar",
            "Jalpaiguri",
            "Cooch Behar",
            "Balurghat",
            "Raiganj",
            "Bankura",
            "Chandannagar",
            "Darjeeling",
            "Krishnanagar",
            "Purulia",
            "Medinipur",
            "Haldia",
            "Ranaghat",
            "Bongaon",
            "Alipurduar",
            "Basirhat",
            "Diamond Harbour",
            "Barasat",
            "Barrackpore",
            "Kalyani",
        ],
    };

    let selectedState = "";

    stateInput.addEventListener("input", handleStateInputChange);

    cityInput.addEventListener("input", handleCityInputChange);

    document.addEventListener("click", (event) => {
        if (!event.target.closest(".input-group")) {
            stateSuggestionsContainer.style.display = "none";
            citySuggestionsContainer.style.display = "none";
        }
    });

    function handleStateInputChange() {
        const inputValue = stateInput.value.toLowerCase().trim();
        const matchedStates = states.filter((state) =>
            state.toLowerCase().includes(inputValue),
        );
        displaySuggestions(
            matchedStates,
            stateSuggestionsContainer,
            stateInput,
            (selected) => {
                selectedState = selected;
                stateInput.value = selected;
                cityInput.value = "";
                citySuggestionsContainer.innerHTML = "";
                citySuggestionsContainer.style.display = "none";
            },
        );
    }

    function handleCityInputChange() {
        if (!selectedState) {
            citySuggestionsContainer.innerHTML =
                "<div class='suggestion'>Please select a state first</div>";
            citySuggestionsContainer.style.display = "block";
            return;
        }
        const inputValue = cityInput.value.toLowerCase().trim();
        const cities = stateCityMap[selectedState] || [];
        const matchedCities = cities.filter((city) =>
            city.toLowerCase().includes(inputValue),
        );
        displaySuggestions(matchedCities, citySuggestionsContainer, cityInput);
    }

    function displaySuggestions(
        suggestions,
        container,
        inputField,
        onSelectCallback,
    ) {
        container.innerHTML = "";
        if (suggestions.length > 0) {
            suggestions.forEach((suggestion) => {
                const suggestionElement = document.createElement("div");
                suggestionElement.classList.add("suggestion");
                suggestionElement.textContent = suggestion;
                suggestionElement.addEventListener("click", () => {
                    inputField.value = suggestion;
                    container.style.display = "none";
                    if (onSelectCallback) {
                        onSelectCallback(suggestion);
                    }
                });
                container.appendChild(suggestionElement);
            });
            container.style.display = "block";
        } else {
            container.style.display = "none";
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
        ".other-degree-input-container",
    );
    const otherDegreeInput = document.getElementById("other-degree");
    const degreeRadios = document.querySelectorAll('input[name="degree_type"]');

    let isOthersSelected = false;

    degreeRadios.forEach((radio) => {
        radio.addEventListener("click", () => {
            if (radio === othersRadio) {
                isOthersSelected = !isOthersSelected;
                otherDegreeInputContainer.style.display = isOthersSelected
                    ? "flex"
                    : "none";
                if (!isOthersSelected) {
                    othersRadio.value = "others";
                    otherDegreeInput.value = "";
                }
            } else {
                isOthersSelected = false;
                otherDegreeInputContainer.style.display = "none";
                othersRadio.value = "others";
                otherDegreeInput.value = "";
            }
        });
    });

    otherDegreeInput.addEventListener("input", () => {
        othersRadio.value = otherDegreeInput.value;
    });

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

    document
        .getElementById("income-co-borrower")
        .addEventListener("input", function () {
            const incomeInput = document.getElementById("income-co-borrower");
            const errorMessage = document.getElementById(
                "income-error-message",
            );
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
            if (
                (emiInput.value && isNaN(emiInput.value)) ||
                emiInput.value.trim() === ""
            ) {
                errorMessage.style.display = "block";
            } else {
                errorMessage.style.display = "none";
            }
        });

    const genderDropdown = document.querySelector(".dropdown-gender");
    const genderHeader = document.querySelector(".dropdown-gender-header");
    const genderOptions = document.querySelector(".dropdown-options-gender");
    const genderOptionItems = document.querySelectorAll(
        ".dropdown-option-gender",
    );
    const genderHiddenInput = document.querySelector('input[name="gender"]');
    const genderError = document.querySelector("#gender-error");

    function genderToggleOptions() {
        genderOptions.style.display =
            genderOptions.style.display === "block" ? "none" : "block";
    }

    function genderHandleSelection(event) {
        const genderSelectedValue =
            event.currentTarget.getAttribute("data-value");
        const genderSelectedText =
            event.currentTarget.querySelector("span").textContent;
        document.querySelector(".dropdown-label-gender").textContent =
            genderSelectedText;
        genderHiddenInput.value = genderSelectedValue;
        genderError.textContent = "";
        genderOptions.style.display = "none";
    }

    function genderHandleOutsideClick(event) {
        if (!genderDropdown.contains(event.target)) {
            genderOptions.style.display = "none";
        }
    }

    genderHeader.addEventListener("click", genderToggleOptions);
    genderOptionItems.forEach((item) => {
        item.addEventListener("click", genderHandleSelection);
    });
    document.addEventListener("click", genderHandleOutsideClick);
});
