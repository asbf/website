<?php include("pages/header.php");

$gid = $_GET["id"];

if (!isset($_GET["id"]) || empty($_GET['id'])) {
?>
        <script type="text/javascript">
        document.location.href="index.php";
        </script>
<?php
}

$ok = NULL;
$error = NULL;
if (isset($_POST['o'])) {
    extract($_POST);
                $offre = $bdd->prepare("UPDATE `offre` SET `titre` = ?, `region` = ?, `desc` = ?, `link` = ? WHERE id = ?");
                $offre->execute(array($titre,$region,$desc,$link,$gid));
                $ok = "Ok !";
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
            $so = $bdd->prepare("SELECT * FROM `offre` WHERE id = ?");
            $so->execute(array($gid));
            $nb=$so->rowCount();
            $do=$so->fetch();
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
                <span style="color:red"><?php echo $error; ?></span><span style="color:green"><?php echo $ok; ?></span>
                <form role="form" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" type="text" value="<?php echo $do["titre"]; ?>" name="titre" required>
                    </div>
                    <div class="form-group">
                        <label>Région</label>
                        <select class="form-control" name="region" required>
                            <option value="1" <?php echo ($do['region']==1) ? "selected" : ""; ?>>Alsace</option>
                            <option value="2" <?php echo ($do['region']==2) ? "selected" : ""; ?>>Aquitaine</option>
                            <option value="3" <?php echo ($do['region']==3) ? "selected" : ""; ?>>Auvergne</option>
                            <option value="4" <?php echo ($do['region']==4) ? "selected" : ""; ?>>Basse Normandie</option>
                            <option value="5" <?php echo ($do['region']==5) ? "selected" : ""; ?>>Bourgogne</option>
                            <option value="6" <?php echo ($do['region']==6) ? "selected" : ""; ?>>Bretagne</option>
                            <option value="7" <?php echo ($do['region']==7) ? "selected" : ""; ?>>Centre</option>
                            <option value="8" <?php echo ($do['region']==8) ? "selected" : ""; ?>>Champagne Ardenne</option>
                            <option value="9" <?php echo ($do['region']==9) ? "selected" : ""; ?>>Corse</option>
                            <option value="10" <?php echo ($do['region']==10) ? "selected" : ""; ?>>Franche Comté</option>
                            <option value="11" <?php echo ($do['region']==11) ? "selected" : ""; ?>>Haute Normandie</option>
                            <option value="12" <?php echo ($do['region']==12) ? "selected" : ""; ?>>Ile de France</option>
                            <option value="13" <?php echo ($do['region']==13) ? "selected" : ""; ?>>Languedoc roussillon</option>
                            <option value="14" <?php echo ($do['region']==14) ? "selected" : ""; ?>>Lauraine</option>
                            <option value="15" <?php echo ($do['region']==15) ? "selected" : ""; ?>>Limousin</option>
                            <option value="16" <?php echo ($do['region']==16) ? "selected" : ""; ?>>Midi Pyrenees</option>
                            <option value="17" <?php echo ($do['region']==17) ? "selected" : ""; ?>>Nord pas de calais</option>
                            <option value="18" <?php echo ($do['region']==18) ? "selected" : ""; ?>>Pays de la loire</option>
                            <option value="19" <?php echo ($do['region']==19) ? "selected" : ""; ?>>Picardie</option>
                            <option value="20" <?php echo ($do['region']==20) ? "selected" : ""; ?>>Poitou Charrante</option>
                            <option value="21" <?php echo ($do['region']==21) ? "selected" : ""; ?>>Provance Alple Cote D'Azure</option>
                            <option value="22" <?php echo ($do['region']==22) ? "selected" : ""; ?>>Rhone Alpe</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control"  name="desc" rows="12" required><?php echo $do["desc"]; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>lien</label>
                        <input class="form-control" type="link" value="<?php echo $do["link"]; ?>" name="link" required>
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
