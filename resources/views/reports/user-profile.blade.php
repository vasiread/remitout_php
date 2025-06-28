<!DOCTYPE html>
<html>

<head>
    <title>User Profile Report</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1, h2, h3, h4, h5 {
            color: #2d2d2d;
            font-weight: 600;
            margin-bottom: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
            color: #333;
            font-weight: 600;
        }

        .header-export {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 45px;
        }

        .secondheader-export {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .secondheader-export h2 {
            font-size: 24px;
            color: rgba(233, 134, 53, 1);
            font-weight: 600;
        }

        .header-group {
            border-bottom: 1px solid rgba(217, 217, 217, 1);
            padding-bottom: 12px;
        }

        .registrationexport-section h1 {
            font-size: 16px;
            font-weight: 600;
            margin-top: 40px;
        }

        .export-results {
            display: flex;
            flex-direction: column;
        }

        .footer-group {
            display: flex;
            padding-top: 2rem;
            border-top: 1px solid rgba(217, 217, 217, 1);
            justify-content: flex-start;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="export-container">
        <div class="header-group">
            <div class="header-export">
                <img src="{{ public_path('assets/images/Icons/remitoutlogo.png') }}" alt="Logo" height="40">
            </div>
            <div class="secondheader-export">
                <h2>Dashboard Reports</h2>
                <h2>{{ $exportMonth }}</h2>
            </div>
        </div>

        <div class="export-results">
            <div class="registrationexport-section">
                <h1>Download Progress</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Linked Through</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($downloadProgressReport as $record)
                            <tr>
                                <td>{{ $record['created_at'] ?? 'N/A' }}</td>
                                <td>{{ $record['name'] }}</td>
                                <td>{{ $record['type'] ?? 'N/A' }}</td>
                                <td>{{ $record['linked_through'] ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="registrationexport-section">
                <h1>Registration</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Unique ID</th>
                            <th>Referral Code</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Degree Type</th>
                            <th>Destination</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userProfileReport as $user)
                            <tr>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['unique_id'] }}</td>
                                <td>{{ $user['referral_code'] }}</td>
                                <td>{{ $user['gender'] ?? 'N/A' }}</td>
                                <td>{{ $user['age'] ?? 'N/A' }}</td>
                                <td>{{ $user['degree_type'] ?? 'N/A' }}</td>
                                <td>{{ $user['plan_to_study'] ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="registrationexport-section">
                <h1>City Stats</h1>
                <table>
                    <thead>
                        <tr>
                            <th>City</th>
                            <th>State</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>Others</th>
                            <th>Total Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cityStats as $city)
                            <tr>
                                <td>{{ $city->city }}</td>
                                <td>{{ $city->state }}</td>
                                <td>{{ $city->male }}</td>
                                <td>{{ $city->female }}</td>
                                <td>{{ $city->others }}</td>
                                <td>{{ $city->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="registrationexport-section">
                <h1>Destination Countries</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Country</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>Others</th>
                            <th>Total Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($destinationCountries as $country)
                            <tr>
                                <td>{{ $country['country'] }}</td>
                                <td>{{ $country['male'] }}</td>
                                <td>{{ $country['female'] }}</td>
                                <td>{{ $country['others'] }}</td>
                                <td>{{ $country['total_students'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="registrationexport-section">
                <h1>Referrals Report</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Referrer Name</th>
                            <th>Referral Code</th>
                            <th>Student Name</th>
                            <th>Student Unique ID</th>
                            <th>Degree Type</th>
                            <th>Date of Registration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($referralsReport as $entry)
                            <tr>
                                <td>{{ $entry['referrer_name'] }}</td>
                                <td>{{ $entry['referrer_code'] }}</td>
                                <td>{{ $entry['student_name'] }}</td>
                                <td>{{ $entry['student_id'] }}</td>
                                <td>{{ $entry['degree_type'] }}</td>
                                <td>{{ $entry['created_at'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="footer-group">
            <img src="{{ public_path('assets/images/Icons/remitoutlogo.png') }}" alt="Footer Logo" height="30">
        </div>
    </div>
</body>

</html>
