<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'wmpConstants.php'; ?>
    <?php include 'meta_inc.php'; ?>
    <!-- css -->

    <?php include 'css_inc.php'; ?>
    <style>

        .instr-container {

            padding-bottom: 50%;
            padding-top: 35px;
            height: 0;
            overflow: hidden;
        }

        .instr-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        h2 {
            padding-top: 60px;
            margin-top: -40px;
        }

        /* float table of content */

        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            top: 60px;
            right: 5px;
            /* background-color: #0C9; */
            /* color: #FFF; */
            border-radius: 50px;
            text-align: center;
            /* box-shadow: 2px 2px 3px #999; */
        }

        .float-toc {
            position: fixed;
            /*width: 60px;
            height: 60px;*/
            top: 122px;
            right: 0;
            background-color: #d1d2d4;
            /* color: #FFF; */
            border-radius: 0 0 5px 5px;
            text-align: left;
            padding: 10px;
        }


        .my-float {
            margin-top: 22px;
        }

        .tocontents{
            width: 280px;
            height: 0;
            border-top: 20px solid #939597;
            border-bottom: 20px solid #939597;
            border-left: 20px solid transparent;
            float: right;
            top: 82px;
            right: 0;
            position: fixed;
            transform: translateX(210px);
            transition: .15s ease;
        }
        .tocontents:hover {
            cursor: pointer;
            transform: translateX(200px);
        }
        .tocontents-label {
            margin-top: -10px;
            padding: 0 20px;
            color: white;
        }
        .hidden-closed {
            display: none;
        }


        @keyframes slide-in {
            0% {
                opacity: 1;
                transform: translateX(80px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }


        .animation-up {
            /*-ms-flex-positive: 1;
            flex-grow: 1;
            transform: scale(.95);
            transform-origin: 100% 0;
            opacity: 0;
            will-change: transform,opacity;
            transition-property: transform,opacity;
            transition-duration: .25s;*/
            animation:ButtonSlide 0.20s ease;

        /* animation-delay: 2s; */
        /* animation-fill-mode: both; */


        }

        @keyframes ButtonSlide {
            0% {
                opacity: 1;
                transform: translateX(80px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animation-down {
                animation:ButtonSlideDisolve 0.20s ease;
            animation-fill-mode: both;
        }

        /*@keyframes ButtonSlideDisolve {from{opacity:1} to{opacity:0}}*/

        @keyframes ButtonSlideDisolve {
            0% {
                opacity: 1;
                transform: translateX(0);
            }

            100% {
                opacity: 1;
                transform: translateX(250px);
            }
        }

    </style>

</head>
<body class="home" id="body">

<?php include 'loader.php'; ?>

<?php include 'top_nav.php'; ?>

<!-- <div id="float-button">
    <a href="#/" class="float">

        <i onclick="enableTOC()" class="fa fa-info fa-lg my-float"></i>

    </a>
</div>-->

<a onclick="enableTOC()"><div class="tocontents" id="tocontents">
    <div class="tocontents-label">
        <i class="fa fa-info" aria-hidden="true"></i> <span style="padding-left:33%;">Contents</span>
    </div>
</div></a>



<div id="float-toc" class="float-toc" style="display: none;">
    <!-- <div style="float:right;margin-right: -20px;margin-top: -6px;">
        <a href="#/">
            <i onclick="disableTOC()" class="fa fa-times fa-lg"></i>
        </a>
    </div>
    <h1>Contents</h1>-->
    <ul>
        <li><a href="#homescreen" onclick="enableTOC()">Home Screen</a></li>
        <li><a href="#checkingin" onclick="enableTOC()">Checking In</a></li>
        <li><a href="#checkinginaunit" onclick="enableTOC()">Checking in a Unit</a></li>
        <li><a href="#multiselect" onclick="enableTOC()">Multi-Select</a></li>
        <li><a href="#navigation" onclick="enableTOC()">Navigation</a></li>
        <li><a href="#persondetails" onclick="enableTOC()">Person Details</a></li>
        <li><a href="#menu" onclick="enableTOC()">Menu</a></li>
        <li><a href="#howtogethelp" onclick="enableTOC()">How to Get Help</a></li>
        <li><a href="#frequentlyaskedquestions" onclick="enableTOC()">Frequently Asked Questions</a></li>
    </ul>
</div>
<!-- content -->
<div class="container" id="parent">
    <div class="row" id="">
        <div style="padding-left: 25px;padding-right: 25px;">
            <div>

                <h2 id="top">Instructions</h2>

                <!--
                <h1>Contents</h1>
                <ul>
                    <li><a href="#homescreen">Home Screen</a></li>
                    <li><a href="#checkingin">Checking In</a></li>
                    <li><a href="#checkinginaunit">Checking in a Unit</a></li>
                    <li><a href="#multiselect">Multi-Select</a></li>
                    <li><a href="#navigation">Navigation</a></li>
                    <li><a href="#persondetails">Person Details</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#howtogethelp">How to Get Help</a></li>
                    <li><a href="#frequentlyaskedquestions">Frequently Asked Questions</a></li>
                </ul>

                <br>
                <hr>
                <br>-->

                <h2 id="homescreen">Home Screen</h2>

                <p>Upon logging in to Peeps, you will see your home screen.</p>

                <p>The home screen displays:</p>

                <ul>
                    <li>Status Bar – The top bar of the application now shows event
                        status information
                    </li>
                    <li style="list-style:none">
                        <ul>
                            <li>Read-Only – When no incidents are in progress, you will see a
                                lock icon and the text "READ-ONLY"
                            </li>
                            <li>Evacuation – Once an evacuation is in progress, the status will
                                display an exclamation mark icon and the text "EVACUATION"
                            </li>
                            <li>All Clear – Once the emergency management team has declared the building safe to enter,
                                the status will display with a smiley face icon and the
                                text "ALL CLEAR"
                            </li>
                        </ul>
                    </li>
                    <li>Home and Refresh Buttons</li>
                    <li>Your Information</li>
                    <li>Progress Bar – A graphical indicator of how many people in your accounting structure have been
                        accounted for
                    </li>
                    <li>Scoreboard – Real-time count of status of all people within your
                        reporting structure
                    </li>
                    <li>Your Direct Reports – All those that you are responsible for
                        checking in
                    </li>
                    <li>Subordinate Units – Any units in your reporting structure</li>
                </ul>

                <p>
                    Note: Typically,
                    your direct reports are responsible for checking in their employees, but you
                    can check in any employee on their behalf by navigating through the
                    organization structure.
                </p>

                <img width=254 height=441 id="Picture 1"
                     src="<?php ECHO APP_RESOURCE_PATH; ?>/images/instructions/image001.png"
                     alt="">

                <img width=254 height=198 id="Picture 5"
                     src="<?php ECHO APP_RESOURCE_PATH; ?>/images/instructions/image002.png"
                     alt="">


                <h2 id="checkingin">Checking In</h2>

                <p><b>Step 1: Swipe</b></p>

                <p>Swipe from right to left on a direct report’s name to show
                    the check-in options</p>

                <p><b>Step 2: Tap</b></p>

                <p>Tap on the appropriate status for the direct report</p>

                <p><b>Step 3: Repeat</b></p>

                <p>Continue checking in staff using one of these three
                    options: In, Out, or Missing. </p>

                <p><img width=258 height=228 id="Picture 4"
                        src="<?php ECHO APP_RESOURCE_PATH; ?>/images/instructions/image003.png"
                        alt="">
                </p>

                <p>Note: As you check staff in, your progress bar and
                    scoreboard will be updated accordingly.</p>

                <p>As you enter data, your manager will be able to monitor
                    your progress on their progress bar and scoreboard. <u>Marking someone as
                        missing is a big deal, so we ask you to confirm. </u></p>

                <p>Once you have checked in all of your team, keep the Peeps
                    app open so you can be notified when the all-clear is given for re-entering the
                    buildings.</p>


                <h2 id="checkinginaunit">Checking in a Unit</h2>

                <p>To save time, Peeps allows you to check in an entire unit.
                    Swipe and tap just as you would for a direct report.</p>

                <p><b>Step 1: Swipe from right to left</b></p>

                <p><b>Step 2: Tap on the appropriate status</b></p>

                <p><b>Step 3: Adjust</b></p>

                <p>To adjust an individual status, tap the unit, then swipe
                    and tap the correct status. You can return to the home screen by using the
                    navigation bar or tapping on the home icon. Once adjusted, the unit will
                    display the total number of staff accounted for by In, Out, and Missing.</p>

                <p><img width=254 height=121 id="Picture 6"
                        src="<?php ECHO APP_RESOURCE_PATH; ?>/images/instructions/image004.png"
                        alt=""></p>


                <h2 id="multiselect">Multi-Select</h2>

                <p>To speed up checking in multiple people or units at the
                    same time, a new feature was added to Peeps. To activate the multi-select
                    feature, press and hold the photo icon of the first person or unit you are
                    checking in until the blue “plus” icon appears. Continue to select more people
                    or units by pressing on the photo. When you have completed your selection, tap <b>In</b>,
                    <b>Out</b>, or <b>Missing</b> to assign a status for the whole selection.  You
                    will be prompted to confirm your selection.  You can also cancel your selection
                    by tapping on <b>Cancel</b>.</p>

                <p><img width=254 height=441 id="Picture 7"
                        src="<?php ECHO APP_RESOURCE_PATH; ?>/images/instructions/image005.png"
                        alt="">
                </p>


                <h2 id="navigation">Navigation</h2>

                <p>Navigation is easier now when organizational structures
                    get very deep. You can just tap on the image of the manager of the unit to move
                    up levels or all the way to the top. You can always use the home button to get
                    back to your original view.</p>

                <p><img width=254 height=219 id="Picture 3"
                        src="<?php ECHO APP_RESOURCE_PATH; ?>/images/instructions/image006.png"
                        alt=""></p>


                <h2 id="persondetails">Person Details</h2>

                <p>Access detailed profile information about a person by
                    tapping on their name. From the details screen you can view:</p>

                <ul>
                    <li>Team member’s photo – tap the thumbnail for an enlarged view,
                        which is helpful for checking in people you may not know
                    </li>
                    <li>Contact information – Work, cell, and email contact information,
                        as available in PeopleSoft
                    </li>
                    <li>Status history – this shows the date and time of the last
                        check-in, and who checked the person in
                    </li>
                </ul>


                <p><img width=254 height=441 id="Picture 8"
                        src="<?php ECHO APP_RESOURCE_PATH; ?>/images/instructions/image007.png"
                        alt="">
                </p>


                <h2 id="menu">Menu</h2>

                <p>To access the menu, tap the icon on the upper-left.</p>

                <p><img width=254 height=441 id="Picture 9"
                        src="<?php ECHO APP_RESOURCE_PATH; ?>/images/instructions/image008.png"
                        alt="">
                </p>

                <p><b>Reports</b></p>

                <p>Access reports for employees that are designated as
                    missing or who are not yet accounted for.</p>

                <p><b>Emergency Contacts</b></p>

                <p>The Emergency Contacts section contains contact
                    information for CalPERS team members, Colliers, and External Resources (such as
                    the fire department).</p>

                <p><b>Instructions</b></p>

                <p>This section contains basic information about how to use
                    Peeps featured and can be accessed at your convenience.</p>

                <p><b>Manage Events</b></p>

                <p>Only designated emergency management personnel have access
                    to this menu.  This menu is used to activate an emergency event, declare an
                    all-clear signal, and close out events for final reporting.</p>

                <p><b>Sign Off</b></p>

                <p>Log out from the Peeps app once an event is over.</p>


                <h2 id="howtogethelp">How to Get Help?</h2>

                <p>If you have any questions or issues using the Where’s My
                    Peeps application, please contact the <a
                            href="mailto:Emergency_Management@calpers.ca.gov">Emergency Management</a>
                    email box. </p>

                <p>If you see any issues with the data on your team roster
                    displayed in Peeps, contact your division’s personnel liaison. Your liaison
                    will work with Human Resources to correct the data in the PeopleSoft system.</p>

                <h2 id="frequentlyaskedquestions">Frequently Asked Questions</h2>

                <p><b>What username and password should I use?</b></p>

                <p>User your regular network username and password to access Peeps.</p>

                <p><b>What if I am out of the office during an evacuation?
                        Who will check in my team members?</b></p>

                <p>If you are out of the office, your manager will be able to
                    check in your team members using the app. Paper checklists can always be used
                    in lieu of the app.</p>

                <p><b>When I log into Peeps, I am not seeing all of my
                        employees or consultants. What do I do?</b></p>

                <p>If you are seeing people who are not in your reporting
                    structure or if you are missing people, it’s more than likely a data issue. Contact
                    your division’s personnel liaison for assistance. Your liaison will work with
                    Human Resources to correct the data in the PeopleSoft system.</p>

                <p><b>I don’t have a CalPERS issued mobile device and I don’t
                        want to use my personal phone to access Where’s My Peeps.</b></p>

                <p>The Where’s My Peeps app is an electronic alternative to
                    the paper checklists. You can continue to use a manual process to check in your
                    team members and report your counts to your manager. Your manager will be able
                    to check in your team using the app.</p>

                <p><b>How do I download Where’s My Peeps to my phone?</b></p>

                <p>Where’s My Peeps is a web-based application that’s
                    designed to use all the features of your phone, like swiping and tapping
                    gestures.  You don’t need to download it to your phone. Just navigate to this
                    address: <a href="http://www.calpers.ca.gov/wmp/"
                                title="Access Where's My Peeps">www.calpers.ca.gov/wmp/</a>. There are
                    instructions in this job aid to help you save Peeps as an icon on your iPhone
                    or Android mobile device.</p>

                <p><b>Now that we can access our team roster through Peeps,
                        do I still need to have my paper checklist?</b></p>

                <p>While Where’s My Peeps makes accounting for your employees
                    easier, it’s still a good idea to keep the paper list in your backpack though,
                    just in case phone service is down.</p>

                <p><b>I’m trying to use Peeps and I can’t check in any staff
                        because the app says read-only. What do I do?</b></p>

                <p>Where’s My Peeps is designed for use during emergency
                    evacuations (or drills). Unless there is an evacuation in progress, the app
                    status will display <b>Read-Only</b> in the status bar.</p>

            </div>
        </div>
    </div>

    <?php require_once("common_modals.php"); ?>
    <!-- end of modals -->
</body>

<?php require_once("js_inc.php"); ?>
<!-- javascript -->


<!--[if lt IE 9]>
<script src="/wmp/resources/js/html5shiv.min.js"></script>
<script src="/wmp/resources/js/respond.min.js"></script>
<![endif]-->

<script>

    var floater = document.getElementById("float-toc");

    function enableTOC() {


        if (floater.classList.contains("animation-up")) {
            $("#float-button").css("display", "block");
            $("#tocontents").css("transform", "translateX(220px)");
            animationDown();
        } else {
            // $("#float-toc").css("display", "block");
            $("#float-button").css("display", "none");
            $("#tocontents").css("transform", "translateX(0)");

            animationUp();
        }
    }

    function disableTOC() {
        animationDown();
        //$("#float-toc").css("display", "none");
        $("#float-button").css("display", "block");
        //$("#float-toc").toggleClass("toc-animation");
    }



    function animationUp() {

        if (!floater.classList.contains("animation-up")) {

            //go up
            floater.style.display = 'block';
            floater.addEventListener('webkitAnimationEnd', function (event) {
                floater.style.display = 'block';
            }, false);
            floater.classList.remove("animation-down");
            floater.classList.add("animation-up");
        }
    }

    function animationDown() {

        if (floater.classList.contains("animation-up")) {

            //go down
            floater.classList.remove("animation-up");
            floater.classList.add("animation-down");
            floater.addEventListener('webkitAnimationEnd', function (event) {
                floater.style.display = 'none';
            }, false);
            //floater.style.display = 'none';
        }


    }

    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 500);
    });

</script>

<script type="text/javascript">
    $('.single-item').slick({
        arrows: false,
        infinite: false,
        speed: 0
    });

    $(window).load(function () {


        $(".loader").fadeOut("slow");
    })


</script>


</html>