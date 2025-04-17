<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
    <link rel="stylesheet" href="assets/css/adminmanagestudent.css">
</head>

<body>

    @extends('layouts.app')

    @php


     @endphp
     
<div class="manage-student-main-report-section" id="manage-student-main-admin-report-container-id">
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
                            <option>10 entries</option>
                            <option>25 entries</option>
                            <option>50 entries</option>
                        </select>
                    </div>
                    <div class="manage-student-report-filters-right">
                        <input type="date" class="manage-student-report-input">
                        <select class="manage-student-report-select">
                            <option>NBFC</option>
                        </select>
                        <select class="manage-student-report-select">
                            <option>Student Counsellor</option>
                        </select>
                        <select class="manage-student-report-select">
                            <option>Status</option>
                        </select>
                    </div>
                </div>
                <div class="manage-student-report-filters-row">
                    <div class="manage-student-report-filters-left">
                        <div class="manage-student-report-search-container">
                            <input type="text" class="manage-student-report-input manage-student-report-search-input"
                                placeholder="Search">
                            <img src="assets/images/search.png" class="manage-student-report-search-icon" alt="search">
                        </div>
                    </div>
                    <div class="manage-student-report-filters-right">
                        <select class="manage-student-report-select">
                            <option>City</option>
                        </select>
                        <select class="manage-student-report-select">
                            <option>State</option>
                        </select>
                        <select class="manage-student-report-select">
                            <option>Country</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Add this mobile header section just after the opening div of manage-student-report-container -->
<div class="mobile-report-header">
    <div class="mobile-report-header-top">
        <h2 class="mobile-report-title">Reports</h2>
        <div class="mobile-header-actions">
            <div class="mobile-search-container">
                <input type="text" class="mobile-search-input" placeholder="Search">
                <img src="assets/images/search.png" class="mobile-search-icon" alt="search">
            </div>
            <button class="mobile-filter-btn" id="show-mobile-filters">
                Filters <span>⌄</span>
            </button>
            <button class="mobile-calendar-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/>
                    <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
                    <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"/>
                    <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"/>
                </svg>
            </button>
        </div>
    </div>
    <button class="mobile-export-btn">Export to Excel</button>
</div>

<!-- Add this mobile filters popup at the end of your body tag -->
<div class="mobile-filters-popup" id="mobile-filters-popup">
    <div class="mobile-filters-content">
        <div class="mobile-filters-header">
            <h3 class="mobile-filters-title">Filters</h3>
            <button class="mobile-close-btn" id="close-mobile-filters">×</button>
        </div>
        <div class="mobile-filter-item">
            <select>
                <option>NBFC</option>
            </select>
        </div>
        <div class="mobile-filter-item">
            <select>
                <option>Student Counsellor</option>
            </select>
        </div>
        <div class="mobile-filter-item">
            <select>
                <option>Status</option>
            </select>
        </div>
        <div class="mobile-filter-item">
            <select>
                <option>City</option>
            </select>
        </div>
        <div class="mobile-filter-item">
            <select>
                <option>State</option>
            </select>
        </div>
        <div class="mobile-filter-item">
            <select>
                <option>Country</option>
            </select>
        </div>
    </div>
</div>

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
                    <!-- Table rows will be populated by JavaScript -->
                </tbody>
            </table>

            <div class="manage-student-report-pagination">
                <div class="manage-student-report-pagination-wrapper">
                    <button class="manage-student-report-pagination-btn">&lt;</button>
                    <span class="manage-student-report-pagination-text">1-10 / 30</span>
                    <button class="manage-student-report-pagination-btn">&gt;</button>
                </div>
            </div>
        </div>
    </div>

</div>            
          
      <script>
// Sample data
const manageStudentReportData = [
    {
        id: 1,
        name: "Aarav Mehta",
        uniqueId: "AMXJH245879",
        email: "aarav.mehta@gmail.com",
        mobile: "9876543210",
        type: "Undergraduate",
        gender: "Male",
        loanAmount: "₹12,50,000",
        date: "15/10/2024"
    },
    {
        id: 2,
        name: "Sanya Kapoor",
        uniqueId: "SKLPO298745",
        email: "sanya.kapoor@gmail.com",
        mobile: "8765432109",
        type: "Post Graduate",
        gender: "Female",
        loanAmount: "₹18,75,000",
        date: "22/09/2024"
    },
    {
        id: 3,
        name: "Rohan Sharma",
        uniqueId: "RSHAR452189",
        email: "rohan.sharma@gmail.com",
        mobile: "7654321098",
        type: "Diploma",
        gender: "Male",
        loanAmount: "₹8,90,000",
        date: "10/11/2024"
    },
    {
        id: 4,
        name: "Priya Verma",
        uniqueId: "PVKOH789654",
        email: "priya.verma@gmail.com",
        mobile: "6543210987",
        type: "Doctorate",
        gender: "Female",
        loanAmount: "₹22,00,000",
        date: "05/12/2024"
    },
    {
        id: 5,
        name: "Kabir Malhotra",
        uniqueId: "KMLHT987456",
        email: "kabir.malhotra@gmail.com",
        mobile: "5432109876",
        type: "Undergraduate",
        gender: "Male",
        loanAmount: "₹14,30,000",
        date: "18/08/2024"
    },
    {
        id: 6,
        name: "Simran Kaur",
        uniqueId: "SKJYT659874",
        email: "simran.kaur@gmail.com",
        mobile: "4321098765",
        type: "Post Graduate",
        gender: "Female",
        loanAmount: "₹20,00,000",
        date: "30/09/2024"
    }
];

