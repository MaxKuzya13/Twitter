<div class="sidebar" >
    <div class="sidebar-wrapper">

        <div class="sidebar-wrapper-main">
            <article class="sidebar-wrapper-main-home">
                <form action="<?=ROOT?>/homefull">
                    <button ><img src="<?=ROOT?>/assets/images/twitter.png"></button>
                </form>
            </article>

            <?php if(URL('page') == 'homefull'): ?>
                <a href="<?=ROOT?>/homefull" class="active">
                    <div class="inline-container"><img src="<?=ROOT?>/assets/images/home_active.png"><span>Home</span></div>
                </a>
            <?php else: ?>
                <a href="<?=ROOT?>/homefull">
                    <div class="inline-container"><img src="<?=ROOT?>/assets/images/home.png"><span>Home</span></div>
                </a>
            <?php endif; ?>

            <?php if(URL('page') == 'explore'): ?>
                <a href="<?=ROOT?>/explore" class="active"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/search_active.png"><span>Explore</span></div>
                </a>
            <?php else: ?>
                <a href="<?=ROOT?>/explore"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/search.png"><span>Explore</span></div>
                </a>
            <?php endif; ?>

            <?php if(URL('page') == 'notifications'): ?>
                <a href="<?=ROOT?>/notifications" class="active"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/notification_active.png"><span>Notifications</span></div>
                </a>
            <?php else: ?>
                <a href="<?=ROOT?>/notifications"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/notification.png"><span>Notifications</span></div>
                </a>
            <?php endif; ?>

            <?php if(URL('page') == 'messages'): ?>
                <a href="<?=ROOT?>/messages" class="active"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/envelope_active.png"><span>Messages</span></div>
                </a>
            <?php else: ?>
                <a href="<?=ROOT?>/messages"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/envelope.png"><span>Messages</span></div>
                </a>
            <?php endif; ?>

            <?php if(URL('page') == 'lists'): ?>
                <a href="<?=ROOT?>/lists" class="active"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/page_active.png"><span>Lists</span></div>
                </a>
            <?php else: ?>
                <a href="<?=ROOT?>/lists"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/page.png"><span>Lists</span></div>
                </a>
            <?php endif; ?>

            <?php if(URL('page') == 'bookmarks'): ?>
                <a href="<?=ROOT?>/bookmarks" class="active"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/unbookmark.png"><span>Bookmarks</span></div>
                </a>
            <?php else: ?>
                <a href="<?=ROOT?>/bookmarks"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/bookmark.png"><span>Bookmarks</span></div>
                </a>
            <?php endif; ?>

            <?php if(URL('page') == 'verified'): ?>
                <a href="" class="active"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/verified_active.png"><span>Verified</span></div>
                </a>
            <?php else: ?>
                <a href=""><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/verified.png"><span>Verified</span></div>
                </a>
            <?php endif; ?>

            <?php if(URL('page') == 'profile'): ?>
                <a href="<?=ROOT?>/profile/<?=$user->id?>" class="active"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/profile_active.png"><span>Profile</span></div>
                </a>
            <?php else: ?>
                <a href="<?=ROOT?>/profile/<?=$user->id?>"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/profile.png"><span>Profile</span></div>
                </a>
            <?php endif; ?>

            <?php if(URL('page') == 'more'): ?>
                <a href="" class="active"><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/more_active.png"><span>More</span></div>
                </a>
            <?php else: ?>
                <a href=""><div class="inline-container">
                        <img src="<?=ROOT?>/assets/images/more.png"><span>More</span></div>
                </a>
            <?php endif; ?>



            <div class="sidebar-wrapper-main-btn"><a href="<?=ROOT?>/tweet">Tweet</a></div>
        </div>


           <button onclick="show_block(event)" class="sidebar-wrapper-footer">
                <div class="sidebar-wrapper-footer-image"><img src="<?=get_image($user->avatar)?>"></div>
                <div class="sidebar-wrapper-footer-body">
                    <span><?=$user->username?></span>
                    <p>@<?=$user->username?></p>
                </div>
               <div class="sidebar-wrapper-footer-btn"><img src="<?=ROOT?>/assets/images/more.png"></div>

           </button>

        <div class="sidebar-wrapper-main-block hide" >
            <div> <button onclick="hide_block(event)"><img src="<?=ROOT?>/assets/images/exit.png" width="12" height="12"></button></div>
            <a class="">Add an existing account</a>
            <a href="<?=ROOT?>/logout" class="">Log out @<?=$user->username?></a>
        </div>
    </div>
</div>

<script>
    function show_block(e)
    {
        e.preventDefault();
        document.querySelector('.sidebar-wrapper-main-block').classList.remove('hide');
    }

    function hide_block(e)
    {
        e.preventDefault();
        document.querySelector('.sidebar-wrapper-main-block').classList.add('hide');
    }


</script>