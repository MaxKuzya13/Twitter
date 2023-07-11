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
<?php if($data['section'] == 'create') :?>
    <div class="background__container">
        <form onsubmit="new_lists(event)" method="post" enctype="multipart/form-data" class="compose__container">
            <div class="lists__header">
                <div class="lists__create__header-left"><a href="<?=ROOT?>/lists"><img src="<?=ROOT?>/assets/images/exit.png" width="12" height="12" alt=""></a></div>
                <div class="lists__create__header-main"><h3>Create a new List</h3></div>
                <div class="lists__create__header-right"><button type="submit"><span>Next</span></button></div>
            </div>
            <div class="lists__create__image-box">
                <img class="lists__image" src="" alt="">
                <div><input class="js-image" onchange="display_image(event)" type="file"><img src="<?=ROOT?>/assets/images/camera.png" alt=""></div>

            </div>

            <div class="lists__create__title">
                <div class=""><input class="js-title" placeholder="Name" name="title" type="text"></div>
            </div>

            <div class="lists__create__desc">
                <div class=""><textarea class="js-description-list" placeholder="Description" name="description" cols="30" rows="10"></textarea></div>
            </div>

            <div class="lists__create__footer">
                <div><span>Make private</span><input type="checkbox" ></div>
                <p>When you make a List private, only you can see it.</p>
            </div>
            <div class="prog js-prog d-none">
                <div class="prog-bar js-prog-bar">0%</div>
            </div>
        </form>

    </div>
<?php endif; ?>

    <?php require_once "includes/left-sidebar-full.php"?>

    <div class="main">

       <div class="lists__header">
           <div class="lists__header-left"><a title="New list" href="<?=ROOT?>/home"><img src="<?=ROOT?>/assets/images/back.png" alt=""></a></div>
           <div class="lists__header-main">
               <h3>Lists</h3>
               <p>@username</p>
           </div>
           <div class="lists__header-right">
               <a href="<?=ROOT?>/lists/create"><img src="<?=ROOT?>/assets/images/add_text.png" alt=""></a>
               <a href=""><span class="fa fa-ellipsis-h"></span></a>
           </div>
       </div>
        <div class="lists__pinned">
<!--        <div class="lists__pinned"><h3>Pinned Lists</h3></div>-->
        <?php foreach ($rows as $row): ?>
        <?php if($row->role == 'pinned'): ?>

            <a href="" class="lists__pinned-box">
                <div class="lists__pinned-box-drop">
                    <img src="<?=get_image($row->image)?>" width="68" height="68" alt="">
                    <span><?=esc($row->title)?></span>
                    <div class="lists__pinned-hover-box">
                        <div class="lists__pinned-hover-box-top"><img src="<?=get_image($row->image)?>" width="300" height="100"></div>
                        <div class="lists__pinned-hover-box-bottom">
                            <div class="lists_pinned-hover-box-bottom-title"><h3><?=esc($row->title)?></h3></div>
                            <div class="lists_pinned-hover-box-bottom-desc"><span><?=esc($row->description)?></span></div>
                            <div class="lists_pinned-hover-box-bottom-user">
                                <img width="15" height="15" src="<?=get_image($row->avatar)?>"><h4><?=esc($row->username)?></h4><p><?=esc($row->email)?></p>
                            </div>
                            <div class="lists_pinned-hover-box-bottom-followers">
                                <div class="lists__pinned-hover-box-bottom-followers-left"><span>0</span><p>Members</p></div>
                                <div class="lists__pinned-hover-box-bottom-followers-right"><span>1</span><p>Followers</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        <?php endif; ?>
        <?php endforeach; ?>

        </div>

        <?php if(empty($pinned)):?>
            <div class="lists__pinned-text"><span>Nothing to see here yet — pin your favorite Lists to access them quickly.</span></div>
        <?php endif; ?>

        <div class="lists__yours"><h3>Your Lists</h3></div>

<!--        <div class="lists__yours-text"><span>You haven't created or followed any Lists. When you do, they'll show up here.</span></div>-->
       <?php if($rows): ?>
            <?php foreach ($rows as $row): ?>
                <?php if($row->role == 'unpinned'): ?>
                <form method="post" onsubmit="create_pinned_lists(event)" enctype="multipart/form-data" action="">
                <?php elseif($row->role == 'pinned'): ?>
                <form method="post" onsubmit="delete_pinned_lists(event)" enctype="multipart/form-data" action="">
                <?php endif ?>
                <div class="lists__yours-wrapper">
                    <div class="lists__yours-left"><img src="<?=get_image($row->image ?? '')?>" alt=""></div>
                    <div class="lists__yours-body">
                        <a href=""><h5><?=esc($row->title)?></h5></a>
                        <div class="lists__yours-body-footer">
                            <a href=""><img src="<?=get_image($row->avatar ?? '')?>" alt=""></a>
                            <a href=""><span><?=esc($row->username)?></span></a>
                            <a href=""> <p>@<?=esc($row->email)?></p></a>
                            <input type="hidden" id="list_id" value="<?=$row->id?>">
                        </div>
                    </div>
                    <?php if ($row->role == 'unpinned'): ?>
                        <div class="lists__yours-right"><button><img src="<?=ROOT?>/assets/images/pinned.png"></button></div>
                    </form>
                    <?php elseif($row->role == 'pinned'): ?>
                        <div class="lists__yours-right"><button><img src="<?=ROOT?>/assets/images/unpinned.png"></button></div>
                    </form>
                    <?php endif ?>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
        <div class="lists__yours-text"><span>You haven't created or followed any Lists. When you do, they'll show up here.</span></div>
    <?php endif; ?>
        <div class="lists__dont_use"></div>


    </div>


    <?php require_once "includes/right-sidebar-full.php"?>

</body>
</html>
<script>
    let image_added = false;

    function display_image(e)
    {
        let file = e.currentTarget.files[0];
        let allowed = ['image/jpeg', 'image/png', 'image/webp'];

        if(!allowed.includes(file.type))
        {
            image_added = false;
            alert('File type not valid! Files type allowed: '+allowed.toString().replaceAll('image/', ''));
            return;
        }
        image_added = true;
        document.querySelector('.lists__image').src = URL.createObjectURL(file);
    }

    function create_pinned_lists(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'pinned_lists';
        obj.list_id = e.currentTarget.querySelector("#list_id").value;
        obj.role = 'pinned';


        send_data(obj);
    }

    function delete_pinned_lists(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'unpinned_lists';
        obj.list_id = e.currentTarget.querySelector("#list_id").value;
        obj.role = 'unpinned';


        send_data(obj);
    }

    function new_lists(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'new_lists';

        obj.title = e.currentTarget.querySelector(".js-title").value.trim();
        obj.description = e.currentTarget.querySelector(".js-description-list").value.trim();

        if(image_added)
            obj.image = e.currentTarget.querySelector(".js-image").files[0];


        if(obj.description == '')
        {
            alert("Enter a description");
            e.currentTarget.querySelector(".js-description").focus();
            return;
        }

        if(obj.title == '')
        {
            alert("Enter a title");
            e.currentTarget.querySelector(".js-title").focus();
            return;
        }


        obj.progressbar = 'post-prog';

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
            window.location.href = '<?=ROOT?>/lists';
        } else {
            alert("Please fix the errors");
            for (key in obj.errors){
                alert(obj.errors[key]);
            }
        }

    }


</script>