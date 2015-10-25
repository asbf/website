<?php
include 'pages/header.php';

if(isset($_GET["id"]) && !empty($_GET["id"])){
    $s = $bdd->query("SELECT * FROM `news` WHERE id ='".$_GET['id']."'");
    $nbr=$s->rowCount();
}

?>
        <h1>Actualités ASBF</h1>
        <div class="panel panel-danger">
            <div class="panel-body">
                <br />
                <?php
                if (empty($_GET["id"]) || !isset($_GET["id"])) {
                    $sa = $bdd->query("SELECT * FROM `news` ORDER BY `id` DESC");
                    while($dsa=$sa->fetch()) {
                        $date = date("d/m/Y", strtotime($dsa['datefr']));
                ?>
                        <div>
                            <span><a href="actualites.php?id=<?php echo $dsa['id']; ?>"><?php echo $dsa['titre']; ?></a></span><span style="float:right"><?php echo $date; ?></span>
                        </div>
                <?php
                    }
                } elseif($nbr==0){
                    header('location: erreur.php');
                } else {
                    while ($ds=$s->fetch()) {
                        $dsate = date("d/m/Y", strtotime($ds['datefr']));
                ?>

                        <!-- TODO: check car wtf -->
                        <h2><b><?php echo $ds["titre"]; ?></b></h2>
                        <hr />
                        <div>
                            <span class="text-primary"><b><?php echo $ds["auteur"] ?></b></span>
                            <span class="text-primary" style="float:right;" ><b><?php echo $dsate; ?></b></span>
                        </div>
                        <br />
                        <?php
                        echo $ds["article"]. "<br />";
                    }
                }
                ?>
                <br />
            </div>
        </div>
<?php include("pages/footer.php"); ?>
