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
        <div class="home-header-fix">
            <div class="home__header"><h3>Home</h3></div>
            <nav class="home__navigation">
                <a href="<?=ROOT?>/homefull">
                    <span>For you</span>
                    <div class="<?=(URL('page') == 'homefull' && URL('section') == '') ? 'active_navigation' : ''?>"></div>
                </a>
                <a href="<?=ROOT?>/homefull/following">
                    <span>Following</span>
                    <div class="<?=(URL('section') == 'following') ? 'active_navigation' : ''?>"></div>
                </a>
            </nav>
        </div>

        <form onsubmit="new_tweet(event)" method="post" >
            <div class="new__tweet-box">

<!--            <form method="post" enctype="multipart/form-data" action="">-->
            <div class="new__tweet-box-left"><img src="<?=get_image($user->avatar)?>"></div>
            <div class="new__tweet-box-right">
                <div class="new__tweet-box-right-top"><input class="js-description" name="description" type="text" placeholder="What is happening?"></div>
                <div class="new__tweet-box-right-main hide"><img class="tweet__image" src="" width="500" height="500"></div>
                <div class="new__tweet-box-right-footer">

                    <div class="new__tweet-box-right-footer-logos">

                        <li><img src="<?=ROOT?>/assets/images/picture.png"><input class="js-file" onchange="display_image(event)" type="file"></li>
                        <li><img src="<?=ROOT?>/assets/images/gif.png"></li>
                        <li><img src="<?=ROOT?>/assets/images/poll.png"></li>
                        <li><img src="<?=ROOT?>/assets/images/happy.png"></li>
                        <li><img src="<?=ROOT?>/assets/images/schedule.png"></li>
                        <li><img src="<?=ROOT?>/assets/images/location.png"></li>

                    </div>

                    <div class="new__tweet-box-right-footer-btn">
                        <button>Tweet</button>
                    </div>

                </div>
            </div>

            </div>
        </form>

        <?php if($rows): ?>
            <?php foreach ($rows as $row): ?>
                    <?php require 'tweetbox.view.php'?>
            <?php endforeach ?>
        <?php endif; ?>
        <div>
            <button class="show_more-tweets">
                <span>Show 60 tweets</span>
            </button>
        </div>
        <div>
            <button class="show_less-tweets hide">
                <span>Reload localstorage</span>
            </button>
        </div>
    </div>
    <?php if($section == 'compose'): ?>

        <?php require 'compose.php'?>

    <?php endif; ?>

    <?php if($section == 'compose_reply'): ?>

        <?php require 'compose_reply.php'?>

    <?php endif; ?>
    <?php require_once "includes/right-sidebar-full.php"?>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="./assets/js/homefull.js"></script>
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


    let file_added = false;

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

    function new_reply_for_reply(e)
    {
        e.preventDefault();
        let obj = {};
        obj.data_type = "new_reply_for_reply";

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


    // function new_save(e)
    // {
    //     e.preventDefault();
    //
    //     let obj = {};
    //     obj.data_type = 'save_tweet';
    //     obj.user_id = e.currentTarget.querySelector("#user_id").value;
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
    //     obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value;
    //
    //
    //     send_data(obj);
    // }


    function delete_tweet(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'delete_tweet';
        obj.id = e.currentTarget.querySelector("#tweet_id").value;


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