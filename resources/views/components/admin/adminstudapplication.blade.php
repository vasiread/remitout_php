<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Course Details</title>

  
       <link rel="stylesheet" href="assets/css/adminstudapplication.css">
  
</head>

<body>

    @extends('layouts.app')
    


<div class="admin-studnet-application-main-container">
    <div class="nbfc-studentdashboardprofile-profile-section-container" id="admin-student-form-edit-container">
        <div class="admin-student-form-container">
            <!-- Form Header -->
            <div class="admin-student-form-header">
                <h1>Edit Registration Form</h1>
            </div>

            <!-- Personal Information Section -->
            <div class="admin-student-form-section">
                <div class="admin-student-section-header">
                    <div class="admin-student-section-title">Personal Information</div>
                    <span class="admin-student-question-count">02 Questions</span>
                    <div class="admin-student-arrow-icon">
                        <img src="assets/images/admin-drop.png" alt="Arrow Icon" class="admin-student-arrow-down" />
                    </div>
                </div>

                <div class="admin-student-section-content">
                    <!-- First Question: Personal Info -->
                    <div class="admin-student-form-question">
                        <div class="admin-student-question-row" id="admin-student-person-info">
                            <div class="admin-student-question-title">1. Let us know more about you</div>
                            <div class="admin-student-dropdown-field">
                                <span class="admin-student-field-text">Text field</span>
                                <span class="admin-student-dropdown-icon"></span>
                            </div>
                        </div>
                        
                        <div class="admin-student-options-section" id="person-info-section" style="display: none;">
                            <div class="admin-student-options-label">Options:</div>

                            <!-- Input Row 1 -->
                            <div class="input-row" id="input-row-1">
                                <div class="input-group">
                                    <div class="input-content">
                                        <img src="./assets/images/person-icon.png" alt="Person Icon" class="icon" />
                                        <input type="text" placeholder="Full Name" name="full_name" id="fullName" required />
                                    </div>
                                    <span class="remove-option">×</span>
                                    <div class="validation-message" id="fullName-error"></div>
                                </div>

                                <div class="input-group">
                                    <div class="input-content">
                                        <img src="./assets/images/call-icon.png" alt="Phone Icon" class="icon" />
                                        <input type="tel" placeholder="Phone Number" name="phone_number" id="phone" required />
                                    </div>
                                    <span class="remove-option">×</span>
                                    <div class="validation-message" id="phone-error"></div>
                                </div>

                                <div class="input-group">
                                    <div class="input-content">
                                        <img src="./assets/images/school.png" alt="Referral Code Icon" class="icon" />
                                        <input type="text" placeholder="Referral Code" name="referral_code" id="referralCode" required />
                                    </div>
                                    <span class="remove-option">×</span>
                                    <div class="validation-message" id="referralCode-error"></div>
                                </div>
                            </div>

                            <!-- Input Row 2 -->
                            <div class="input-row" id="input-row-2">
                                <div class="input-group">
                                    <div class="input-content">
                                        <img src="./assets/images/mail.png" alt="Mail Icon" class="icon" />
                                        <input type="email" placeholder="Email ID" name="email" id="email" required />
                                    </div>
                                    <span class="remove-option">×</span>
                                    <div class="validation-message" id="email-error"></div>
                                </div>

                                <div class="input-group">
                                    <div class="input-content">
                                        <img src="./assets/images/pin_drop.png" alt="Location Icon" class="icon">
                                        <input type="text" placeholder="City" name="city" required id="city-input" />
                                        <div id="suggestions" class="suggestions-container"></div>
                                    </div>
                                    <span class="remove-option">×</span>
                                    <div class="validation-message" id="city-error"></div>
                                </div>

                                <div class="add-field" id="add-input-field">
                                    <span class="add-text">Add</span>
                                    <span class="add-icon">+</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Question: How did you find about us -->
                    <div class="admin-student-form-question">
                        <div class="admin-student-question-row" id="admin-student-about-us">
                            <div class="admin-student-question-title">2. How did you find about us?</div>
                            <div class="admin-student-dropdown-field">
                                <span class="admin-student-field-text">Drop Down List</span>
                                <span class="admin-student-dropdown-icon"></span>
                            </div>
                        </div>
                        
                        <div class="admin-student-options-section" id="about-us-section" style="display: none;">
                            <div class="admin-student-options-label">Options:</div>
                            <div class="second-main-section-container">
                                <div class="second-question-options">
                                    <div class="social-option">
                                        <span class="social-name">Youtube</span>
                                        <span class="social-remove">×</span>
                                    </div>
                                    <div class="social-option">
                                        <span class="social-name">LinkedIn</span>
                                        <span class="social-remove">×</span>
                                    </div>
                                    <div class="social-option">
                                        <span class="social-name">Social Media</span>
                                        <span class="social-remove">×</span>
                                    </div>
                                    <div class="social-option">
                                        <span class="social-name">Institution</span>
                                        <span class="social-remove">×</span>
                                    </div>
                                </div>
                                
                                <div class="add-social">
                                    <span class="add-text">Add</span>
                                    <span class="add-icon">+</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Details Section -->
            <div class="admin-student-form-section-course-details">
                <div class="admin-student-section-header-course">
                    <div class="admin-student-section-title-course">Course Details</div>
                    <span class="admin-student-question-count-course">4 Questions</span>
                    <div class="admin-student-arrow-icon-course">
                        <img src="assets/images/admin-drop.png" alt="Arrow Icon" class="admin-student-arrow-down-course" />
                    </div>
                </div>

                <div class="admin-student-section-content-course">
                    <div class="admin-student-form-question-course">
                        <div class="admin-student-question-row-course" id="admin-student-course">
                            <div class="admin-student-question-title-course">1. Where are you planning to study? Select all that applies</div>
                            <div class="admin-student-dropdown-field-course">
                                <span class="admin-student-field-text-course">Check Box</span>
                                <span class="admin-student-dropdown-icon-course"></span>
                            </div>
                        </div>

                        <div class="admin-student-options-section-course" id="person-info-section-course">
                             <div class="admin-student-options-label">Options:</div>
                            <div class="checkbox-group" id="selected-study-location">
                                <label>
                                    <input type="checkbox" name="study-location" value="USA"> USA
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="UK"> UK
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Ireland"> Ireland
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="New Zealand"> New Zealand
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Germany"> Germany
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="France"> France
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Sweden"> Sweden
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Italy"> Italy
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Canada"> Canada
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Australia"> Australia
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Others"> Others
                                </label>

                                <!-- Add Checkbox Container -->
                                <div class="add-checkbox-container">

                                     <span class="add-checkbox-input">Add</span>
                                    <span class="add-checkbox-btn" id="add-course-checkbox-id">+</span>
                                </div>
                            </div>
                        </div>


              </div> 


                <!--course details 2-->

                        <div class="admin-student-form-question-course-degree" id="admin-student-form-question-course-degree">   
                            <div class="admin-student-question-row-course-degree" id="admin-student-course-second">
                                <div class="admin-student-question-title-course-degree">2. Select the type of degree you want to pursue:</div>
                                <div class="admin-student-dropdown-field-course-degree">
                                    <span class="admin-student-field-text-course">Check Box</span>
                                    <span class="admin-student-dropdown-icon-course"></span>
                                </div>
                            </div>
                    </div>

                    </div>
                </div>
            </div>
        </div> <!-- End of admin-student-form-container -->
    </div> <!-- End of nbfc-studentdashboardprofile-profile-section-container -->
