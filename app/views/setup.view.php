<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/home-full.css">
    <title>Twitter login</title>
</head>
<body class="setup_bg">

<div class="container">
    <form onsubmit="edit_data(event)" method="post" class="settings__container" enctype="multipart/form-data">
            <div class="settings__box-header">
                <div class="settings__box-header-left"><a href="<?=ROOT?>/profile/<?=$user->id?>"><img src="<?=ROOT?>/assets/images/exit.png" alt=""></a></div>
                <div class="settings__box-header-main"><h4>Edit profile</h4></div>
                <div class="settings__box-header-right"><button type="submit"><span>Save</span></button></div>
            </div>

            <div class="settings__box-image">
                <img class="settings_box-bg-img" src="<?=get_image($row->header)?>" alt="">
                <div class="settings__box-image-input">
                    <div class="settings__box-image-input-one"><input id="header" onchange="display_bg_image(event)" type="file"><img src="<?=ROOT?>/assets/images/camera.png" alt=""></div>
                </div>
            </div>

            <div class="settings__box-avatar">
                <div class="settings__box-avatar-main"><img class="settings__box-avatar-img" src="<?=get_image($row->avatar)?>" alt=""></div>
                <div class="settings__box-image-input">
                    <div class="settings__box-image-input-one"><input id="avatar" onchange="display_avatar(event)" type="file"><img src="<?=ROOT?>/assets/images/camera.png" alt=""></div>
                </div>
            </div>

            <div class="settings__box-body">
                <div class="settings__box-body-name">
                    <div>
                        <input value="<?=old_value('username', $row->username)?>" type="text" placeholder="Name" id="username">
                    </div>
                </div>
                <div class="settings__box-body-bio">
                    <div>
                        <textarea id="bio" placeholder="Bio" cols="30" rows="10"><?=$row->bio?></textarea>
                    </div>
                </div>
                <div class="settings__box-body-location">
                    <div>
                        <input value="<?=old_value('location', $row->location)?>" type="text" placeholder="Location" id="location">
                    </div>
                </div>
                <div class="settings__box-body-website">
                    <div>
                        <input value="<?=old_value('website', $row->website)?>" type="text" placeholder="Website" id="website">
                    </div>
                </div>
                <div class="settings__box-body-birthday">
                    <div class="settings__box-body-birthday-header"><span>Birth date</span><p>Edit</p></div>
                    <div class="settings__box-body-birthday-main"><h4>January 23, 1999</h4></div>
                </div>
                <a href="#" class="settings__box-body-profession">
                    <span>Switch to professional</span><p>go</p>
                </a>
            </div>
    </form>
    <div class="post-prog progress d-none">
        <div class="progress-bar"style="width: 0;">0%</div>
    </div>
</div>

</body>
</html>

<script>
    function display_bg_image(e)
    {
        let file = e.currentTarget.files[0];
        let allowed = ['image/jpeg', 'image/png', 'image/webp'];

        if(!allowed.includes(file.type))
        {
            header_added = false;
            alert('File type not valid! Files type allowed: '+allowed.toString().replaceAll('image/', ''));
            return;
        }
        header_added = true;
        document.querySelector('.settings_box-bg-img').src = URL.createObjectURL(file);
        // change_bg_image(file);

    }

    function display_avatar(e)
    {
        let file = e.currentTarget.files[0];
        let allowed = ['image/jpeg', 'image/png', 'image/webp'];

        if(!allowed.includes(file.type))
        {
            avatar_added = false;
            alert('File type not valid! Files type allowed: '+allowed.toString().replaceAll('image/', ''));
            return;
        }
        avatar_added = true;
        document.querySelector('.settings__box-avatar-img').src = URL.createObjectURL(file);
        // change_avatar(file)

    }

    function delete_image(e)
    {
        image_added = false;
        e.currentTarget.parentNode.querySelector('img').src = "<?=ROOT?>/assets/images/no_image.jpg";
    }

</script>

<script>

    let = avatar_added = false;
    let = header_added = false;
    function edit_data(e)
    {
        e.preventDefault();

        var obj = {};
        obj.data_type = 'profile-settings';

        if(avatar_added)
            obj.avatar = e.currentTarget.querySelector("#avatar").files[0];

        if(header_added)
            obj.header = e.currentTarget.querySelector("#header").files[0];

        obj.id = "<?=user('id')?>";


        obj.username = e.currentTarget.querySelector("#username").value.trim();
        obj.bio = e.currentTarget.querySelector("#bio").value.trim();
        obj.location = e.currentTarget.querySelector("#location").value.trim();
        obj.website = e.currentTarget.querySelector("#website").value.trim();

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

        alert(obj.message);

        if(obj.success)
            window.location.href = '<?=ROOT?>/profile';

    }
</script>