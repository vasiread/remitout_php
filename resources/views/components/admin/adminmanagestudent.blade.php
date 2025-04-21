<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
   
</head>
<body>

    @extends('layouts.app')

    @php


     @endphp
<div class="manage-student-main-report-container" id="manage-student-main-admin-report-container-id">
 <div class="manage-student-main-admin-report-container">
        <div class="manage-student-report-header">
            <h1 class="manage-student-report-title">Manage Students Reports</h1>
           <div class="export-button-group">
                    <button class="manage-student-report-export-btn" id="manage-student-report-export-btn-excel">Export
                        to excel</button>
                    <button class="manage-student-report-export-btn" id="manage-student-report-export-btn-pdf">Export to
                        PDF</button>
                </div>
            </div>
            <div class="manage-student-report-container">
                <div class="manage-student-report-filters">
                    <div class="manage-student-report-filters-row">
                        <div class="manage-student-report-filters-left">
                            <select class="manage-student-report-select" id="manage-student-report-entries">
                                <option>7 entries</option>
                                <option>14 entries</option>
                                <option>21 entries</option>
                            </select>
                        </div>
                        <div class="manage-student-report-filters-right">
                            <input type="date" class="manage-student-report-input">
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
                                <input type="text" class="manage-student-report-input manage-student-report-search-input" placeholder="Search">
                                <img src="assets/images/search.png" class="manage-student-report-search-icon" alt="search">
                            </div>
                        </div>
                        <div class="manage-student-report-filters-right">
                            <select class="manage-student-report-select" id="filter-country">
                                <option value="">Country</option>
                                <option value="India">India</option>
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
                                <input type="text" class="mobile-search-input-student-report" placeholder="Search">
                                <img src="assets/images/search.png" class="mobile-search-icon-student-report" alt="search">
                            </div>
                            <button class="mobile-filter-btn-student-report" id="show-mobile-filters">
                                Filters <span>⌄</span>
                            </button>
                            <button class="mobile-calendar-btn-student-report">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/>
                                    <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
                                    <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button class="mobile-export-btn-student-report" id="manage-student-report-export-btn-excel-mobile">Export to excel</button>
                </div>
                <div class="manage-student-report-table-wrapper">
                    <table class="manage-student-report-table">
                        <thead>
                            <tr>
                                <th class="manage-student-report-th">S.No</th>
                                <th class="manage-student-report-th">Student Name</th>
                                <th class="manage-student-report-th">Unique ID</th>
                                <th class="manage-student-report-th">Email</th>
                                <th class="manage-student-report-th">Mobile No.</th>
                                <th class="manage-student-report-th">Type</th>
                                <th class="manage-student-report-th">Gender</th>
                                <th class="manage-student-report-th">Loan Amount</th>
                                <th class="manage-student-report-th">Date</th>
                            </tr>
                        </thead>
                        <tbody id="manage-student-report-table-body">
                        </tbody>
                    </table>
                </div>
                <div class="manage-student-report-pagination">
                    <div class="manage-student-report-pagination-wrapper">
                        <button class="manage-student-report-pagination-btn" id="prev-page"><</button>
                        <span class="manage-student-report-pagination-text" id="pagination-text">1-7 / 30</span>
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
        // Sample data with 30 students (updated with filter fields)
        const manageStudentReportData = [
            { id: 1, name: "Aarav Mehta", uniqueId: "AMXJH245879", email: "aarav.mehta@gmail.com", mobile: "9876543210", type: "Undergraduate", gender: "Male", loanAmount: "₹12,50,000", date: "15/10/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Mumbai", state: "Maharashtra", country: "India" },
            { id: 2, name: "Sanya Kapoor", uniqueId: "SKLPO298745", email: "sanya.kapoor@gmail.com", mobile: "8765432109", type: "Post Graduate", gender: "Female", loanAmount: "₹18,75,000", date: "22/09/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Delhi", state: "Delhi", country: "India" },
            { id: 3, name: "Rohan Sharma", uniqueId: "RSHAR452189", email: "rohan.sharma@gmail.com", mobile: "7654321098", type: "Diploma", gender: "Male", loanAmount: "₹8,90,000", date: "10/11/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Bangalore", state: "Karnataka", country: "India" },
            { id: 4, name: "Priya Verma", uniqueId: "PVKOH789654", email: "priya.verma@gmail.com", mobile: "6543210987", type: "Doctorate", gender: "Female", loanAmount: "₹22,00,000", date: "05/12/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Chennai", state: "Tamil Nadu", country: "India" },
            { id: 5, name: "Kabir Malhotra", uniqueId: "KMLHT987456", email: "kabir.malhotra@gmail.com", mobile: "5432109876", type: "Undergraduate", gender: "Male", loanAmount: "₹14,30,000", date: "18/08/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Hyderabad", state: "Telangana", country: "India" },
            { id: 6, name: "Simran Kaur", uniqueId: "SKJYT659874", email: "simran.kaur@gmail.com", mobile: "4321098765", type: "Post Graduate", gender: "Female", loanAmount: "₹20,00,000", date: "30/09/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Pune", state: "Maharashtra", country: "India" },
            { id: 7, name: "Vikram Singh", uniqueId: "VSING123456", email: "vikram.singh@gmail.com", mobile: "9876541234", type: "Undergraduate", gender: "Male", loanAmount: "₹10,00,000", date: "12/07/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Jaipur", state: "Rajasthan", country: "India" },
            { id: 8, name: "Ananya Gupta", uniqueId: "AGUPT789123", email: "ananya.gupta@gmail.com", mobile: "8765439876", type: "Post Graduate", gender: "Female", loanAmount: "₹15,50,000", date: "25/08/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Kolkata", state: "West Bengal", country: "India" },
            { id: 9, name: "Arjun Patel", uniqueId: "APATE456789", email: "arjun.patel@gmail.com", mobile: "7654328765", type: "Diploma", gender: "Male", loanAmount: "₹9,20,000", date: "03/10/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Ahmedabad", state: "Gujarat", country: "India" },
            { id: 10, name: "Neha Sharma", uniqueId: "NSHAR321654", email: "neha.sharma@gmail.com", mobile: "6543217654", type: "Doctorate", gender: "Female", loanAmount: "₹25,00,000", date: "15/11/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Surat", state: "Gujarat", country: "India" },
            { id: 11, name: "Rahul Jain", uniqueId: "RJAIN987321", email: "rahul.jain@gmail.com", mobile: "5432106543", type: "Undergraduate", gender: "Male", loanAmount: "₹13,75,000", date: "20/06/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Lucknow", state: "Uttar Pradesh", country: "India" },
            { id: 12, name: "Kriti Agarwal", uniqueId: "KAGAR654987", email: "kriti.agarwal@gmail.com", mobile: "4321095432", type: "Post Graduate", gender: "Female", loanAmount: "₹19,25,000", date: "08/09/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Kanpur", state: "Uttar Pradesh", country: "India" },
            { id: 13, name: "Aditya Roy", uniqueId: "AROYX123789", email: "aditya.roy@gmail.com", mobile: "9876544321", type: "Diploma", gender: "Male", loanAmount: "₹7,80,000", date: "17/10/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Nagpur", state: "Maharashtra", country: "India" },
            { id: 14, name: "Sneha Reddy", uniqueId: "SREDD456123", email: "sneha.reddy@gmail.com", mobile: "8765433210", type: "Doctorate", gender: "Female", loanAmount: "₹23,50,000", date: "29/11/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Visakhapatnam", state: "Andhra Pradesh", country: "India" },
            { id: 15, name: "Ishaan Khanna", uniqueId: "IKHAN789456", email: "ishaan.khanna@gmail.com", mobile: "7654322109", type: "Undergraduate", gender: "Male", loanAmount: "₹11,90,000", date: "14/08/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Bhopal", state: "Madhya Pradesh", country: "India" },
            { id: 16, name: "Meera Nair", uniqueId: "MNAIR321789", email: "meera.nair@gmail.com", mobile: "6543211098", type: "Post Graduate", gender: "Female", loanAmount: "₹17,00,000", date: "02/10/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Patna", state: "Bihar", country: "India" },
            { id: 17, name: "Yash Chopra", uniqueId: "YCHOP654123", email: "yash.chopra@gmail.com", mobile: "5432109987", type: "Diploma", gender: "Male", loanAmount: "₹8,50,000", date: "22/07/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Indore", state: "Madhya Pradesh", country: "India" },
            { id: 18, name: "Tara Bose", uniqueId: "TBOSE987654", email: "tara.bose@gmail.com", mobile: "4321098876", type: "Doctorate", gender: "Female", loanAmount: "₹21,75,000", date: "10/12/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Thiruvananthapuram", state: "Kerala", country: "India" },
            { id: 19, name: "Siddharth Menon", uniqueId: "SMENO123987", email: "siddharth.menon@gmail.com", mobile: "9876547765", type: "Undergraduate", gender: "Male", loanAmount: "₹12,20,000", date: "05/09/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Coimbatore", state: "Tamil Nadu", country: "India" },
            { id: 20, name: "Riya Das", uniqueId: "RDASX456321", email: "riya.das@gmail.com", mobile: "8765436654", type: "Post Graduate", gender: "Female", loanAmount: "₹18,00,000", date: "18/10/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Bhubaneswar", state: "Odisha", country: "India" },
            { id: 21, name: "Nikhil Vargese", uniqueId: "NVARG789123", email: "nikhil.vargese@gmail.com", mobile: "7654325543", type: "Diploma", gender: "Male", loanAmount: "₹9,70,000", date: "27/11/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Guwahati", state: "Assam", country: "India" },
            { id: 22, name: "Anjali Pillai", uniqueId: "APILL321456", email: "anjali.pillai@gmail.com", mobile: "6543214432", type: "Doctorate", gender: "Female", loanAmount: "₹24,25,000", date: "13/08/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Ranchi", state: "Jharkhand", country: "India" },
            { id: 23, name: "Devansh Thakur", uniqueId: "DTHAK654789", email: "devansh.thakur@gmail.com", mobile: "5432103321", type: "Undergraduate", gender: "Male", loanAmount: "₹14,80,000", date: "30/09/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Dehradun", state: "Uttarakhand", country: "India" },
            { id: 24, name: "Shreya Iyer", uniqueId: "SIYER987123", email: "shreya.iyer@gmail.com", mobile: "4321092210", type: "Post Graduate", gender: "Female", loanAmount: "₹19,90,000", date: "07/10/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Shimla", state: "Himachal Pradesh", country: "India" },
            { id: 25, name: "Karan Oberoi", uniqueId: "KOBER123654", email: "karan.oberoi@gmail.com", mobile: "9876541109", type: "Diploma", gender: "Male", loanAmount: "₹8,30,000", date: "19/12/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Amritsar", state: "Punjab", country: "India" },
            { id: 26, name: "Pooja Bhatt", uniqueId: "PBHAT456987", email: "pooja.bhatt@gmail.com", mobile: "8765430098", type: "Doctorate", gender: "Female", loanAmount: "₹22,80,000", date: "11/09/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Ludhiana", state: "Punjab", country: "India" },
            { id: 27, name: "Amitabh Saxena", uniqueId: "ASAXE789321", email: "amitabh.saxena@gmail.com", mobile: "7654329987", type: "Undergraduate", gender: "Male", loanAmount: "₹13,10,000", date: "23/10/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Agra", state: "Uttar Pradesh", country: "India" },
            { id: 28, name: "Divya Rana", uniqueId: "DRANA321654", email: "divya.rana@gmail.com", mobile: "6543218876", type: "Post Graduate", gender: "Female", loanAmount: "₹17,60,000", date: "04/11/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Varanasi", state: "Uttar Pradesh", country: "India" },
            { id: 29, name: "Sahil Grover", uniqueId: "SGROV654123", email: "sahil.grover@gmail.com", mobile: "5432107765", type: "Diploma", gender: "Male", loanAmount: "₹9,40,000", date: "16/08/2024", nbfc: "NBFC1", counsellor: "Counsellor1", status: "Active", city: "Srinagar", state: "Jammu & Kashmir", country: "India" },
            { id: 30, name: "Lakshmi Menon", uniqueId: "LMENO987456", email: "lakshmi.menon@gmail.com", mobile: "4321096654", type: "Doctorate", gender: "Female", loanAmount: "₹20,50,000", date: "28/09/2024", nbfc: "NBFC2", counsellor: "Counsellor2", status: "Inactive", city: "Trivandrum", state: "Kerala", country: "India" }
        ];

        // Pagination variables
        let currentPage = 1;
        let recordsPerPage = 7;
        let filteredData = manageStudentReportData;

        // Function to populate unique options for all filters
        function populateFilterOptions() {
            // Get unique countries
            const uniqueCountries = [...new Set(manageStudentReportData.map(student => student.country))];
            const countrySelects = [document.getElementById('filter-country'), document.getElementById('mobile-filter-country')];
            countrySelects.forEach(select => {
                uniqueCountries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country;
                    option.textContent = country;
                    select.appendChild(option.cloneNode(true));
                });
            });

            // Get unique states
            const uniqueStates = [...new Set(manageStudentReportData.map(student => student.state))];
            const stateSelects = [document.getElementById('filter-state'), document.getElementById('mobile-filter-state')];
            stateSelects.forEach(select => {
                uniqueStates.forEach(state => {
                    const option = document.createElement('option');
                    option.value = state;
                    option.textContent = state;
                    select.appendChild(option.cloneNode(true));
                });
            });

            // Get unique NBFCs
            const uniqueNBFCs = [...new Set(manageStudentReportData.map(student => student.nbfc))];
            const nbfcSelects = [document.getElementById('filter-nbfc'), document.getElementById('mobile-filter-nbfc')];
            nbfcSelects.forEach(select => {
                uniqueNBFCs.forEach(nbfc => {
                    const option = document.createElement('option');
                    option.value = nbfc;
                    option.textContent = nbfc;
                    select.appendChild(option.cloneNode(true));
                });
            });

            // Get unique Counsellors
            const uniqueCounsellors = [...new Set(manageStudentReportData.map(student => student.counsellor))];
            const counsellorSelects = [document.getElementById('filter-counsellor'), document.getElementById('mobile-filter-counsellor')];
            counsellorSelects.forEach(select => {
                uniqueCounsellors.forEach(counsellor => {
                    const option = document.createElement('option');
                    option.value = counsellor;
                    option.textContent = counsellor;
                    select.appendChild(option.cloneNode(true));
                });
            });

            // Get unique Statuses
            const uniqueStatuses = [...new Set(manageStudentReportData.map(student => student.status))];
            const statusSelects = [document.getElementById('filter-status'), document.getElementById('mobile-filter-status')];
            statusSelects.forEach(select => {
                uniqueStatuses.forEach(status => {
                    const option = document.createElement('option');
                    option.value = status;
                    option.textContent = status;
                    select.appendChild(option.cloneNode(true));
                });
            });

            // Get unique Cities
            const uniqueCities = [...new Set(manageStudentReportData.map(student => student.city))];
            const citySelects = [document.getElementById('filter-city'), document.getElementById('mobile-filter-city')];
            citySelects.forEach(select => {
                uniqueCities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    select.appendChild(option.cloneNode(true));
                });
            });
        }

        // Function to populate table with paginated data
        function populateManageStudentReportTable(data, page = 1) {
            const tableBody = document.getElementById('manage-student-report-table-body');
            tableBody.innerHTML = '';

            const startIndex = (page - 1) * recordsPerPage;
            const endIndex = startIndex + recordsPerPage;
            const paginatedData = data.slice(startIndex, endIndex);

            if (paginatedData.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="9" class="manage-student-report-td" style="text-align: center;">No matching records found</td>
                    </tr>
                `;
            } else {
                paginatedData.forEach((student, index) => {
                    const row = document.createElement('tr');
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
                    `;
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
        }

        // Function to filter table data based on filter criteria
        function applyFilters() {
            const nbfc = document.getElementById('filter-nbfc').value || document.getElementById('mobile-filter-nbfc').value;
            const counsellor = document.getElementById('filter-counsellor').value || document.getElementById('mobile-filter-counsellor').value;
            const status = document.getElementById('filter-status').value || document.getElementById('mobile-filter-status').value;
            const city = document.getElementById('filter-city').value || document.getElementById('mobile-filter-city').value;
            const state = document.getElementById('filter-state').value || document.getElementById('mobile-filter-state').value;
            const country = document.getElementById('filter-country').value || document.getElementById('mobile-filter-country').value;

            filteredData = manageStudentReportData.filter(student => {
                return (
                    (nbfc === '' || student.nbfc === nbfc) &&
                    (counsellor === '' || student.counsellor === counsellor) &&
                    (status === '' || student.status === status) &&
                    (city === '' || student.city === city) &&
                    (state === '' || student.state === state) &&
                    (country === '' || student.country === country)
                );
            });
            currentPage = 1;
            populateManageStudentReportTable(filteredData, currentPage);
        }

        // Function to search table data based on search query
        function searchTable(query) {
            query = query.toLowerCase().trim();
            filteredData = manageStudentReportData.filter(student => {
                return (
                    student.name.toLowerCase().includes(query) ||
                    student.uniqueId.toLowerCase().includes(query) ||
                    student.email.toLowerCase().includes(query) ||
                    student.mobile.includes(query) ||
                    student.type.toLowerCase().includes(query) ||
                    student.gender.toLowerCase().includes(query) ||
                    student.loanAmount.toLowerCase().includes(query) ||
                    student.date.includes(query) ||
                    student.nbfc.toLowerCase().includes(query) ||
                    student.counsellor.toLowerCase().includes(query) ||
                    student.status.toLowerCase().includes(query) ||
                    student.city.toLowerCase().includes(query) ||
                    student.state.toLowerCase().includes(query) ||
                    student.country.toLowerCase().includes(query)
                );
            });
            currentPage = 1;
            populateManageStudentReportTable(filteredData, currentPage);
        }

        // Function to update pagination buttons
        function updatePaginationButtons(data) {
            const prevButton = document.getElementById('prev-page');
            const nextButton = document.getElementById('next-page');
            const totalPages = Math.ceil(data.length / recordsPerPage);

            prevButton.disabled = currentPage === 1;
            nextButton.disabled = currentPage === totalPages || data.length === 0;
        }

        // Function to handle entries per page change
        function updateRecordsPerPage() {
            const select = document.getElementById('manage-student-report-entries');
            recordsPerPage = parseInt(select.value.split(' ')[0]);
            currentPage = 1;
            populateManageStudentReportTable(filteredData, currentPage);
        }

        // Function to export to Excel
        function downloadExcel() {
            const headers = ["S.No", "Student Name", "Unique ID", "Email", "Mobile No.", "Type", "Gender", "Loan Amount", "Date"];
            const tableData = filteredData.map((student, index) => [
                index + 1,
                student.name,
                student.uniqueId,
                student.email,
                student.mobile,
                student.type,
                student.gender,
                student.loanAmount,
                student.date
            ]);
            let csvContent = headers.join(',') + '\n';
            tableData.forEach(row => {
                csvContent += row.join(',') + '\n';
            });
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const date = new Date().toISOString().split('T')[0];
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.setAttribute('href', url);
            link.setAttribute('download', `student_report_${date}.csv`);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Wait for DOM content to be fully loaded
        document.addEventListener('DOMContentLoaded', () => {
            populateFilterOptions(); // Populate all filter options
            populateManageStudentReportTable(manageStudentReportData, currentPage);

            // Search functionality for desktop
            const desktopSearchInput = document.querySelector('.manage-student-report-search-input');
            if (desktopSearchInput) {
                desktopSearchInput.addEventListener('input', function(e) {
                    searchTable(e.target.value);
                });
            }

            // Search functionality for mobile
            const mobileSearchInput = document.querySelector('.mobile-search-input-student-report');
            if (mobileSearchInput) {
                mobileSearchInput.addEventListener('input', function(e) {
                    searchTable(e.target.value);
                });
            }

            // Pagination buttons
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

            // Export to Excel (Desktop and Mobile)
            const exportExcelButtons = [document.getElementById('manage-student-report-export-btn-excel'), document.getElementById('manage-student-report-export-btn-excel-mobile')];
            exportExcelButtons.forEach(button => {
                if (button) {
                    button.addEventListener('click', () => {
                        downloadExcel();
                    });
                }
            });

            // Entries per page
            const entriesSelect = document.getElementById('manage-student-report-entries');
            if (entriesSelect) {
                entriesSelect.addEventListener('change', updateRecordsPerPage);
            }

            // Filter popup functionality
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

            // Add event listeners for all filter selects
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

            // Handle window resize to hide mobile popup on desktop
            window.addEventListener('resize', () => {
                const popup = document.getElementById('mobile-filters-popup');
                if (window.innerWidth > 768 && popup.style.display === 'flex') {
                    popup.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>