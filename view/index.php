<!DOCTYPE html>
<html>

    <?php
        include_once(__DIR__.'/head.php');
    ?>
    <body>
        <?php
        include_once(__DIR__.'/header.php');
        if ($view === null) {
            $main = '/main.php';
        } else {
            $main = $view;
        }
        include_once(__DIR__.$main);
        include_once(__DIR__.'/footer.php');
        ?>
    </body> 
</html>