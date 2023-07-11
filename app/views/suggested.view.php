<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home / Twitter</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/home-full.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body class="grid-container">


    <?php require_once "includes/left-sidebar-full.php"?>

    <div class="main">
        <div class="profile-header">
            <div class="profile-back">
                <i class=""><a href="<?=ROOT?>/home">back</a></i>
            </div>
            <div class="header-text">
                <span>Connect</span>
            </div>
        </div>

        <div class="profile-follow-wrapper">

            <h2>Suggested for you</h2>

            <div class="profile-follow-box">
                <div class="profile-follow-followers">
                    <svg></svg>
                    <span>Serhiy Prytula follows</span>
                </div>
                <div class="profile-follow-main">
                    <div class="">
                        <img src="<?=ROOT?>/assets/images/no_image.jpg" alt="">
                    </div>
                    <div class="profile-follow-box-main">
                        <div class="profile-follow-box-header">
                            <div>
                                <span>Михайло подоляк</span>
                                <p>@Podolyak_M</p>
                            </div>
                            <button>Follow</button>
                        </div>
                        <div class="profile-follow-box-desc">
                            <span>Adviser to the Head of the Office</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-follow-box">
                <div class="profile-follow-followers">
                    <svg></svg>
                    <span>Serhii Sternenko follows</span>
                </div>
                <div class="profile-follow-main">
                    <div class="">
                        <img src="<?=ROOT?>/assets/images/no_image.jpg" alt="">
                    </div>
                    <div class="profile-follow-box-main">
                        <div class="profile-follow-box-header">
                            <div>
                                <span>Serhiy Prytula</span>
                                <p>@Prytula_S</p>
                            </div>
                            <button>Follow</button>
                        </div>
                        <div class="profile-follow-box-desc">
                            <span>постачальник бавовни | Ukrainian activist, vlogger, volunteer</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php require_once "includes/right-sidebar-full.php"?>


</body>
</html>