<?php
include_once "mysqlConnect.php";
// include_once "../style/css/headStyle.css";

function generation_head_menu ($mysqli) {
    $sql = "SELECT * FROM `topic`";
    $resSQL = $mysqli -> query($sql);
    ?>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">Главная</a>
            <ul class="navbar-nav mr-auto">
                <?php
                    while ($rowTopic = $resSQL -> fetch_assoc()) {
                        echo '<li class="nav-item"><a class="nav-link" href="./topic.php?id_topic='. $rowTopic["id"] .'">'. $rowTopic['name'].'</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>
    <?php
}

function generation_posts_index ($mysqli) {
    $sql = "SELECT * FROM `articles`";
    $res = $mysqli -> query($sql);

    if ($res -> num_rows > 0) {
        while ($resArticle = $res -> fetch_assoc()) {
            ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" ><a href="post.php?id_article=<?= $resArticle['id'] ?>"><?= $resArticle['title'] ?></a></h5>
                    <p class="card-text"><?= mb_substr($resArticle['text'], 0, 158, 'UTF-8') ?></p>
                </div>
            </div>
            <?php
        }
    } else {
        echo "Нет статей";
    }
}

function generation_posts_topic ($mysqli, $id_topic) {
    $sql = "SELECT * FROM `articles` WHERE `id_topic` = $id_topic";
    $res = $mysqli -> query($sql);

    if ($res -> num_rows > 0) {
        while ($resArticle = $res -> fetch_assoc()) {
            ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" ><a href="post.php?id_article=<?= $resArticle['id'] ?>"><?= $resArticle['title'] ?></a></h5>
                    <p class="card-text"><?= mb_substr($resArticle['text'], 0, 158, 'UTF-8') ?></p>
                </div>
            </div>
            <?php
        }
    } else {
        echo "В этом раздели статей нету";
    }
}

function generation_post ($mysqli, $id_article) {
    $sql = "SELECT * FROM `articles` WHERE `id` = '$id_article'";
    $res = $mysqli -> query($sql);

    if ($res -> num_rows === 1) {
        $resPost = $res -> fetch_assoc()?>
        <h1><?= $resPost['title'] ?></h1>
        <p><?= $resPost['text'] ?></p>
        <p>Дата публикации: <?= substr($resPost['date'], 0, 11) ?></p>
        <?php
    }
}

function generation_comment ($mysqli, $id_article) {
    $sql = "SELECT * FROM `comments` WHERE `id_article` = $id_article";
    $resSQL = $mysqli -> query($sql);

    if ($resSQL -> num_rows > 0) {
        while ($resComment = $resSQL -> fetch_assoc()) {
            ?> 
            <div class="comment">
                <p><b><?= $resComment['comment']?></b></p>
                <p>Оставлин: <?= substr($resComment['date'], 0, 11)  ?></p>
            </div>
            <hr>
            <?php
        }
    } else {
        ?>
            <p>Комментариев нет</p>
        <?php
    }
}
?> 
