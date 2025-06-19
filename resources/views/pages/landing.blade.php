<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>

<body>
    @extends('layouts.app')


    @section('title', 'Welcome to Remitout')

    @section('homecontent')
        <x-herosection></x-herosection>

        <!-- <div class="lineargradientbackground">
                    <?php $backgroundLinearBackground = "assets/images/BG Linear gradient.png"; ?>
                    <img src="<?php echo $backgroundLinearBackground; ?>" alt="Background Image">
                </div> -->

      @include('components.profilecardsection', [
        'combinedTestimonials'=>$combinedTestimonials,
        'landingpageContents'=>$landingpageContents

        ])
      @include('components.inforecords', [
        'study_loan' => $study_loan,
        'landingpageContents'=>$landingpageContents
        ])
      


        <x-graphflow></x-graphflow>

  
@include('components.faqsection', [
    'combinedFaqs' => $combinedFaqs
])

         @endsection


    <script>
        function getInfoDetailHomepage() {
            fetch("/landingpage", {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Fetched Data:', data);

                    if (data.length > 0) {
                        const item = data[0];

                        const parts = item.banner_header ? item.banner_header.split('|') : [];

                        document.querySelector('.line-1').innerText = parts[0] || '';
                        document.querySelector('.line-2 .bold').innerText = parts[1] || '';

                        const italicSpan = document.querySelector('.line-2');
                        italicSpan.innerText = parts[2] || '';
                        italicSpan.style.fontStyle = 'italic';
                        italicSpan.style.fontWeight = '100';

                        document.querySelector('.line-3').innerText = parts[3] || '';

                        // Other dynamic fields
                        document.querySelector('.journey-title').innerText = item.banner_little_quote || '';
                        document.querySelector('.journey-text').innerText = item.banner_little_description || '';
                        document.querySelector('.secure-loan').innerText = item.button_textcontent || '';
                        document.querySelector('.watch-demo').innerHTML = `<img src="assets/images/play-icon.png" alt="Video Icon" class="play-icon"> ${item.video_trigger_button || ''}`;
                    }


                })
                .catch(error => {
                    console.error('Error fetching homepage data:', error);
                });
        }


        document.addEventListener("DOMContentLoaded", () => {
            getInfoDetailHomepage();
        });

    </script>


</body>

</html>