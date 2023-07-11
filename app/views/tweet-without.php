<div class="full-box">
    <div class="tweet-box-without">
        <div class="tweet-box-without-header">
            <div class="tweet-box-without-left">
                <a href="">
                    <img src="<?=get_image($tweet->avatar ?? "")?>" width="50" height="50">
                </a>
            </div>
            <div class="tweet-box-without-body">
                <div class="tweet-box-without-body-left">
                    <a href="<?=ROOT?>/profile/<?=$tweet->user_id?>" class="tweet-name"><?=esc($tweet->username ?? '')?></a>
                    <p class="tweet-username">@<?=esc($tweet->username ?? '')?></p>
                </div>
                <div class="tweet-box-without-body-right">
                    <div class="dropdown">
                        <button type="button" class="dropbtn tweet-without-btn"><img src="<?=ROOT?>/assets/images/more.png" width="23" height="23"></button>
                        <div class="dropdown-content hide">
                            <button ><i class="far fa-trash-alt"></i><span>More</span></button>
                            <button><i class="far fa-trash-alt"></i><span>Woto</span></button>
                            <?php if($tweet->user_id == $user->id) : ?>
                                <form onsubmit="delete_tweet(event)" method="post">
                                    <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                    <button><i class="far fa-trash-alt"></i><span>Delete</span></button>
                                </form>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>

            <div class="tweet-without-desc"><?=esc($tweet->description ?? 'text')?></div>

            <?php if(!empty($tweet->file)): ?>
                <div class="tweet-files">
                    <img src="<?=get_image($tweet->file ?? "")?>" alt="">
                </div>
            <?php endif; ?>

            <div class="date_box-without">
                <time>8:13PM Jun 2, 2023</time>
                <span>327K</span>
                <p>Views</p>
            </div>

            <div class="info_box-without">
                <div class="info_box-without-retweet"><span><?=esc($tweet->retweet)?></span><p>Retweets</p></div>
                <div class="info_box-without-quotes"><span><?=esc($tweet->views)?></span><p>Views</p></div>
                <div class="info_box-without-likes"><span><?=esc($tweet->likeable)?></span><p>Likes</p></div>
                <div class="info_box-without-bookmarks"><span><?=esc($tweet->bookmark)?></span><p>Bookmarks</p></div>
            </div>

            <div class="icons-wrapper-without">
                <div>
                    <form action="<?=ROOT?>/homefull/compose/<?=$tweet->id?>">
                        <button class="reply_hover"><img src="<?=ROOT?>/assets/images/comment.png" width="23" height="23"></button>
                    </form>
                </div>

                <div>
                    <?php if(isset($retweetTweet) && !empty($retweetTweet)): ?>

                        <?php $results = [];?>

                        <?php foreach ($retweetTweet as $retweet): ?>
                            <?php $results[] = $retweet->tweet_id ?>
                            <?php if($retweet->tweet_id == $tweet->id) : ?>
                                <form method="post" onsubmit="delete_retweet(event)">

                                    <button class="retweet_hover"><img src="<?=ROOT?>/assets/images/unretweet.png" width="23" height="23"></button>
                                    <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                    <input type="hidden" id="user_id" value="<?=$tweet->user_id?>">
                                    <input type="hidden" id="retweet_id" value="<?=$retweet->id?>">
                                </form>

                            <?php endif; ?>
                        <?php endforeach?>
                        <?php if(!in_array($tweet->id, $results)): ?>
                            <form method="post" onsubmit="new_retweet(event)">

                                <button class="retweet_hover"><img src="<?=ROOT?>/assets/images/retweet.png" width="23" height="23"></button>
                                <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                <input type="hidden" id="user_id" value="<?=$tweet->user_id?>">
                            </form>
                        <?php endif; ?>
                    <?php else : ?>
                        <form method="post" onsubmit="new_retweet(event)" action="">

                            <button class="retweet_hover"><img src="<?=ROOT?>/assets/images/retweet.png" width="23" height="23"></button>
                            <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                            <input type="hidden" id="user_id" value="<?=$tweet->user_id?>">
                        </form>
                    <?php endif; ?>

                </div>

                <div>

                    <?php if($likesTweets): ?>

                        <?php $results = [];?>

                        <?php foreach ($likesTweets as $like): ?>
                            <?php $results[] = $like->tweet_id ?>
                            <?php if($like->tweet_id == $tweet->id): ?>
                                <form  method="post" onsubmit="delete_like(event)">
                                    <button type="submit" class="like_hover"><img src="<?=ROOT?>/assets/images/unlike.png" width="23" height="23"></button>
                                    <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                    <input type="hidden" id="user_id" value="<?=$user->id?>">
                                    <input type="hidden" id="like_id" value="<?=$like->id?>">
                                </form>

                            <?php endif; ?>
                        <?php endforeach?>
                        <?php if(!in_array($tweet->id, $results)): ?>
                            <form class="get-like" method="post" onsubmit="get_like(event)">

                                <button type="submit" class="like_hover"><img src="<?=ROOT?>/assets/images/like.png" width="23" height="23"></button>
                                <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                <input type="hidden" id="user_id" value="<?=$user->id?>">
                            </form>
                        <?php endif; ?>
                    <?php else : ?>
                        <form class="get-like" method="post" onsubmit="get_like(event)">

                            <button type="submit" class="like_hover"><img src="<?=ROOT?>/assets/images/like.png" width="23" height="23"></button>
                            <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                            <input type="hidden" id="user_id" value="<?=$user->id?>">
                        </form>
                    <?php endif; ?>

                </div>

                <div>
                    <?php if($tweetBookmark): ?>
                        <?php $res = []; ?>

                        <?php foreach ($tweetBookmark as $bookmark):?>
                            <?php $res[] = $bookmark->tweet_id ?>

                            <?php if($bookmark->tweet_id == $tweet->id): ?>
                                <form method="post" onsubmit="delete_save(event)">
                                    <button type="submit"><img src="<?=ROOT?>/assets/images/unbookmark.png" width="23" height="23"></button>
                                    <input type="hidden" id="bookmark_id" value="<?=$bookmark->id?>">
                                    <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                </form>
                            <?php endif; ?>

                        <?php endforeach ?>

                        <?php if(!in_array($tweet->id, $res)):?>
                            <form method="post" onsubmit="new_save(event)">
                                <button><img src="<?=ROOT?>/assets/images/bookmark.png" width="23" height="23"></button>
                                <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                <input type="hidden" id="user_id" value="<?=$user->id?>">
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <form method="post" onsubmit="new_save(event)" action="">
                            <button><img src="<?=ROOT?>/assets/images/bookmark.png" width="23" height="23"></button>
                            <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                            <input type="hidden" id="user_id" value="<?=$user->id?>">
                        </form>
                    <?php endif; ?>

                </div>
                
            </div>
        </div>


