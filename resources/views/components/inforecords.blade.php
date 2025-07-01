@php

    function mapCmsContent($contents)
    {
        $map = [];
        foreach ($contents as $item) {
            $map[$item->section][$item->title] = $item->content;
        }
        return $map;
    }

    $cms = mapCmsContent($landingpageContents);

    function smartBreak($text)
    {
        $text = trim($text);
        $words = explode(' ', $text);
        $count = count($words);

        if ($count === 2) {
            // Split directly into two lines
            return implode('<br>', $words);
        } elseif ($count === 3) {
            // One word on first line, two on second
            return $words[0] . '<br>' . $words[1] . ' ' . $words[2];
        } elseif ($count === 4) {
            // Two words on each line
            return implode(' ', array_slice($words, 0, 2)) . '<br>' . implode(' ', array_slice($words, 2));
        } elseif ($count > 4) {
            // Split roughly in half
            $half = intdiv($count, 2);
            return implode(' ', array_slice($words, 0, $half)) . '<br>' . implode(' ', array_slice($words, $half));
        } else {
            // Just return as-is
            return $text;
        }
    }

    function smartSplitHeading($text, $splitAt = null)
    {
        $text = trim($text);
        $words = explode(' ', $text);
        $count = count($words);

        if ($count <= 1) {
            return $text;
        }

        $splitIndex = $splitAt ?? ceil($count / 2);
        $firstPart = implode(' ', array_slice($words, 0, $splitIndex));
        $secondPart = implode(' ', array_slice($words, $splitIndex));

        return $firstPart . '<br>' . $secondPart;
    }

    function smartSplitText($text, $splitAt = null)
    {
        $words = explode(' ', $text);
        $count = count($words);

        if ($count <= 1) {
            return $text;
        }

        $splitIndex = $splitAt ?? ceil($count / 2);
        $firstPart = implode(' ', array_slice($words, 0, $splitIndex));
        $secondPart = implode(' ', array_slice($words, $splitIndex));

        return $firstPart . '<br>' . $secondPart;
    }

    // Fallback static if content is missing
    $subText =
        trim($cms['study-loan']['Graph Subheading'] ?? '') !== ''
            ? smartSplitText($cms['study-loan']['Graph Subheading'], 5)
            : smartSplitText('Bespoke Loan Options from Trusted NBFCs for Your International Education.', 5);

    $heading =
        trim($cms['study-loan']['Graph Heading'] ?? '') !== ''
            ? smartSplitText($cms['study-loan']['Graph Heading'], 4)
            : 'Your Smart Route to  <br> Study Loans';
@endphp


