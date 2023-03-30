<?
require_once('header.php');
?>

<section class="content" id="content">
    <div class="container">
        <?=$content?>
        <?php
            echo ($nav_pages != '') ? $nav_pages : '';
        ?>
    </div>
</section>

<?
require_once('footer.php');
?>