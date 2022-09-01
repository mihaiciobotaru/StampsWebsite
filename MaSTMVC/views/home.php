<?php

/** @var $this View */

use app\core\View;

$this->title = 'Home';
?>
<div class="content">
    <div class="horizontal-list">
        <div class="list-header-container">
            <div class="list-buttons">
                <h1 class="list-header">Most popular uploads</h1>
                <label class="b-contain">
                    <input type="checkbox" />
                </label>
            </div>
        </div>

        <div class="slider">
            <?php echo $popularStamps ?>
        </div>
    </div>

    <div class="horizontal-list">
        <div class="list-header-container">
            <div class="list-buttons">
                <h1 class="list-header">New Users</h1>
                <label class="b-contain">
                    <input type="checkbox" />
                </label>
            </div>
        </div>

        <div class="slider">

            <?php echo $newUsers ?>

        </div>
    </div>

    <div class="horizontal-list">
        <div class="list-header-container">
            <div class="list-buttons">
                <h1 class="list-header">Most Active Users</h1>
                <label class="b-contain">
                    <input type="checkbox" />
                </label>
            </div>
        </div>

        <div class="slider">
            <?php echo $activeUsers ?>

        </div>

    </div>
    <form action="" method="get">
        <button type="submit">
            <a href='../core/Download.php?file=rssfeed.xml' class="home-button">Download RSS Feed</a>
        </button>
    </form>
</div>
</div>