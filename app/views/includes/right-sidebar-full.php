<div class="right__sidebar-full">
    <div class="search-container">
        <a href="#" class="search-btn">
            <i class="fa fa-search"></i>
        </a>
        <input type="text" name="search" placeholder="Search Twitter" class="search-input">
    </div>

    <div class="trends__container">

        <div class="trends__box-full">
            <div class="trends__header-full">
                <p>Who to follow</p>
            </div>

            <div class="trends__body-full">


                <?php if($trends): ?>
                    <?php foreach ($trends as $trend): ?>
                         <?php  require 'right-sidebar-trend.php' ?>
                    <?php endforeach; ?>
                <?php endif; ?>



                <div class="trends__show-more-full">
                    <a href="">Show more</a>
                </div>
            </div>

        </div>
    </div>
</div>
