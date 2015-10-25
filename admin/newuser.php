<?php include 'pages/header.php';

$ok = NULL;
$error = NULL;

if (isset($_POST['nu'])) {
    extract($_POST);

    $mdp = random(5);
    $hmdp = hashMdp($mdp);

    $s = $bdd->prepare("SELECT * FROM `users` WHERE `login` = ? OR `mail` = ?");
    $s->execute(array($login,$mail));
    $n=$s->rowCount();

    if($n == 0) {
        $e = $bdd->prepare("INSERT INTO `users` (`login`,`mail`,`pass`,`rank`) VALUES(?,?,?,?)");
        $e->execute(array($login,$mail,$hmdp,$rank));
        mail($mail, "[ASBF] compte admin", "Utilisateur : ".$login." mdp : ".$mdp,"FROM: contact@asbf.fr");
        $ok = "ok ";
    } else {
        $error = "Nom d'utilisateur ou mail déjà pris";
    }
}

?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            New
                            <small>User</small>
                        </h1>
                    </div>
                    <?php
                    if ($data["rank"] != 1) {
                        echo "<h1>CETTE PAGE VOUS EST INTERDITE</h1> <a href='index.php'>retour index</a>";
                    } else {
                    ?>
                    <span style="color:green;"><?php echo $ok; ?></span><span style="color:red;"><?php echo $error; ?></span>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Mail</label>
                            <input type="email" name="mail" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" name="login" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Rank</label>
                            <select class="form-control" name="rank">
                                <?php
                                $r = $bdd->query("SELECT * FROM `rank` ORDER BY `id` DESC");

                                while ($dr=$r->fetch()) {
                                        ?>
                                <option value="<?php echo $dr['id']; ?>"><?php echo $dr['rank']; ?></option>

                    <?php } ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success" name="nu" value="Nouveau Utilisateur" />
                    </form>
                </div>
            </div>
        </div>
<?php } ?>
