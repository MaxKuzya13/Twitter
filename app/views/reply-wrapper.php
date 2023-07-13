<article class="reply_box">

    <div class="reply_box-line"></div>
    <div class="reply_box-wrapper">
       <div class="reply_box-wrapper-header">
           <div class="reply_box-wrapper-header-avatar"><img width="40" height="40" src="<?=get_image($row->avatar)?>"></div>
           <div class="reply_box-wrapper-header-desc">
               <div class="reply_box-wrapper-header-desc-left">
                    <div><a href="<?=ROOT?>/profile/<?=$row->user_id?>"><?=esc($row->username)?></a> <img src="" ></div>
                    <p>@<?=esc($row->username)?></p>
               </div>
               <div class="reply_box-wrapper-header-desc-right">
                   <button type="button" class="dropbtn reply-wrapper-btn"><img src="<?=ROOT?>/assets/images/more.png" width="23" height="23"></button>
                   <div class="dropdown-content-reply-wrapper hide">
                       <button ><i class="far fa-trash-alt"></i><span>More</span></button>
                       <button><i class="far fa-trash-alt"></i><span>Woto</span></button>
                       <?php if($row->user_id == $user->id) : ?>
                           <form method="post">
                               <input type="hidden" id="reply_id" value="<?=$row->id?>">
                               <button><i class="far fa-trash-alt"></i><span>Delete</span></button>
                           </form>
                       <?php endif; ?>
                   </div>
               </div>
           </div>
       </div>
        <div class="reply_box-wrapper-replying">Replying to
            <form action="<?=ROOT?>/profile/<?=$tweet->user_id?>"><button>@<?=esc($tweet->username)?></button></form>
        </div>
        <div class="reply_box-wrapper-desc"><?=esc($row->description)?></div>
        <?php if(isset($row->file)): ?>
        <div class="reply_box-wrapper-desc"><img src="<?=get_image($row->file)?>"></div>
        <?php endif; ?>
        <div class="reply_box-wrapper-date"><span>1:59 Pm</span><h4>2,523</h4><span>Views</span></div>
        <div class="reply_box-wrapper-icons-info">
            <div class="reply_box-wrapper-icons-info-box"><a href=""><span><?=esc($row->retweet)?></span><p>Retweets</p></a></div>
            <div class="reply_box-wrapper-icons-info-box"><a href=""><span><?=esc($row->views)?></span><p>Views</p></a></div>
            <div class="reply_box-wrapper-icons-info-box"><a href=""><span><?=esc($row->likeable)?></span><p>Likes</p></a></div>
            <div class="reply_box-wrapper-icons-info-box"><a href=""><span><?=esc($row->bookmark)?></span><p>Bookmark</p></a></div>
        </div>

        <div class="icons-wrapper-without">
            <div>
                <form action="<?=ROOT?>/homefull/compose_reply/<?=$row->id?>">
                    <button class="reply_hover"><img src="<?=ROOT?>/assets/images/comment.png" width="23" height="23"></button>
                </form>
            </div>

            <div>
                <?php if(isset($retweetReply) && !empty($retweetReply)): ?>

                    <?php $results = [];?>

                    <?php foreach ($retweetReply as $retweet): ?>
                        <?php $results[] = $retweet->reply_id ?>
                        <?php if($retweet->reply_id == $row->id) : ?>
                            <form method="post" onsubmit="delete_retweet_reply(event)">

                                <button class="retweet_hover"><img src="<?=ROOT?>/assets/images/unretweet.png" width="23" height="23"></button>
                                <input type="hidden" id="reply_id" value="<?=$row->id?>">
                                <input type="hidden" id="user_id" value="<?=$row->user_id?>">
                                <input type="hidden" id="retweet_id" value="<?=$retweet->id?>">
                            </form>

                        <?php endif; ?>
                    <?php endforeach?>
                    <?php if(!in_array($row->id, $results)): ?>
                        <form method="post" onsubmit="new_retweet_reply(event)">

                            <button class="retweet_hover"><img src="<?=ROOT?>/assets/images/retweet.png" width="23" height="23"></button>
                            <input type="hidden" id="reply_id" value="<?=$row->id?>">
                            <input type="hidden" id="user_id" value="<?=$row->user_id?>">
                        </form>
                    <?php endif; ?>
                <?php else : ?>
                    <form method="post" onsubmit="new_retweet_reply(event)" action="">

                        <button class="retweet_hover"><img src="<?=ROOT?>/assets/images/retweet.png" width="23" height="23"></button>
                        <input type="hidden" id="reply_id" value="<?=$row->id?>">
                        <input type="hidden" id="user_id" value="<?=$row->user_id?>">
                    </form>
                <?php endif; ?>
            </div>

            <div>

                <?php if($likesReply): ?>

                    <?php $results = [];?>

                    <?php foreach ($likesReply as $like): ?>
                        <?php $results[] = $like->reply_id ?>

                        <?php if($like->reply_id == $row->id): ?>
                            <form  method="post" onsubmit="delete_like_reply(event)">
                                <button type="submit" class="like_hover"><img src="<?=ROOT?>/assets/images/unlike.png" width="23" height="23"></button>
                                <input type="hidden" id="reply_id" value="<?=$row->id?>">
                                <input type="hidden" id="user_id" value="<?=$user->id?>">
                                <input type="hidden" id="like_id" value="<?=$like->id?>">
                            </form>

                        <?php endif; ?>
                    <?php endforeach?>
                    <?php if(!in_array($row->id, $results)): ?>
                        <form class="get-like" method="post" onsubmit="get_like_reply(event)">

                            <button type="submit" class="like_hover"><img src="<?=ROOT?>/assets/images/like.png" width="23" height="23"></button>
                            <input type="hidden" id="reply_id" value="<?=$row->id?>">
                            <input type="hidden" id="user_id" value="<?=$user->id?>">
                        </form>
                    <?php endif; ?>
                <?php else : ?>
                    <form class="get-like" method="post" onsubmit="get_like_reply(event)">

                        <button type="submit" class="like_hover"><img src="<?=ROOT?>/assets/images/like.png" width="23" height="23"></button>
                        <input type="hidden" id="reply_id" value="<?=$row->id?>">
                        <input type="hidden" id="user_id" value="<?=$user->id?>">
                    </form>
                <?php endif; ?>

            </div>

            <div>
                <?php if($replyBookmark): ?>
                    <?php $res = []; ?>

                    <?php foreach ($replyBookmark as $bookmark):?>
                        <?php $res[] = $bookmark->reply_id ?>

                        <?php if($bookmark->reply_id == $row->id): ?>
                            <form method="post" onsubmit="delete_reply_save(event)">
                                <button type="submit"><img src="<?=ROOT?>/assets/images/unbookmark.png" width="23" height="23"></button>
                                <input type="hidden" id="bookmark_id" value="<?=$bookmark->id?>">
                                <input type="hidden" id="reply_id" value="<?=$row->id?>">
                            </form>
                        <?php endif; ?>

                    <?php endforeach ?>

                    <?php if(!in_array($row->id, $res)):?>
                        <form method="post" onsubmit="new_save_reply(event)">
                            <button><img src="<?=ROOT?>/assets/images/bookmark.png" width="23" height="23"></button>
                            <input type="hidden" id="reply_id" value="<?=$row->id?>">
                            <input type="hidden" id="user_id" value="<?=$user->id?>">
                        </form>
                    <?php endif; ?>
                <?php else: ?>
                    <form method="post" onsubmit="new_save_reply(event)" action="">
                        <button><img src="<?=ROOT?>/assets/images/bookmark.png" width="23" height="23"></button>
                        <input type="hidden" id="reply_id" value="<?=$row->id?>">
                        <input type="hidden" id="user_id" value="<?=$user->id?>">
                    </form>
                <?php endif; ?>

            </div>

        </div>


    </div>

