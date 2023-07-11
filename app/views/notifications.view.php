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

        <div class="notifications__header">
           <h2>Notifications</h2>
            <div class="search__settings">
                <button class="drop-btn"><span class="fa fa-ellipsis-h"></span></button>
            </div>
        </div>

        <div class="notifications__swapper">
            <div>
                <a href="<?=ROOT?>/notifications/all"><span>All</span></a>
            </div>
            <div>
                <a href="<?=ROOT?>/notifications/verified"><span>Verified</span></a>
            </div>
            <div>
                <a href="<?=ROOT?>/notifications/mentions"><span>Mentions</span></a>
            </div>
        </div>
        <div class="notifications__body">
        <?php if($data['section'] == 'all'): ?>
        
            <a class="notifications__body-all-a" href="">
                <div class="notifications__body-all"><img src="<?=ROOT?>/assets/images/icon.png" alt=""></div>
                <span>There was a login to your account @maxit2301 from a new device on 08 трав. 2023. Review it now.</span>
            </a>

        <?php elseif($data['section'] == 'verified'): ?>
        <div class="notifications__body-verified">
            <img src="<?=ROOT?>/assets/images/verified.png">
            <h2>Nothing to see here — yet</h2>
            <p>Likes, mentions, Retweets, and a whole lot more — when it comes from a verified account, you’ll find it here. <a
                    href="https://help.twitter.com/en/managing-your-account/about-twitter-verified-accounts" target="_blank">Learn more</a></p>
        </div>
        <?php elseif ($data['section'] == 'mentions'): ?>
        <div class="notifications__body-mentions">
            <h2>Nothing to see here — yet</h2>
            <p>When someone mentions you, you’ll find it here.</p>
        </div>
        <?php endif;?>
         </div>

    </div>


    </div>

    <?php require_once "includes/right-sidebar-full.php"?>


</body>
</html>