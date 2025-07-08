<div class="scmember-profilecontainer" style="display: none;">
    <div class="scmember-profilecontainerimg">
        <img src="" id="studentcounsellor-profile" alt="Profile">
        <i class="fa-regular fa-pen-to-square"></i>
    </div>

    <div class="scmember-rowfirst">
        <h1>Student Counsellor</h1>
    </div>

    <p id="screferral-id-fromprofile">Referral Number: <span></span></p>

    <div id="screferral-dob-fromprofile" inputmode="Date">
        <i class="fa-solid fa-calendar"></i>
        <p id="dob-display"></p>
    </div>

    <div id="screferral-dob-fromprofile-editmode" style="display: none;">
        <i class="fa-solid fa-calendar"></i>
        <input type="date" id="dob-input">
    </div>

    <ul class="scmember_personalinfo">
        <li class="scmember_personal_info_name" id="referenceNeId">
            <img src="{{ $profileIconPath }}" alt="SC Profile personal name Icon">
            <p></p>
        </li>
        <li class="scmember_personal_info_phone">
            <img src="{{ $phoneIconPath }}" alt="SC Profile Phone Icon">
            <p></p>
        </li>
        <li class="scmember_personal_info_email" style="word-break: break-all;" id="referenceEmailId">
            <img src="{{ $mailIconPath }}" alt="SC Profile Email Icon">
            <p></p>
        </li>
        <li class="scmember_personal_info_state">
            <img src="{{ $pindropIconPath }}" alt="SC Profile location Icon">
            <p style="line-height:19px"></p>
        </li>
    </ul>
</div>