<section class="study-loans-section" id="study-loan">
    <div class="study-loans-content">

        <!-- Left Section -->
        <div class="study-loans-left">
            <div class="study-loans-text">
                <h3>{!! $heading !!}</h3>

                <p>
                <p>{!! $subText !!}</p>
            </div>
        </div>
        <!-- Right Section -->
        <div class="study-loans-image-right">
            <img src="{{ isset($cms['study-loan']['Globe Image']) ? asset($cms['study-loan']['Globe Image']) : asset('assets/images/globe-1.png') }}" alt="Globe Image" class="globe-image">
        </div>

    </div>

    <div class="study-loans-graphview">
    <div class="study-loans-graphfirstbox">
        <h3>{{ trim($cms['study-loan']['Step 2 Header: Get Matched with Top NBFCs'] ?? 'Get Matched with Top NBFCs') }}
        </h3>

        <p>{{ trim(
            $cms['study-loan']['Step 2 Content: Get Matched with Top NBFCs'] ??
                'We connect you with
                        multiple non-banking financial companies (NBFCs) offering competitive study loans.',
        ) }}
        </p>
    </div>
    <img src="{{ asset('assets/images/graphvectors/verticalGraphline.png') }}" alt="Graph vertical graph" id="firstverticalline">
    <div class="study-loans-numbertwosection">
        <img src="{{ asset('assets/images/graphvectors/02.png') }}" id="numbertwo" alt="Graph vector two">
        <img src="{{ asset('assets/images/graphvectors/handshake.png') }}" id="handshake-id" alt="Handsahke image">
    </div>
    <img src="{{ asset('assets/images/graphvectors/perfectmatchvector.png') }}" alt="Graphs first diagonal" id="first-diagonal">
    <p id="first-diagonal-header" class="global-diagonal-content">
        {!! trim($cms['study-loan']['Diagonal Label: Perfect Match'] ?? '') !== ''
            ? smartBreak($cms['study-loan']['Diagonal Label: Perfect Match'])
            : 'Perfect <br> Match' !!}

    </p>



    <div class="study-loans-graphsecondbox">
        <img src="{{ asset('assets/images/graphvectors/01.png') }}" id="numberone" alt="Graphs one image">
        <img src="{{ asset('assets/images/graphvectors/horizontalfirst.png') }}" id="horizontallinefirst"
            alt="">

        <h3 class="global-header-graph" style="text-align:left">
            {{ trim($cms['study-loan']['Step 1 Header: Profile Assessment'] ?? 'Profile Assessment') }}
        </h3>
        <p class="global-content-graph" style="text-align:left">
            {{ trim(
                $cms['study-loan']['Step 1 Content: Profile Assessment'] ??
                    'Our experts assess your academic and financial
                            profile to determine the best loan options for your
                            overseas education.',
            ) }}

        </p>
    </div>
    <img src="{{ asset('assets/images/graphvectors/profileassesmentvector.png') }}" id="second-diagonal"
        alt="Graph profile assessment image">
    <p id="second-diagonal-content" class="global-diagonal-content">
        {!! trim($cms['study-loan']['Diagonal Label: Profile Assessment'] ?? '') !== ''
            ? smartBreak($cms['study-loan']['Diagonal Label: Profile Assessment'])
            : 'Profile <br> Assessment' !!}


    </p>

    <img src="{{ asset('assets/images/graphvectors/additionalvector.png') }}" alt="Graph first vector"
        id="first-additional-vector">
    <img src="{{ asset('assets/images/graphvectors/firstgroup.png') }}" alt="Graph group illustration" id="graph-group-img">
    <img src="{{ asset('assets/images/graphvectors/verticalgraphshort.png') }}" alt="Short vertical graph line"
        id="vertical-shortfirst">
    <img src="{{ asset('assets/images/graphvectors/verticalgraphshort.png') }}" alt="Shorthand vertical graph line"
        id="vertical-shortsecond">
    <img src="{{ asset('assets/images/graphvectors/loanchoicesvector.png') }}" alt="Loan choices vector illustration" id="third-diagonal">
    <p id="third-diagonal-content" class="global-diagonal-content">
        {!! trim($cms['study-loan']['Diagonal Label: Loan Choices'] ?? '') !== ''
            ? smartBreak($cms['study-loan']['Diagonal Label: Loan Choices'])
            : 'Loan <br> Choices' !!}



    </p>
    <img src="{{ asset('assets/images/graphvectors/verticalGraphlinesecond.png') }}" alt="Second vertical graph line"
        id="vertical-line-second">
    <img src="{{ asset('assets/images/graphvectors/03.png') }}" alt="Number three icon" id="numberthree">

    <div class="study-loans-graphthirdbox">

        <h3 class="global-header-graph" style="text-align:left;width: 110% ;">
            {!! trim($cms['study-loan']['Step 3 Header: Choose Your Loan Offers'] ?? '') !== ''
                ? smartBreak($cms['study-loan']['Step 3 Header: Choose Your Loan Offers'])
                : 'Choose Your <br> Loan Offers' !!}

        </h3>
        <p class="global-content-graph" style="text-align:left">



            {{ trim($cms['study-loan']['Step 3 Content: Choose Your Loan Offers'] ?? 'Browse and compare personalized loan offers based on your eligibility and repayment preferences.') }}


        </p>
    </div>
    <img src="{{ asset('assets/images/graphvectors/guaranteevector.png') }}" id="sixth-diagonal" alt="Guarantee vector illustration">
    <p id="sixth-diagonal-content" class="global-diagonal-content">


        {!! trim($cms['study-loan']['Diagonal Label: Guaranteed Disbursement'] ?? '') !== ''
            ? smartBreak($cms['study-loan']['Diagonal Label: Guaranteed Disbursement'])
            : 'Guaranteed <br> Disbursement' !!}


    </p>

    <img src="{{ asset('assets/images/graphvectors/easyprocessvector.png') }}" id="fourth-diagonal" alt="Easy process vector illustration">
    <img src="{{ asset('assets/images/graphvectors/additionalvector.png') }}" id="second-additional-vector"
        alt="Additional graph vector">
    <p id="fifth-diagonal-content" class="global-diagonal-content">
        {!! trim($cms['study-loan']['Diagonal Label: Easy Process'] ?? '') !== ''
            ? smartBreak($cms['study-loan']['Diagonal Label: Easy Process'])
            : 'Easy <br> Process' !!}


    </p>
    <img src="{{ asset('assets/images/graphvectors/verticalGraphline.png') }}" id="verticallinethird" alt="Third vertical graph line">
    <img src="{{ asset('assets/images/graphvectors/04.png') }}" id="numberfour" alt="Number four icon">
    <img src="{{ asset('assets/images/graphvectors/06.png') }}" id="numbersix" alt="Number six icon">
    <img src="{{ asset('assets/images/graphvectors/05.png') }}" id="numberfive" alt="Number five icon">
    <img src="{{ asset('assets/images/graphvectors/handpointer.png') }}" id="handpointer-img" alt="Hand pointer graphic">
    <img src="{{ asset('assets/images/graphvectors/fastrackaprovalvector.png') }}" id="fifth-diagonal" alt="Fast track approval vector illustration">
    <img src="{{ asset('assets/images/graphvectors/clockhand.png') }}" id="clock-hand" alt="Clock hand graphic">
    <img src="{{ asset('assets/images/graphvectors/verticalGraphline.png') }}" id="verticallinefourth" alt="Fourth vertical graph line">
    <img src="{{ asset('assets/images/graphvectors/horizontalfirst.png') }}" id="horizontalsecond" alt="Horizontal graph line image">
    <p id="fourth-diagonal-content" class="global-diagonal-content" style="width:82px">
        {!! trim($cms['study-loan']['Diagonal Label: Fast-Track Approval'] ?? '') !== ''
            ? smartBreak($cms['study-loan']['Diagonal Label: Fast-Track Approval'])
            : 'Fast-Track <br> Approval' !!}

    </p>
    <div class="study-loans-graphfourthbox">
        <h3 class="global-header-graph" style="text-align:left;">
            {!! trim($cms['study-loan']['Step 4 Header: Submit Documents With Ease'] ?? '') !== ''
                ? smartBreak($cms['study-loan']['Step 4 Header: Submit Documents With Ease'])
                : 'Submit Documents<br>With Ease' !!}
        </h3>
        <p class="global-content-graph" style="text-align:left;width: 120% ;">

            {{ trim(
                $cms['study-loan']['Step 4 Content: Submit Documents With Ease'] ??
                    'Upload your required documents                                                                                              securely through our
                     platform for a seamless process.',
            ) }}


        </p>
    </div>

    <div class="study-loans-graphfifthbox">

        <h3 class="global-header-graph" style="text-align:right;width:100%">
            {{ trim($cms['study-loan']['Diagonal Label: Fast-Track Approval'] ?? 'Fast-Track Approval') }}

        </h3>
        <p class="global-content-graph" style="text-align:right;width:100%">
            {{ trim($cms['study-loan']['Step 5 Content: Fast-Track Approval'] ?? '') ?:
                'Experience quick approvals with minimal delays, ensuring you stay on track for your educational goals.' }}

        </p>
    </div>
    <div class="study-loans-graphsixthbox">

        <h3 class="global-header-graph" style="text-align:left">
            {!! trim($cms['study-loan']['Step 6 Header: Guaranteed Disbursement'] ?? '') !== ''
                ? smartBreak($cms['study-loan']['Step 6 Header: Guaranteed Disbursement'])
                : 'Guaranteed <br> Disbursement' !!}
        </h3>
        <p class="global-content-graph" style="text-align:left">

            {{ trim($cms['study-loan']['Step 6 Content: Guaranteed Disbursement'] ?? '') ?:
                'Once approved, your loan is disbursed directly to your institution on time, securing your admission.' }}

        </p>
    </div>


