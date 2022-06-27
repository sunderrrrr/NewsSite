<?php
include_once "./templates/generation.php";
$id_article = $_REQUEST["id_article"];
$comment = $_REQUEST["comment"];

function send_comment ($mysqli, $comment, $id_article) {
    $sql = "INSERT INTO `comments` (`comment`, `id_article`, `date`) VALUES ('$comment', '$id_article', CURRENT_TIMESTAMP)";
    $mysqli -> query($sql);
    echo '<script>location.replace("http://first-my-blog-php/post.php?id_article=' . $id_article . '");</script>'; exit;
}

if (isset($_REQUEST['doGo']) === true) {
    send_comment($mysqli, $_REQUEST['comment'], $id_article);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Статья</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <?php 
        generation_head_menu($mysqli);
    ?>
    <div class="container">
        <?php
        generation_post($mysqli, $id_article);
        ?>
    </div>
    <div class="comments container">
        <hr>
        <form action="<?= $_SERVER["SCRIPT_NAME"] ?>">
            <textarea name="comment" id="" style="width:800px; height:50px;"></textarea>
            <input type="hidden" name="id_article" value="<?php echo $id_article ?>">
            <input name="doGo" type="submit" value="Отправить">
        </form>
        <p>Коментарии:</p>
        <hr>
        
        <?php 
            generation_comment($mysqli, $id_article);
        ?>
    </div>
</body>
</html>