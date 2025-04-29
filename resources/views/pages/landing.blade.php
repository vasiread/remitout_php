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

<x-profilecardsection></x-profilecardsection>

<x-graphflow></x-graphflow>

<x-landingpageservice></x-landingpageservice>

<x-inforecords></x-inforecords>

<x-faqsection></x-faqsection>
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
                console.log(item)

                // document.querySelector('.line-1').innerText = item.banner_line1;
                // document.querySelector('.line-2 .bold').innerText = item.banner_bold;
                // document.querySelector('.line-2 .thin-italic').innerText = item.banner_italic;
                // document.querySelector('.line-3').innerText = item.banner_line3;

                document.querySelector('.journey-title').innerText = item.banner_little_quote;
                document.querySelector('.journey-text').innerText = item.banner_little_description;
                document.querySelector('.secure-loan').innerText = item.button_textcontent;
                document.querySelector('.watch-demo').innerHTML = `<img src="assets/images/play-icon.png" alt="Video Icon" class="play-icon"> ${item.video_trigger_button}`;
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