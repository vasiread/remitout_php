<section class="study-loans-section">
  <div class="study-loans-content">
    <!-- Left Section -->
    <div class="study-loans-left">
      <div class="study-loans-text">
        <h3>Your Smart Route to <br>Study Loans</h3>
        <p>Bespoke Loan Options from Trusted NBFCs for <br> Your International Education.</p>
      </div>
    </div>
    <!-- Right Section -->
    <div class="study-loans-image-right">
      <img src="{{ asset('assets/images/globe-1.png') }}" alt="Globe Image" class="globe-image" >
    </div>
  </div>
  <div class="flowchart-section">
    <img src="{{asset('assets/images/flowchat.png')}}" alt="Flowchart Image" class="flowchart-image">
  </div>
</section>

<div class="smart-banner-image">

 <section class="smart-lending-section">
        <div class="smart-content-wrapper">
            <!-- Left Content -->
            <div class="smart-left-content">
                <h1 class="main-heading">
                    Where your safety meets<br>
                    smart lending
                </h1>

                <div class="features-list">
                    <div class="feature-item">
                        <img src="assets/images/icon-1.png" alt="Support Icon">
                        <div class="feature-content">
                            <h4>Integrated Support, Anytime, Anywhere</h4>
                            <p>Instant support builds trust and enhances experience!</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <img src="assets/images/icon-2.png" alt="Processing Icon">
                        <div class="feature-content">
                            <h4>Rapid Processing</h4>
                            <p>Easy student remittance in just a few steps!</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <img src="assets/images/icon-3.png" alt="Price Icon">
                        <div class="feature-content">
                            <h4>Best Price Commitment</h4>
                            <p>Transparent, competitive exchange rates guaranteed!</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <img src="assets/images/iocn-4.png" alt="Protection Icon">
                        <div class="feature-content">
                            <h4>Absolutely Protected</h4>
                            <p>Instant transfers, no fees, 24/7 support!</p>
                        </div>
                    </div>
                </div>

                <button class="cta-button" id="loanButton">
                    Secure your loan now!
                </button>
            </div>

            <!-- Right Content -->
            <div class="smart-right-content">
                <div class="loading-container">
                    <img src="assets/images/Circle.png" alt="Loading animation" class="loading-dots">
                </div>
                <div class="radcliffe-brand">
                    <img src="assets/images/over-icon.png" alt="Radcliffe Camera icon">
                </div>
                <div class="radcliffe-image">
                    <img src="assets/images/image-1.png" alt="Radcliffe Camera">
                </div>
                <div class="students-image">
                    <img src="assets/images/image-2.png" alt="Students with Tablet">
                </div>
                <div class="graduation-image">
                    <img src="assets/images/image-3.png" alt="Graduation Celebration">
                </div>
            </div>
        </div>
</section>


<?php
// Dynamic data for stats
$stats = [
    'students' => '500+',
    'nbfcs' => '100',
    'countries' => '40+',
    'customers' => '2k+'
];

$labels = [
    'students' => 'Students',
    'nbfcs' => 'NBFCs',
    'countries' => 'Countries',
    'customers' => 'Happy customers'
];

$icons = [
    'students' => 'assets/images/icon-students.png',
    'nbfcs' => 'assets/images/icon-nbfcs.png',
    'countries' => 'assets/images/icon-countries.png',
    'customers' => 'assets/images/icon-customers.png'
];

?>

 <div class="effort-section">
        <!-- Background Image -->
        <img src="assets/images/effort-banner.png" alt="Background Image" class="effort-background-image">

        <div class="effort-container">
            <div class="effort-content">
                <!-- Left Column with Image -->
                <div class="effort-image-column">
                    <div class="effort-image-wrapper">
                        <img src="assets/images/girl-image-with-banner.png" alt="Student with backpack" class="effort-main-image">
                    </div>
                </div>

                <!-- Right Column with Content -->
                <div class="effort-content-column">
                <div class="effort-heading">

                    <h1>Effortless and affordable <br>global transfers!</h1>
                    <p>Support loved ones abroad by sending money from India for education and expenses. 
                       Transfer to 40+ countries with real exchange rates, no hidden fees. 
                       Sign up easily online with your PAN and address.</p>
                </div>

                <div class="effort-icons-image">
                   <img src="assets/images/account_circle.png" alt="Students Icon" class="effort-icon">
                   <img src="assets/images/account_balance.png" alt="NBFCs Icon" class="effort-icon">
                   <img src="assets/images/flag.png" alt="Countries Icon" class="effort-icon">
                  <img src="assets/images/sentiment_very_satisfied.png" alt="Customers Icon" class="effort-icon">
                </div>

                    <!-- Stats Grid -->
                    <div class="effort-stats-grid">
                        <?php
foreach ($stats as $key => $value) {
    echo "
                            <div class=\"effort-stat-card\">
                                <div class=\"effort-stat-value\">{$value}</div>
                                <div class=\"effort-stat-label\">{$labels[$key]}</div>
                            </div>
                            ";
}
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>