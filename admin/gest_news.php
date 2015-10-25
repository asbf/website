<?php
include("pages/header.php");

if (isset($_POST["del"])) {
    extract($_POST);
    $d = $bdd->prepare("DELETE FROM `news` WHERE `id` = ?");
    $d->execute(array($id));
}

?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            News
                            <small>Actu ASBF</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Titre</th><th>Auteur</th><th>Date</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $o = $bdd->query("SELECT * FROM `news` ORDER BY `id` DESC");

                    while ($do=$o->fetch()) {
                        $date = date("d/m/Y", strtotime($do["datefr"]));
                    ?>
                        <tr>
                            <td><?php echo $do["titre"]; ?></td><td><?php echo $do["auteur"]; ?></td><td><?php echo $date; ?></td><td>
                                <form method="POST" action="">
                                    <input type="hidden" name="id" value="<?php echo $do["id"]; ?>">
                                    <input type="submit" name="del" value="Suprimer" class="btn btn-danger">
                                </form>
                                <a href="modif_news.php?id=<?php echo $do["id"]; ?>"><button class="btn btn-primary">Modifier</button></a>
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