</div> 
   

 <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle section content and arrow direction
            const sectionHeader = document.querySelector('.admin-student-section-header');
            const sectionContent = document.querySelector('.admin-student-section-content');
            const arrowIcon = document.querySelector('.admin-student-arrow-icon img');

            // By default section is expanded (content visible, arrow up)
            sectionContent.style.display = 'block';
            arrowIcon.classList.add('admin-student-arrow-up');
            arrowIcon.classList.remove('admin-student-arrow-down');

            sectionHeader.addEventListener('click', function () {
                const isContentVisible = sectionContent.style.display === 'block';

                // Toggle content visibility
                sectionContent.style.display = isContentVisible ? 'none' : 'block';

                // Toggle arrow direction
                if (isContentVisible) {
                    // Content is being hidden, arrow points down
                    arrowIcon.classList.add('admin-student-arrow-down');
                    arrowIcon.classList.remove('admin-student-arrow-up');
                } else {
                    // Content is being shown, arrow points up
                    arrowIcon.classList.add('admin-student-arrow-up');
                    arrowIcon.classList.remove('admin-student-arrow-down');
                }
            });

            // Remove option functionality
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-option')) {
                    e.target.closest('.input-group').remove();
                    reorganizeInputs();
                } else if (e.target.classList.contains('social-remove')) {
                    e.target.closest('.social-option').remove();
                }
            });

            // Add field functionality 
            const addInputField = document.getElementById('add-input-field');

            addInputField.addEventListener('click', function () {
                showInputPrompt();
            });

            // Function to show input prompt
            function showInputPrompt() {
                const fieldType = prompt("Enter field type (e.g., Country, Pincode):");
                if (fieldType && fieldType.trim() !== "") {
                    addNewInputField(fieldType);
                }
            }

            // Function to add a new input field
            // Function to add a new input field with appropriate icons
            function addNewInputField(fieldType) {
                // Icon mapping based on field type (case insensitive)
                const iconMap = {
                    'name': './assets/images/person-icon.png',
                    'full name': './assets/images/person-icon.png',
                    'first name': './assets/images/person-icon.png',
                    'last name': './assets/images/person-icon.png',
                    'phone': './assets/images/call-icon.png',
                    'phone number': './assets/images/call-icon.png',
                    'mobile': './assets/images/call-icon.png',
                    'email': './assets/images/mail.png',
                    'email id': './assets/images/mail.png',
                    'city': './assets/images/pin_drop.png',
                    'address': './assets/images/pin_drop.png',
                    'location': './assets/images/pin_drop.png',
                    'country': './assets/images/pin_drop.png',
                    'state': './assets/images/pin_drop.png',
                    'pincode': './assets/images/pin_drop.png',
                    'zip code': './assets/images/pin_drop.png',
                    'postal code': './assets/images/pin_drop.png',
                    'referral': './assets/images/school.png',
                    'referral code': './assets/images/school.png',
                    'code': './assets/images/school.png',
                    // Add more mappings as needed
                };

                // Check for icon match (case insensitive)
                const fieldTypeLower = fieldType.toLowerCase();
                let iconSrc = './assets/images/pin_drop.png'; // default icon

                // Find matching icon
                for (const [key, value] of Object.entries(iconMap)) {
                    if (fieldTypeLower.includes(key) || key.includes(fieldTypeLower)) {
                        iconSrc = value;
                        break;
                    }
                }

                const newInput = document.createElement('div');
                newInput.className = 'input-group';
                newInput.innerHTML = `
        <div class="input-content">
            <img src="${iconSrc}" alt="${fieldType} Icon" class="icon" />
            <input type="text" placeholder="${fieldType}" name="${fieldTypeLower.replace(/\s+/g, '_')}" required />
        </div>
        <span class="remove-option">×</span>
        <div class="validation-message" id="${fieldTypeLower.replace(/\s+/g, '_')}-error"></div>
    `;

                // Find the current parent of the add button
                const addButton = document.getElementById('add-input-field');
                const addButtonParent = addButton.parentNode;

                // Add the new input field before the add button
                addButtonParent.insertBefore(newInput, addButton);

                // Reorganize inputs to maintain exactly 3 per row
                reorganizeInputs();
            }
            // Function to reorganize inputs to maintain exactly 3 per row
            function reorganizeInputs() {
                // Get all input groups and the add field
                const allInputs = document.querySelectorAll('.input-group');
                const addField = document.getElementById('add-input-field');

                // Get or create rows as needed
                let row1 = document.getElementById('input-row-1');
                let row2 = document.getElementById('input-row-2');

                // Clear all rows
                row1.innerHTML = '';
                row2.innerHTML = '';

                // Remove any existing row3
                const existingRow3 = document.getElementById('input-row-3');
                if (existingRow3) {
                    existingRow3.remove();
                }

                // Create row3 if needed
                let row3 = null;
                if (allInputs.length > 6) {
                    row3 = document.createElement('div');
                    row3.className = 'input-row';
                    row3.id = 'input-row-3';
                    row2.parentNode.insertBefore(row3, row2.nextSibling);
                }

                // Distribute inputs, exactly 3 per row
                for (let i = 0; i < allInputs.length; i++) {
                    if (i < 3) {
                        row1.appendChild(allInputs[i]);
                    } else if (i < 6) {
                        row2.appendChild(allInputs[i]);
                    } else if (row3) {
                        row3.appendChild(allInputs[i]);
                    }
                }

                // Determine where to place the add button
                const lastRow = row3 || (allInputs.length > 3 ? row2 : row1);
                const inputsInLastRow = lastRow.querySelectorAll('.input-group').length;

                // Only add the add button if there's room (less than 3 inputs)
                if (inputsInLastRow < 3) {
                    lastRow.appendChild(addField);
                } else {
                    // Create a new row for the add button
                    const newRow = document.createElement('div');
                    newRow.className = 'input-row';
                    newRow.id = 'input-row-' + (row3 ? '4' : (row2.children.length > 0 ? '3' : '2'));
                    newRow.appendChild(addField);
                    lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
                }
            }



            // Basic form validation
            const inputs = document.querySelectorAll('input[required]');
            inputs.forEach(input => {
                input.addEventListener('blur', function () {
                    validateField(this);
                });
            });

            function validateField(field) {
                // Find the error element associated with this field
                const errorId = field.id + "-error";
                const errorElement = document.getElementById(errorId);

                if (!errorElement) return; // Skip if no error element exists

                const inputGroup = field.closest('.input-group');

                // Reset previous error styling
                inputGroup.style.borderColor = '';

                // Check for errors
                if (!field.value.trim()) {
                    errorElement.textContent = `Please enter a valid ${field.placeholder.toLowerCase()}`;
                    errorElement.style.display = 'block';
                    inputGroup.style.borderColor = 'red';
                } else if (field.type === 'email' && !isValidEmail(field.value)) {
                    errorElement.textContent = 'Please enter a valid email address';
                    errorElement.style.display = 'block';
                    inputGroup.style.borderColor = 'red';
                } else if (field.id === 'phone' && !isValidPhone(field.value)) {
                    errorElement.textContent = 'Please enter a valid 10-digit phone number.';
                    errorElement.style.display = 'block';
                    inputGroup.style.borderColor = 'red';
                } else {
                    // Clear error message
                    errorElement.textContent = '';
                    errorElement.style.display = 'none';
                }
            }

            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function isValidPhone(phone) {
                const phoneRegex = /^\d{10}$/;
                return phoneRegex.test(phone);
            }

            // City input suggestions
            const cityInput = document.getElementById('city-input');
            const suggestionsContainer = document.getElementById('suggestions');

            // Example city list (you would replace this with your actual city data)
            const cities = ['Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Kolkata', 'Hyderabad', 'Pune', 'Ahmedabad'];

            cityInput.addEventListener('input', function () {
                const inputValue = this.value.toLowerCase();

                // Clear previous suggestions
                suggestionsContainer.innerHTML = '';

                if (inputValue.length > 0) {
                    // Filter cities that match input
                    const matchedCities = cities.filter(city =>
                        city.toLowerCase().startsWith(inputValue)
                    );

                    if (matchedCities.length > 0) {
                        suggestionsContainer.style.display = 'block';

                        // Create suggestion elements
                        matchedCities.forEach(city => {
                            const div = document.createElement('div');
                            div.textContent = city;
                            div.style.padding = '8px 10px';
                            div.style.cursor = 'pointer';

                            div.addEventListener('click', function () {
                                cityInput.value = city;
                                suggestionsContainer.style.display = 'none';
                                validateField(cityInput);
                            });

                            div.addEventListener('mouseover', function () {
                                this.style.backgroundColor = '#f0f0f0';
                            });

                            div.addEventListener('mouseout', function () {
                                this.style.backgroundColor = 'transparent';
                            });

                            suggestionsContainer.appendChild(div);
                        });
                    } else {
                        suggestionsContainer.style.display = 'none';
                    }
                } else {
                    suggestionsContainer.style.display = 'none';
                }
            });

            // Hide suggestions when clicking outside
            document.addEventListener('click', function (e) {
                if (e.target !== cityInput && e.target !== suggestionsContainer) {
                    suggestionsContainer.style.display = 'none';
                }
            });

            // Function to toggle visibility
            function toggleSection(questionRowId, sectionId) {
                const questionRow = document.getElementById(questionRowId);
                const section = document.getElementById(sectionId);

                questionRow.addEventListener('click', function () {
                    if (section.style.display === "none" || section.style.display === "") {
                        section.style.display = "block";
                    } else {
                        section.style.display = "none";
                    }
                });
            }

            // Call the function for both sections
            toggleSection('admin-student-person-info', 'person-info-section');
            toggleSection('admin-student-about-us', 'about-us-section');


            document.querySelector('.add-social').addEventListener('click', function () {
                // Prompt user for input
                const userInput = prompt("Enter dropdown option", "");

                // Only proceed if the user entered something
                if (userInput && userInput.trim() !== "") {
                    // Create new option
                    const newOption = document.createElement('div');
                    newOption.className = 'social-option';

                    // Create the name span with the user's input
                    const nameSpan = document.createElement('span');
                    nameSpan.className = 'social-name';
                    nameSpan.textContent = userInput.trim(); // Display what the user typed

                    // Create the remove button
                    const removeSpan = document.createElement('span');
                    removeSpan.className = 'social-remove';
                    removeSpan.textContent = '×';

                    // Add event listener to the remove button
                    removeSpan.addEventListener('click', function () {
                        newOption.remove();
                    });

                    // Append the spans to the new option
                    newOption.appendChild(nameSpan);
                    newOption.appendChild(removeSpan);

                    // Get the parent container
                    const optionsContainer = document.querySelector('.second-question-options');

                    // Append the new option to the container
                    optionsContainer.appendChild(newOption);
                }
            });

            // Add this for existing remove buttons
            document.querySelectorAll('.social-remove').forEach(function (removeButton) {
                removeButton.addEventListener('click', function () {
                    this.parentElement.remove();
                });
            });
             let container = document.getElementById("studentFormContainer"); // Replace with your actual ID


