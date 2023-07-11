<a class="reply_box-redirect" href="<?=ROOT?>/status/reply/<?=$row->id?>">
    <div class="reply_box-line"></div>
    <div class="reply_box-bookmark">
        <div class="reply_box-avatar">
            <div class="reply_box-avatar-box">
                <img src="<?=get_image($row->avatar)?>">
            </div>

        </div>
        <div class="reply_box-main">
            <div class="reply_box-main-header">
                <div class="reply_box-main-header-left">
                    <form action="<?=ROOT?>/profile/<?=$row->user_id?>">
                        <button><?=esc($row->username)?></button>
                    </form>
                    <img width="16" height="16" src="">
                    <form action="<?=ROOT?>/profile/<?=$row->user_id?>">
                        <button><?=esc($row->username)?></button>
                    </form>
                    <p><?=esc($row->date)?></p>
                </div>
                <div class="reply_box-main-header-right">
                    <button type="button" class="dropbtn replybox-book-btn"><img src="<?=ROOT?>/assets/images/more.png" width="23" height="23"></button>
                    <div class="dropdown-content-replybox-book-btn hide">
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
            <div class="reply_box-main-replying"><span>Replying to</span>
                <form action="<?=ROOT?>/profile/<?=$row->replying_id?>">
                    <button>@<?=esc($row->username ?? $tweet->username)?></button>
                </form>
            </div>
            <div class="reply_box-main-desc"><span><?=esc($row->description)?></span></div>
            <?php if(!empty($row->file)): ?>
                <div class="reply_box-main-files">
                    <img src="<?=get_image($row->file ?? "")?>" alt="">
                </div>
            <?php endif; ?>
            <div class="icons-wrapper">

                <div class="box-icons">
                    <form action="<?=ROOT?>/homefull/compose_reply/<?=$row->id?>">
                        <button class="reply_hover"><img src="<?=ROOT?>/assets/images/comment.png"></button>
                    </form>
                    <span class="reply_counter"><?=esc($row->reply)?></span>
                </div>

                <div class="box-icons">
                    <button class="retweet_hover"><img src="<?=ROOT?>/assets/images/retweet.png" width="15" height="15"></button>
                    <span class="retweet_counter"><?=esc($row->retweet)?></span>
                </div>



                <div class="box-icons">

                    <?php if($likesReply): ?>

                        <?php $results = [];?>

                        <?php foreach ($likesReply as $like): ?>
                            <?php $results[] = $like->reply_id ?>

                            <?php if($like->reply_id == $row->id): ?>
                                <form  method="post" onsubmit="delete_like_reply(event)">

                                    <button type="submit" class="like_hover"><img src="<?=ROOT?>/assets/images/unlike.png" width="15" height="15"></button>
                                    <input type="hidden" id="reply_id" value="<?=$row->id?>">
                                    <input type="hidden" id="user_id" value="<?=$user->id?>">
                                    <input type="hidden" id="like_id" value="<?=$like->id?>">
                                </form>

                            <?php endif; ?>
                        <?php endforeach?>
                        <?php if(!in_array($row->id, $results)): ?>
                            <form class="get-like" method="post" onsubmit="get_like_reply(event)">

                                <button type="submit" class="like_hover"><img src="<?=ROOT?>/assets/images/like.png" width="15" height="15"></button>
                                <input type="hidden" id="reply_id" value="<?=$row->id?>">
                                <input type="hidden" id="user_id" value="<?=$user->id?>">
                            </form>
                        <?php endif; ?>
                    <?php else : ?>
                        <form class="get-like" method="post" onsubmit="get_like_reply(event)">

                            <button type="submit" class="like_hover"><img src="<?=ROOT?>/assets/images/like.png" width="15" height="15"></button>
                            <input type="hidden" id="reply_id" value="<?=$row->id?>">
                            <input type="hidden" id="user_id" value="<?=$user->id?>">
                        </form>
                    <?php endif; ?>

                    <span class="like_counter"><?=esc($row->likeable)?></span>
                </div>

                <div class="box-icons">
                    <button class="view_hover"><img src="<?=ROOT?>/assets/images/graph.png" width="15" height="15"></button>
                    <span class="view_counter"><?=esc($row->views)?></span>
                </div>

                <div class="box-icons">
                    <?php if($replyBookmark): ?>
                        <?php $res = []; ?>

                        <?php foreach ($replyBookmark as $bookmark):?>
                            <?php $res[] = $bookmark->reply_id ?>

                            <?php if($bookmark->reply_id == $row->id): ?>
                                <form method="post" onsubmit="delete_reply_save(event)">
                                    <button type="submit"><img src="<?=ROOT?>/assets/images/unbookmark.png" width="15" height="15"></button>
                                    <input type="hidden" id="bookmark_id" value="<?=$bookmark->id?>">
                                    <input type="hidden" id="reply_id" value="<?=$row->id?>">
                                </form>
                            <?php endif; ?>

                        <?php endforeach ?>

                        <?php if(!in_array($row->id, $res)):?>
                            <form method="post" onsubmit="new_save_reply(event)">
                                <button><img src="<?=ROOT?>/assets/images/bookmark.png" width="15" height="15"></button>
                                <input type="hidden" id="reply_id" value="<?=$row->id?>">
                                <input type="hidden" id="user_id" value="<?=$user->id?>">
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <form method="post" onsubmit="new_save_reply(event)" action="">
                            <button><img src="<?=ROOT?>/assets/images/bookmark.png" width="15" height="15"></button>
                            <input type="hidden" id="reply_id" value="<?=$row->id?>">
                            <input type="hidden" id="user_id" value="<?=$user->id?>">
                        </form>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

</a>

<script>
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

    function delete_reply_save(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'delete_reply_save';

        obj.bookmark_id = e.currentTarget.querySelector("#bookmark_id").value;
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
