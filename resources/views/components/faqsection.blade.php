<div class="faqsection">
    <div class="lineargradientbackground">
        @php $backgroundLinearBackground = asset('assets/images/BG Linear gradient.png'); @endphp
        <img src="{{ $backgroundLinearBackground }}" class="faqlinear">
    </div>

    <div class="faqsection-insidecontent">
        <h1 style="padding-left: 2.5rem;">Frequently asked questions</h1>
        <div class="faqsection-inputcontainer">
            <div class="faqsection-keywords">
                <input type="text" placeholder="Type keywords to find related queries">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="faqsection-sortby">
                <input type="text" placeholder="Sort by" id="faqsearchinput">
                <i class="fa-solid fa-sort"></i>
            </div>
        </div>

        @php
            $questionAnswerDetails = [
                [
                    "question" => "How can I apply for a loan with Remitout?",
                    "answer" => "You can easily apply online by visiting our [application page] and filling out a short form with your basic information. Once submitted, our team will review your application and reach out with the next steps."
                ],
                [
                    "question" => "What are the eligibility criteria for a loan?",
                    "answer" => "You can easily apply online by visiting our [application page] and filling out a short form with your basic information. Once submitted, our team will review your application and reach out with the next steps."
                ],
                [
                    "question" => "How long does the loan approval process take?",
                    "answer" => "You can easily apply online by visiting our [application page] and filling out a short form with your basic information. Once submitted, our team will review your application and reach out with the next steps."
                ],
                [
                    "question" => "What documents are required to apply for a loan?",
                    "answer" => "You can easily apply online by visiting our [application page] and filling out a short form with your basic information. Once submitted, our team will review your application and reach out with the next steps."
                ],
            ];
        @endphp

        <div class="qasection">
            @foreach ($questionAnswerDetails as $index => $items)
                <div class="individual-qasection">
                    <div class="leftqa">
                        <h1>{{ $items['question'] }}</h1>
                        <p class="answer" style="display: none;">{{ $items['answer'] }}</p>
                    </div>
                    <div class="rightqa">
                        <i class="fa-solid fa-chevron-up" data-index="{{ $index }}"></i>
                        <i class="fa-solid fa-chevron-up active" data-index="{{ $index }}"
                            style="display:none;transform: rotate(180deg);"></i>
                    </div>
                </div>
            @endforeach

            <div class="pagenavigationcontainer">
                <div class="leftnavigator" id="leftnavigatorid">
                    <i class="fa-solid fa-arrow-left leftarrownavigator"
                        style="background-color: rgba(255, 255, 255, 1);color:rgba(217, 217, 217, 1)"></i>
                </div>
                <div style="background-color:rgba(255, 122, 0, 1);width:14px;height:14px"></div>
                <div style="background-color:rgba(217, 217, 217, 1);width:10px;height:10px"></div>
                <div style="background-color:rgba(217, 217, 217, 1);width:10px;height:10px"></div>
                <div class="rightnavigator">
                    <i class="fa-solid fa-arrow-right rightarrownavigator"
                        style="background-color: rgba(111, 37, 206, 1);color:rgba(255, 255, 255, 1)"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.rightqa i').forEach(icon => {
        icon.addEventListener('click', function () {
            const rightqa = this.closest('.rightqa');
            const answer = this.closest('.individual-qasection').querySelector('.answer');
            const inactiveIcon = rightqa.querySelector('.fa-chevron-up');
            const activeIcon = rightqa.querySelector('.fa-chevron-up.active');

            if (answer.style.display === "none" || answer.style.display === "") {
                answer.style.display = "block";
                inactiveIcon.style.display = "none";
                activeIcon.style.display = "inline-block";
                activeIcon.classList.add('rotate');
            } else {
                answer.style.display = "none";
                inactiveIcon.style.display = "inline-block";
                activeIcon.style.display = "none";
                activeIcon.classList.remove('rotate');
            }
        });
    });
</script>