// 2. Course Details Section container 1
const checkboxContainer = document.getElementById('selected-study-location');
const addCheckboxContainer = document.querySelector('.add-checkbox-container');

// Comprehensive error checking
if (!checkboxContainer) {
    console.error('Checkbox container not found');
    return;
}

if (!addCheckboxContainer) {
    console.error('Add checkbox container not found');
    return;
}

function addNewCheckbox() {
    // Prompt user for input
    const newCountry = prompt("Enter country name", "");
    
    // Only proceed if the user entered something
    if (newCountry && newCountry.trim() !== "") {
        // Check if country already exists
        const existingCountries = Array.from(checkboxContainer.querySelectorAll('input[type="checkbox"]'))
            .map(checkbox => checkbox.value.toLowerCase());
        
        if (existingCountries.includes(newCountry.toLowerCase())) {
            alert('This country is already in the list');
            return;
        }
        
        // Create new checkbox element
        const newLabel = document.createElement('label');
        const newCheckbox = document.createElement('input');
        
        // Configure checkbox
        newCheckbox.type = 'checkbox';
        newCheckbox.name = 'study-location';
        newCheckbox.value = newCountry;
        newCheckbox.checked = true;
        
        // Create label with checkbox and text
        newLabel.appendChild(newCheckbox);
        newLabel.appendChild(document.createTextNode(' ' + newCountry));
        
        // Insert new checkbox before the add container
        checkboxContainer.insertBefore(newLabel, addCheckboxContainer);
    }
}

