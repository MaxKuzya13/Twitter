<a href="<?=ROOT?>/status/<?=$tweet->id?>" class="tweet_reply-box">
    <div class="top-line"></div>
    <div class="tweet_reply-wrapper">
        <div class="tweet_reply-avatar">
            <div class="tweet_reply-avatar-image"><img src="<?=get_image($tweet->avatar)?>"></div>
            <div class="tweet_reply-vertical-line"></div>
        </div>
        <div class="tweet_reply-body">
            <div class="tweet_reply-body-header">
                <div class="tweet_reply-body-header-left">
                    <form action="<?=ROOT?>/profile/<?=$tweet->user_id?>">
                        <button>
                            <h4><?=esc($tweet->username)?></h4>
                            <img src=""><span>@<?=esc($tweet->username)?></span><p>19h</p>
                        </button>

                    </form>
                </div>
                <div class="tweet_reply-body-header-right">
                    <button class="dropbtn tweet-reply-btn"><img width="23" height="23" src="<?=ROOT?>/assets/images/more.png"></button>
                    <div class="dropdown-content-tweet-reply hide">
                        <button ><i class="far fa-trash-alt"></i><span>More</span></button>
                        <button><i class="far fa-trash-alt"></i><span>Woto</span></button>
                        <?php if($tweet->user_id == $user->id) : ?>
                            <form onsubmit="delete_tweet(event)" method="post">
                                <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                <button><i class="far fa-trash-alt"></i><span>Delete</span></button>
                            </form>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <div class="tweet_reply-body-desc"><?=esc($tweet->description)?></div>
            <?php if($tweet->file): ?>
                <div class="tweet_reply-body-file"><img src="<?=get_image($tweet->file)?>"></div>
            <?php endif; ?>
            <div class="tweet_reply-body-icons">
                <div class="tweet_reply-box-icons-container">
                    <form class="tweet_reply-box-icons" action="<?=ROOT?>/homefull/compose/<?=$tweet->id?>"><button id="comment_icon"><img src="<?=ROOT?>/assets/images/comment.png"></button></form><span id="comment_count"><?=esc($tweet->reply)?></span>
                </div>

                <div class="tweet_reply-box-icons-container">
                    <?php if(isset($retweetTweet) && !empty($retweetTweet)): ?>

                        <?php $results = [];?>

                        <?php foreach ($retweetTweet as $retweet): ?>
                            <?php $results[] = $retweet->tweet_id ?>

                            <?php if($retweet->tweet_id == $tweet->id) : ?>
                                <form class="tweet_reply-box-icons" method="post" onsubmit="delete_retweet(event)">

                                    <button id="retweet_icon"><img src="<?=ROOT?>/assets/images/unretweet.png" width="23" height="23"></button>
                                    <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                    <input type="hidden" id="user_id" value="<?=$tweet->user_id?>">
                                    <input type="hidden" id="retweet_id" value="<?=$retweet->id?>">
                                </form>

                            <?php endif; ?>
                        <?php endforeach?>
                        <?php if(!in_array($tweet->id, $results)): ?>
                            <form class="tweet_reply-box-icons" method="post" onsubmit="new_retweet(event)">

                                <button id="retweet_icon"><img src="<?=ROOT?>/assets/images/retweet.png" width="23" height="23"></button>
                                <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                <input type="hidden" id="user_id" value="<?=$tweet->user_id?>">
                            </form>
                        <?php endif; ?>
                    <?php else : ?>
                        <form class="tweet_reply-box-icons" method="post" onsubmit="new_retweet(event)" action="">

                            <button id="retweet_icon"><img src="<?=ROOT?>/assets/images/retweet.png" width="23" height="23"></button>
                            <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                            <input type="hidden" id="user_id" value="<?=$tweet->user_id?>">
                        </form>
                    <?php endif; ?>
                    <span id="retweet_count"><?=esc($tweet->retweet)?></span>
                </div>

                <div class="tweet_reply-box-icons-container">
                    <?php if($likesTweet): ?>

                        <?php $results = [];?>

                        <?php foreach ($likesTweet as $like): ?>
                            <?php $results[] = $like->tweet_id ?>
                            <?php if($like->tweet_id == $tweet->id): ?>
                                <form class="tweet_reply-box-icons" method="post" onsubmit="delete_like(event)">

                                    <button id="like_icon"><img src="<?=ROOT?>/assets/images/unlike.png"></button>
                                    <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                    <input type="hidden" id="user_id" value="<?=$user->id?>">
                                    <input type="hidden" id="like_id" value="<?=$like->id?>">
                                </form>

                            <?php endif; ?>
                        <?php endforeach?>
                        <?php if(!in_array($tweet->id, $results)): ?>

                            <form class="tweet_reply-box-icons" method="post" onsubmit="get_like(event)">
                                <button id="like_icon"><img src="<?=ROOT?>/assets/images/like.png"></button>
                                <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                <input type="hidden" id="user_id" value="<?=$user->id?>">
                            </form>

                        <?php endif; ?>
                    <?php else : ?>

                        <form class="tweet_reply-box-icons" method="post" onsubmit="get_like(event)">
                            <button id="like_icon"><img src="<?=ROOT?>/assets/images/like.png"></button>
                            <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                            <input type="hidden" id="user_id" value="<?=$user->id?>">
                        </form>

                    <?php endif; ?>
                   <span id="like_count"><?=esc($tweet->likeable)?></span>
                </div>

                <div class="tweet_reply-box-icons-container">
                    <form class="tweet_reply-box-icons" action=""><button id="view_icon"><img src="<?=ROOT?>/assets/images/view.png"></button></form><span id="view_count"><?=esc($tweet->views)?></span>
                </div>

                <div class="tweet_reply-box-icons-container">
                    <?php if($tweetBookmark): ?>
                        <?php $res = []; ?>

                        <?php foreach ($tweetBookmark as $bookmark):?>
                            <?php $res[] = $bookmark->tweet_id ?>

                            <?php if($bookmark->tweet_id == $tweet->id): ?>
                                <form method="post" onsubmit="delete_save(event)" class="tweet_reply-box-icons">
                                    <button id="bookmark_icon"><img src="<?=ROOT?>/assets/images/unbookmark.png"></button>
                                    <input type="hidden" id="bookmark_id" value="<?=$bookmark->id?>">
                                    <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                </form>
                            <?php endif; ?>

                        <?php endforeach ?>

                        <?php if(!in_array($tweet->id, $res)):?>
                            <form method="post" onsubmit="new_save(event)" class="tweet_reply-box-icons">
                                <button id="bookmark_icon"><img src="<?=ROOT?>/assets/images/bookmark.png"></button>
                                <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                                <input type="hidden" id="user_id" value="<?=$user->id?>">
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <form method="post" onsubmit="new_save(event)" class="tweet_reply-box-icons">
                            <button id="bookmark_icon"><img src="<?=ROOT?>/assets/images/bookmark.png"></button>
                            <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                            <input type="hidden" id="user_id" value="<?=$user->id?>">
                        </form>

                    <?php endif; ?>


                </div>
            </div>
        </div>
    </div>

</a>

<script>


</script>