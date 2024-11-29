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




</body>
</html>