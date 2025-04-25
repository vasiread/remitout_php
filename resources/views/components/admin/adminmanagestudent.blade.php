<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Include FileSaver.js for cross-browser file download support -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <style>
        /* Minimal CSS for horizontal scrolling */
        .manage-student-report-table-wrapper {
            overflow-x: auto; /* Enable horizontal scrolling */
        }

        .manage-student-report-table {
            min-width: 2000px; /* Ensure the table is wide enough to trigger scrolling */
        }

        /* Style for table headers to wrap two-word names and align properly */
        .manage-student-report-th {
            white-space: normal; /* Allow text to wrap */
            width: 120px; /* Fixed width for uniformity */
            text-align: center; /* Center-align text */
            padding: 8px; /* Consistent padding */
        }

        /* Basic styling for table data cells */
        .manage-student-report-td {
            text-align: center;
            padding: 8px;
        }

        /* Ensure mobile filter popup is hidden by default */
        .mobile-filters-popup-student-report {
            display: none;
        }
    </style>
</head>
<body>
    <div class="manage-student-main-report-container" id="manage-student-main-admin-report-container-id">
        <div class="manage-student-main-admin-report-container">
            <div class="manage-student-report-header">
                <h1 class="manage-student-report-title">Manage Students Reports</h1>
                <button class="manage-student-report-export-btn" id="manage-student-report-export-btn-excel">Export to Excel</button>
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
                                <input type="text" class="manage-student-report-input manage-student-report-search-input" placeholder="Search">
                                <img src="assets/images/search.png" class="manage-student-report-search-icon" alt="search">
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
                    <button class="mobile-export-btn-student-report" id="manage-student-report-export-btn-excel-mobile">Export to Excel</button>
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
                                <th class="manage-student-report-th" id="th-counsellor-name">Student Counsellor Name</th>
                                <th class="manage-student-report-th" id="th-state">State</th>
                                <th class="manage-student-report-th" id="th-city">City</th>
                                <th class="manage-student-report-th" id="th-destination-country">Destination Country</th>
                                <th class="manage-student-report-th" id="th-nbfc">NBFC</th>
                                <th class="manage-student-report-th" id="th-no-proposals">No. of Proposals</th>
                                <th class="manage-student-report-th" id="th-status">Status</th>
                                <th class="manage-student-report-th" id="th-point-entry">Point of Entry</th>
                            </tr>
                        </thead>
                        <tbody id="manage-student-report-table-body">
                        </tbody>
                    </table>
                </div>
                <div class="manage-student-report-pagination">
                    <div class="manage-student-report-pagination-wrapper">
                        <button class="manage-student-report-pagination-btn" id="prev-page"><</button>
                        <span class="manage-student-report-pagination-text" id="pagination-text">1-6 / 30</span>
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
        // Complete sample data with 30 records
        const manageStudentReportData = [
            { id: 1, name: "Aarav Mehta", uniqueId: "AMXJH245879", email: "aarav.mehta@gmail.com", mobile: "9876543210", type: "Undergraduate", gender: "Male", loanAmount: "₹12,50,000", date: "15/10/2024", nbfc: "HSBC", counsellor: "Rakesh Sharma", status: "Complete Application", city: "Mumbai", state: "Maharashtra", country: "Australia", dateOfRegistration: "20/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857979", noOfProposals: 2, pointOfEntry: "LinkedIn" },
            { id: 2, name: "Sanya Kapoor", uniqueId: "SKLPO298745", email: "sanya.kapoor@gmail.com", mobile: "8765432109", type: "Post Graduate", gender: "Female", loanAmount: "₹18,75,000", date: "22/09/2024", nbfc: "Deutsche Bank", counsellor: "Rakesh Sharma", status: "Incomplete Application", city: "Delhi", state: "Delhi", country: "Germany", dateOfRegistration: "20/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857979", noOfProposals: 2, pointOfEntry: "LinkedIn" },
            { id: 3, name: "Rohan Sharma", uniqueId: "RSHAR452189", email: "rohan.sharma@gmail.com", mobile: "7654321098", type: "Diploma", gender: "Male", loanAmount: "₹8,90,000", date: "10/11/2024", nbfc: "Mitsubishi UFJ", counsellor: "Rakesh Sharma", status: "Offer accepted & Closed", city: "Bangalore", state: "Karnataka", country: "Japan", dateOfRegistration: "20/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857979", noOfProposals: 2, pointOfEntry: "LinkedIn" },
            { id: 4, name: "Priya Verma", uniqueId: "PVKOH789654", email: "priya.verma@gmail.com", mobile: "6543210987", type: "Doctorate", gender: "Female", loanAmount: "₹22,00,000", date: "05/12/2024", nbfc: "Lloyds Bank", counsellor: "Rakesh Sharma", status: "Pending with Queries", city: "Chennai", state: "Tamil Nadu", country: "UK", dateOfRegistration: "20/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857979", noOfProposals: 2, pointOfEntry: "LinkedIn" },
            { id: 5, name: "Kabir Malhotra", uniqueId: "KMLHT987456", email: "kabir.malhotra@gmail.com", mobile: "5432109876", type: "Undergraduate", gender: "Male", loanAmount: "₹14,30,000", date: "18/08/2024", nbfc: "Bank of Canada", counsellor: "Rakesh Sharma", status: "Offer issued to student", city: "Hyderabad", state: "Telangana", country: "Canada", dateOfRegistration: "20/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857979", noOfProposals: 2, pointOfEntry: "LinkedIn" },
            { id: 6, name: "Simran Kaur", uniqueId: "SKJYT659874", email: "simran.kaur@gmail.com", mobile: "4321098765", type: "Post Graduate", gender: "Female", loanAmount: "₹20,00,000", date: "30/09/2024", nbfc: "HSBC", counsellor: "Rakesh Sharma", status: "Offer rejected to student", city: "Pune", state: "Maharashtra", country: "Australia", dateOfRegistration: "20/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857979", noOfProposals: 2, pointOfEntry: "LinkedIn" },
            { id: 7, name: "Vikram Singh", uniqueId: "VSING123456", email: "vikram.singh@gmail.com", mobile: "9876541234", type: "Undergraduate", gender: "Male", loanAmount: "₹10,00,000", date: "12/07/2024", nbfc: "Deutsche Bank", counsellor: "Rakesh Sharma", status: "Complete Application", city: "Jaipur", state: "Rajasthan", country: "Germany", dateOfRegistration: "20/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857979", noOfProposals: 2, pointOfEntry: "LinkedIn" },
            { id: 8, name: "Ananya Gupta", uniqueId: "AGUPT789123", email: "ananya.gupta@gmail.com", mobile: "8765439876", type: "Post Graduate", gender: "Female", loanAmount: "₹15,50,000", date: "25/08/2024", nbfc: "Mitsubishi UFJ", counsellor: "Rakesh Sharma", status: "Incomplete Application", city: "Kolkata", state: "West Bengal", country: "Japan", dateOfRegistration: "21/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857980", noOfProposals: 1, pointOfEntry: "Website" },
            { id: 9, name: "Arjun Patel", uniqueId: "APATE456789", email: "arjun.patel@gmail.com", mobile: "7654328765", type: "Diploma", gender: "Male", loanAmount: "₹9,20,000", date: "03/10/2024", nbfc: "Lloyds Bank", counsellor: "Rakesh Sharma", status: "Offer accepted & Closed", city: "Ahmedabad", state: "Gujarat", country: "UK", dateOfRegistration: "21/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857980", noOfProposals: 1, pointOfEntry: "Website" },
            { id: 10, name: "Neha Sharma", uniqueId: "NSHAR321654", email: "neha.sharma@gmail.com", mobile: "6543217654", type: "Doctorate", gender: "Female", loanAmount: "₹25,00,000", date: "15/11/2024", nbfc: "Bank of Canada", counsellor: "Rakesh Sharma", status: "Pending with Queries", city: "Surat", state: "Gujarat", country: "Canada", dateOfRegistration: "21/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857980", noOfProposals: 1, pointOfEntry: "Website" },
            { id: 11, name: "Rahul Jain", uniqueId: "RJAIN987321", email: "rahul.jain@gmail.com", mobile: "5432106543", type: "Undergraduate", gender: "Male", loanAmount: "₹13,75,000", date: "20/06/2024", nbfc: "HSBC", counsellor: "Rakesh Sharma", status: "Offer issued to student", city: "Lucknow", state: "Uttar Pradesh", country: "Australia", dateOfRegistration: "21/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857980", noOfProposals: 1, pointOfEntry: "Website" },
            { id: 12, name: "Kriti Agarwal", uniqueId: "KAGAR654987", email: "kriti.agarwal@gmail.com", mobile: "4321095432", type: "Post Graduate", gender: "Female", loanAmount: "₹19,25,000", date: "08/09/2024", nbfc: "Deutsche Bank", counsellor: "Rakesh Sharma", status: "Offer rejected to student", city: "Kanpur", state: "Uttar Pradesh", country: "Germany", dateOfRegistration: "21/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857980", noOfProposals: 1, pointOfEntry: "Website" },
            { id: 13, name: "Aditya Roy", uniqueId: "AROYX123789", email: "aditya.roy@gmail.com", mobile: "9876544321", type: "Diploma", gender: "Male", loanAmount: "₹7,80,000", date: "17/10/2024", nbfc: "Mitsubishi UFJ", counsellor: "Rakesh Sharma", status: "Complete Application", city: "Nagpur", state: "Maharashtra", country: "Japan", dateOfRegistration: "21/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857980", noOfProposals: 1, pointOfEntry: "Website" },
            { id: 14, name: "Sneha Reddy", uniqueId: "SREDD456123", email: "sneha.reddy@gmail.com", mobile: "8765433210", type: "Doctorate", gender: "Female", loanAmount: "₹23,50,000", date: "29/11/2024", nbfc: "Lloyds Bank", counsellor: "Rakesh Sharma", status: "Incomplete Application", city: "Visakhapatnam", state: "Andhra Pradesh", country: "UK", dateOfRegistration: "22/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857981", noOfProposals: 3, pointOfEntry: "Email" },
            { id: 15, name: "Ishaan Khanna", uniqueId: "IKHAN789456", email: "ishaan.khanna@gmail.com", mobile: "7654322109", type: "Undergraduate", gender: "Male", loanAmount: "₹11,90,000", date: "14/08/2024", nbfc: "Bank of Canada", counsellor: "Rakesh Sharma", status: "Offer accepted & Closed", city: "Bhopal", state: "Madhya Pradesh", country: "Canada", dateOfRegistration: "22/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857981", noOfProposals: 3, pointOfEntry: "Email" },
            { id: 16, name: "Meera Nair", uniqueId: "MNAIR321789", email: "meera.nair@gmail.com", mobile: "6543211098", type: "Post Graduate", gender: "Female", loanAmount: "₹17,00,000", date: "02/10/2024", nbfc: "HSBC", counsellor: "Rakesh Sharma", status: "Pending with Queries", city: "Patna", state: "Bihar", country: "Australia", dateOfRegistration: "22/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857981", noOfProposals: 3, pointOfEntry: "Email" },
            { id: 17, name: "Yash Chopra", uniqueId: "YCHOP654123", email: "yash.chopra@gmail.com", mobile: "5432109987", type: "Diploma", gender: "Male", loanAmount: "₹8,50,000", date: "22/07/2024", nbfc: "Deutsche Bank", counsellor: "Rakesh Sharma", status: "Offer issued to student", city: "Indore", state: "Madhya Pradesh", country: "Germany", dateOfRegistration: "22/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857981", noOfProposals: 3, pointOfEntry: "Email" },
            { id: 18, name: "Tara Bose", uniqueId: "TBOSE987654", email: "tara.bose@gmail.com", mobile: "4321098876", type: "Doctorate", gender: "Female", loanAmount: "₹21,75,000", date: "10/12/2024", nbfc: "Mitsubishi UFJ", counsellor: "Rakesh Sharma", status: "Offer rejected to student", city: "Thiruvananthapuram", state: "Kerala", country: "Japan", dateOfRegistration: "22/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857981", noOfProposals: 3, pointOfEntry: "Email" },
            { id: 19, name: "Siddharth Menon", uniqueId: "SMENO123987", email: "siddharth.menon@gmail.com", mobile: "9876547765", type: "Undergraduate", gender: "Male", loanAmount: "₹12,20,000", date: "05/09/2024", nbfc: "Lloyds Bank", counsellor: "Rakesh Sharma", status: "Complete Application", city: "Coimbatore", state: "Tamil Nadu", country: "UK", dateOfRegistration: "22/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857981", noOfProposals: 3, pointOfEntry: "Email" },
            { id: 20, name: "Riya Das", uniqueId: "RDASX456321", email: "riya.das@gmail.com", mobile: "8765436654", type: "Post Graduate", gender: "Female", loanAmount: "₹18,00,000", date: "18/10/2024", nbfc: "Bank of Canada", counsellor: "Rakesh Sharma", status: "Incomplete Application", city: "Bhubaneswar", state: "Odisha", country: "Canada", dateOfRegistration: "23/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857982", noOfProposals: 2, pointOfEntry: "Phone" },
            { id: 21, name: "Nikhil Vargese", uniqueId: "NVARG789123", email: "nikhil.vargese@gmail.com", mobile: "7654325543", type: "Diploma", gender: "Male", loanAmount: "₹9,70,000", date: "27/11/2024", nbfc: "HSBC", counsellor: "Rakesh Sharma", status: "Offer accepted & Closed", city: "Guwahati", state: "Assam", country: "Australia", dateOfRegistration: "23/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857982", noOfProposals: 2, pointOfEntry: "Phone" },
            { id: 22, name: "Anjali Pillai", uniqueId: "APILL321456", email: "anjali.pillai@gmail.com", mobile: "6543214432", type: "Doctorate", gender: "Female", loanAmount: "₹24,25,000", date: "13/08/2024", nbfc: "Deutsche Bank", counsellor: "Rakesh Sharma", status: "Pending with Queries", city: "Ranchi", state: "Jharkhand", country: "Germany", dateOfRegistration: "23/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857982", noOfProposals: 2, pointOfEntry: "Phone" },
            { id: 23, name: "Devansh Thakur", uniqueId: "DTHAK654789", email: "devansh.thakur@gmail.com", mobile: "5432103321", type: "Undergraduate", gender: "Male", loanAmount: "₹14,80,000", date: "30/09/2024", nbfc: "Mitsubishi UFJ", counsellor: "Rakesh Sharma", status: "Offer issued to student", city: "Dehradun", state: "Uttarakhand", country: "Japan", dateOfRegistration: "23/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857982", noOfProposals: 2, pointOfEntry: "Phone" },
            { id: 24, name: "Shreya Iyer", uniqueId: "SIYER987123", email: "shreya.iyer@gmail.com", mobile: "4321092210", type: "Post Graduate", gender: "Female", loanAmount: "₹19,90,000", date: "07/10/2024", nbfc: "Lloyds Bank", counsellor: "Rakesh Sharma", status: "Offer rejected to student", city: "Shimla", state: "Himachal Pradesh", country: "UK", dateOfRegistration: "23/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857982", noOfProposals: 2, pointOfEntry: "Phone" },
            { id: 25, name: "Karan Oberoi", uniqueId: "KOBER123654", email: "karan.oberoi@gmail.com", mobile: "9876541109", type: "Diploma", gender: "Male", loanAmount: "₹8,30,000", date: "19/12/2024", nbfc: "Bank of Canada", counsellor: "Rakesh Sharma", status: "Complete Application", city: "Amritsar", state: "Punjab", country: "Canada", dateOfRegistration: "23/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857982", noOfProposals: 2, pointOfEntry: "Phone" },
            { id: 26, name: "Pooja Bhatt", uniqueId: "PBHAT456987", email: "pooja.bhatt@gmail.com", mobile: "8765430098", type: "Doctorate", gender: "Female", loanAmount: "₹22,80,000", date: "11/09/2024", nbfc: "HSBC", counsellor: "Rakesh Sharma", status: "Incomplete Application", city: "Ludhiana", state: "Punjab", country: "Australia", dateOfRegistration: "24/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857983", noOfProposals: 1, pointOfEntry: "Social Media" },
            { id: 27, name: "Amitabh Saxena", uniqueId: "ASAXE789321", email: "amitabh.saxena@gmail.com", mobile: "7654329987", type: "Undergraduate", gender: "Male", loanAmount: "₹13,10,000", date: "23/10/2024", nbfc: "Deutsche Bank", counsellor: "Rakesh Sharma", status: "Offer accepted & Closed", city: "Agra", state: "Uttar Pradesh", country: "Germany", dateOfRegistration: "24/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857983", noOfProposals: 1, pointOfEntry: "Social Media" },
            { id: 28, name: "Divya Rana", uniqueId: "DRANA321654", email: "divya.rana@gmail.com", mobile: "6543218876", type: "Post Graduate", gender: "Female", loanAmount: "₹17,60,000", date: "04/11/2024", nbfc: "Mitsubishi UFJ", counsellor: "Rakesh Sharma", status: "Pending with Queries", city: "Varanasi", state: "Uttar Pradesh", country: "Japan", dateOfRegistration: "24/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857983", noOfProposals: 1, pointOfEntry: "Social Media" },
            { id: 29, name: "Sahil Grover", uniqueId: "SGROV654123", email: "sahil.grover@gmail.com", mobile: "5432107765", type: "Diploma", gender: "Male", loanAmount: "₹9,40,000", date: "16/08/2024", nbfc: "Lloyds Bank", counsellor: "Rakesh Sharma", status: "Offer issued to student", city: "Srinagar", state: "Jammu & Kashmir", country: "UK", dateOfRegistration: "24/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857983", noOfProposals: 1, pointOfEntry: "Social Media" },
            { id: 30, name: "Lakshmi Menon", uniqueId: "LMENO987456", email: "lakshmi.menon@gmail.com", mobile: "4321096654", type: "Doctorate", gender: "Female", loanAmount: "₹20,50,000", date: "28/09/2024", nbfc: "Bank of Canada", counsellor: "Rakesh Sharma", status: "Offer rejected to student", city: "Trivandrum", state: "Kerala", country: "Canada", dateOfRegistration: "24/11/2024", sourceOfReferral: "SC Referral", referralNo: "7346857983", noOfProposals: 1, pointOfEntry: "Social Media" }
        ];

        // Pagination variables
        let currentPage = 1;
        let recordsPerPage = 6;
        let filteredData = manageStudentReportData;

        // Utility function to convert DD/MM/YYYY to YYYY-MM-DD for comparison
        function convertDateFormat(dateStr) {
            if (!dateStr) return null;
            const [day, month, year] = dateStr.split('/');
            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`; // Convert to YYYY-MM-DD
        }

        // Function to populate unique options for all filters
        function populateFilterOptions() {
            try {
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
            } catch (error) {
                console.error('Error populating filter options:', error);
            }
        }

        // Function to populate table with paginated data
        function populateManageStudentReportTable(data, page = 1) {
            try {
                console.log('Populating table with data:', data.length, 'records, page:', page);
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
                                statusButtonStyle = 'style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; padding: 5px 10px; border-radius: 5px; white-space: nowrap;"';
                                break;
                            case 'Offer rejected to student':
                                statusButtonStyle = 'style="background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; padding: 5px 10px; border-radius: 5px; white-space: nowrap;"';
                                break;
                            default:
                                statusButtonStyle = 'style="background-color: #e9ecef; color: #383d41; border-color: #dee2e6; padding: 5px 10px; border-radius: 5px; white-space: nowrap;"';
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
                            <td class="manage-student-report-td">${student.country}</td>
                            <td class="manage-student-report-td">${student.nbfc}</td>
                            <td class="manage-student-report-td">${student.noOfProposals}</td>
                            <td class="manage-student-report-td"><button ${statusButtonStyle} disabled>${student.status}</button></td>
                            <td class="manage-student-report-td">${student.pointOfEntry}</td>
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

                filteredData = manageStudentReportData.filter(student => {
                    const studentDate = convertDateFormat(student.date);
                    const filterDate = date ? date : null;

                    return (
                        (nbfc === '' || student.nbfc === nbfc) &&
                        (counsellor === '' || student.counsellor === counsellor) &&
                        (status === '' || student.status === status) &&
                        (city === '' || student.city === city) &&
                        (state === '' || student.state === state) &&
                        (country === '' || student.country === country) &&
                        (!filterDate || studentDate === filterDate)
                    );
                });
                currentPage = 1;
                populateManageStudentReportTable(filteredData, currentPage);
            } catch (error) {
                console.error('Error applying filters:', error);
            }
        }

        // Function to search table data based on search query
        function searchTable(query) {
            try {
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

        // Wait for DOM content to be fully loaded
        document.addEventListener('DOMContentLoaded', () => {
            try {
                console.log('DOM loaded, initializing application');
                console.log('Initial data length:', manageStudentReportData.length);

                // Initialize filters and table
                populateFilterOptions();
                populateManageStudentReportTable(manageStudentReportData, currentPage);

                const desktopSearchInput = document.querySelector('.manage-student-report-search-input');
                if (desktopSearchInput) {
                    desktopSearchInput.addEventListener('input', function(e) {
                        searchTable(e.target.value);
                    });
                }

                const mobileSearchInput = document.querySelector('.mobile-search-input-student-report');
                if (mobileSearchInput) {
                    mobileSearchInput.addEventListener('input', function(e) {
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