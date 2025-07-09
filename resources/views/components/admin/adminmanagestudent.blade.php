<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Include FileSaver.js for cross-browser file download support -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
</head>

<body>
    <div class="manage-student-main-report-container" id="manage-student-main-admin-report-container-id">
        <div class="manage-student-main-admin-report-container">
            <div class="manage-student-report-header">
                <h1 class="manage-student-report-title">Manage Students Reports</h1>
                <button class="manage-student-report-export-btn" id="manage-student-report-export-btn-excel">Export to
                    Excel</button>
            </div>
            <div class="manage-student-report-container">
                <div class="manage-student-report-filters">
                    <div class="manage-student-report-filters-row">
                        <div class="manage-student-report-filters-left">
                            <select class="manage-student-report-select" id="manage-student-report-entries">
                                <option>6 entries</option>
                                <option>12 entries</option>
                                <option>18 entries</option>
                            </select>
                        </div>
                        <div class="manage-student-report-filters-right">
                            <input type="date" class="manage-student-report-input" id="filter-date">
                            <select class="manage-student-report-select" id="filter-nbfc">
                                <option value="">NBFC</option>
                            </select>
                            <select class="manage-student-report-select" id="filter-counsellor">
                                <option value="">Student Counsellor</option>
                            </select>
                            <select class="manage-student-report-select" id="filter-status">
                                <option value="">Status</option>
                            </select>
                        </div>
                    </div>
                    <div class="manage-student-report-filters-row">
                        <div class="manage-student-report-filters-left">
                            <div class="manage-student-report-search-container">
                                <input type="text"
                                    class="manage-student-report-input manage-student-report-search-input"
                                    placeholder="Search">
                                <img src="assets/images/search.png" class="manage-student-report-search-icon"
                                    alt="search">
                            </div>
                        </div>
                        <div class="manage-student-report-filters-right">
                            <select class="manage-student-report-select" id="filter-country">
                                <option value="">Country</option>
                            </select>
                            <select class="manage-student-report-select" id="filter-state">
                                <option value="">State</option>
                            </select>
                            <select class="manage-student-report-select" id="filter-city">
                                <option value="">City</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mobile-report-header-student-report">
                    <div class="mobile-report-header-top-student-report">
                        <h2 class="mobile-report-title-student-report">Manage Students Reports</h2>
                    </div>
                    <h3 class="mobile-report-subtitle-student-report">Reports</h3>
                    <div class="mobile-report-header-middle-student-report">
                        <div class="mobile-header-actions-student-report">
                            <div class="mobile-search-container-student-report">
                              <div class="mobile-search-input-student-report">
                                    <input type="text"  placeholder="Search">
                                     <img src="assets/images/search.png" class="mobile-search-icon-student-report" alt="search">
                             </div>     
                            </div>
                           <button class="mobile-filter-btn-student-report" id="show-mobile-filters">
                                Filters <img src="assets/images/filter-icon.png" alt="Dropdown Icon" class="dropdown-icon">
                            </button>
                            <button class="mobile-calendar-btn-student-report">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor"
                                        stroke-width="2" />
                                    <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2" />
                                    <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button class="mobile-export-btn-student-report"
                        id="manage-student-report-export-btn-excel-mobile">Export to Excel</button>
                </div>
                <div class="manage-student-report-table-wrapper">
                    <table class="manage-student-report-table">
                        <thead>
                            <tr>
                                <th class="manage-student-report-th" id="th-sno">S.No</th>
                                <th class="manage-student-report-th" id="th-student-name">Student Name</th>
                                <th class="manage-student-report-th" id="th-unique-id">Unique ID</th>
                                <th class="manage-student-report-th" id="th-email">Email</th>
                                <th class="manage-student-report-th" id="th-mobile-no">Mobile No.</th>
                                <th class="manage-student-report-th" id="th-type">Type</th>
                                <th class="manage-student-report-th" id="th-gender">Gender</th>
                                <th class="manage-student-report-th" id="th-loan-amount">Loan Amount</th>
                                <th class="manage-student-report-th" id="th-date">Date</th>
                                <th class="manage-student-report-th" id="th-date-registration">Date of Registration</th>
                                <th class="manage-student-report-th" id="th-source-referral">Source of Referral</th>
                                <th class="manage-student-report-th" id="th-referral-no">Referral No.</th>
                                <th class="manage-student-report-th" id="th-counsellor-name">Student Counsellor Name
                                </th>
                                <th class="manage-student-report-th" id="th-state">State</th>
                                <th class="manage-student-report-th" id="th-city">City</th>
                                {{-- <th class="manage-student-report-th" id="th-destination-country">Destination Country
                                </th>
                                <th class="manage-student-report-th" id="th-nbfc">NBFC</th> --}}
                                <th class="manage-student-report-th" id="th-no-proposals">No. of Proposals</th>
                                {{-- <th class="manage-student-report-th" id="th-status">Status</th> --}}
                                <th class="manage-student-report-th" id="th-point-entry">Point of Entry</th>
                            </tr>
                        </thead>
                        <tbody id="manage-student-report-table-body">
                        </tbody>
                    </table>
                </div>
                <div class="manage-student-report-pagination">
                    <div class="manage-student-report-pagination-wrapper">
                        <button class="manage-student-report-pagination-btn" id="prev-page">
                            </button>
                                <span class="manage-student-report-pagination-text" id="pagination-text">1-6 / 0</span>
                                <button class="manage-student-report-pagination-btn" id="next-page">></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add the filter popup container -->
    <div class="mobile-filters-popup-student-report" id="mobile-filters-popup">
        <div class="mobile-filters-content-student-report">
            <div class="mobile-filters-header-student-report">
                <h3 class="mobile-filters-title-student-report">Filters</h3>
                <button class="mobile-close-btn-student-report" id="close-mobile-filters">×</button>
            </div>
            <div class="mobile-filter-item-student-report">
                <select id="mobile-filter-nbfc">
                    <option value="">NBFC</option>
                </select>
            </div>
            <div class="mobile-filter-item-student-report">
                <select id="mobile-filter-counsellor">
                    <option value="">Student Counsellor</option>
                </select>
            </div>
            <div class="mobile-filter-item-student-report">
                <select id="mobile-filter-status">
                    <option value="">Status</option>
                </select>
            </div>
            <div class="mobile-filter-item-student-report">
                <select id="mobile-filter-city">
                    <option value="">City</option>
                </select>
            </div>
            <div class="mobile-filter-item-student-report">
                <select id="mobile-filter-state">
                    <option value="">State</option>
                </select>
            </div>
            <div class="mobile-filter-item-student-report">
                <select id="mobile-filter-country">
                    <option value="">Country</option>
                </select>
            </div>
        </div>
    </div>

    <script>
        // Pagination variables
        let currentPage = 1;
        let recordsPerPage = 6;
        let fullData = []; // Store the raw API data
        let filteredData = []; // Store the filtered data for display

        // Utility function to convert DD/MM/YYYY to YYYY-MM-DD for comparison
        function convertDateFormat(dateStr) {
            if (!dateStr) return null;
            const [day, month, year] = dateStr.split('/');
            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`; // Convert to YYYY-MM-DD
        }

        // Function to fetch data from the API
       async function fetchStudentData() {
    try {
        const response = await fetch('/api/mergestudents', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status} - ${response.statusText}`);
        }

        const data = await response.json();
        // console.log('Fetched student data:', data);

        let studentData = data;
        if (data.data && Array.isArray(data.data)) {
            studentData = data.data;
        } else if (!Array.isArray(data)) {
            throw new Error('Invalid API response: Expected an array of student data');
        }

        return studentData.map(item => {
            // Fix: Normalize and check type
            let typeValue = 'Others';
            const rawType = (item.type || '').toLowerCase().trim();

            if (rawType.includes('bachelor')) {
                typeValue = 'Under Graduate';
            } else if (rawType.includes('master')) {
                typeValue = 'Post Graduate';
            }

            return {
                id: item.id || 0,
                name: item.full_name || 'N/A',
                uniqueId: item.unique_id || 'N/A',
                email: item.email || 'N/A',
                mobile: item.phone_number || 'N/A',
                type: typeValue,
                gender: item.gender || 'N/A',
                loanAmount: item.loan_amount || '₹0',
                date: item.dateofbirth || 'N/A',
                dateOfRegistration: item.registration_date || 'N/A',
                sourceOfReferral: item.sourceOfReferral || 'N/A',
                referralNo: item.scReferral || 'N/A',
                counsellor: item.student_counsellor_name || 'N/A',
                state: item.state || 'N/A',
                city: item.city || 'N/A',
                country: item.country || 'N/A',
                nbfc: item.nbfc || 'N/A',
                noOfProposals: item.proposal_count || 0,
                status: item.status || 'N/A',
                pointOfEntry: item.PointOfEntry || 'N/A'
            };
        });

    } catch (error) {
        console.error('Error fetching student data:', error);
        throw error;
    }
}

        // Function to populate unique options for all filters
        function populateFilterOptions(data) {
            try {
                const uniqueCountries = [...new Set(data.map(student => student.country))];
                const countrySelects = [document.getElementById('filter-country'), document.getElementById('mobile-filter-country')];
                countrySelects.forEach(select => {
                    uniqueCountries.forEach(country => {
                        const option = document.createElement('option');
                        option.value = country;
                        option.textContent = country;
                        select.appendChild(option.cloneNode(true));
                    });
                });

                const uniqueStates = [...new Set(data.map(student => student.state))];
                const stateSelects = [document.getElementById('filter-state'), document.getElementById('mobile-filter-state')];
                stateSelects.forEach(select => {
                    uniqueStates.forEach(state => {
                        const option = document.createElement('option');
                        option.value = state;
                        option.textContent = state;
                        select.appendChild(option.cloneNode(true));
                    });
                });

                const uniqueNBFCs = [...new Set(data.map(student => student.nbfc))];
                const nbfcSelects = [document.getElementById('filter-nbfc'), document.getElementById('mobile-filter-nbfc')];
                nbfcSelects.forEach(select => {
                    uniqueNBFCs.forEach(nbfc => {
                        const option = document.createElement('option');
                        option.value = nbfc;
                        option.textContent = nbfc;
                        select.appendChild(option.cloneNode(true));
                    });
                });

                const uniqueCounsellors = [...new Set(data.map(student => student.counsellor))];
                const counsellorSelects = [document.getElementById('filter-counsellor'), document.getElementById('mobile-filter-counsellor')];
                counsellorSelects.forEach(select => {
                    uniqueCounsellors.forEach(counsellor => {
                        const option = document.createElement('option');
                        option.value = counsellor;
                        option.textContent = counsellor;
                        select.appendChild(option.cloneNode(true));
                    });
                });

                const uniqueStatuses = [...new Set(data.map(student => student.status))];
                const statusSelects = [document.getElementById('filter-status'), document.getElementById('mobile-filter-status')];
                statusSelects.forEach(select => {
                    uniqueStatuses.forEach(status => {
                        const option = document.createElement('option');
                        option.value = status;
                        option.textContent = status;
                        select.appendChild(option.cloneNode(true));
                    });
                });

                const uniqueCities = [...new Set(data.map(student => student.city))];
                const citySelects = [document.getElementById('filter-city'), document.getElementById('mobile-filter-city')];
                citySelects.forEach(select => {
                    uniqueCities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city;
                        option.textContent = city;
                        select.appendChild(option.cloneNode(true));
                    });
                });
            } catch (error) {
                console.error('Error populating filter options:', error);
            }
        }

        // Function to populate table with paginated data
        function populateManageStudentReportTable(data, page = 1) {
            try {
                // console.log('Populating table with data:', data.length, 'records, page:', page);
                const tableBody = document.getElementById('manage-student-report-table-body');
                if (!tableBody) {
                    console.error('Table body not found');
                    return;
                }
                tableBody.innerHTML = '';

                const startIndex = (page - 1) * recordsPerPage;
                const endIndex = startIndex + recordsPerPage;
                const paginatedData = data.slice(startIndex, endIndex);

                if (paginatedData.length === 0) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="20" class="manage-student-report-td" style="text-align: center;">No matching records found</td>
                        </tr>
                    `;
                } else {
                    paginatedData.forEach((student, index) => {
                        const row = document.createElement('tr');
                        let statusButtonStyle = '';
                        switch (student.status) {
                            case 'Offer accepted & Closed':
                                statusButtonStyle = 'style="background-color: #d4edda; color: #155724; border-color: none; padding: 5px 10px; border-radius: 15px; white-space: nowrap;"';
                                break;
                            case 'Offer rejected to student':
                                statusButtonStyle = 'style="background-color: #f8d7da; color: #721c24; border-color: none; padding: 5px 10px; border-radius: 15px; white-space: nowrap;"';
                                break;
                            default:
                                statusButtonStyle = 'style="background-color: #e9ecef; color: #383d41; border-color: none; padding: 5px 10px; border-radius: 15px; white-space: nowrap;"';
                                break;
                        }
                        row.innerHTML = `
                            <td class="manage-student-report-td">${startIndex + index + 1}</td>
                            <td class="manage-student-report-td">${student.name}</td>
                            <td class="manage-student-report-td">${student.uniqueId}</td>
                            <td class="manage-student-report-td">${student.email}</td>
                            <td class="manage-student-report-td">${student.mobile}</td>
                            <td class="manage-student-report-td">${student.type}</td>
                            <td class="manage-student-report-td">${student.gender}</td>
                            <td class="manage-student-report-td">${student.loanAmount}</td>
                            <td class="manage-student-report-td">${student.date}</td>
                            <td class="manage-student-report-td">${student.dateOfRegistration}</td>
                            <td class="manage-student-report-td">${student.sourceOfReferral}</td>
                            <td class="manage-student-report-td">${student.referralNo}</td>
                            <td class="manage-student-report-td">${student.counsellor}</td>
                            <td class="manage-student-report-td">${student.state}</td>
                            <td class="manage-student-report-td">${student.city}</td>
                            <td class="manage-student-report-td">${student.noOfProposals}</td>
                            <td class="manage-student-report-td">${student.pointOfEntry}</td>`;
                        tableBody.appendChild(row);
                    });
                }

                const paginationText = document.getElementById('pagination-text');
                const totalRecords = data.length;
                if (totalRecords === 0) {
                    paginationText.textContent = '0 / 0';
                } else {
                    const startRecord = startIndex + 1;
                    const endRecord = Math.min(endIndex, totalRecords);
                    paginationText.textContent = `${startRecord}-${endRecord} / ${totalRecords}`;
                }

                updatePaginationButtons(data);
            } catch (error) {
                console.error('Error populating table:', error);
            }
        }

        // Function to filter table data based on filter criteria
        function applyFilters() {
            try {
                const nbfc = document.getElementById('filter-nbfc').value || document.getElementById('mobile-filter-nbfc').value;
                const counsellor = document.getElementById('filter-counsellor').value || document.getElementById('mobile-filter-counsellor').value;
                const status = document.getElementById('filter-status').value || document.getElementById('mobile-filter-status').value;
                const city = document.getElementById('filter-city').value || document.getElementById('mobile-filter-city').value;
                const state = document.getElementById('filter-state').value || document.getElementById('mobile-filter-state').value;
                const country = document.getElementById('filter-country').value || document.getElementById('mobile-filter-country').value;
                const date = document.getElementById('filter-date').value;

                filteredData = fullData.filter(student => {
    const registrationDate = convertDateFormat(student.dateOfRegistration);
    const filterDate = date ? date : null;

                    return (
                        (nbfc === '' || student.nbfc === nbfc) &&
                        (counsellor === '' || student.counsellor === counsellor) &&
                        (status === '' || student.status === status) &&
                        (city === '' || student.city === city) &&
                        (state === '' || student.state === state) &&
                        (country === '' || student.country === country) &&
                        (!filterDate || registrationDate  === filterDate)
                    );
                });
                currentPage = 1;
                populateManageStudentReportTable(filteredData, currentPage);
            } catch (error) {
                console.error('Error applying filters:', error);
            }
        }
 
        function searchTable(query) {
            try {
                query = query.toLowerCase().trim();
                filteredData = fullData.filter(student => {
                    return (
                        student.name.toLowerCase().includes(query) ||
                        student.uniqueId.toLowerCase().includes(query) ||
                        student.email.toLowerCase().includes(query) ||
                        student.mobile.includes(query) ||
                        student.type.toLowerCase().includes(query) ||
                        student.gender.toLowerCase().includes(query) ||
                        student.loanAmount.toLowerCase().includes(query) ||
                        student.date.toLowerCase().includes(query) ||
                        student.dateOfRegistration.toLowerCase().includes(query) ||
                        student.sourceOfReferral.toLowerCase().includes(query) ||
                        student.referralNo.toLowerCase().includes(query) ||
                        student.counsellor.toLowerCase().includes(query) ||
                        student.state.toLowerCase().includes(query) ||
                        student.city.toLowerCase().includes(query) ||
                        student.country.toLowerCase().includes(query) ||
                        student.nbfc.toLowerCase().includes(query) ||
                        student.noOfProposals.toString().includes(query) ||
                        student.status.toLowerCase().includes(query) ||
                        student.pointOfEntry.toLowerCase().includes(query)
                    );
                });
                currentPage = 1;
                populateManageStudentReportTable(filteredData, currentPage);
            } catch (error) {
                console.error('Error searching table:', error);
            }
        }

        // Function to update pagination buttons
        function updatePaginationButtons(data) {
            try {
                const prevButton = document.getElementById('prev-page');
                const nextButton = document.getElementById('next-page');
                const totalPages = Math.ceil(data.length / recordsPerPage);

                prevButton.disabled = currentPage === 1;
                nextButton.disabled = currentPage === totalPages || data.length === 0;
            } catch (error) {
                console.error('Error updating pagination buttons:', error);
            }
        }

        // Function to handle entries per page change
        function updateRecordsPerPage() {
            try {
                const select = document.getElementById('manage-student-report-entries');
                recordsPerPage = parseInt(select.value.split(' ')[0]);
                currentPage = 1;
                populateManageStudentReportTable(filteredData, currentPage);
            } catch (error) {
                console.error('Error updating records per page:', error);
            }
        }

        // Function to export to Excel
        function downloadExcel() {
            try {
                const headers = [
                    "S.No", "Student Name", "Unique ID", "Email", "Mobile No.", "Type", "Gender", "Loan Amount",
                    "Date", "Date of Registration", "Source of Referral", "Referral No.", "Student Counsellor Name",
                    "State", "City", "Destination Country", "NBFC", "No. of Proposals", "Status", "Point of Entry"
                ];
                const tableData = filteredData.map((student, index) => [
                    index + 1,
                    student.name,
                    student.uniqueId,
                    student.email,
                    student.mobile,
                    student.type,
                    student.gender,
                    student.loanAmount,
                    student.date,
                    student.dateOfRegistration,
                    student.sourceOfReferral,
                    student.referralNo,
                    student.counsellor,
                    student.state,
                    student.city,
                    student.country,
                    student.nbfc,
                    student.noOfProposals,
                    student.status,
                    student.pointOfEntry
                ]);
                let csvContent = headers.join(',') + '\n';
                tableData.forEach(row => {
                    const escapedRow = row.map(cell => {
                        if (typeof cell === 'string' && (cell.includes(',') || cell.includes('"'))) {
                            return `"${cell.replace(/"/g, '""')}"`;
                        }
                        return cell;
                    });
                    csvContent += escapedRow.join(',') + '\n';
                });
                const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                const date = new Date().toISOString().split('T')[0];
                saveAs(blob, `student_report_${date}.csv`);
            } catch (error) {
                console.error('Error during Excel export:', error);
            }
        }

        // Function to attach export button listeners
        function attachExportButtonListeners() {
            try {
                const exportExcelButton = document.getElementById('manage-student-report-export-btn-excel');
                const exportExcelMobile = document.getElementById('manage-student-report-export-btn-excel-mobile');

                if (exportExcelButton) {
                    exportExcelButton.addEventListener('click', () => {
                        // Only trigger export in desktop view (width > 768px)
                        if (window.innerWidth > 768) {
                            downloadExcel();
                        }
                    });
                } else {
                    console.error('Export Excel button not found');
                }

                if (exportExcelMobile) {
                    exportExcelMobile.addEventListener('click', downloadExcel);
                } else {
                    console.error('Mobile export button not found');
                }
            } catch (error) {
                console.error('Error attaching export button listeners:', error);
            }
        }

        // Initialize the application
        async function initializeApp() {
            try {
                // Fetch data from the API
                fullData = await fetchStudentData();
                filteredData = [...fullData];
                // console.log('Initialized with data:', fullData.length, 'records');

                // Populate filters and table
                populateFilterOptions(fullData);
                populateManageStudentReportTable(filteredData, currentPage);
            } catch (error) {
                console.error('Initialization failed:', error);
                const tableBody = document.getElementById('manage-student-report-table-body');
                if (tableBody) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="20" class="manage-student-report-td" style="text-align: center;">
                                Failed to load data. Please check the API or try again later.
                            </td>
                        </tr>
                    `;
                }
                const paginationText = document.getElementById('pagination-text');
                if (paginationText) {
                    paginationText.textContent = '0 / 0';
                }
                updatePaginationButtons([]);
            }
        }

        // Wait for DOM content to be fully loaded
        document.addEventListener('DOMContentLoaded', () => {
            try {
                // console.log('DOM loaded, initializing application');

                // Initialize the app with API data
                initializeApp();

                // Attach event listeners
                const desktopSearchInput = document.querySelector('.manage-student-report-search-input');
                if (desktopSearchInput) {
                    desktopSearchInput.addEventListener('input', function (e) {
                        searchTable(e.target.value);
                    });
                }

                const mobileSearchInput = document.querySelector('.mobile-search-input-student-report');
                if (mobileSearchInput) {
                    mobileSearchInput.addEventListener('input', function (e) {
                        searchTable(e.target.value);
                    });
                }

                const prevButton = document.getElementById('prev-page');
                if (prevButton) {
                    prevButton.addEventListener('click', () => {
                        if (currentPage > 1) {
                            currentPage--;
                            populateManageStudentReportTable(filteredData, currentPage);
                        }
                    });
                }

                const nextButton = document.getElementById('next-page');
                if (nextButton) {
                    nextButton.addEventListener('click', () => {
                        const totalPages = Math.ceil(filteredData.length / recordsPerPage);
                        if (currentPage < totalPages) {
                            currentPage++;
                            populateManageStudentReportTable(filteredData, currentPage);
                        }
                    });
                }

                const entriesSelect = document.getElementById('manage-student-report-entries');
                if (entriesSelect) {
                    entriesSelect.addEventListener('change', updateRecordsPerPage);
                }

                const filterButton = document.getElementById('show-mobile-filters');
                if (filterButton) {
                    filterButton.addEventListener('click', () => {
                        const popup = document.getElementById('mobile-filters-popup');
                        if (window.innerWidth <= 768) {
                            popup.style.display = 'flex';
                        }
                    });
                }

                const closeButton = document.getElementById('close-mobile-filters');
                if (closeButton) {
                    closeButton.addEventListener('click', () => {
                        const popup = document.getElementById('mobile-filters-popup');
                        popup.style.display = 'none';
                    });
                }

                const filterSelects = [
                    document.getElementById('filter-nbfc'),
                    document.getElementById('filter-counsellor'),
                    document.getElementById('filter-status'),
                    document.getElementById('filter-city'),
                    document.getElementById('filter-state'),
                    document.getElementById('filter-country'),
                    document.getElementById('mobile-filter-nbfc'),
                    document.getElementById('mobile-filter-counsellor'),
                    document.getElementById('mobile-filter-status'),
                    document.getElementById('mobile-filter-city'),
                    document.getElementById('mobile-filter-state'),
                    document.getElementById('mobile-filter-country')
                ];
                filterSelects.forEach(select => {
                    if (select) {
                        select.addEventListener('change', applyFilters);
                    }
                });

                const dateFilter = document.getElementById('filter-date');
                if (dateFilter) {
                    dateFilter.addEventListener('change', applyFilters);
                }

                window.addEventListener('resize', () => {
                    const popup = document.getElementById('mobile-filters-popup');
                    if (window.innerWidth > 768 && popup.style.display === 'flex') {
                        popup.style.display = 'none';
                    }
                });

                // Attach export button listeners
                attachExportButtonListeners();

                // Retry attaching listeners after a short delay to handle dynamic DOM changes
                setTimeout(attachExportButtonListeners, 1000);
            } catch (error) {
                console.error('Error in DOMContentLoaded:', error);
            }
        });
    </script>
</body>

</html>