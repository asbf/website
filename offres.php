<?php
include 'pages/header.php';

if (empty($_GET["r"]) && !isset($_GET["r"]) ) {
    $msg = "Aucune région définie";
} else {
    $so = $bdd->query("SELECT * FROM `offre` WHERE region='".$_GET["r"]."'");
    $nbr=$so->rowCount();
    if ($nbr==0) {
        $msg = "Aucune offre disponible";
    } else {
        $l = $bdd->query("SELECT * FROM `region` WHERE id = '".$_GET["r"]."'");
        $dl = $l->fetch();

        $msg = "il y a : ".$nbr." offres en ".$dl["libelle"];
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
            <?php echo $msg; ?>
            <div class="row">
            <?php
            if (!empty($_GET["r"]) && isset($_GET["r"]) && $nbr>0) {
                while ($dso=$so->fetch()) {
            ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="admin/imgs/offres/<?php echo $dso['photo']; ?>" alt="photo" width="243px" hight="200px">
                        <div class="caption">
                            <h3><?php echo $dso['titre']; ?></h3>
                            <p><?php echo $dso['desc']; ?></p>
                            <p><a href="<?php echo $dso['link']; ?>" class="btn btn-primary" role="button">Lien</a></p>
                        </div>
                    </div>
                </div>
            <?php
                }
            }
            ?>
            </div>
        </div>
<?php include("pages/footer.php"); ?>
