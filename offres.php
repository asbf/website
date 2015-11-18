<?php

require_once __DIR__ . '/pages/header.php';

$so = [];

if (empty($_GET['r']) && !isset($_GET['r']) ) {
    $msg = 'Aucune région définie';
} else {
    $so = $bdd->query('SELECT * FROM offre WHERE region = :region', [':region' => $_GET['r']]);

    if (empty($so)) {
        $msg = 'Aucune offre disponible';
    } else {
        $dl = $bdd->queryOne('SELECT * FROM region WHERE id = :id', [':id' => $_GET['r']]);

        $msg = 'il y a : ' . count($so) . ' offres en ' . $dl->libelle;
    }
}

?>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">Map</div>
                <script data-cfasync="false" src="cmap/France-map.js" type="text/javascript"></script>
                <script data-cfasync="false" type="text/javascript">
                    francefree();
                </script>
            </div>
        </div>
        <div class="col-lg-8">
            <?= $msg ?>
            <div class="row">
            <?php
            if (!empty($_GET['r']) && isset($_GET['r']) && count($so) > 0):
                foreach ($so as $dso):
                ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="admin/imgs/offres/<?= $dso->photo ?>" alt="photo" width="243px" hight="200px">
                        <div class="caption">
                            <h3><?= $dso->titre ?></h3>
                            <p><?= $dso->desc ?></p>
                            <p><a href="<?= $dso->link ?>" class="btn btn-primary" role="button">Lien</a></p>
                        </div>
                    </div>
                </div>
            <?php
                endforeach;
            endif;
            ?>
            </div>
        </div>
<?php include_once __DIR__ . '/pages/footer.php'; ?>
