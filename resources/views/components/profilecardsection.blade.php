<?php
$profileCards = [
    [
        "name" => "Mark Debrovski",
        "role" => "Designation",

        "starrating" => 5,
        "description" => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC. Lorem Ipsum is not simply random text.",

    ],
    [
        "name" => "Mark Debrovski",
        "role" => "Designation",

        "starrating" => 4,
        "description" => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC. Lorem Ipsum is not simply random text.",

    ],
    [
        "name" => "Mark Debrovski",
        "role" => "Designation",

        "starrating" => 2,
        "description" => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC. Lorem Ipsum is not simply random text.",

    ],
]
        ?>
<div class="profilecardsection">
    <div class="profilecardsection-inside">
        <img src="assets/images/leftclosevector.png"  alt="" class="openedvectorimage">

        <div class="profilecard-container">
            <div class="profilecard-additionalsideheader">
                <h1>Hear What <span>They</span> Say</h1>
            </div>

            <?php foreach ($profileCards as $items): ?>
            <div class="profilecard-container">
                <div class="profilecardsection-individual">
                    <div class="profilecard-firstrow">
                        <div class="profilecard-firstrowleft">
                            <img src="assets/images/dummyimage.png" alt="">
                        </div>
                        <div class="profilecard-firstrowright">
                            <h1><?php    echo $items["name"]; ?></h1>
                            <p><?php    echo $items["role"]; ?> </p>
                            <div class="profilecard-ratingcontainer">
                                <?php    for ($i = 0; $i < $items["starrating"]; $i++): ?>
                                <i class="fa-solid fa-star"></i>
                                <?php    endfor; ?>
                            </div>
                        </div>
                    </div>
                    <div class="profilecard-secondrow">
                        <p><?php    echo $items["description"]; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>



        </div>

        <img src="assets/images/rightclosevector.png" alt="" class="closedvectorimage">
    </div>


    <div class="pagenavigationcontainer" style="padding-right:5.5rem;padding-top:1rem;">
        <div class="leftnavigator">
            <i class="fa-solid fa-arrow-left leftarrownavigator"  id="lefticonnavigatorid"
                style="background-color: rgba(255, 255, 255, 1);color:rgba(217, 217, 217, 1)"></i>

        </div>
        <div style="background-color:rgba(255, 122, 0, 1);width:14px;height:14px"></div>
        <div style="background-color:rgba(217, 217, 217, 1);width:10px;height:10px"></div>
        <div style="background-color:rgba(217, 217, 217, 1);width:10px;height:10px"></div>
        <div class="rightnavigator">
            <i class="fa-solid fa-arrow-right rightarrownavigator" id="righticonnavigatorid"
                style="background-color: rgba(111, 37, 206, 1);color:rgba(255, 255, 255, 1)"></i>
        </div>

    </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const slideButton = document.getElementById('lefticonnavigatorid');
    const rightSlideButton = document.getElementById('righticonnavigatorid');
    const profileCard = document.querySelector('.profilecard-container');
    let currentPosition = 0;  // Track the current position of the card

    slideButton.addEventListener('click', function () {
        // Move the card to the left by 200px
        if (currentPosition === 0) {
            currentPosition = -200;  // Move left by 200px
            profileCard.classList.add('slide-left');
            profileCard.classList.remove('slide-right');
        } else if (currentPosition === 200) {
            currentPosition = 0;  // Return to original position
            profileCard.classList.remove('slide-left');
        }
    });

    rightSlideButton.addEventListener('click', function () {
        // Move the card to the right by 200px
        if (currentPosition === 0) {
            currentPosition = 200;  // Move right by 200px
            profileCard.classList.add('slide-right');
            profileCard.classList.remove('slide-left');
        } else if (currentPosition === -200) {
            currentPosition = 0;  // Return to original position
            profileCard.classList.remove('slide-right');
        }
    });
});

</script>