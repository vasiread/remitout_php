document.addEventListener("DOMContentLoaded", () => {
    const studentFormMenuIcon = document.getElementById(
        "student-form-menu-icon-id",
    );
    const studentFormNavLinks = document.getElementById(
        "student-form-nav-links",
    );

    const studentId = document.getElementById("personal-info-userid")?.value;
    if (studentId) {
        initialiseStudentUploads(studentId);
        initialiseStaticUploadedFiles();
        initialiseDynamicUploadedFiles();

        connectedThrough();
    }

    if (studentFormMenuIcon && studentFormNavLinks) {
        studentFormMenuIcon.addEventListener("click", () => {
            studentFormMenuIcon.classList.toggle("active");
            studentFormNavLinks.classList.toggle("active");
        });
    } else {
        console.warn("Menu icon or nav links not found in the DOM.");
    }

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
            link.classList.toggle("active", index === currentBreadcrumbIndex);
            link.style.color =
                index === currentBreadcrumbIndex ? "#E98635" : "";
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
    if (nextButton) {
        nextButton.addEventListener("click", () => {
            if (areFieldsFilled()) {
                navigate("next");
            }
        });
    }

    function updateUserIds() {
        const inputElement = document.getElementById("personal-info-userid");

        // Exit early if the component doesn't exist
        if (!inputElement) {
            console.info(
                "Skipping updateUserIds(): #personal-info-userid not found.",
            );
            return;
        }

        const personalInfoId = inputElement.value;

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

        // Only define once
        function getSelectedAnswer(callback) {
            const selectedOption = document.querySelector('input[name="borrow-relation"]:checked');

            if (selectedOption && selectedOption.value !== "blood-relative") {
                return callback(selectedOption.value);
            } else if (selectedOption && selectedOption.value === "blood-relative") {
                const selectedDropdown = document.querySelector('.borrow-dropdown .borrow-dropdown-item.selected');
                if (selectedDropdown) {
                    return callback(selectedDropdown.textContent.trim()); 
                } else {
                    return callback("blood-relative");
                      
                 }
            } else {
                return callback("none selected");
            }
        }


        // Call the function
        getSelectedAnswer(function (answer) {
            const personalInfoId = document.getElementById("personal-info-userid")?.value;
            const incomeValue = document.getElementById("income-co-borrower")?.value;
            const selectedLiability = document.querySelector('input[name="co-borrower-liability"]:checked')?.value;
            const emiAmount = document.getElementById("emi-amount")?.value;

            const coborrowerData = {
                personalInfoId,
                co_borrower_relation: answer,  
                incomeValue,
                selectedLiability,
                emiAmount
            };

            console.log("Submitting coborrowerData:", coborrowerData);
            // alert(JSON.stringify(coborrowerData)); // for debugging

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
                        console.error("Failed to update co-borrower info:", data.message);
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

        const personalInfoId = document.getElementById(
            "personal-info-userid",
        ).value;
        const personalInfoName =
            document.getElementById("personal-info-name").value;
        const personalInfoPhone = document.getElementById(
            "personal-info-phone",
        ).value;
        const personalInfoEmail = document.getElementById(
            "personal-info-email",
        ).value;
        const personalInfoCity =
            document.getElementById("personal-info-city").value;
        const personalInfoReferral = document.getElementById(
            "personal-info-referral",
        ).value;
        const personalInfoState = document.getElementById(
            "personal-info-state",
        ).value;
        const personalInfoDob =
            document.getElementById("personal-info-dob").value;
        const genderOptions = document.getElementById(
            "gender-personal-info",
        ).value;
        const personalInfoFindOut = selectedValue;

        // ✅ Collect dynamic fields
        const dynamicFields = {};

        document
            .querySelectorAll(
                'input[name^="dynamic_fields["], select[name^="dynamic_fields["]',
            )
            .forEach((input) => {
                const name = input.getAttribute("name");
                const multipleMatch = name.match(
                    /^dynamic_fields\[(\d+)\]\[\]$/,
                );
                const singleMatch = name.match(/^dynamic_fields\[(\d+)\]$/);

                if (multipleMatch) {
                    const fieldId = multipleMatch[1];
                    if (!dynamicFields[fieldId]) {
                        dynamicFields[fieldId] = [];
                    }
                    // For checkboxes, only add if checked
                    if (
                        (input.type === "checkbox" || input.type === "radio") &&
                        input.checked
                    ) {
                        dynamicFields[fieldId].push(input.value);
                    }
                } else if (singleMatch) {
                    const fieldId = singleMatch[1];
                    if (input.type === "checkbox" || input.type === "radio") {
                        if (input.checked) {
                            dynamicFields[fieldId] = input.value;
                        }
                    } else if (input.tagName.toLowerCase() === "select") {
                        dynamicFields[fieldId] = input.value;
                    } else {
                        dynamicFields[fieldId] = input.value;
                    }
                }
            });

        console.log(dynamicFields);

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
                dynamic_fields: dynamicFields,
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
                    } else {
                        console.error(
                            "Failed to update personal info:",
                            data.message,
                        );
                    }
                })
                .catch((error) => {
                    console.error("Error updating personal info:", error);
                });
        }
    }

    function getSelectedExpenseType() {
        const selectedExpense = document.querySelector(
            'input[name="course-details"]:checked'
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
        )?.value;
        const expenseType = getSelectedExpenseType(); // Custom method you already use
        const loanAmount = getLoanAmount(); // Custom method you already use
        const courseDuration = getSelectedCourseDuration(); // Custom method
        const studyLocations = getSelectedStudyLocations(); // Custom method
        

        // ✅ Collect dynamic fields (same logic as in personal info)
        const dynamicFields = {};

        document
            .querySelectorAll(
                'input[name^="dynamic_fields["], select[name^="dynamic_fields["]',
            )
            .forEach((input) => {
                const name = input.getAttribute("name"); // e.g. dynamic_fields[5], dynamic_fields[5][]
                const multipleMatch = name.match(
                    /^dynamic_fields\[(\d+)\]\[\]$/,
                );
                const singleMatch = name.match(/^dynamic_fields\[(\d+)\]$/);

                if (multipleMatch) {
                    const fieldId = multipleMatch[1];
                    if (!dynamicFields[fieldId]) {
                        dynamicFields[fieldId] = [];
                    }
                    if (
                        (input.type === "checkbox" || input.type === "radio") &&
                        input.checked
                    ) {
                        dynamicFields[fieldId].push(input.value);
                    }
                } else if (singleMatch) {
                    const fieldId = singleMatch[1];
                    if (input.type === "checkbox" || input.type === "radio") {
                        if (input.checked) {
                            dynamicFields[fieldId] = input.value;
                        }
                    } else if (input.tagName.toLowerCase() === "select") {
                        dynamicFields[fieldId] = input.value;
                    } else {
                        dynamicFields[fieldId] = input.value;
                    }
                }
            });

        const courseInfoData = {
            personalInfoId,
            degree_type: selectedDegreeType,
            loan_amount_in_lakhs: loanAmount,
            course_duration: courseDuration,
            plan_to_study: studyLocations,
            course_details: expenseType,
            dynamic_fields: dynamicFields,
        };
        // alert(expenseType)

        // ✅ Send data to backend
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
                    console.log(courseInfoData)
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
        )?.value;
        const reasonForGap = document.querySelector(
            ".academic-reason textarea",
        )?.value;
        const selectedAdmitOption = document.querySelector(
            'input[name="admit-option"]:checked',
        )?.value;
        const selectedWorkOption = document.querySelector(
            'input[name="work-option"]:checked',
        )?.value;
        const ieltsScore = document.getElementById("admit-ielts")?.value;
        const greScore = document.getElementById("admit-gre")?.value;
        const toeflScore = document.getElementById("admit-toefl")?.value;
        const otherExamName =
            document.getElementById("admit-others-name")?.value;
        const otherExamScore =
            document.getElementById("admit-others-score")?.value;
        const universityName =
            document.getElementById("universityschoolid")?.value;
        const courseName = document.getElementById("educationcourseid")?.value;

        if (!validateAllScores(ieltsScore, greScore, toeflScore)) {
            return; // Stop submission if validation fails
        }

        const dynamicFields = {};
        document
            .querySelectorAll(
                'input[name^="dynamic_fields["], select[name^="dynamic_fields["]',
            )
            .forEach((input) => {
                const name = input.getAttribute("name");
                const multipleMatch = name.match(
                    /^dynamic_fields\[(\d+)\]\[\]$/,
                );
                const singleMatch = name.match(/^dynamic_fields\[(\d+)\]$/);

                if (multipleMatch) {
                    const fieldId = multipleMatch[1];
                    if (!dynamicFields[fieldId]) {
                        dynamicFields[fieldId] = [];
                    }
                    if (
                        (input.type === "checkbox" || input.type === "radio") &&
                        input.checked
                    ) {
                        dynamicFields[fieldId].push(input.value);
                    }
                } else if (singleMatch) {
                    const fieldId = singleMatch[1];
                    if (input.type === "checkbox" || input.type === "radio") {
                        if (input.checked) {
                            dynamicFields[fieldId] = input.value;
                        }
                    } else {
                        dynamicFields[fieldId] = input.value;
                    }
                }
            });

        const academicDetails = {
            personalInfoId,
            selectedAcademicGap,
            reasonForGap,
            selectedAdmitOption,
            selectedWorkOption,
            ieltsScore,
            greScore,
            toeflScore,
            others: {
                otherExamName,
                otherExamScore,
            },
            universityName,
            courseName,
            dynamic_fields: dynamicFields,
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

    if (nextBreadcrumbButton) {
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
    }

    if (nextCourseButton) {
        nextCourseButton.addEventListener("click", () => {
            // Always hide the current section
            breadcrumbSections[currentBreadcrumbIndex].forEach(
                (container) => (container.style.display = "none")
            );

            // Move to next section (force index 2 = Academic Details)
            currentBreadcrumbIndex = 2;
            currentContainerIndex = 0;

            // Show the first container in Academic Details
            breadcrumbSections[currentBreadcrumbIndex].forEach(
                (container, index) => {
                    container.style.display = index === 0 ? "block" : "none";
                }
            );

            updateBreadcrumbNavigation();
            updateNavigationButtons();
            updateDots();
            updateMobileHeading(currentBreadcrumbIndex);
            showToast("Moved to Academic Details");
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
        clearName = null,
        sourceType = "static", // default value
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
        if (studentId === null) {
            const userId = document.getElementById(
                "personal-info-userid",
            ).value;
            await uploadFileToServer(
                file,
                userId,
                fileNameId,
                clearName,
                sourceType,
            );
        } else if (studentId !== null) {
            const userId = studentId;
            await uploadFileToServer(
                file,
                userId,
                fileNameId,
                clearName,
                sourceType,
            );
        }
    }

    function uploadFileToServer(
        file,
        userId,
        fileNameId,
        clearName,
        sourceType,
    ) {
        fileNameId = fileNameId.replace(`-${userId}`, "");
        const formDetailsData = new FormData();
        formDetailsData.append("file", file);
        formDetailsData.append("userId", userId);
        formDetailsData.append("fileNameId", fileNameId);
        formDetailsData.append("clearName", clearName);
        formDetailsData.append("sourceType", sourceType);

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
        sourceType,
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
            await deleteFileToServer(userId, fileNameId, sourceType);
        } else if (studentId !== null) {
            const userId = studentId;
            await deleteFileToServer(userId, fileNameId, sourceType);
        }
    }

    function deleteFileToServer(userId, fileNameId, sourceType = "static") {
        fileNameId = fileNameId.replace(`-${userId}`, "");
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        const data = {
            userId: userId,
            fileNameId: fileNameId,
            sourceType: sourceType,
        };
        // alert(userId);
        // alert(fileNameId);
        // alert(sourceType);

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
                console.log("Files deleted successfully", data);
            })
            .catch((error) => {
                console.error("Error deleting file:", error);
            });
    }

    async function initialiseStudentUploads(userId) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");
        if (!csrfToken || !userId) {
            console.error("Missing CSRF token or userId");
            return;
        }

        const fileTypes = [
            "aadhar-card-name",
            "pan-card-name",
            "passport-card-name",
            "tenth-grade-name",
            "twelfth-grade-name",
            "graduation-grade-name",
            "secured-tenth-name",
            "secured-twelfth-name",
            "secured-graduation-name",
            "co-pan-card-name",
            "co-aadhar-card-name",
            "co-addressproof",
            
        ];

        try {
            const response = await fetch("/retrieve-file", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ userId, fileTypes })
            });

            const data = await response.json();
            const allFiles = data.staticFiles || data;

            fileTypes.forEach(fileType => {
                const fileData = allFiles[fileType];
                if (!fileData) return;

                const fileNameId = `${fileType}-${userId}`;
                const uploadIconId = `upload-${fileType}-${userId}`;
                const removeIconId = `remove-${fileType}-${userId}`;
                const fileNameElement = document.getElementById(fileNameId);
                const uploadIcon = document.getElementById(uploadIconId);
                const removeIcon = document.getElementById(removeIconId);
                const formatInfo = fileNameElement?.parentElement?.nextElementSibling?.querySelector("span:last-child");

                if (fileNameElement && fileData.url && fileData.name) {
                    renderUploadedFileUI(fileNameElement, fileData, uploadIcon, removeIcon, formatInfo);
                }
            });
        } catch (error) {
            console.error("Error fetching uploaded files:", error);
        }
    }
    function renderUploadedFileUI(fileNameElement, fileData, uploadIcon, removeIcon, formatInfo) {
        const fileName = fileData.name;
        const fileExtension = fileName.slice(fileName.lastIndexOf(".")).toLowerCase();
        const truncatedFileName = fileName.length > 30 ? fileName.slice(0, 27) + "..." : fileName;

        fileNameElement.innerHTML = truncatedFileName;

        const fileIcon = document.createElement("img");
        fileIcon.style.width = "20px";
        fileIcon.style.height = "20px";
        fileIcon.style.marginRight = "10px";

        fileIcon.src = [".jpg", ".jpeg", ".png"].includes(fileExtension)
            ? "/assets/images/image-upload.png"
            : "/assets/images/image-pdf.png";

        const existingIcon = fileNameElement.querySelector("img");
        if (existingIcon) existingIcon.remove();

        fileNameElement.prepend(fileIcon);

        if (uploadIcon) uploadIcon.style.display = "none";
        if (removeIcon) removeIcon.style.display = "inline";
        if (formatInfo) formatInfo.textContent = "File uploaded";

        fileNameElement.style.display = "block";
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

    function initialiseStaticUploadedFiles() {
        const userId = document.getElementById("personal-info-userid")?.value;
        if (!userId) {
            console.warn("User ID not found.");
            return;
        }

        // Static files
        const staticFileTypes = [
            { fileType: "pan-card-name", inputId: "pan-card" },
            { fileType: "aadhar-card-name", inputId: "aadhar-card" },
            { fileType: "passport-card-name", inputId: "passport" },
            { fileType: "tenth-grade-name", inputId: "tenth-grade" },
            { fileType: "twelfth-grade-name", inputId: "twelfth-grade" },
            { fileType: "graduation-grade-name", inputId: "graduation-grade" },
            { fileType: "secured-tenth-name", inputId: "secured-tenth" },
            { fileType: "secured-twelfth-name", inputId: "secured-twelfth" },
            { fileType: "secured-graduation-name", inputId: "secured-graduation" },
            { fileType: "work-experience-experience-letter", inputId: "work-experience-tenth" },
            { fileType: "work-experience-monthly-slip", inputId: "work-experience-twelfth" },
            { fileType: "work-experience-office-id", inputId: "work-experience-graduation" },
            { fileType: "work-experience-joining-letter", inputId: "work-experience-fourth" },
            { fileType: "co-pan-card-name", inputId: "co-pan-card", uploadIconId: "co-upload-icon", removeIconId: "co-remove-icon" },
            { fileType: "co-aadhar-card-name", inputId: "co-aadhar-card", uploadIconId: "co-aadhar-upload-icon", removeIconId: "co-aadhar-remove-icon" },
            { fileType: "co-addressproof", inputId: "co-passport", uploadIconId: "co-passport-upload-icon", removeIconId: "co-passport-remove-icon" },
            { fileType: "salary-upload-salary-slip-name", inputId: "salary-upload-salary-slip", uploadIconId: "salary-upload-salary-slip-upload-icon", removeIconId: "salary-remove-salary-slip-1" },
            { fileType: "salary-upload-salary-statement-name", inputId: "salary-upload-salary-statement", uploadIconId: "salary-upload-salary-statement-upload-icon", removeIconId: "salary-remove-salary-statement-2" },
            { fileType: "salary-upload-address-proof-name", inputId: "salary-upload-address-proof", uploadIconId: "salary-upload-address-proof-upload-icon", removeIconId: "salary-remove-address-proof-3" },
            { fileType: "salary-upload-itr-name", inputId: "salary-upload-itr", uploadIconId: "salary-upload-itr-upload-icon", removeIconId: "salary-remove-itr-4" },
            { fileType: "salary-upload-fourth-document-name", inputId: "salary-upload-fourth-document", uploadIconId: "salary-upload-fourth-document-upload-icon", removeIconId: "salary-remove-fourth-document-5" },
            { fileType: "salary-upload-fifth-document-name", inputId: "salary-upload-fifth-document", uploadIconId: "salary-upload-fifth-document-upload-icon", removeIconId: "salary-remove-fifth-document-6" },

        ];

        const dynamicDocumentKeys = JSON.parse(document.getElementById('dynamic-doc-keys-json')?.textContent || '[]');

        const staticFileTypesPaths = staticFileTypes.map(file => `static/${file.fileType}`);
        const dynamicFileTypesPaths = dynamicDocumentKeys.map(key => `dynamic/${key}`);

        const fileTypes = [...staticFileTypesPaths, ...dynamicFileTypesPaths];

        fetch("/retrieve-file", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ userId, fileTypes })
        })
            .then(res => res.json())
            .then(data => {
                const staticFiles = data.staticFiles || {};
                const dynamicFiles = data.dynamicFiles || {};

                // Process static files
                staticFileTypes.forEach(item => {
                    const fileData = staticFiles[`static/${item.fileType}`];
                    updateFileDisplay(fileData, item.fileType, item.inputId, item.uploadIconId, item.removeIconId);
                });

                // Process dynamic files
                dynamicDocumentKeys.forEach(key => {
                    const fileData = dynamicFiles[`dynamic/${key}`];
                    updateFileDisplay(fileData, `${key}-name`, key);
                });
            })
            .catch(err => console.error("Error loading uploaded files:", err));
    }
    function initialiseDynamicUploadedFiles() {
        const userId = document.getElementById("personal-info-userid")?.value;
        if (!userId) {
            console.warn("User ID not found.");
            return;
        }

        fetch("/dynamic-file", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ userId })
        })
            .then(res => res.json())
            .then(data => {
                const dynamicFiles = data.dynamicFiles || {};

                // Loop through each dynamic/<key>
                Object.entries(dynamicFiles).forEach(([groupKey, fileArray]) => {
                    const key = groupKey.replace('dynamic/', '');
                    const inputId = key.replace(/-name$/, '');

                    const nameEl = document.getElementById(`${inputId}-name`);
                    const removeIcon = document.getElementById(`${inputId}-remove-icon`);
                    const uploadIcon = document.getElementById(`${inputId}-upload-icon`);

                    if (!fileArray || fileArray.length === 0 || !nameEl) return;

                    const file = fileArray[0];
                    const fileName = file.url.split("/").pop();
                    const ext = fileName.split('.').pop().toLowerCase();
                    const base = fileName.slice(0, fileName.lastIndexOf(".")) || fileName;
                    const shortName = base.length > 18 ? base.slice(0, 18) + "..." : base;
                    const iconSrc = ext === "pdf"
                        ? "assets/images/image-pdf.png"
                        : "assets/images/image-upload.png";

                    nameEl.innerHTML = `
        <img src="${iconSrc}" width="20" style="vertical-align:middle; margin-right: 5px;">
        <span title="${fileName}">${shortName}.${ext}</span>
    `;

                    // ✅ This is the part you're asking about
                    if (removeIcon) removeIcon.style.display = "inline";
                    if (uploadIcon) uploadIcon.style.display = "none";
                });
            })
            .catch(err => console.error("Error loading dynamic uploaded files:", err));
    }


    function updateFileDisplay(fileData, nameId, inputId, uploadIconId, removeIconId) {
        if (!fileData || !fileData.url) return;

        const fileName = fileData.url.split("/").pop();
        const nameEl = document.getElementById(nameId);
        const removeIcon = document.getElementById(removeIconId || `${inputId}-remove-icon`);
        const uploadIcon = document.getElementById(uploadIconId || `${inputId}-upload-icon`);

        if (nameEl) {
            const fileExtension = fileName.slice(fileName.lastIndexOf(".")).toLowerCase();
            const baseName = fileName.slice(0, fileName.lastIndexOf("."));
            const shortBase = baseName.length > 18 ? baseName.slice(0, 18) + "..." : baseName;
            const iconSrc = fileExtension === ".pdf" ? "assets/images/image-pdf.png" : "assets/images/image-upload.png";

            nameEl.innerHTML = `
            <img src="${iconSrc}" width="20" style="vertical-align:middle; margin-right: 5px;">
            <span title="${fileName}">${shortBase + fileExtension}</span>
        `;
        }

        if (removeIcon) removeIcon.style.display = "inline";
        if (uploadIcon) uploadIcon.style.display = "none";
    }


    function connectedThrough() {
        const selected = document.querySelector(".dropdown-option-about-us.selected");
        if (selected) {
            const label = selected.closest('.dropdown-about').querySelector('.dropdown-label-about');
            label.textContent = selected.textContent;
        }
    }

    
    let selectedCollege = null;

    const fallbackColleges = [
        { Name: "Aligarh Muslim University", State: "Uttar Pradesh", City: "Aligarh" },
        { Name: "Amity University", State: "Uttar Pradesh", City: "Noida" },
        { Name: "Anna University", State: "Tamil Nadu", City: "Chennai" },
        { Name: "Banaras Hindu University", State: "Uttar Pradesh", City: "Varanasi" },
        { Name: "Birla Institute of Technology and Science, Pilani", State: "Rajasthan", City: "Pilani" },
        { Name: "Christ University", State: "Karnataka", City: "Bangalore" },
        { Name: "Delhi Technological University", State: "Delhi", City: "New Delhi" },
        { Name: "Hindu College, University of Delhi", State: "Delhi", City: "New Delhi" },
        { Name: "Indian Institute of Management, Ahmedabad", State: "Gujarat", City: "Ahmedabad" },
        { Name: "Indian Institute of Management, Bangalore", State: "Karnataka", City: "Bangalore" },
        { Name: "Indian Institute of Management, Calcutta", State: "West Bengal", City: "Kolkata" },
        { Name: "Indian Institute of Science, Bangalore", State: "Karnataka", City: "Bangalore" },
        { Name: "Indian Institute of Technology, Bhubaneswar", State: "Odisha", City: "Bhubaneswar" },
        { Name: "Indian Institute of Technology, Bombay", State: "Maharashtra", City: "Mumbai" },
        { Name: "Indian Institute of Technology, Delhi", State: "Delhi", City: "New Delhi" },
        { Name: "Indian Institute of Technology, Gandhinagar", State: "Gujarat", City: "Gandhinagar" },
        { Name: "Indian Institute of Technology, Guwahati", State: "Assam", City: "Guwahati" },
        { Name: "Indian Institute of Technology, Hyderabad", State: "Telangana", City: "Hyderabad" },
        { Name: "Indian Institute of Technology, Kanpur", State: "Uttar Pradesh", City: "Kanpur" },
        { Name: "Indian Institute of Technology, Kharagpur", State: "West Bengal", City: "Kharagpur" },
        { Name: "Indian Institute of Technology, Madras", State: "Tamil Nadu", City: "Chennai" },
        { Name: "Indian Institute of Technology, Roorkee", State: "Uttarakhand", City: "Roorkee" },
        { Name: "Jadavpur University", State: "West Bengal", City: "Kolkata" },
        { Name: "Jamia Millia Islamia", State: "Delhi", City: "New Delhi" },
        { Name: "Jawaharlal Nehru University", State: "Delhi", City: "New Delhi" },
        { Name: "Kalinga Institute of Industrial Technology", State: "Odisha", City: "Bhubaneswar" },
        { Name: "Lady Shri Ram College for Women", State: "Delhi", City: "New Delhi" },
        { Name: "Loyola College", State: "Tamil Nadu", City: "Chennai" },
        { Name: "Madras Christian College", State: "Tamil Nadu", City: "Chennai" },
        { Name: "Mahatma Gandhi University", State: "Kerala", City: "Kottayam" },
        { Name: "Manipal Academy of Higher Education", State: "Karnataka", City: "Manipal" },
        { Name: "Miranda House, University of Delhi", State: "Delhi", City: "New Delhi" },
        { Name: "National Institute of Technology, Calicut", State: "Kerala", City: "Kozhikode" },
        { Name: "National Institute of Technology, Karnataka, Surathkal", State: "Karnataka", City: "Mangalore" },
        { Name: "National Institute of Technology, Tiruchirappalli", State: "Tamil Nadu", City: "Tiruchirappalli" },
        { Name: "Osmania University", State: "Telangana", City: "Hyderabad" },
        { Name: "Panjab University", State: "Punjab", City: "Chandigarh" },
        { Name: "Presidency College", State: "Tamil Nadu", City: "Chennai" },
        { Name: "PSG College of Technology", State: "Tamil Nadu", City: "Coimbatore" },
        { Name: "Ramaiah Institute of Technology", State: "Karnataka", City: "Bangalore" },
        { Name: "Saveetha Institute of Medical and Technical Sciences", State: "Tamil Nadu", City: "Chennai" },
        { Name: "Shoolini University", State: "Himachal Pradesh", City: "Solan" },
        { Name: "Sikkim Manipal University", State: "Sikkim", City: "Gangtok" },
        { Name: "Sri Ram College of Commerce, University of Delhi", State: "Delhi", City: "New Delhi" },
        { Name: "St. Stephen’s College, University of Delhi", State: "Delhi", City: "New Delhi" },
        { Name: "Symbiosis International University", State: "Maharashtra", City: "Pune" },
        { Name: "Thapar Institute of Engineering and Technology", State: "Punjab", City: "Patiala" },
        { Name: "University of Calcutta", State: "West Bengal", City: "Kolkata" },
        { Name: "University of Delhi", State: "Delhi", City: "New Delhi" },
        { Name: "Vellore Institute of Technology", State: "Tamil Nadu", City: "Vellore" }
    ];
    
    async function fetchColleges(query = "") {
        try {
            const url = query 
                ? `https://colleges-api.onrender.com/colleges?search=${encodeURIComponent(query)}`
                : `https://colleges-api.onrender.com/colleges`;
            const response = await fetch(url, {
                method: "GET",
                headers: { "Accept": "application/json" },
                mode: "cors",
                cache: "no-cache"
            });
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            const data = await response.json();
            if (!Array.isArray(data.colleges)) {
                return [];
            }
            return data.colleges.length > 0 ? data.colleges : fallbackColleges;
        } catch (error) {
            return query 
                ? fallbackColleges.filter(college => 
                    college.Name.toLowerCase().includes(query.toLowerCase())
                  )
                : fallbackColleges;
        }
    }
    
    const universityInput = document.getElementById("universityschoolid");
    const universitySuggestionsContainer = document.getElementById("suggestions-university");
    
    if (!universityInput || !universitySuggestionsContainer) {
        showToast("Error: University input field not found.");
    } else {
        let debounceTimeout;
        universityInput.addEventListener("input", () => {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(async () => {
                const inputValue = universityInput.value.trim();
                const colleges = await fetchColleges(inputValue);
                const matchedColleges = colleges.map(college => {
                    const display = `${college.Name} (${college.City}, ${college.State})`;
                    return {
                        name: college.Name,
                        state: college.State,
                        city: college.City,
                        display
                    };
                }).filter(college => college.name && college.display);
                displaySuggestions(
                    matchedColleges,
                    universitySuggestionsContainer,
                    universityInput,
                    (selected) => {
                        universityInput.value = selected.name;
                        selectedCollege = selected;
                        universitySuggestionsContainer.style.display = "none";
                    }
                );
            }, 100);
        });
    }
    
    function displaySuggestions(suggestions, container, inputField, onSelectCallback) {
        container.innerHTML = "";
        if (suggestions.length > 0) {
            suggestions.forEach((suggestion) => {
                const suggestionElement = document.createElement("div");
                suggestionElement.classList.add("suggestion");
                suggestionElement.textContent = suggestion.display || suggestion;
                suggestionElement.addEventListener("click", () => {
                    inputField.value = suggestion.name || suggestion;
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


});