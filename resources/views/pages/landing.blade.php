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
        

        <!-- <div class="lineargradientbackground">
                    <?php $backgroundLinearBackground = "assets/images/BG Linear gradient.png"; ?>
                    <img src="<?php echo $backgroundLinearBackground; ?>" alt="Background Image">
                </div> -->
 @include('components.herosection', [
         'landingpageContents'=>$landingpageContents

        ])
      @include('components.profilecardsection', [
        'combinedTestimonials'=>$combinedTestimonials,
        'landingpageContents'=>$landingpageContents

        ])
      @include('components.inforecords', [
        'study_loan' => $study_loan,
        'landingpageContents'=>$landingpageContents
        ])
      @include('components.graphflow', [
        'landingpageContents'=>$landingpageContents
        ])
      



  
@include('components.faqsection', [
    'combinedFaqs' => $combinedFaqs
])

         @endsection


    <script>
       


        document.addEventListener("DOMContentLoaded", () => {
            getInfoDetailHomepage();
        });

    </script>


</body>

</html>