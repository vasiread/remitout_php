 
 
 
 <?php
$locationIcon = '<i class="fa-solid fa-location-dot"></i>';
$calenderIcon = '<i class="fa-solid fa-calendar"></i>';
$ticketIcon = '<i class="fa-solid fa-ticket-simple"></i>';
$lockerIcon = '<i class="fa-solid fa-lock"></i>';
$cardServiceDetails = [
    [
        "icon" => $locationIcon,
        "serviceName" => "Integrated Support, Anytime, Anywhere",
        "serviceBrief" => "Instant support builds trust and enhances experience!"
    ],
    [
        "icon" => $calenderIcon,
        "serviceName" => "Rapid Processing",
        "serviceBrief" => "Easy student remittance in just a few steps!"
    ],
    [
        "icon" => $ticketIcon,
        "serviceName" => "Best Price Commitment",
        "serviceBrief" => "Transparent, competitive exchange rates guaranteed!"
    ],
    [
        "icon" => $lockerIcon,
        "serviceName" => "Absolutely Protected",
        "serviceBrief" => "Instant transfers, no fees, 24/7 support!"
    ],
]
        ?>


    <div class="Homepageservices">
        <div class="Homepageservices-container">
            <div class="Homepageservices-leftcontent">
                <h1 class="Homepageservices-header">Where your safety meets
                    smart lending</h1>
                <div class="Homepageservices-cardgroupedinfos">
                    <?php foreach ($cardServiceDetails as $items): ?>
                        <div class="Homepageservices-individuals">
                            <div class="services-iconcontainer">
                                <?php    echo $items["icon"]; ?>
                            </div>
                            <div class="services-infocontainer">
                                <h1><?php    echo $items["serviceName"]; ?> </h1>
                                <p><?php    echo $items["serviceBrief"]; ?> </p>
                            </div>

                        </div>
                    <?php endforeach ?>

                </div>
                <button>Secure your loan now!</button>


            </div>
            <?php $circleImage = "assets/images/Circle.png";
$RadcliffeCamera = "assets/images/Radcliffe Camera.svg";
            ?>
            <div class="Homepageservices-rightcontent">
                <img src="<?php echo $circleImage; ?>" class="services-circle" alt="">
                <img src="<?php echo $RadcliffeCamera; ?>" class="services-camera" alt="">



            </div>
        </div>
    </div>