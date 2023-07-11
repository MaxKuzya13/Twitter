<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
        <div class="status_main-header">
            <div class="status_main-header-left"><a href="<?=ROOT?>/homefull"><img width="20" height="20" src="<?=ROOT?>/assets/images/back.png"></a></div>
            <div class="status_main-header-right"><h4>Tweet</h4></div>
        </div>

        <?php if(isset($tweet) || isset($row)):?>
            <?php if ($section == 'default'): ?>
                <?php require_once "tweet-without.php"?>
            <?php elseif($section == 'reply'): ?>
                <?php require_once "tweet-at-reply.php"?>
                <?php require_once "reply-wrapper.php"?>
            <?php endif; ?>
        <?php endif; ?>

<!--        Якщо не нажато на input-->
<!--        <div class="status_main-reply">-->
<!--            <div class="status_main-reply-left"><img src="--><?php //=get_image($user->avatar)?><!--" width="50" height="50"></div>-->
<!--            <div class="status_main-reply-main"><input placeholder="Tweet your reply!" type="text"></div>-->
<!--            <div class="status_main-reply-right"><button><span>Reply</span></button></div>-->
<!--        </div>-->

<!--        Якщо нажато на input -->



        <div class="status_main-reply-wrapper">
            <?php if($replyes) :?>
                <?php foreach ($replyes as $reply): ?>

                    <?php if ($section == 'default' && !empty($reply->tweet_id) && empty($reply->reply_id)): ?>
                        <?php require "replybox.php"?>
                    <?php elseif($section == 'reply'): ?>
                        <?php require "replybox.php"?>
                    <?php endif; ?>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>


    </div>


    <?php require_once "includes/right-sidebar-full.php"?>


</body>
</html>

<script>

    let collReplyBox = document.getElementsByClassName('reply-box-btn');

    for(let m = 0; m < collReplyBox.length; m++)
    {
        collReplyBox[m].addEventListener('click', function(e){
            e.preventDefault();
            this.classList.toggle('active');
            let contentReplyBox = this.nextElementSibling;
            console.log(contentReplyBox);
            if(contentReplyBox.classList.contains('hide'))
            {
                contentReplyBox.classList.remove('hide');
            } else {
                contentReplyBox.classList.add('hide');
            }
        })
    }

    let collTweetAtReply = document.getElementsByClassName('tweet-reply-btn');

    for(let j = 0; j < collTweetAtReply.length; j++)
    {
        collTweetAtReply[j].addEventListener('click', function(e){
            e.preventDefault();
            this.classList.toggle('active');
            let contentTweetAtReply = this.nextElementSibling;
            console.log(contentTweetAtReply);
            if(contentTweetAtReply.classList.contains('hide'))
            {
                contentTweetAtReply.classList.remove('hide');
            } else {
                contentTweetAtReply.classList.add('hide');
            }
        })
    }

    let collTweetWithout = document.getElementsByClassName('tweet-without-btn');
    for(let k = 0; k < collTweetWithout.length; k++)
    {
        collTweetWithout[k].addEventListener('click', function(e){
            e.preventDefault();
            this.classList.toggle('active');
            let contenTweetWithout = this.nextElementSibling;
            console.log(contenTweetWithout);
            if(contenTweetWithout.classList.contains('hide'))
            {
                contenTweetWithout.classList.remove('hide');
            } else {
                contenTweetWithout.classList.add('hide');
            }
        })
    }

    let collReplyWrapper = document.getElementsByClassName('reply-wrapper-btn');

    for(let l = 0; l < collReplyWrapper.length; l++)
    {
        collReplyWrapper[l].addEventListener('click', function(e){
            e.preventDefault();
            this.classList.toggle('active');
            let contentReplyWrapper = this.nextElementSibling;
            console.log(contentReplyWrapper);
            if(contentReplyWrapper.classList.contains('hide'))
            {
                contentReplyWrapper.classList.remove('hide');
            } else {
                contentReplyWrapper.classList.add('hide');
            }
        })
    }

    let file_added = false;

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

    function show_display(e)
    {
        e.preventDefault();

        e.currentTarget.querySelector(".dropdown-content").style.display = 'block';

    }


    function display_image(e)
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
        document.querySelector(".new__tweet-box-right-main").classList.remove('hide')
        document.querySelector('.tweet__image').src = URL.createObjectURL(file);
    }

    function load_image(e)
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
        document.querySelector(".tweet-reply-text-box-main--image-box").classList.remove('hide')
        document.querySelector('.js-load-image').src = URL.createObjectURL(file);
    }

    function new_tweet(e)
    {
        e.preventDefault();
        let obj = {};
        obj.data_type = "new_tweet";

        obj.description = e.currentTarget.querySelector(".js-description").value.trim();

        if(file_added)
            obj.file = e.currentTarget.querySelector(".js-file").files[0];

        if(obj.description == '')
        {
            alert("Enter a description");
            e.currentTarget.querySelector(".js-description").focus();
            return;
        }

        send_data(obj);
    }

    function new_reply(e)
    {
        e.preventDefault();
        let obj = {};
        obj.data_type = "new_reply";

        obj.reply = e.currentTarget.querySelector(".js-reply").value.trim();
        obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value.trim();

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

    function new_save(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'save_tweet';
        obj.user_id = e.currentTarget.querySelector("#user_id").value;
        obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value;
        obj.bookmark = 'save';


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

    function delete_tweet(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'delete_tweet';
        obj.id = e.currentTarget.querySelector("#tweet_id").value;


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