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

<body class="grid-container-messages">


    <?php require_once "includes/left-sidebar-full.php"?>

    <div class="messages__main">
        <div class="messages__header">
            <div class="messages__header-left"><h4>Messages</h4></div>
            <div class="messages__header-right">
                <div>
                    <img src="<?=ROOT?>/assets/images/settings.png" width="18" height="18">
                </div>
                <div>
                    <a href="<?=ROOT?>/messages/compose">
                        <img src="<?=ROOT?>/assets/images/message.png" width="20" height="18" alt="">
                    </a>
                </div>
            </div>
        </div>


        <div class="direct__search">
            <label for="">
                <i class="fa fa-search"></i>
                <form method="get" action="<?=ROOT?>/messages/direct" role="search">
                    <input value="<?=old_value('find', '', 'get') ?>" name="find" type="search" placeholder="Search..." aria-label="Search">
                </form>
            </label>
        </div>

<!--        Бокс для аватара юзерів з ким в нас бесіда-->
        <?php if(!empty($directs)) : ?>
            <?php foreach ($directs as $direct): ?>
                <a href="<?=ROOT?>/messages/private/<?=esc($direct->direct_id)?>" class="direct__box">
                    <div class="direct__box-left">
                        <img src="<?=get_image($direct->avatar)?>" width="50" height="50" alt="">
                    </div>
                    <div class="direct__box-right">
                        <h4><?=esc($direct->username)?></h4>
                        <span>@<?=esc($direct->username)?></span>
                    </div>
                </a>
            <?php endforeach ?>
            <!--        Бокс для аватара юзерів з ким в нас бесіда-->
        <?php else: ?>
        <div class="messages__box">
            <h1>Welcome to your inbox!</h1>
            <p>Drop a line, share Tweets and more with private conversations between you and others on Twitter.</p>
            <a class="messages__a" href="<?=ROOT?>/messages/compose"><span>Write a message</span></a>
        </div>
        <?php endif; ?>
    </div>
    <!--===========================================================================-->
<!--    Блок для райт сайд бару,-->
    <?php if($data['section'] == 'default'): ?>
    <div class="right__sidebar-messages">
        <div>
            <h1>Select a message</h1>
            <p>Choose from your existing conversations, start a new one, or just keep swimming.</p>
            <a href="<?=ROOT?>/messages/compose"><span>New message</span></a>
        </div>
    </div>
    <?php endif; ?>
    <!--===========================================================================-->
<!--    Блок для райд сайт бару якщо ми відкриємо діалог-->
    <?php if($data['section'] == 'direct'): ?>
    <div class="right__sidebar-messages-direct">
        <?php if($privates):?>
            <?php foreach ($privates as $private): ?>
                <?php if($private->id != $user->id): ?>
                    <div class="right__sidebar-direct-header">
                        <div class="right__sidebar-direct-header-left"><img src="<?=get_image($private->avatar)?>" alt=""><span><?=esc($private->username)?></span></div>
                        <div class="right__sidebar-direct-header-right"><img src="<?=ROOT?>/assets/images/info.png" alt=""></div>
                    </div>
                <?php endif;?>
            <?php endforeach; ?>
        <?php endif; ?>

        <!--===========================================================================-->
<!--         Висвітлення самого повідомлення            -->
        <div class="right__sidebar-direct-body">
            <?php if(!empty($messages)) : ?>
                <?php foreach ($messages as $message): ?>
                    <?php if($message->sender_id == $user->id): ?>
                        <div class="messages__direct-text">
                            <div class="messages__direct-text-delete">
                                <img src="<?=ROOT?>/assets/images/three_dote.png" width="20" height="20">
                                <div class="messages__direct-text-delete-drop-content">
                                    <form method="post" onsubmit="delete_message(event)">
                                        <input type="hidden" id="message_id" value="<?=$message->id?>">
                                        <button class="messages_delete"><p>Delete message</p></button>
                                    </form>
                                    <form action="">
                                        <button class="messages_edit"><p>Edit message</p></button>
                                    </form>
                                </div>
                            </div>
                            <span><?=$message->description?></span>
                        </div>
                        <div class="messages__direct-failed"><p class="messages__failed">date</p><p>Sent</p></div>
<!--                        <div class="messages__direct-info"><span>Delete for you</span><p>Try again</p></div>-->
                    <?php else: ?>
                        <div class="messages__direct-text-recipient"><span><?=$message->description?></span></div>
                        <div class="messages__direct-failed-recipient"><p class="messages__failed">date</p><p>Sent</p></div>
                    <?php endif ?>
                <?php endforeach; ?>
            <?php else: ?>
            <div class="none_messages"><span>None messages</span></div>
            <?php endif; ?>
            <!--===========================================================================-->
            
        </div>