// Add click event to the entire add-checkbox-container instead of just the button
addCheckboxContainer.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent any default form submission
    addNewCheckbox();
});

// Toggle functionality for admin-student-options-section-course
const questionRow = document.querySelector('.admin-student-question-row-course');
const optionsSection = document.querySelector('.admin-student-options-section-course');

// Hide the options section by default
if (optionsSection) {
    optionsSection.style.display = 'none';
}

// Add click event listener to the question row
if (questionRow) {
    questionRow.addEventListener('click', function() {
        // Toggle the visibility of the options section
        if (optionsSection) {
            if (optionsSection.style.display === 'none') {
                optionsSection.style.display = 'block';
            } else {
                optionsSection.style.display = 'none';
            }
        }
    });
} else {
    console.error('Question row element not found');
}

//coures details 2 container
 // Find where you have this section in your existing code:
//coures details 2 container
const optionsContainer = document.getElementById('option-section-degree-container');
const dropdownTrigger = document.getElementById('admin-student-course-second');

// 2. Hide the options container by default
if (optionsContainer) {
    optionsContainer.style.display = 'none';
    console.log('Options container hidden on load');
} else {
    console.error('Could not find options container element');
}

// 3. Add click event to show/hide the options container
if (dropdownTrigger) {
    dropdownTrigger.addEventListener('click', function(e) {
        e.stopPropagation(); // Prevent event bubbling
        if (optionsContainer.style.display === 'none') {
            optionsContainer.style.display = 'block';
            console.log('Options container shown');
        } else {
            optionsContainer.style.display = 'none';
            console.log('Options container hidden');
        }
    });
} else {
    console.error('Could not find dropdown trigger element');
}

// 4. Keep the existing add functionality
const addSection = document.getElementById('addSection');
const optionsGrid = document.getElementById('optionsContainer');

if (addSection && optionsGrid) {
    addSection.onclick = function(e) {
        e.stopPropagation(); // Stop event from reaching document click handler
        const newOptionName = prompt('Enter new option:');
        if (newOptionName && newOptionName.trim() !== '') {
            // Remove the add section
            optionsGrid.removeChild(addSection);
            
            // Create the new option item
            const newOptionItem = document.createElement('div');
            newOptionItem.className = 'option-item';
            newOptionItem.innerHTML = `
                <input type="checkbox" class="option-checkbox">
                <div class="option-name">${newOptionName.trim()}</div>
            `;
            
            // Add the new option to the grid
            optionsGrid.appendChild(newOptionItem);
            
            // Add back the add section
            optionsGrid.appendChild(addSection);
            console.log('New option added: ' + newOptionName);
        }
    };
} else {
    console.error('Could not find addSection or optionsGrid elements');
}
    
});


    </script>

</body>

</html>