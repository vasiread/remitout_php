 <?php $recordMaskImage = "assets/images/recordMaskimg.png"; ?>
    <div class="inforecords">
        <div class="inforecords-firstrow">
            <img src="<?php echo $recordMaskImage; ?>" alt="">
            <div class="inforecords-details">
                <h1>Effortless and affordable
                    global transfers!</h1>
                <p>Support loved ones abroad by sending money from India
                    for education and expenses. Transfer
                    to 40+ countries with real exchange rates,
                    no hidden fees. Sign up easily online with your PAN and address.</p>
            </div>
        </div>
        <div class="inforecords-secondrow">
            <div class="inforecords-groupicons">
                <img src="assets/images/iconrecords/profile.png" alt="proile">
                <img src="assets/images/iconrecords/balance.png" alt="balance">
                <img src="assets/images/iconrecords/flag.png" alt="flag">
                <img src="assets/images/iconrecords/smile.png" alt="smile">
            </div>
            <?php
$infoRecords = [
    [
        "count" => "500+",
        "subject" => "Students"
    ],
    [
        "count" => "100",
        "subject" => "NBFCs"
    ],
    [
        "count" => "40+",
        "subject" => "Countries"
    ],
    [
        "count" => "2k+",
        "subject" => "Happy customers"
    ],
]
                ?>

            <div class="inforecords-groupiconsinfos">
                <?php foreach ($infoRecords as $details): ?>
                    <div class="inforecords-individualcards">
                        <h1><?php    echo $details["count"]; ?></h1>
                        <p><?php    echo $details["subject"]; ?></p>



                    </div>

                <?php endforeach ?>


            </div>
        </div>



    </div>