<!--        Форма дла повідомлення, знизу де іконки і конпка надіслати -->
        <form onsubmit="new_messages(event)" method="post" enctype="multipart/form-data" >
            <div class="right__sidebar-direct-footer">
                <div class="">
                    <input class="js-file" onchange="display_image(event)" type="file">
                    <img src="<?=ROOT?>/assets/images/picture.png" alt="">
                    <img src="<?=ROOT?>/assets/images/gif.png" alt="">
                    <img src="<?=ROOT?>/assets/images/happy.png" alt="">
                </div>

                <?php foreach ($privates as $private): ?>
                    <?php if($private->id != $user->id): ?>
                        <input type="hidden" id="recipient_id" value="<?=$private->id?>">
                        <input type="hidden" id="direct_id" value="<?=$private->direct_id?>">
                        <input class="first__input js-description" name="description" type="text" placeholder="Start a new message">
                    <?php endif; ?>
                <?php endforeach; ?>

                <button type="submit"><img src="<?=ROOT?>/assets/images/send.png" alt=""></button>
            </div>
            <div class="right__sidebar-direct-footer__post-edit-box d-none">
                <div class="right__sidebar-direct-footer__post-edit">
                    <div class="right__sidebar-direct-footer__post-edit-left">
                        <img class="message_image" src="" alt="">
                        <div>
                            <?php foreach ($privates as $private): ?>
                                <?php if($private->id != $user->id): ?>
                                    <input type="hidden" id="recipient_id" value="<?=$private->id?>">
                                    <input type="hidden" id="direct_id" value="<?=$private->direct_id?>">
                                    <input class="second_input" name="description" type="text" placeholder="Start a new message">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="right__sidebar-direct-footer__post-edit-right">
                        <button type="submit"><img src="<?=ROOT?>/assets/images/send.png" width="15" height="15"></button>
                    </div>
                </div>
            </div>
        </form>
        <div class="prog js-prog hide">
            <div class="prog-bar js-prog-bar">0%</div>
        </div>
    </div>
    <?php endif; ?>
    <!--===========================================================================-->
<!--    Блок для знахолдження челів для переписки-->
    <?php if($data['section'] == 'compose'): ?>
    <div class="background__container">
        <div class="compose__container">
            <div class="compose__header">
                <a href="<?=ROOT?>/messages" class="compose__close"><img src="<?=ROOT?>/assets/images/exit.png" alt=""></a>
                <h2></h2>
                <a href="<?=ROOT?>/messages/compose" class="compose__btn-next"><span>Next</span></a>
            </div>
            <div class="compose__search">
                <div class="compose__search-left">
                    <i class="fa fa-search"></i>
                </div>
                <form method="get" action="<?=ROOT?>/messages/compose" role="search">
                    <input value="<?=old_value('find', '', 'get') ?>" name="find" type="search" placeholder="Search..." aria-label="Search">
                </form>
            </div>
            <?php if($rows): ?>
            <?php foreach ($rows as $row): ?>
                <form onclick="new_direct(event)" method="post" action="">
                    <div class="compose__search-find">
                        <div class="compose__search-find-left"><img src="<?=get_image($row->avatar)?>" alt=""></div>
                        <div class="compose__search-find-right"><h4><?=esc($row->username)?></h4><p>@<?=esc($row->slug)?></p></div>
                        <input type="hidden" id="second_user" value="<?=$row->id?>">
                    </div>
                </form>
                <div class="prog js-prog hide">
                    <div class="prog-bar js-prog-bar">0%</div>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php endif; ?>
    <!--===========================================================================-->
</body>

<script>
    let file_added = false;
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
        document.querySelector('.message_image').src = URL.createObjectURL(file);
        document.querySelector('.right__sidebar-direct-footer__post-edit-box').classList.remove('d-none');
        document.querySelector('.first__input').classList.remove('js-description');
        document.querySelector('.right__sidebar-direct-footer').classList.add('d-none');
        document.querySelector('.second_input').classList.add('js-description');
        // change_avatar(file)

    }

    function new_direct(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'new_direct';
        obj.second_user = e.currentTarget.querySelector("#second_user").value;

        send_data(obj);
    }

    function delete_message(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'delete_messages';
        obj.id = e.currentTarget.querySelector("#message_id").value;

        send_data(obj);
    }

    function new_messages(e)
    {
        e.preventDefault();
        let obj = {};
        obj.data_type = "new_messages";

        obj.recipient_id = e.currentTarget.querySelector("#recipient_id").value;
        obj.direct_id = e.currentTarget.querySelector("#direct_id").value;

        obj.description = e.currentTarget.querySelector(".js-description").value.trim();

        if(image_added)
            obj.file = e.currentTarget.querySelector(".js-file").files[0];

        if(obj.description == '')
        {
            alert("Enter a description");
            e.currentTarget.querySelector(".js-description").focus();
            return;
        }

        send_data(obj);
    }

    function send_data(obj)
    {
        let myform = new FormData();

        for(key in obj)
        {
            myform.append(key, obj[key]);
        }

        let progbar = document.querySelector(".js-prog-bar");
        progbar.style.width = "0%";
        progbar.innerHTML = "0%";
        document.querySelector(".js-prog").classList.remove("hide");

        var xhr = new XMLHttpRequest();

        xhr.upload.addEventListener('progress', function(e)
        {
            let percent = Math.round((e.loaded / e.total) * 100);
            progbar.style.width = percent + "%";
            progbar.innerHTML = percent + "%";
        });

        xhr.addEventListener('readystatechange', function()
        {
            if (xhr.readyState == 4)
            {
                if(xhr.status == 200)
                {
                    document.querySelector(".js-prog").classList.add("hide");
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


