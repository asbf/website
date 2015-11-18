<?php

require_once __DIR__ . '/pages/header.php';

$gid = $_GET['id'];

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
}

$ok = NULL;
$error = NULL;

if (isset($_POST['o'])) {
    $titre = htmlspecialchars($_POST['titre']);
    $region = $_POST['region'];
    $desc = htmlspecialchars($_POST['desc']);
    $link = htmlspecialchars($_POST['link']);

    $bdd->execute('UPDATE offre SET titre = :titre, region = :region, `desc` = :desc, link = :link WHERE id = :id', [':titre' => $titre, ':region' => $region, ':desc' => $desc, ':link' => $link, ':id' => $gid]);
    $ok = 'Ok !';
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
            $data = $bdd->queryOne('SELECT * FROM offre WHERE id = :id', [':id' => $gid]);
            ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Offre
                            <small>Bénévolat <a href="gest_offre.php">Gérer les offres</a></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <span style="color:red"><?= $error ?></span><span style="color:green"><?= $ok ?></span>
                <form role="form" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" type="text" value="<?= $data->titre ?>" name="titre" required>
                    </div>
                    <div class="form-group">
                        <label>Région</label>
                        <select class="form-control" name="region" required>
                            <option value="1" <?= $data->region==1 ? "selected" : ""; ?>>Alsace</option>
                            <option value="2" <?= $data->region==2 ? "selected" : ""; ?>>Aquitaine</option>
                            <option value="3" <?= $data->region==3 ? "selected" : ""; ?>>Auvergne</option>
                            <option value="4" <?= $data->region==4 ? "selected" : ""; ?>>Basse Normandie</option>
                            <option value="5" <?= $data->region==5 ? "selected" : ""; ?>>Bourgogne</option>
                            <option value="6" <?= $data->region==6 ? "selected" : ""; ?>>Bretagne</option>
                            <option value="7" <?= $data->region==7 ? "selected" : ""; ?>>Centre</option>
                            <option value="8" <?= $data->region==8 ? "selected" : ""; ?>>Champagne Ardenne</option>
                            <option value="9" <?= $data->region==9 ? "selected" : ""; ?>>Corse</option>
                            <option value="10" <?= $data->region==10 ? "selected" : ""; ?>>Franche Comté</option>
                            <option value="11" <?= $data->region==11 ? "selected" : ""; ?>>Haute Normandie</option>
                            <option value="12" <?= $data->region==12 ? "selected" : ""; ?>>Ile de France</option>
                            <option value="13" <?= $data->region==13 ? "selected" : ""; ?>>Languedoc roussillon</option>
                            <option value="14" <?= $data->region==14 ? "selected" : ""; ?>>Lauraine</option>
                            <option value="15" <?= $data->region==15 ? "selected" : ""; ?>>Limousin</option>
                            <option value="16" <?= $data->region==16 ? "selected" : ""; ?>>Midi Pyrenees</option>
                            <option value="17" <?= $data->region==17 ? "selected" : ""; ?>>Nord pas de calais</option>
                            <option value="18" <?= $data->region==18 ? "selected" : ""; ?>>Pays de la loire</option>
                            <option value="19" <?= $data->region==19 ? "selected" : ""; ?>>Picardie</option>
                            <option value="20" <?= $data->region==20 ? "selected" : ""; ?>>Poitou Charrante</option>
                            <option value="21" <?= $data->region==21 ? "selected" : ""; ?>>Provance Alple Cote D'Azure</option>
                            <option value="22" <?= $data->region==22 ? "selected" : ""; ?>>Rhone Alpe</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control"  name="desc" rows="12" required><?= $data->desc ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>lien</label>
                        <input class="form-control" type="link" value="<?= $data->link ?>" name="link" required>
                    </div>
                    <input type="submit" class="btn btn-success" value="Nouvelle offre" name="o">
                </form>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>
