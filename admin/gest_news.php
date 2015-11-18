<?php

require_once __DIR__ . '/pages/header.php';

if (isset($_POST['del'])) {
    $id = htmlspecialchars($_POST['id']);
    $bdd->execute('DELETE FROM news WHERE id = :id', [':id' => $id]);
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
                    $data = $bdd->query('SELECT * FROM news ORDER BY id DESC');

                    foreach ($data as $row):
                        $date = date('d/m/Y', strtotime($row->datefr));
                    ?>
                        <tr>
                            <td><?= $row->titre ?></td><td><?= $row->auteur ?></td><td><?= $date; ?></td><td>
                                <form method="POST" action="">
                                    <input type="hidden" name="id" value="<?= $row->id ?>">
                                    <input type="submit" name="del" value="Suprimer" class="btn btn-danger">
                                </form>
                                <a href="modif_news.php?id=<?= $row->id ?>"><button class="btn btn-primary">Modifier</button></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
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
