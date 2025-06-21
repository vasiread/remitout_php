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
        trim($landingpageContents[14]->content ?? '') ?:
        'Bespoke Loan Options from Trusted NBFCs for Your International Education.';

    $heading = trim($landingpageContents[13]->content ?? '') ?: 'Your Smart Route to Study Loans';
@endphp


<section class="study-loans-section">
    <div class="study-loans-content">

        <!-- Left Section -->
        <div class="study-loans-left">
            <div class="study-loans-text">
                <h3>{!! smartSplitHeading($heading) !!}</h3>

                <p>
                <p>{!! smartSplitText($subText) !!}</p>
            </div>
        </div>
        <!-- Right Section -->
        <div class="study-loans-image-right">
            <img src="{{ asset('assets/images/globe-1.png') }}" alt="Globe Image" class="globe-image">
        </div>
    </div>

</section>


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
    <img src="{{ asset('assets/images/graphvectors/verticalGraphline.png') }}" alt="" id="firstverticalline">
    <div class="study-loans-numbertwosection">
        <img src="{{ asset('assets/images/graphvectors/02.png') }}" id="numbertwo" alt="">
        <img src="{{ asset('assets/images/graphvectors/handshake.png') }}" id="handshake-id" alt="">
    </div>
    <img src="{{ asset('assets/images/graphvectors/perfectmatchvector.png') }}" alt="" id="first-diagonal">
    <p id="first-diagonal-header" class="global-diagonal-content">
        {!! trim($landingpageContents['study-loan']['Diagonal Label: Perfect Match'] ?? '') !== ''
            ? smartBreak($landingpageContents[23]->content)
            : 'Perfect <br> Match' !!}
    </p>



    <div class="study-loans-graphsecondbox">
        <img src="{{ asset('assets/images/graphvectors/01.png') }}" id="numberone" alt="">
        <img src="{{ asset('assets/images/graphvectors/horizontalfirst.png') }}" id="horizontallinefirst"
            alt="">

        <h3 class="global-header-graph" style="text-align:left">
            {{ trim($landingpageContents['study-loan']['Step 1 Header: Profile Assessment'] ?? 'Profile Assessment') }}
        </h3>
        <p class="global-content-graph" style="text-align:left">
            {{ trim($landingpageContents[17]->content ?? '') ?:
                'Our experts assess your academic and financial
                profile to determine the best loan options for your
                overseas education.' }}

        </p>
    </div>
    <img src="{{ asset('assets/images/graphvectors/profileassesmentvector.png') }}" id="second-diagonal"
        alt="">
    <p id="second-diagonal-content" class="global-diagonal-content">
        {!! trim($landingpageContents[19]->content ?? '') !== ''
            ? smartBreak($landingpageContents[19]->content)
            : 'Profile <br> Assessment' !!}

    </p>

    <img src="{{ asset('assets/images/graphvectors/additionalvector.png') }}" alt=""
        id="first-additional-vector">
    <img src="{{ asset('assets/images/graphvectors/firstgroup.png') }}" alt="" id="graph-group-img">
    <img src="{{ asset('assets/images/graphvectors/verticalgraphshort.png') }}" alt=""
        id="vertical-shortfirst">
    <img src="{{ asset('assets/images/graphvectors/verticalgraphshort.png') }}" alt=""
        id="vertical-shortsecond">
    <img src="{{ asset('assets/images/graphvectors/loanchoicesvector.png') }}" alt="" id="third-diagonal">
    <p id="third-diagonal-content" class="global-diagonal-content">
        {!! trim($landingpageContents[27]->content ?? '') !== ''
            ? smartBreak($landingpageContents[19]->content)
            : 'Loan <br> Choices' !!}

    </p>
    <img src="{{ asset('assets/images/graphvectors/verticalGraphlinesecond.png') }}" alt=""
        id="vertical-line-second">
    <img src="{{ asset('assets/images/graphvectors/03.png') }}" alt="" id="numberthree">

    <div class="study-loans-graphthirdbox">

        <h3 class="global-header-graph" style="text-align:left;width: 110% ;">
            {!! trim($landingpageContents[24]->content ?? '') !== ''
                ? smartBreak($landingpageContents[24]->content)
                : 'Choose Your  <br> Loan Offers' !!}
        </h3>
        <p class="global-content-graph" style="text-align:left">

            {{ trim($landingpageContents[25]->content ?? '') ?:
                'Browse and compare personalized loan offers based on
                                                                                                your eligibility
                                                                                                and repayment preferences.' }}


        </p>
    </div>
    <img src="{{ asset('assets/images/graphvectors/guaranteevector.png') }}" id="sixth-diagonal" alt="">
    <p id="sixth-diagonal-content" class="global-diagonal-content">


        {!! trim($landingpageContents[39]->content ?? '') !== ''
            ? smartBreak($landingpageContents[39]->content)
            : 'Guaranteed  <br> Disbursement' !!}

    </p>

    <img src="{{ asset('assets/images/graphvectors/easyprocessvector.png') }}" id="fourth-diagonal" alt="">
    <img src="{{ asset('assets/images/graphvectors/additionalvector.png') }}" id="second-additional-vector"
        alt="">
    <p id="fifth-diagonal-content" class="global-diagonal-content">
        {!! trim($landingpageContents[31]->content ?? '') !== ''
            ? smartBreak($landingpageContents[31]->content)
            : 'Easy  <br> Process' !!}

    </p>
    <img src="{{ asset('assets/images/graphvectors/verticalGraphline.png') }}" id="verticallinethird" alt="">
    <img src="{{ asset('assets/images/graphvectors/04.png') }}" id="numberfour" alt="">
    <img src="{{ asset('assets/images/graphvectors/06.png') }}" id="numbersix" alt="">
    <img src="{{ asset('assets/images/graphvectors/05.png') }}" id="numberfive" alt="">
    <img src="{{ asset('assets/images/graphvectors/handpointer.png') }}" id="handpointer-img" alt="">
    <img src="{{ asset('assets/images/graphvectors/fastrackaprovalvector.png') }}" id="fifth-diagonal" alt="">
    <img src="{{ asset('assets/images/graphvectors/clockhand.png') }}" id="clock-hand" alt="">
    <img src="{{ asset('assets/images/graphvectors/verticalGraphline.png') }}" id="verticallinefourth"
        alt="">
    <img src="{{ asset('assets/images/graphvectors/horizontalfirst.png') }}" id="horizontalsecond" alt="">
    <p id="fourth-diagonal-content" class="global-diagonal-content" style="width:82px">
        {!! trim($landingpageContents[35]->content ?? '') !== ''
            ? smartBreak($landingpageContents[35]->content)
            : ' Fast-Track </br>
                                                        Approval' !!}

    </p>
    <div class="study-loans-graphfourthbox">
        <h3 class="global-header-graph" style="text-align:left;">
            {!! trim($landingpageContents[28]->content ?? '') !== ''
                ? smartBreak($landingpageContents[28]->content)
                : 'Submit Documents<br>With Ease' !!}


        </h3>
        <p class="global-content-graph" style="text-align:left;width: 120% ;">

            {{ trim($landingpageContents[29]->content ?? '') ?:
                'Upload your required documents
                                                                                                securely through our
                                                                                                platform for a seamless process.' }}


        </p>
    </div>

    <div class="study-loans-graphfifthbox">

        <h3 class="global-header-graph" style="text-align:right;width:100%">
            {{ trim($landingpageContents[32]->content ?? '') ?: 'Fast-Track Approval' }}

        </h3>
        <p class="global-content-graph" style="text-align:right;width:100%">
            {{ trim($landingpageContents[33]->content ?? '') ?: 'Experience quick approvals with minimal delays, ensuring you stay on track for your educational goals.' }}

        </p>
    </div>
    <div class="study-loans-graphsixthbox">

        <h3 class="global-header-graph" style="text-align:left">
            {!! trim($landingpageContents[36]->content ?? '') !== ''
                ? smartBreak($landingpageContents[36]->content)
                : 'Guaranteed  <br> Disbursement' !!}


        </h3>
        <p class="global-content-graph" style="text-align:left">


            {{ trim($landingpageContents[37]->content ?? '') ?: 'Once approved, your loan is disbursed directly to your institution on time, securing your admission.' }}




        </p>
    </div>


</div>


















</section>

<div class="smart-banner-image">

    <section class="smart-lending-section">
        <div class="smart-content-wrapper">
            <!-- Left Content -->
            <div class="smart-left-content">
                <h1 class="main-heading">
                    {!! trim($landingpageContents[40]->content ?? '') !== ''
                        ? smartBreak($landingpageContents[40]->content)
                        : 'Where your safety meets smart lending' !!}



                </h1>

                <div class="mobile-right-image-smart-lending">

                    <img src="assets/images/tablet-group-image.png" alt="Smart Lending Image">

                </div>


                <div class="features-list">
                    <div class="feature-item">
                        <img src="assets/images/icon-1.png" alt="Support Icon">
                        <div class="feature-content">
                            <h4>
                                {{ trim($landingpageContents[42]->content ?? '') ?: 'Integrated Support, Anytime, Anywhere' }}


                            </h4>
                            <p>

                                {{ trim($landingpageContents[43]->content ?? '') ?: 'Instant support builds trust and enhances experience!' }}
                            </p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <img src="assets/images/icon-2.png" alt="Processing Icon">
                        <div class="feature-content">
                            <h4>
                                {{ trim($landingpageContents[45]->content ?? '') ?: 'Rapid Processing' }}


                            </h4>
                            <p>
                                {{ trim($landingpageContents[46]->content ?? '') ?: 'Easy student remittance in just a few steps!' }}


                            </p>
                        </div>

                    </div>

                    <div class="feature-item">
                        <img src="assets/images/icon-3.png" alt="Price Icon">
                        <div class="feature-content">
                            <h4>
                                {{ trim($landingpageContents[48]->content ?? '') ?: 'Best Price Commitment' }}

                            </h4>
                            <p>

                                {{ trim($landingpageContents[49]->content ?? '') ?: 'Transparent, competitive exchange rates guaranteed!' }}

                            </p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <img src="assets/images/iocn-4.png" alt="Protection Icon">
                        <div class="feature-content">
                            <h4>
                                {{ trim($landingpageContents[51]->content ?? '') ?: 'Absolutely Protected' }}



                            </h4>
                            <p>

                                {{ trim($landingpageContents[52]->content ?? '') ?: 'Instant transfers, no fees, 24/7 support!' }}

                            </p>
                        </div>
                    </div>
                </div>

                <button class="cta-button" id="loanButton" onclick="handleLoanRedirect()">
                    {{ trim($landingpageContents[54]->content ?? '') ?: 'Secure your loan now!' }}

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
    $stats = [
        'students' => trim($landingpageContents[68]->counts ?? '') ?: '500+',
        'nbfcs' => trim($landingpageContents[70]->counts ?? '') ?: '100',
        'countries' => trim($landingpageContents[72]->counts ?? '') ?: '40+',
        'customers' => trim($landingpageContents[74]->counts ?? '') ?: '2k+',
    ];
    
    $labels = [
        'students' => trim($landingpageContents[69]->content ?? '') ?: 'Students',
        'nbfcs' => trim($landingpageContents[71]->content ?? '') ?: 'NBFCs',
        'countries' => trim($landingpageContents[73]->content ?? '') ?: 'Countries',
        'customers' => trim($landingpageContents[75]->content ?? '') ?: 'Happy customers',
    ];
    
    $icons = [
        'students' => trim($landingpageContents[64]->content ?? '') ?: 'assets/images/account_circle-grid.png',
        'nbfcs' => trim($landingpageContents[65]->icon_url ?? '') ?: 'assets/images/account_balance.png',
        'countries' => trim($landingpageContents[66]->icon_url ?? '') ?: 'assets/images/flag.png',
        'customers' => trim($landingpageContents[67]->icon_url ?? '') ?: 'assets/images/sentiment_very_satisfied.png',
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
                        <img src="assets/images/girl-image-with-banner.png" alt="Student with backpack"
                            class="effort-main-image">
                    </div>
                </div>

                <!-- Right Column with Content -->
                <div class="effort-content-column">
                    <div class="effort-heading">

                        <h1>
                            {!! trim($landingpageContents[62]->content ?? '') !== ''
                                ? smartSplitHeading($landingpageContents[62]->content, 3)
                                : 'Effortless and affordable <br>global transfers!' !!}
                        </h1>


                        <p>
                            {{ trim($landingpageContents[63]->content ?? '') ?:
                                'Support loved ones abroad by sending money from India for education and expenses.
                                                                                    Transfer to 40+ countries with real exchange rates, no hidden fees.
                                                                                    Sign up easily online with your PAN and address.' }}

                        </p>
                    </div>



                    <!-- Stats Grid -->
                    <div class="effort-icons-image">
                        <img src={{ trim($landingpageContents[64]->content ?? '') ?: 'assets/images/account_circle-grid.png' }}
                            alt="Students Icon" class="effort-icon">
                        <img src={{ trim($landingpageContents[65]->content ?? '') ?: 'assets/images/account_balance.png' }}
                            alt="NBFCs Icon" class="effort-icon">
                        <img src={{ trim($landingpageContents[66]->content ?? '') ?: 'assets/images/flag.png' }}
                            alt="Countries Icon" class="effort-icon">
                        <img src={{ trim($landingpageContents[67]->content ?? '') ?: 'assets/images/sentiment_very_satisfied.png' }}
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
