<!DOCTYPE html>
<html>

<head>
    <title>User Profile Report</title>
    <!-- Preload Poppins Font -->
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <style>
        body {
            font-family: Poppins;

        }

        h1 {
            color: rgba(93, 92, 92, 1);
            font-weight: 500;
            font-size: 1rem;
        }

        table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        td {
            color: rgba(93, 92, 92, 1);
        }

        th {
            background-color: transparent;
            color: rgba(93, 92, 92, 1);
            font-family: Poppins;
            font-weight: 500;

        }

        .header-export {
            display: flex;
            height: 45px;
            max-width: 100%;
            width: 100%;
            justify-content: space-between;
            align-items: center;

        }

        .rightside-header {
            display: flex;
            gap: 1rem;

        }

        .rightside-header p {
            font-family: Poppins;
            font-weight: 500;
            font-size: 12px;
            line-height: 18.36px;
            letter-spacing: 0%;
            color: rgba(93, 92, 92, 1);

        }

        .authordiv,
        .designation {
            display: flex;
            flex-direction: column;


        }

        .secondheader-export {
            display: flex;
            max-width: 100%;
            width: 100%;
            justify-content: space-between;

        }

        .secondheader-export h2 {
            font-family: Poppins;
            font-weight: 500;
            font-size: 24px;
            color: rgba(233, 134, 53, 1);

        }

        .header-group {
            max-width: 100%;
            width: 100%;
            padding: 0 5px;
            display: flex;
            flex-direction: column;
            gap: 26px;
            padding: 12px 0;
            margin-top: 1rem;
            border-bottom: 1px solid rgba(217, 217, 217, 1);

        }

        .registrationexport-section h1 {
            font-family: Poppins;
            font-weight: 500;
            font-size: 16px;
            line-height: 18.36px;
            color: rgba(93, 92, 92, 1);

        }

        .export-results {
            display: flex;
            flex-direction: column;
            gap: 55px;

        }

        .footer-group {
            display: flex;
            padding-top: 1rem;
            border-top: 1px solid rgba(217, 217, 217, 1);
            justify-content: flex-start;
        }

        /* .rightside-header  */
    </style>
</head>

<body>
    <div class="export-container">
        <div class="header-group">
            <div class="header-export">
                <img src="{{ asset('assets/images/Icons/remitoutlogo.png') }}" alt="">

                <div class="rightside-header">
                    <div class="authordiv">
                        <p><strong>Authority name</strong></p>
                        <p><strong>Designation:</strong></p>

                    </div>
                    <div class="designation">
                        <p><strong>Date of export:</strong> {{ $exportDate }}</p>

                        <p><strong>Time of export:</strong> {{ $exportTime }}</p>

                    </div>
                </div>


            </div>
            <div class="secondheader-export">
                <h2>
                    Dashboard Reports

                </h2>
                <h2>
                    {{$exportMonth}}
                </h2>
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
                                <td>{{ $record['name'] }}</td>
                                <td>{{ $record['created_at'] ?? 'N/A' }}</td>
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
            <img src="{{ asset('assets/images/Icons/remitoutlogo.png') }}" alt="">


        </div>

    </div>





</body>

</html>