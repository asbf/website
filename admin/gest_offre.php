<?php
include("pages/header.php");

if (isset($_POST["del"])) {
    extract($_POST);
    $d = $bdd->prepare("DELETE FROM `offre` WHERE `id` = ?");
    $d->execute(array($id));
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
                            <small>Bénévolat</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Titre</th><th>Region</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $o = $bdd->query("SELECT * FROM `offre` as `o`,`region` as `r` WHERE `r`.`id` = `o`.`region`");

                    while ($do=$o->fetch()) {
                        $ido = $do[0];
                    ?>
                        <tr>
                            <td><?php echo $do["titre"]; ?></td><td><?php echo $do["libelle"]; ?></td><td>
                                <form method="POST" action="">
                                    <input type="hidden" name="id" value="<?php echo $ido; ?>">
                                    <input type="submit" name="del" value="Suprimer" class="btn btn-danger">
                                </form>
                                <a href="modif_offre.php?id=<?php echo $ido; ?>"><button class="btn btn-primary">Mofifier</button></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>
