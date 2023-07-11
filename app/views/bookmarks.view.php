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

        <div class="bookmarks__header">
            <h2>Bookmarks</h2>
            <p>@<?=esc($user->username)?></p>
        </div>

        <?php if(empty($rows)):?>

        <div class="bookmarks__main">
            <div class="bookmarks__main-box">
                <img src="<?=ROOT?>/assets/images/bookmarks.png" alt="">
                <h1>Save Tweets for later</h1>
                <span>Don’t let the good ones fly away! Bookmark Tweets to easily find them again in the future.</span>
            </div>
        </div>

        <?php endif; ?>

        <?php if(!empty($rows)):?>
            <?php foreach ($rows as $row): ?>

            <?php if(isset($row->tweet_id) || isset($row->reply_id)): ?>

                    <?php require 'replybox-book.php' ?>

                <?php else: ?>

                    <?php require 'tweetbox.view.php' ?>

            <?php endif ?>
            <?php endforeach?>
        <?php endif?>


    </div>


    </div>

    <?php require_once "includes/right-sidebar-full.php"?>


</body>
</html>

<script>

    let collReplyBoxBook = document.getElementsByClassName('replybox-book-btn');

    for(let q = 0; q < collReplyBoxBook.length; q++)
    {
        collReplyBoxBook[q].addEventListener('click', function(e){
            e.preventDefault();
            this.classList.toggle('active');
            let contentReplyBoxBook = this.nextElementSibling;
            console.log(contentReplyBoxBook);
            if(contentReplyBoxBook.classList.contains('hide'))
            {
                contentReplyBoxBook.classList.remove('hide');
            } else {
                contentReplyBoxBook.classList.add('hide');
            }
        })
    }

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

    // function get_like_reply(e)
    // {
    //     e.preventDefault();
    //
    //     let obj = {};
    //     obj.data_type = 'get_like_reply';
    //     obj.user_id = e.currentTarget.querySelector("#user_id").value;
    //     obj.reply_id = e.currentTarget.querySelector("#reply_id").value;
    //
    //     send_data(obj);
    // }
    //
    // function delete_like_reply(e)
    // {
    //     e.preventDefault();
    //
    //     let obj = {};
    //     obj.data_type = 'delete_like_reply';
    //     obj.user_id = e.currentTarget.querySelector("#user_id").value;
    //     obj.id = e.currentTarget.querySelector("#like_id").value;
    //     obj.reply_id = e.currentTarget.querySelector("#reply_id").value;
    //
    //
    //     send_data(obj);
    // }
    //
    // function get_like(e)
    // {
    //     e.preventDefault();
    //
    //     let obj = {};
    //     obj.data_type = 'get_like';
    //     obj.user_id = e.currentTarget.querySelector("#user_id").value;
    //     obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value;
    //
    //     send_data(obj);
    // }
    //
    // function delete_like(e)
    // {
    //     e.preventDefault();
    //
    //     let obj = {};
    //     obj.data_type = 'delete_like';
    //     obj.user_id = e.currentTarget.querySelector("#user_id").value;
    //     obj.id = e.currentTarget.querySelector("#like_id").value;
    //     obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value;
    //
    //
    //     send_data(obj);
    // }
    //
    // function delete_save(e)
    // {
    //     e.preventDefault();
    //
    //     let obj = {};
    //     obj.data_type = 'delete_save';
    //     obj.bookmark_id = e.currentTarget.querySelector("#bookmark_id").value;
    //
    //
    //
    //     send_data(obj);
    // }
    //
    // function delete_reply_save(e)
    // {
    //     e.preventDefault();
    //
    //     let obj = {};
    //     obj.data_type = 'delete_reply_save';
    //
    //     obj.bookmark_id = e.currentTarget.querySelector("#bookmark_id").value;
    //
    //
    //
    //     send_data(obj);
    // }

    //function send_data(obj)
    //{
    //    let myform = new FormData();
    //
    //    for(key in obj)
    //    {
    //        myform.append(key, obj[key]);
    //    }
    //
    //    var xhr = new XMLHttpRequest();
    //
    //
    //    xhr.addEventListener('readystatechange', function()
    //    {
    //        if (xhr.readyState == 4)
    //        {
    //            if(xhr.status == 200)
    //            {
    //
    //                handle_result(xhr.responseText);
    //            } else {
    //                alert('Could not send data. Please check your connection')
    //            }
    //        }
    //    });
    //    xhr.open('post', '<?php //=ROOT?>///ajax', true);
    //    xhr.send(myform);
    //}
    //
    //function handle_result(result)
    //{
    //    console.log(result);
    //    let obj = JSON.parse(result);
    //
    //    if(obj.success)
    //    {
    //        window.location.reload();
    //    } else {
    //        alert("Please fix the errors");
    //        for (key in obj.errors){
    //            alert(obj.errors[key]);
    //        }
    //    }
    //
    //}

</script>