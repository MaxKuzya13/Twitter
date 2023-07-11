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

<div class="grid-container">


    <?php require_once "includes/left-sidebar-full.php"?>

    <div class="main">
        <div class="profile-header">
            <div class="profile-back">
                <i class=""><a href="<?=ROOT?>/homefull"><img src="<?=ROOT?>/assets/images/back.png" width="20" height="20"></a></i>
            </div>
            <div class="header-text">
                <span><?=$profile->username?></span>
                <p>0 Tweets</p>
            </div>
        </div>
        <div class="profile-main">
            <div class="bg-phone"><img src="<?=get_image($profile->header)?>" alt=""></div>
            <div class="profile-main-two">
                <div class="profile-logo">
                    <div><img class="profile-avatar" src="<?=get_image($profile->avatar)?>"></div>
                    <?php if($profile->id == $user->id):?>
                        <div><a href="<?=ROOT?>/setup">Edit profile</a></div>
                    <?php else: ?>
                        <?php if(isset($follow) && !empty($follow)): ?>
                            <div>
                                <button><img src="<?=ROOT?>/assets/images/more.png" width="12" height="12"></button>
                                <form onsubmit="unfollow_to_user(event)" method="post">
                                    <button type="submit" id="unfollow" >Unfollow</button>
                                    <input type="hidden" id="account_id" value="<?=$follow->account_id?>">
                                    <input type="hidden" id="follower_id" value="<?=$follow->follower_id?>">
                                    <input type="hidden" id="follow_id" value="<?=$follow->id?>">
                                </form>
                            </div>
                        <?php else: ?>
                            <div>
                                <button><img src="<?=ROOT?>/assets/images/more.png" width="12" height="12"></button>
                                <form onsubmit="follow_to_user(event)" method="post">
                                    <button type="submit" id="follow" >Follow</button>
                                    <input type="hidden" id="account_id" value="<?=$profile->id?>">
                                    <input type="hidden" id="follower_id" value="<?=$user->id?>">
                                </form>
                            </div>
                        <?php endif ?>
                    <?php endif; ?>
                </div>
                <div class="profile-username">
                    <span><?=esc($profile->username)?></span>
                    <p>@<?=esc($profile->username)?></p>
                </div>
                <?php if(empty($profile->bio) && empty($profile->location) && empty($profile->website)):?>
                    <div class="profile-date">
                        <li><img src="<?=ROOT?>/assets/images/schedule.png" width="15" height="15"></li>
                        <span>Joined <?=esc($profile->month)?> <?=esc($profile->year)?></span>
                    </div>
                <?php else: ?>
                    <div class="profile-bio">
                        <span><?=esc($profile->bio)?></span>
                    </div>

                    <div class="profile-date">
                        <?php if($profile->location):?>
                            <li><img src="<?=ROOT?>/assets/images/location.png" width="15" height="15"></li>
                            <span><?=esc($profile->location)?></span>
                        <?php endif; ?>
                        <?php if($profile->year):?>
                            <li id="year"><img src="<?=ROOT?>/assets/images/schedule.png" width="15" height="15"></li>
                            <span>Joined <?=esc($profile->month)?> <?=esc($profile->year)?></span>
                        <?php endif; ?>
                    </div>


                <?php endif; ?>
                <div class="profile-follow">
                    <a href=""><span><?=esc($profile->following)?></span><p>Following</p></a>
                    <a href=""><span><?=esc($profile->followers)?></span><p>Followers</p></a>
                </div>

            </div>
        </div>
        <div class="profile-wrapper">

                <a href="<?=ROOT?>/profile/index/<?=$profile->id?>"><span>Tweets</span>
                    <div class="<?=(URL('section') == 'index') ? 'active_navigation_profile' : ''?>"></div>
                </a>
                <a href="<?=ROOT?>/profile/replies/<?=$profile->id?>"><span>Replies</span>
                    <div class="<?=(URL('section') == 'replies') ? 'active_navigation_profile' : ''?>"></div>
                </a>
                <a href="<?=ROOT?>/profile/media/<?=$profile->id?>"><span>Media</span>
                    <div class="<?=(URL('section') == 'media') ? 'active_navigation_profile' : ''?>"></div>
                </a>
                <a href="<?=ROOT?>/profile/likes/<?=$profile->id?>"><span>Likes</span>
                    <div class="<?=(URL('section') == 'likes') ? 'active_navigation_profile' : ''?>"></div>
                </a>

        </div>
        <?php if($data['section'] == 'tweets'):?>

            <?php if($rows && !empty($rows)): ?>
                <?php foreach ($rows as $row): ?>
                    <?php require 'tweetbox.view.php'?>
                <?php endforeach ?>
            <?php else: ?>

            <div class="profile-setup">
                <span>Let`s get you set up</span>
                <div class="profile-btn"><button class="profile-dropbtn fa fa-ellipsis-h""></button></div>
            </div>
            <div class="profile-icons">
                <a href="">
                    <img src="<?=ROOT?>/assets/images/profile_1.png" alt="">
                    <span>Complete your profile</span>
                </a>
                <a href="">
                    <img src="<?=ROOT?>/assets/images/follow_1.png" alt="">
                    <span>Follow 5 accounts</span>
                </a>
                <a href="">
                    <img src="<?=ROOT?>/assets/images/topics_1.png" alt="">
                    <span>Follow 3 Topics</span>
                </a>
            </div>
            <?php endif;?>

        <div class="profile-follow-wrapper">

            <h2>Who to follow</h2>

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

            <a class="profile-follow-wrapper-show" href="<?=ROOT?>/suggested">
                <span>Show more</span>
            </a>
        </div>
    </div>
        <?php elseif ($data['section'] == 'replies'): ?>
            <!--        // Те саме але міняються чели в Фоловерах-->

        <div class="profile-setup">
            <span>Let`s get you set up</span>
            <div class="profile-btn"><button class="profile-dropbtn fa fa-ellipsis-h""></button></div>
        </div>
        <div class="profile-icons">
            <a href="">
                <img src="<?=ROOT?>/assets/images/profile_1.png" alt="">
                <span>Complete your profile</span>
            </a>
            <a href="">
                <img src="<?=ROOT?>/assets/images/follow_1.png" alt="">
                <span>Follow 5 accounts</span>
            </a>
            <a href="">
                <img src="<?=ROOT?>/assets/images/topics_1.png" alt="">
                <span>Follow 3 Topics</span>
            </a>
        </div>

        <div class="profile-follow-wrapper">

            <h2>Who to follow</h2>

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

            <a class="profile-follow-wrapper-show" href="<?=ROOT?>/suggested">
                <span>Show more</span>
            </a>
        </div>
    </div>

    <?php elseif ($data['section'] == 'media'): ?>

        <div class="profile-follow-wrapper-media">
            <img src="<?=ROOT?>/assets/images/media.png" alt="">
            <h2>Lights, camera ... attachments!</h2>
            <span>When you send Tweets with photos or videos in them, they will show up here.</span>
        </div>
    </div>

    <?php elseif ($data['section'] == 'likes'): ?>



        <?php if($rowsLikes && !empty($rowsLikes)): ?>
            <?php foreach ($rowsLikes as $row): ?>
                <?php require 'tweetbox.view.php'?>
            <?php endforeach ?>
        <?php else: ?>
            <div class="profile-follow-wrapper-media">
                <h2>You don`t have any likes yet</h2>
                <span>Tap the heart on any Tweet to show it some love. When you do, it’ll show up here.</span>
            </div>
        <?php endif; ?>
    </div>
    <?php endif ?>





    <?php require_once "includes/right-sidebar-full.php"?>


</body>
</html>

<script>

    let coll = document.getElementsByClassName('tweet-btn');

    for(let i = 0; i < coll.length; i++)
    {
        coll[i].addEventListener('click', function(e){
            e.preventDefault();
            this.classList.toggle('active');
            let content = this.nextElementSibling;
            console.log(content);
            if(content.classList.contains('hide'))
            {
                content.classList.remove('hide');
            } else {
                content.classList.add('hide');
            }
        })
    }

    function follow_to_user(e)
    {
        e.preventDefault();

        let obj = {};

        obj.data_type = 'follow';
        obj.follower_id = e.currentTarget.querySelector("#follower_id").value.trim();
        obj.account_id = e.currentTarget.querySelector("#account_id").value.trim();

        send_data(obj);
    }

    function unfollow_to_user(e)
    {
        e.preventDefault();

        let obj = {};

        obj.data_type = 'unfollow';
        obj.follower_id = e.currentTarget.querySelector("#follower_id").value.trim();
        obj.account_id = e.currentTarget.querySelector("#account_id").value.trim();
        obj.id = e.currentTarget.querySelector("#follow_id").value.trim();

        send_data(obj);
    }

    function send_data(obj)
    {
        let myform = new FormData();

        for(key in obj)
        {
            myform.append(key, obj[key]);
        }

        var xhr = new XMLHttpRequest();


        xhr.addEventListener('readystatechange', function()
        {
            if (xhr.readyState == 4)
            {
                if(xhr.status == 200)
                {
                    handle_result(xhr.responseText);
                } else {
                    alert('Could not send data. Please check your connection')
                }
            }
        });
        xhr.open('post', '<?=ROOT?>/ajax', true);
        xhr.send(myform);
    }

    function handle_result(result)
    {
        console.log(result);
        let obj = JSON.parse(result);

        if(obj.success)
        {
            window.location.reload();
        } else {
            alert("Please fix the errors");
            for (key in obj.errors){
                alert(obj.errors[key]);
            }
        }

    }
</script>