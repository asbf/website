<?php

require_once __DIR__ . '/pages/header.php';

$ok = NULL;
$error = NULL;

if (isset($_POST['o'])) {

    $titre = $_POST['titre'];
    $region = $_POST['region'];
    $desc = htmlspecialchars($_POST['desc']);
    $link = htmlspecialchars($_POST['link']);

    $ext = strrchr($_FILES['monfichier']['name'],'.');
    $img = Password::random(50) . '' . $ext;

    if ($_FILES['monfichier']['error']== 0) {
        if ($_FILES['monfichier']['size'] <= 1000000000) {
            if ($ext == '.jpg' || $ext == '.jpeg' || $ext == '.png' || $ext == '.gif') {
                $bdd->execute('INSERT INTO offre (titre, region, `desc`, link, photo) VALUES(:titre, :region, :desc, :link, :img)', [':titre' => $titre, ':region' => $region, ':desc' => $desc, ':link' => $link, ':img' => $img]);

                move_uploaded_file($_FILES['monfichier']['tmp_name'], 'imgs/offres/' . $img);

                $ok = 'Ok !';
            } else{
                $error = 'Extention non supportée';
            }
        } else {
            $error = 'fichier trop gros';
        }
    } else {
        $error = 'Une erreur (fichier) est survenue';
    }
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
                <!-- Page Heading -->
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
                        <input class="form-control" type="text" name="titre" required>
                    </div>

                    <div class="form-group">
                        <label>Région</label>
                        <select class="form-control" name="region" required>
                            <option value="1">Alsace</option>
                            <option value="2">Aquitaine</option>
                            <option value="3">Auvergne</option>
                            <option value="4">Basse Normandie</option>
                            <option value="5">Bourgogne</option>
                            <option value="6">Bretagne</option>
                            <option value="7">Centre</option>
                            <option value="8">Champagne Ardenne</option>
                            <option value="9">Corse</option>
                            <option value="10">Franche Comté</option>
                            <option value="11">Haute Normandie</option>
                            <option value="12">Ile de France</option>
                            <option value="13">Languedoc roussillon</option>
                            <option value="14">Lauraine</option>
                            <option value="15">Limousin</option>
                            <option value="16">Midi Pyrenees</option>
                            <option value="17">Nord pas de calais</option>
                            <option value="18">Pays de la loire</option>
                            <option value="19">Picardie</option>
                            <option value="20">Poitou Charrante</option>
                            <option value="21">Provance Alple Cote D'Azure</option>
                            <option value="22">Rhone Alpe</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control"  name="desc" rows="12" required></textarea>
                    </div>
                     <div class="form-group">
                        <label>Photo</label>
                        <input type="file" name="monfichier" required>
                    </div>
                    <div class="form-group">
                        <label>Lien</label>
                        <input class="form-control" type="link" name="link" required>
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
