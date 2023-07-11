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
        <div class="explore__main">
        <div class="search__wrapper">
            <div class="search__box">
                <a href="#" class="search-btn">
                    <i class="fa fa-search"></i>
                </a>
                <input type="text" name="search" placeholder="Search Twitter" class="search-input">
            </div>
            <div class="search__settings">
                <button class="drop-btn"><span class="fa fa-ellipsis-h"></span></button>
            </div>
        </div>

        <h2>Trends for you</h2>

        <div class="trends__body-full">
            <div class="trend-full">
                <div class="trend-full-body">
                    <span>Trending</span>
                    <p>#Kuzya</p>
                    <span>22.6K Tweets</span>
                </div>
                <div class="trend__del">
                    <div class="drop">
                        <button class="drop-btn"><span class="fa fa-ellipsis-h"></span></button>
                        <div class="drop-content">
                            <a href="#"><img src="<?=ROOT?>/assets/images/bug.svg"<span>No interested in this</span></a>
                            <a href="#"><img src="<?=ROOT?>/assets/images/bug.svg"<span>This trend is harmful or spamy</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="trend-full">
                <div class="trend-full-body">
                    <span>Trending</span>
                    <p>#Kuzya</p>
                    <span>22.6K Tweets</span>
                </div>
                <div class="trend__del">
                    <div class="drop">
                        <button class="drop-btn"><span class="fa fa-ellipsis-h"></span></button>
                        <div class="drop-content">
                            <a href="#"><img src="<?=ROOT?>/assets/images/bug.svg"<span>No interested in this</span></a>
                            <a href="#"><img src="<?=ROOT?>/assets/images/bug.svg"<span>This trend is harmful or spamy</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="explore__show-more-full">
                <a href="<?=ROOT?>/trends">Show more</a>
            </div>
        </div>

        <div class="happen">
            <h2>What`s happening</h2>
        </div>

        <div class="explore__happening">

            <div class="explore__happening-box">
                <div class="explore__happening-header">
                    <span class="explore__happening-header-span">NBA</span>
                    <div class="">
                        <span>Final</span>
                        <li></li>
                        <p>BO5 won</p>
                    </div>
                </div>
                <div class="explore__happening-main">
                    <div class="explore__happening-team-one">
                        <img src="<?=ROOT?>/assets/images/no_image.jpg" alt="">
                        <h3>Boston Celtics</h3>
                        <span>95</span>
                    </div>
                    <div class="explore__happening-team-two">
                        <img src="<?=ROOT?>/assets/images/no_image.jpg" alt="">
                        <h3>Denver Nuggets</h3>
                        <span>32</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="explore__happening-box">
            <div class="explore__happening-header">
                <span class="explore__happening-header-span">NBA</span>
                <div class="">
                    <span>Final</span>
                    <li></li>
                    <p>BO5 won</p>
                </div>
            </div>
            <div class="explore__happening-main">
                <div class="explore__happening-team-one">
                    <img src="<?=ROOT?>/assets/images/no_image.jpg" alt="">
                    <h3>Boston Celtics</h3>
                    <span>95</span>
                </div>
                <div class="explore__happening-team-two">
                    <img src="<?=ROOT?>/assets/images/no_image.jpg" alt="">
                    <h3>Denver Nuggets</h3>
                    <span>32</span>
                </div>
            </div>
        </div>

        <div class="explore__show-more-full">
            <a href="">Show more</a>
        </div>

    </div>
    </div>



    </div>

    <?php require_once "includes/right-sidebar-full.php"?>


</body>
</html>