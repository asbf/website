<?php

require_once __DIR__ . '/pages/header.php';

$gid = $_GET['id'];

if (empty($_GET['id']) || !isset($_GET['id'])) {
    header('Location: index.php');
}

$msg = NULL;

if (isset($_POST['news'])) {
    extract($_POST);
    $titre = htmlspecialchars($_POST['titre']);
    $auteur = $_POST['auteur'];
    $article = $_POST['article'];

    $bdd->execute('UPDATE news SET titre = :titre, auteur = :auteur, article = :article WHERE id = :id', [':titre' => $titre, ':auteur' => $auteur, ':article' => $article, ':id' => $gid]);

    $msg = 'Ok !';
}

?>
        <script data-cfasync='false' type='text/javascript'>
        tinymce.init({
            selector: "textarea#elm1",
            theme: "modern",
            height: 300,
            plugins: [
                 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                 "save table contextmenu directionality emoticons template paste textcolor"
           ],
           content_css: "css/content.css",
           toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
           style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
         });
        </script>
        <div id="page-wrapper">
            <div class="container-fluid">
            <?php
            $data = $bdd->queryOne('SELECT * FROM news WHERE id = :id', [':id' => $gid]);

            if ($data === null) {
                header('Location: index.php');
            }
            ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            News
                            <small>Actu ASBF <a href="gest_news.php">Gérer les news</a></small>
                        </h1>
                    </div>
                    <span style="color:green"><?= $msg ?></span>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text" name="titre" value="<?= $data->titre ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Auteur</label>
                            <input type="text" value="<?= $user->login ?>" class="form-control" disabled>
                            <input type="hidden" value="<?= $user->login ?>" name="auteur" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea rows="12" class="form-control" id="elm1" name="article"><?= $data->article ?></textarea>
                        </div>
                        <input type="submit" name="news" class="btn btn-success" value="Nouvelle actu">
                    </form>
                </div>
            </div>
        </div>