</div>

</section>






</section>

<div class="smart-banner-image">
    <section class="smart-lending-section">
        <div class="smart-content-wrapper">
            <!-- Left Content -->
            <div class="smart-left-content">
                <h3 class="main-heading">
                    {!! trim($cms['secure-loan']['Main Heading'] ?? '') !== ''
                        ? smartSplitText($cms['secure-loan']['Main Heading'], 4)
                        : smartSplitText('Where your safety meets smart lending', 4) !!}
                </h3>


                <div class="mobile-right-image-smart-lending">
                    <img src="{{ trim($cms['secure-loan']['Mobile Image'] ?? '') !== ''
                        ? trim($cms['secure-loan']['Mobile Image'])
                        : asset('assets/images/tablet-group-image.png') }}"
                        alt="Smart Lending Image">
                </div>


                <div class="features-list">
                    <div class="feature-item">
                        <img src="{{ trim($cms['secure-loan']['Feature 1 Icon'] ?? '') !== ''
                            ? trim($cms['secure-loan']['Feature 1 Icon'])
                            : asset('assets/images/icon-1.png') }}"
                            alt="Support Icon">
                        <div class="feature-content">
                            <h4>
                                {{ trim($cms['secure-loan']['Feature 1 Title'] ?? '') ?: 'Integrated Support, Anytime, Anywhere' }}
                            </h4>
                            <p>

                                {{ trim($cms['secure-loan']['Feature 1 Description'] ?? '') ?: 'Instant support builds trust and enhances experience!' }}
                            </p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <img src="{{ trim($cms['secure-loan']['Feature 2 Icon'] ?? 'assets/images/icon-2.png') }}"
                            alt="Processing Icon">
                        <div class="feature-content">
                            <h4>
                                {{ trim($cms['secure-loan']['Feature 2 Title'] ?? 'Rapid Processing') }}
                            </h4>
                            <p>
                                {{ trim($cms['secure-loan']['Feature 2 Description'] ?? 'Easy student remittance in just a few steps!') }}
                            </p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <img src="{{ trim($cms['secure-loan']['Feature 3 Icon'] ?? 'assets/images/icon-3.png') }}"
                            alt="Price Icon">
                        <div class="feature-content">
                            <h4>
                                {{ trim($cms['secure-loan']['Feature 3 Title'] ?? 'Best Price Commitment') }}

                            </h4>
                            <p>

                                {{ trim($cms['secure-loan']['Feature 3 Description'] ?? 'Transparent, competitive exchange rates guaranteed!') }}

                            </p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <img src="{{ asset(trim($cms['secure-loan']['Feature 4 Icon'] ?? 'assets/images/icon-4.png')) }}"
                            alt="Protection Icon">
                        <div class="feature-content">
                            <h4>
                                {{ trim($cms['secure-loan']['Feature 4 Title'] ?? 'Absolutely Protected') }}

                            </h4>
                            <p>

                                {{ trim($cms['secure-loan']['Feature 4 Description'] ?? 'Instant transfers, no fees, 24/7 support!') }}

                            </p>
                        </div>
                    </div>
                </div>

                <button class="cta-button" id="loanButton" onclick="handleLoanRedirect()">
                    {{ trim($cms['secure-loan']['CTA Button Text'] ?? 'Secure your loan now!') }}

                </button>
            </div>

            <!-- Right Content -->
            <div class="smart-right-content">
                <div class="loading-container">
                    <img src="{{ trim($cms['secure-loan']['Loading Animation'] ?? 'assets/images/Circle.png') }}"
                        alt="Loading animation" class="loading-dots">
                </div>
                <div class="radcliffe-brand">
                    <img src="{{ trim($cms['secure-loan']['Radcliffe Icon'] ?? 'assets/images/over-icon.png') }}"
                        alt="Radcliffe Camera icon">
                </div>
                <div class="radcliffe-image">
                    <img src="{{ trim($cms['secure-loan']['Radcliffe Image'] ?? 'assets/images/image-1.png') }}"
                        alt="Radcliffe Camera">
                </div>
                <div class="students-image">
                    <img src="{{ trim($cms['secure-loan']['Students Image'] ?? 'assets/images/image-2.png') }}"
                        alt="Students with Tablet">
                </div>
                <div class="graduation-image">
                    <img src="{{ trim($cms['secure-loan']['Graduation Image'] ?? 'assets/images/image-3.png') }}"
                        alt="Graduation Celebration">
                </div>
            </div>
        </div>
    </section>


    <?php
    $stats = [
        'students' => trim($cms['global-transfer']['Students Stat Value'] ?? '') ?: '500+',
        'nbfcs' => trim($cms['global-transfer']['NBFCs Stat Value'] ?? '') ?: '100',
        'countries' => trim($cms['global-transfer']['Countries Stat Value'] ?? '') ?: '40+',
        'customers' => trim($cms['global-transfer']['Customers Stat Value'] ?? '') ?: '2k+',
    ];
    
    $labels = [
        'students' => trim($cms['global-transfer']['Students Stat Label'] ?? '') ?: 'Students',
        'nbfcs' => trim($cms['global-transfer']['NBFCs Stat Label'] ?? '') ?: 'NBFCs',
        'countries' => trim($cms['global-transfer']['Countries Stat Label'] ?? '') ?: 'Countries',
        'customers' => trim($cms['global-transfer']['Customers Stat Label'] ?? '') ?: 'Happy customers',
    ];
    
    $icons = [
        'students' => trim($cms['global-transfer']['Students Icon'] ?? '') ?: 'assets/images/account_circle-grid.png',
        'nbfcs' => trim($cms['global-transfer']['NBFCs Icon'] ?? '') ?: 'assets/images/account_balance.png',
        'countries' => trim($cms['global-transfer']['Countries Icon'] ?? '') ?: 'assets/images/flag.png',
        'customers' => trim($cms['global-transfer']['Customers Icon'] ?? '') ?: 'assets/images/sentiment_very_satisfied.png',
    ];
    ?>


    <div class="effort-section" id="services">
       
        <img src="{{ trim($cms['global-transfer']['Background Image'] ?? '') ?: asset('assets/images/effort-banner.png') }}"
            alt="Background Image" class="effort-background-image">

        <div class="effort-container">
            <div class="effort-content">
                 <div class="effort-image-column">
                    <div class="effort-image-wrapper">
                        <img src="{{ trim($cms['global-transfer']['Main Imajge'] ?? '') ?: asset('assets/images/girl-image-with-banner.png') }}"
                        alt="Student with backpack" class="effort-main-image">
                    </div>
                </div>

                 <div class="effort-content-column">
                    <div class="effort-heading">

                        <h1>
                            {!! trim($cms['global-transfer']['Heading'] ?? '') !== ''
                                ? smartSplitHeading($cms['global-transfer']['Heading'], 3)
                                : 'Effortless and affordable <br>global transfers!' !!}

                        </h1>


                        <p>
                            {{ trim($cms['global-transfer']['Description'] ?? '') ?:
                                'Support loved ones abroad by sending money from India for education and expenses.
                                Transfer to 40+ countries with real exchange rates, no hidden fees.
                                Sign up easily online with your PAN and address.' }}


                        </p>
                    </div>



                    <!-- Stats Grid -->
                    <div class="effort-icons-image">
                        <img src="{{ trim($cms['global-transfer']['Students Icon'] ?? '') ?: 'assets/images/account_circle-grid.png' }}"
                            alt="Students Icon" class="effort-icon">

                        <img src="{{ trim($cms['global-transfer']['NBFCs Icon'] ?? '') ?: 'assets/images/account_balance.png' }}"
                            alt="NBFCs Icon" class="effort-icon">

                        <img src="{{ trim($cms['global-transfer']['Countries Icon'] ?? '') ?: 'assets/images/flag.png' }}"
                            alt="Countries Icon" class="effort-icon">

                        <img src="{{ trim($cms['global-transfer']['Customers Icon'] ?? '') ?: 'assets/images/sentiment_very_satisfied.png' }}"
                            alt="Customers Icon" class="effort-icon">
                    </div>



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


