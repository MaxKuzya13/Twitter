<a href="#" class="right-sidebar-full-trend">
    <div class="right-sidebar-full-trend-container">
        <div class="right-sidebar-full-trend-avatar">
            <img src="<?=get_image($trend->avatar) ?? ''?>">
        </div>

        <div class="right-sidebar-full-trend-body">
            <span><?=$trend->username?></span>
            <p>#<?=$trend->username?></p>
        </div>

        <div class="right-sidebar-full-trend-follow">
            <?php if(isset($follows) && !empty($follows)): ?>
                <?php $res = []; ?>
                <?php foreach ($follows as $follow): ?>

                    <?php $res[] = $follow->account_id ?>

                    <?php if($follow->account_id == $trend->id): ?>

                        <form onsubmit="unfollow_to_user(event)" method="post">
                            <button type="submit" id="unfollow" >Unfollow</button>
                            <input type="hidden" id="account_id" value="<?=$follow->account_id?>">
                            <input type="hidden" id="follower_id" value="<?=$follow->follower_id?>">
                            <input type="hidden" id="follow_id" value="<?=$follow->id?>">
                        </form>

                    <?php endif; ?>

                <?php endforeach; ?>

                <?php if(!in_array($trend->id, $res)): ?>

                    <form onsubmit="follow_to_user(event)" method="post">
                        <button type="submit" id="follow" >Follow</button>
                        <input type="hidden" id="account_id" value="<?=$trend->id?>">
                        <input type="hidden" id="follower_id" value="<?=$user->id?>">
                    </form>

              <?php endif; ?>

            <?php else: ?>

                    <form onsubmit="follow_to_user(event)" method="post">
                        <button type="submit" id="follow" >Follow</button>
                        <input type="hidden" id="account_id" value="<?=$trend->id?>">
                        <input type="hidden" id="follower_id" value="<?=$user->id?>">
                    </form>

            <?php endif ?>

        </div>
    </div>
</a>

<script>
    function follow_to_user(e)
    {
        e.preventDefault();

        let obj = {};

        obj.data_type = 'follow';
        obj.follower_id = e.currentTarget.querySelector("#follower_id").value.trim();
        obj.account_id = e.currentTarget.querySelector("#account_id").value.trim();

        send_data(obj);
    }

    function unfollow_to_user(e)
    {
        e.preventDefault();

        let obj = {};

        obj.data_type = 'unfollow';
        obj.follower_id = e.currentTarget.querySelector("#follower_id").value.trim();
        obj.account_id = e.currentTarget.querySelector("#account_id").value.trim();
        obj.id = e.currentTarget.querySelector("#follow_id").value.trim();

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