</article>


<div class="status_main-reply-active">
    <div class="status_main-reply-active-header">
        <div class="status_main-reply-active-header-left"></div>
        <div class="status_main-reply-active-header-right">Replying to <span>@<?=esc($row->username)?> and @<?=esc($tweet->username)?></span></div>
    </div>
    <div class="status_main-reply-active-body">
        <div class="status_main-reply-active-body-left"><img src="<?=get_image($user->avatar)?>"></div>
        <div class="status_main-reply-active-body-right">
            <form onsubmit="new_reply_wrapper(event)" method="post" enctype="multipart/form-data">
                <div class="status_main-reply-active-body-right-field"><input class="js-reply-description" placeholder="Tweet your reply!" type="text"></div>
                <div class="status-main-reply-active-body-right-images hide"><img class="reply_image" src=""></div>


                <input type="hidden" id="tweet_id" value="<?=$row->tweet_id?>">
                <input type="hidden" id="replying_id" value="<?=$row->user_id?>">
                <input type="hidden" id="reply_id" value="<?=$reply->id?>">

                <div class="status_main-reply-active-body-right-icons">
                    <div class="status_main-reply-active-body-right-icons-box">
                        <div><img src="<?=ROOT?>/assets/images/picture.png"><input type="file" class="js-reply-file" onchange="display_image_reply_wrapper(event)"></div>
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



    function display_image_reply_wrapper(e)
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

    function new_reply_wrapper(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'new_reply_for_reply';

        obj.description = e.currentTarget.querySelector(".js-reply-description").value.trim();
        obj.reply_id = e.currentTarget.querySelector("#reply_id").value.trim();
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

    function get_like_reply(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'get_like_reply';
        obj.user_id = e.currentTarget.querySelector("#user_id").value;
        obj.reply_id = e.currentTarget.querySelector("#reply_id").value;

        send_data(obj);
    }

    function delete_like_reply(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'delete_like_reply';
        obj.user_id = e.currentTarget.querySelector("#user_id").value;
        obj.id = e.currentTarget.querySelector("#like_id").value;
        obj.reply_id = e.currentTarget.querySelector("#reply_id").value;


        send_data(obj);
    }

    function new_save_reply(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'save_reply';
        obj.user_id = e.currentTarget.querySelector("#user_id").value;
        obj.reply_id = e.currentTarget.querySelector("#reply_id").value;


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