// Function to populate table
function populateManageStudentReportTable() {
    const tableBody = document.getElementById('manage-student-report-table-body');
    tableBody.innerHTML = '';

    manageStudentReportData.forEach((student, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="manage-student-report-td">${index + 1}</td>
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

// Function to filter table data based on search query
function searchTable(query) {
    query = query.toLowerCase().trim();

    // Filter data based on search query
    const filteredData = manageStudentReportData.filter(student => {
        // Search across multiple fields
        return (
            student.name.toLowerCase().includes(query) ||
            student.uniqueId.toLowerCase().includes(query) ||
            student.email.toLowerCase().includes(query) ||
            student.mobile.includes(query) ||
            student.type.toLowerCase().includes(query) ||
            student.gender.toLowerCase().includes(query) ||
            student.loanAmount.toLowerCase().includes(query) ||
            student.date.includes(query)
        );
    });

    // Repopulate table with filtered data
    const tableBody = document.getElementById('manage-student-report-table-body');
    tableBody.innerHTML = '';

    if (filteredData.length === 0) {
        // Display "No results found" message
        const noResultsRow = document.createElement('tr');
        noResultsRow.innerHTML = `
            <td colspan="9" class="manage-student-report-td" style="text-align: center;">No matching records found</td>
        `;
        tableBody.appendChild(noResultsRow);
    } else {
        // Populate with filtered results
        filteredData.forEach((student, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="manage-student-report-td">${index + 1}</td>
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

    // Update pagination text
    const paginationText = document.querySelector('.manage-student-report-pagination-text');
    if (paginationText) {
        if (filteredData.length === 0) {
            paginationText.textContent = '0 / 0';
        } else {
            paginationText.textContent = `1-${Math.min(filteredData.length, 10)} / ${filteredData.length}`;
        }
    }
}

// Function to export to Excel
function downloadExcel() {
    // Get table headers
    const headers = [];
    document.querySelectorAll('.manage-student-report-table thead th').forEach(th => {
        headers.push(th.textContent);
    });

    // Get table data
    const tableData = [];
    const rows = document.querySelectorAll('#manage-student-report-table-body tr');
    rows.forEach(row => {
        const rowData = [];
        row.querySelectorAll('td').forEach(cell => {
            rowData.push(cell.textContent);
        });
        tableData.push(rowData);
    });

    // Create CSV content
    let csvContent = headers.join(',') + '\n';
    tableData.forEach(row => {
        csvContent += row.join(',') + '\n';
    });

    // Create a Blob and download
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const date = new Date().toISOString().split('T')[0];
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.setAttribute('href', url);
    link.setAttribute('download', `student_report_${date}.csv`);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Wait for DOM content to be fully loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize table
    populateManageStudentReportTable();
    
    // Set up search functionality
    const searchInput = document.querySelector('.manage-student-report-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            searchTable(e.target.value);
        });
    } else {
        console.error('Search input element not found');
    }
    
    // Set up clear search button
    const clearSearchButton = document.querySelector('.manage-student-report-search-clear');
    if (clearSearchButton) {
        clearSearchButton.addEventListener('click', function() {
            if (searchInput) {
                searchInput.value = '';
                searchTable('');
            }
        });
    }
    
    // Set up export to Excel button
    const exportExcelButton = document.getElementById('manage-student-report-export-btn-excel');
    if (exportExcelButton) {
        exportExcelButton.addEventListener('click', () => {
            downloadExcel();
        });
    }
    
    // Remove reference to PDF export button and function
    // const exportPdfButton = document.getElementById('manage-student-report-export-btn-pdf');
    // if (exportPdfButton) {
    //     exportPdfButton.addEventListener('click', () => {
    //         downloadPDF(manageStudentReportData);
    //     });
    // }
});
    </script>

    </body>
    </html>