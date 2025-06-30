@php

    if (!function_exists('cmsGraphContent')) {
        function cmsGraphContent($contents)
        {
            $map = [];
            foreach ($contents as $item) {
                $map[$item->section][$item->title] = $item->content;
            }
            return $map;
        }
    }

    $cms = cmsGraphContent($landingpageContents);
        $globeImage = $cms['study-loan']['Globe Image'] ?? null;


    if (!function_exists('breakSmart')) {
        function breakSmart($text)
        {
            $text = trim($text);
            $words = explode(' ', $text);
            $count = count($words);

            if ($count === 2) {
                return implode('<br>', $words);
            } elseif ($count === 3) {
                return $words[0] . '<br>' . $words[1] . ' ' . $words[2];
            } elseif ($count === 4) {
                return implode(' ', array_slice($words, 0, 2)) . '<br>' . implode(' ', array_slice($words, 2));
            } elseif ($count > 4) {
                $half = intdiv($count, 2);
                return implode(' ', array_slice($words, 0, $half)) . '<br>' . implode(' ', array_slice($words, $half));
            } else {
                return $text;
            }
        }
    }

    if (!function_exists('spliteSmartText')) {
        function spliteSmartText($text, $splitAt = null)
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
    }

    if (!function_exists('splitSmartHeading')) {
        function splitSmartHeading($text, $splitAt = null)
        {
            $text = trim($text);
            $words = explode(' ', $text);
            $count = count($words);

            if ($count <= 1) {
                return $text;
            }

            $splitIndex = $splitAt ?? ceil($count / 2);
            return implode(' ', array_slice($words, 0, $splitIndex)) .
                '<br>' .
                implode(' ', array_slice($words, $splitIndex));
        }
    }

@endphp


<div class="mobile-loan-container">
    <h2>{{ trim($cms['study-loan']['Graph Heading'] ?? '') ?: 'Your Smart Route to Study Loans' }}</h2>
    <p class="mobile-loan-subtitle">
        {{ trim($cms['study-loan']['Graph Subheading'] ?? 'Bespoke Loan Options from Trusted NBFCs for Your International Education.') }}
    </p>

    <!-- Top steps (1-3) -->
    <div class="mobile-loan-steps-container">
        <div class="mobile-loan-vertical-line"></div>

        <div class="mobile-loan-step">
            <div class="mobile-loan-step-header">
                <div class="mobile-loan-step-number">01</div>
                <div class="mobile-loan-step-title">
                    {!! breakSmart($cms['study-loan']['Step 1 Header: Profile Assessment'] ?? 'Profile Assessment') !!}

                </div>
            </div>
            <div class="mobile-loan-step-content">
                <p>
                    {{ trim($cms['study-loan']['Step 1 Content: Profile Assessment'] ?? 'Our experts assess your academic and financial profile to determine the best loan options for your overseas education.') }}
                </p>

            </div>
        </div>

        <div class="mobile-loan-step">
            <div class="mobile-loan-step-header">
                <div class="mobile-loan-step-number">02</div>
                <div class="mobile-loan-step-title">
                    {!! spliteSmartText(
                        $cms['study-loan']['Step 2 Header: Get Matched with Top NBFCs'] ?? 'Get Matched With Top NBFCs',
                        3,
                    ) !!}

                </div>
            </div>
            <div class="mobile-loan-step-content">
                <p>
                    {{ trim($cms['study-loan']['Step 2 Content: Get Matched with Top NBFCs'] ?? 'We connect you with multiple non-banking financial companies (NBFCs) offering competitive study loans.') }}
                </p>

            </div>
        </div>

        <div class="mobile-loan-step">
            <div class="mobile-loan-step-header">
                <div class="mobile-loan-step-number">03</div>
                <div class="mobile-loan-step-title">
                    {!! spliteSmartText($cms['study-loan']['Step 3 Header: Choose Your Loan Offers'] ?? 'Choose Your Loan Offers', 3) !!}

                </div>
            </div>
            <div class="mobile-loan-step-content">
                <p>
                    {{ trim($cms['study-loan']['Step 3 Content: Choose Your Loan Offers'] ?? 'Browse and compare personalized loan offers based on your eligibility and repayment preferences.') }}
                </p>

            </div>
        </div>     

         <!-- Bottom steps (4-6) with RIGHT-ALIGNED text to match image 1 -->
    <div class="mobile-loan-bottom-steps">
        <div class="mobile-loan-vertical-line-right"></div>

        <div class="mobile-loan-bottom-step">
            <div class="mobile-loan-bottom-step-header">
                <div class="mobile-loan-bottom-step-title">

                    {!! spliteSmartText(
                        $cms['study-loan']['Step 4 Header: Submit Documents With Ease'] ?? 'Submit Documents With Ease',
                        2,
                    ) !!}

                </div>
                <div class="mobile-loan-bottom-step-number">04</div>
            </div>
            <div class="mobile-loan-bottom-step-content">
                <p>
                    {{ trim($cms['study-loan']['Step 4 Content: Submit Documents With Ease'] ?? 'Upload your required documents securely through our platform for hassle-free processing.') }}
                </p>
            </div>
        </div>

        <div class="mobile-loan-bottom-step">
            <div class="mobile-loan-bottom-step-header">
                <div class="mobile-loan-bottom-step-title">
                    {!! spliteSmartText($cms['study-loan']['Step 5 Header: Fast-Track Approval'] ?? 'Fast-Track Approval', 1) !!}

                </div>
                <div class="mobile-loan-bottom-step-number">05</div>
            </div>
            <div class="mobile-loan-bottom-step-content">
                <p>
                    {{ trim($cms['study-loan']['Step 5 Content: Fast-Track Approval'] ?? 'Experience quick approvals with minimal delays, ensuring you stay on track for your educational goals.') }}

                </p>
            </div>
        </div>

        <div class="mobile-loan-bottom-step">
            <div class="mobile-loan-bottom-step-header">
                <div class="mobile-loan-bottom-step-title">

                    {!! spliteSmartText(
                        $cms['study-loan']['Step 6 Header: Guaranteed Disbursement'] ?? ' Guaranteed Disbursement',
                        1,
                    ) !!}

                </div>
                <div class="mobile-loan-bottom-step-number">06</div>
            </div>
            <div class="mobile-loan-bottom-step-content">
                <p>
                    {{ trim($cms['study-loan']['Step 6 Content: Guaranteed Disbursement'] ?? 'Once approved, your loan is disbursed directly to your institution on time, securing your admission.') }}
                </p>

            </div>
        </div>
    </div>    





    </div>

    <!-- Globe image divider -->
    <div class="mobile-loan-globe-wrapper">
<img 
    src="{{ asset(is_string($globeImage) ? trim($globeImage) : 'assets/Images/globe-1.png') }}" 
    alt="Globe Background" 
    class="mobile-loan-globe-image"
>  </div>

   
</div>