</div>


<div class="status_main-reply-active">
    <div class="status_main-reply-active-header">
        <div class="status_main-reply-active-header-left"></div>
        <div class="status_main-reply-active-header-right">Replying to <span>@<?=esc($tweet->username)?></span></div>
    </div>
    <div class="status_main-reply-active-body">
        <div class="status_main-reply-active-body-left"><img src="<?=get_image($user->avatar)?>"></div>
        <div class="status_main-reply-active-body-right">
            <form onsubmit="new_reply_without(event)" method="post" enctype="multipart/form-data">
            <div class="status_main-reply-active-body-right-field"><input class="js-reply-description" placeholder="Tweet your reply!" type="text"></div>
            <div class="status-main-reply-active-body-right-images hide"><img class="reply_image" src=""></div>


            <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
            <input type="hidden" id="replying_id" value="<?=$tweet->user_id?>">

            <div class="status_main-reply-active-body-right-icons">
                <div class="status_main-reply-active-body-right-icons-box">
                    <div><img src="<?=ROOT?>/assets/images/picture.png"><input type="file" class="js-reply-file" onchange="display_image_reply(event)"></div>
                    <div><img src="<?=ROOT?>/assets/images/gif.png"><input type="hidden"></div>
                    <div><img src="<?=ROOT?>/assets/images/happy.png"><input type="hidden"></div>
                    <div><img src="<?=ROOT?>/assets/images/location.png"><input type="hidden"></div>
                </div>
                <div class="status_main-reply-active-body-right-btn"><button type="submit"><span>Reply</span></button></div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>



    function display_image_reply(e)
    {
        let file = e.currentTarget.files[0];
        let allowed = ['image/jpeg', 'image/png', 'image/webp'];

        if(!allowed.includes(file.type))
        {
            file_added = false;
            alert('File type not valid! Files type allowed: '+allowed.toString().replaceAll('image/', ''));
            return;
        }
        file_added = true;
        document.querySelector(".status-main-reply-active-body-right-images").classList.remove('hide')
        document.querySelector('.reply_image').src = URL.createObjectURL(file);
    }

    function new_reply_without(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'new_reply';

        obj.description = e.currentTarget.querySelector(".js-reply-description").value.trim();
        obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value.trim();
        obj.replying_id = e.currentTarget.querySelector("#replying_id").value.trim();

        if(file_added)
            obj.file = e.currentTarget.querySelector(".js-reply-file").files[0];

        if(obj.description == '')
        {
            alert("Enter a description");
            e.currentTarget.querySelector(".js-reply-description").focus();
            return;
        }

        send_data(obj);
    }

    function get_like(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'get_like';
        obj.user_id = e.currentTarget.querySelector("#user_id").value;
        obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value;

        send_data(obj);
    }

    function delete_like(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'delete_like';
        obj.user_id = e.currentTarget.querySelector("#user_id").value;
        obj.id = e.currentTarget.querySelector("#like_id").value;
        obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value;


        send_data(obj);
    }

    function new_retweet(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'new_retweet';
        obj.user_id = e.currentTarget.querySelector("#user_id").value;
        obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value;

        send_data(obj);
    }

    function delete_retweet(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'delete_retweet';

        obj.id = e.currentTarget.querySelector("#retweet_id").value;
        obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value;

        send_data(obj);
    }

    function send_data(obj) {
        var myform = new FormData();
        var progressbar = null;

        if (typeof obj.progressbar != 'undefined')
            progressbar = document.querySelector("." + obj.progressbar);

        for (key in obj) {
            myform.append(key, obj[key]);
        }

        var ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange', function (e) {

            if (ajax.readyState == 4 && ajax.status == 200) {
                handle_result(ajax.responseText);
            }
        });

        if (progressbar) {
            progressbar.classList.remove('d-none');
            progressbar.children[0].style.width = '0';
            progressbar.children[0].innerHTML = '0';

            ajax.upload.addEventListener('progress', function (e) {
                let percent = Math.round((e.loaded / e.total) * 100);
                progressbar.children[0].style.width = percent + '%';
                progressbar.children[0].innerHTML = percent + "%";

            });
        }


        ajax.open('post', '<?=ROOT?>/ajax', true);
        ajax.send(myform);
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


