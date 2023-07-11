<a class="full-box" href="<?=ROOT?>/status/<?=$row->id?>">
            <div class="tweet-box">
                <div class="tweet-left">
                    <img src="<?=get_image($row->avatar ?? "")?>" alt="">
                </div>

                <div class="tweet-body">
                    <div class="tweet-header">
                        <form action="<?=ROOT?>/profile/<?=$row->user_id?>">
                            <button class="tweet-name"><?=esc($row->username ?? '')?></button>
                        </form>
                        <form action="<?=ROOT?>/profile/<?=$row->user_id?>">
                            <button class="tweet-username"><?=esc($row->username ?? '')?></button>
                        </form>
                        <p class="tweet-date"><?=$row->id?></p>
                    </div>

                    <p class="tweet-desc"><?=esc($row->description ?? 'text')?></p>

                    <?php if(!empty($row->file)): ?>
                        <div class="tweet-files">
                            <img src="<?=get_image($row->file ?? "")?>" alt="">
                        </div>
                    <?php endif; ?>

                    <div class="icons-wrapper">
                        <div>
                            <form action="<?=ROOT?>/homefull/compose/<?=$row->id?>">
                            <button class="reply_hover"><img src="<?=ROOT?>/assets/images/comment.png"></button>
                            </form>
                            <span class="reply_counter"><?=esc($row->reply)?></span>
                        </div>


                        <div>

                            <?php if(isset($retweetTweet) && !empty($retweetTweet)): ?>

                                <?php $results = [];?>

                                <?php foreach ($retweetTweet as $retweet): ?>
                                    <?php $results[] = $retweet->tweet_id ?>
                                    <?php if($retweet->tweet_id == $row->id) : ?>
                                        <form method="post" onsubmit="delete_retweet(event)">

                                            <button class="retweet_hover"><img src="<?=ROOT?>/assets/images/unretweet.png" width="23" height="23"></button>
                                            <input type="hidden" id="tweet_id" value="<?=$row->id?>">
                                            <input type="hidden" id="user_id" value="<?=$row->user_id?>">
                                            <input type="hidden" id="retweet_id" value="<?=$retweet->id?>">
                                        </form>

                                    <?php endif; ?>
                                <?php endforeach?>
                                <?php if(!in_array($row->id, $results)): ?>
                                    <form method="post" onsubmit="new_retweet(event)">

                                        <button class="retweet_hover"><img src="<?=ROOT?>/assets/images/retweet.png" width="23" height="23"></button>
                                        <input type="hidden" id="tweet_id" value="<?=$row->id?>">
                                        <input type="hidden" id="user_id" value="<?=$row->user_id?>">
                                    </form>
                                <?php endif; ?>
                            <?php else : ?>
                                <form method="post" onsubmit="new_retweet(event)" action="">

                                    <button class="retweet_hover"><img src="<?=ROOT?>/assets/images/retweet.png" width="23" height="23"></button>
                                    <input type="hidden" id="tweet_id" value="<?=$row->id?>">
                                    <input type="hidden" id="user_id" value="<?=$row->user_id?>">
                                </form>
                            <?php endif; ?>

                            <span class="retweet_counter"><?=esc($row->retweet)?></span>


                        </div>

                        <div>

                            <?php if(isset($likesTweet) && !empty($likesTweet)): ?>

                                <?php $results = [];?>

                                <?php foreach ($likesTweet as $like): ?>
                                    <?php $results[] = $like->tweet_id ?>
                                    <?php if($like->tweet_id == $row->id): ?>
                                        <form  method="post" onsubmit="delete_like(event)">

                                            <button type="submit" class="like_hover"><img src="<?=ROOT?>/assets/images/unlike.png" width="23" height="23"></button>
                                            <input type="hidden" id="tweet_id" value="<?=$row->id?>">
                                            <input type="hidden" id="user_id" value="<?=$row->user_id?>">
                                            <input type="hidden" id="like_id" value="<?=$like->id?>">
                                        </form>

                                    <?php endif; ?>
                                <?php endforeach?>
                                <?php if(!in_array($row->id, $results)): ?>
                                    <form class="get-like" method="post" onsubmit="get_like(event)">

                                        <button type="submit" class="like_hover"><img src="<?=ROOT?>/assets/images/like.png" width="23" height="23"></button>
                                        <input type="hidden" id="tweet_id" value="<?=$row->id?>">
                                        <input type="hidden" id="user_id" value="<?=$row->user_id?>">
                                    </form>
                                <?php endif; ?>
                            <?php else : ?>
                                <form class="get-like" method="post" onsubmit="get_like(event)">

                                    <button type="submit" class="like_hover"><img src="<?=ROOT?>/assets/images/like.png" width="23" height="23"></button>
                                    <input type="hidden" id="tweet_id" value="<?=$row->id?>">
                                    <input type="hidden" id="user_id" value="<?=$row->user_id?>">
                                </form>
                            <?php endif; ?>

                            <span class="like_counter"><?=esc($row->likeable)?></span>
                        </div>

                        <div>
                            <button class="view_hover"><img src="<?=ROOT?>/assets/images/graph.png" width="23" height="23"></button>
                            <span class="view_counter"><?=esc($row->views)?></span>
                        </div>

                        <?php if(isset($tweetBookmark) && !empty($tweetBookmark)): ?>
                            <?php $res = []; ?>

                            <?php foreach ($tweetBookmark as $bookmark):?>
                                <?php $res[] = $bookmark->tweet_id ?>

                                <?php if($bookmark->tweet_id == $row->id): ?>
                                    <form method="post" onsubmit="delete_save(event)">
                                        <button type="submit"><img src="<?=ROOT?>/assets/images/unbookmark.png" width="23" height="23"></button>
                                        <input type="hidden" id="bookmark_id" value="<?=$bookmark->id?>">
                                        <input type="hidden" id="tweet_id" value="<?=$row->id?>">
                                    </form>
                                <?php endif; ?>

                            <?php endforeach ?>

                            <?php if(!in_array($row->id, $res)):?>
                                <form method="post" onsubmit="new_save(event)">
                                    <button><img src="<?=ROOT?>/assets/images/bookmark.png" width="23" height="23"></button>
                                    <input type="hidden" id="tweet_id" value="<?=$row->id?>">
                                    <input type="hidden" id="user_id" value="<?=$user->id ?? ""?>">
                                </form>
                            <?php endif; ?>
                        <?php else: ?>
                                <form method="post" onsubmit="new_save(event)" action="">
                                    <button><img src="<?=ROOT?>/assets/images/bookmark.png" width="23" height="23"></button>
                                    <input type="hidden" id="tweet_id" value="<?=$row->id?>">
                                    <input type="hidden" id="user_id" value="<?=$user->id ?? ""?>">
                                </form>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="tweet-del" >
                    <div class="dropdown">
                        <button type="button" class="dropbtn tweet-btn"><img src="<?=ROOT?>/assets/images/more.png" width="23" height="23"></button>
                        <div class="dropdown-content hide">
                            <button id="add_to_lists"><img src="<?=ROOT?>/assets/images/add_to_lists.png" width="15" height="15"><span>Add to bookmarks</span></button>
                            <?php if($row->user_id != $user->id): ?>
                            <button id="follow_to"><img src="<?=ROOT?>/assets/images/follow_to.png" width="15" height="15"><span>Follow @<?=esc($row->username)?></span></button>
                            <?php endif; ?>
                            <?php if($row->user_id == $user->id) : ?>
                                <form onsubmit="delete_tweet(event)" method="post">
                                    <input type="hidden" id="tweet_id" value="<?=$row->id?>">
                                    <button><img src="<?=ROOT?>/assets/images/delete.png" width="15" height="15"><span>Delete tweet</span></button>
                                </form>
                            <?php endif; ?>
                            <button id="block"><img src="<?=ROOT?>/assets/images/block.png" width="15" height="15"><span>Block @<?=esc($row->username)?></span></button>
                            <button id="report"><img src="<?=ROOT?>/assets/images/report.png" width="15" height="15"><span>Report Tweet</span></button>
                        </div>

                    </div>
                </div>
            </div>

</a>

<script>


    function show_tweet(e)
    {
        e.preventDefault();

        coll = this.nextElementSibling;
        console.log(coll);
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

    function new_save(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'save_tweet';
        obj.user_id = e.currentTarget.querySelector("#user_id").value;
        obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value;


        send_data(obj);
    }

    function delete_save(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'delete_save';
        obj.bookmark_id = e.currentTarget.querySelector("#bookmark_id").value;
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
        // var progressbar = null;

        // if (typeof obj.progressbar != 'undefined')
        //     progressbar = document.querySelector("." + obj.progressbar);

        for (key in obj) {
            myform.append(key, obj[key]);
        }

        var ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange', function (e) {

            if (ajax.readyState == 4 && ajax.status == 200) {
                handle_result(ajax.responseText);
            }
        });

        // if (progressbar) {
        //     progressbar.classList.remove('d-none');
        //     progressbar.children[0].style.width = '0';
        //     progressbar.children[0].innerHTML = '0';
        //
        //     ajax.upload.addEventListener('progress', function (e) {
        //         let percent = Math.round((e.loaded / e.total) * 100);
        //         progressbar.children[0].style.width = percent + '%';
        //         progressbar.children[0].innerHTML = percent + "%";
        //
        //     });
        // }


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

