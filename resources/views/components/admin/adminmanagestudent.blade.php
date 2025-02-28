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
        // Import jsPDF
        const { jsPDF } = window.jspdf;

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

        function downloadPDF(data) {
            const doc = new jsPDF('p', 'mm', 'a4');
            const pageWidth = doc.internal.pageSize.width;

            // Add REMITOUT text instead of logo
            doc.setFont("helvetica", "bold");
            doc.setFontSize(16);
            doc.setTextColor(255, 107, 0);
            doc.text("REMITOUT", 14, 15);

            // Add header text
            doc.setFont("helvetica", "normal");
            doc.setFontSize(12);
            doc.setTextColor(128, 128, 128);
            doc.text("Authority name", pageWidth - 80, 10);
            doc.text("Designation", pageWidth - 80, 15);
            doc.text("Date of data export", pageWidth - 80, 20);
            doc.text("Time of data export", pageWidth - 80, 25);

            // Add Dashboard Reports title
            doc.setFontSize(18);
            doc.setFont("helvetica", "normal");
            doc.setTextColor(255, 107, 0);
            doc.text("Dashboard Reports", 14, 45);

            // Add Month
            doc.setTextColor(0, 0, 0);
            doc.setFontSize(20);
            doc.text("November", pageWidth - 50, 45);

            doc.setDrawColor(217, 217, 217); // Set line color to #D9D9D9
            doc.setLineWidth(0.1); // Thin line
            doc.line(14, 50, pageWidth - 14, 50); // Line from left to right

            let yPos = 65;

            // Custom table function
            function createCustomTable(headers, data, startY) {
                const cellPadding = 5;
                const lineHeight = 10;
                let currentY = startY;

                // Headers
                doc.setFont("helvetica", "bold");
                doc.setFontSize(10);
                headers.forEach((header, index) => {
                    doc.text(header, 14 + (index * 35), currentY);
                });

                currentY += lineHeight;

                // Data rows
                doc.setFont("helvetica", "normal");
                data.forEach(row => {
                    row.forEach((cell, index) => {
                        doc.text(cell.toString(), 14 + (index * 35), currentY);
                    });
                    currentY += lineHeight;
                });

                return currentY;
            }

            // Get data from website table
            const tableData = [];
            const rows = document.querySelectorAll('#manage-student-report-table-body tr');
            rows.forEach(row => {
                const rowData = [];
                row.querySelectorAll('td').forEach(cell => {
                    rowData.push(cell.textContent);
                });
                tableData.push(rowData);
            });

            // Registration Section
            doc.setFontSize(14);
            doc.text("Registration", 14, yPos);
            yPos += 10;

            const registrationHeaders = ['Date', 'Name', 'Type', 'Source', 'Point of entry'];
            const registrationData = tableData.map(row => [
                row[8], // Date
                row[1], // Name
                row[5], // Type
                'Website', // Source (default)
                'Direct' // Point of entry (default)
            ]);
            yPos = createCustomTable(registrationHeaders, registrationData, yPos);
            yPos += 20;

            // Student Details Section
            doc.setFontSize(14);
            doc.text("Student Details", 14, yPos);
            yPos += 10;

            const studentHeaders = ['Name', 'Unique ID', 'Referral code', 'Gender', 'Age', 'Type', 'Destination'];
            const studentData = tableData.map(row => [
                row[1], // Name
                row[2], // Unique ID
                'N/A', // Referral code (default)
                row[6], // Gender
                'N/A', // Age (default)
                row[5], // Type
                'N/A' // Destination (default)
            ]);
            yPos = createCustomTable(studentHeaders, studentData, yPos);

            // Add new page for remaining sections
            doc.addPage();
            yPos = 20;

            // Cities Section
            doc.setFontSize(14);
            doc.text("Cities", 14, yPos);
            yPos += 10;

            const citiesHeaders = ['City', 'State', 'Female', 'Male', 'Other', 'No. students'];
            // Group by gender and count
            const genderCounts = {
                'Male': tableData.filter(row => row[6] === 'Male').length,
                'Female': tableData.filter(row => row[6] === 'Female').length,
                'Other': tableData.filter(row => !['Male', 'Female'].includes(row[6])).length
            };

            const citiesData = [[
                'Current City', // City
                'Current State', // State
                genderCounts.Female.toString(), // Female count
                genderCounts.Male.toString(), // Male count
                genderCounts.Other.toString(), // Other count
                tableData.length.toString() // Total students
            ]];
            yPos = createCustomTable(citiesHeaders, citiesData, yPos);
            yPos += 20;

            // Destination Countries Section
            doc.setFontSize(14);
            doc.text("Destination Countries", 14, yPos);
            yPos += 10;

            const countriesHeaders = ['Country', 'Continent', 'Female', 'Male', 'Other', 'No. students'];
            const countriesData = [[
                'All Countries', // Country
                'All Continents', // Continent
                genderCounts.Female.toString(), // Female count
                genderCounts.Male.toString(), // Male count
                genderCounts.Other.toString(), // Other count
                tableData.length.toString() // Total students
            ]];
            yPos = createCustomTable(countriesHeaders, countriesData, yPos);
            yPos += 20;

            // NBFCs Section
            doc.setFontSize(14);
            doc.text("NBFCs", 14, yPos);
            yPos += 10;

            const nbfcHeaders = ['NBFC Name', 'Student Name', 'Unique ID', 'Type', 'Proposal status', 'Start Date', 'Time taken'];
            const nbfcData = tableData.map(row => [
                'Current NBFC', // NBFC Name
                row[1], // Student Name
                row[2], // Unique ID
                row[5], // Type
                'In Progress', // Proposal status (default)
                row[8], // Date
                'Ongoing' // Time taken (default)
            ]);
            yPos = createCustomTable(nbfcHeaders, nbfcData, yPos);

            // Add new page for Student Counsellors
            doc.addPage();
            yPos = 20;

            doc.setFontSize(14);
            doc.text("Student Counsellors", 14, yPos);
            yPos += 10;

            const counsellorHeaders = ['Referral code', 'Student Name', 'Unique ID', 'Type', 'Proxy Application', 'Date'];
            const counsellorData = tableData.map(row => [
                'REF-' + row[2].substring(0, 5), // Generated referral code
                row[1], // Student Name
                row[2], // Unique ID
                row[5], // Type
                'No', // Proxy Application (default)
                row[8] // Date
            ]);
            yPos = createCustomTable(counsellorHeaders, counsellorData, yPos);

            // Add footer text on each page
            const pageCount = doc.internal.getNumberOfPages();
            for (let i = 1; i <= pageCount; i++) {
                doc.setPage(i);
                doc.setFont("helvetica", "bold");
                doc.setFontSize(12);
                doc.setTextColor(255, 107, 0);
                doc.text("REMITOUT", 14, doc.internal.pageSize.height - 10);
            }

            // Save the PDF
            const date = new Date().toISOString().split('T')[0];
            doc.save(`dashboard_report_${date}.pdf`);
        }

        // Initial table population
        populateManageStudentReportTable();

        // Add event listener for search
        document.querySelector('.manage-student-report-search-input').addEventListener('input', (e) => {
            // Add search functionality here
            console.log('Searching for:', e.target.value);
        });

        // Add event listeners for both export buttons
        document.getElementById('manage-student-report-export-btn-excel').addEventListener('click', () => {
            downloadExcel();
        });

        document.getElementById('manage-student-report-export-btn-pdf').addEventListener('click', () => {
            downloadPDF(manageStudentReportData);
        });
    </script>

    </body>
    </html>