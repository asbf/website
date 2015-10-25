<?php
include("pages/header.php");

$error = NULL;
$ok = NULL;
$ook = NULL;
if(isset($_POST["nmdp"])) {
    extract($_POST);

    if(hashMdp($old) == $data['pass']) {
        if ($newone == $newtwo) {
            $hmdp = hashMdp($newone);
            $u = $bdd->prepare("UPDATE `users` SET `pass` = ? WHERE `login` = ?");
            $u->execute(array($hmdp,$data['login']));
            $ok = "Mot de passe changer";
        } else {
            $error = "Les deux mot de passes sont pas identique";
        }
    } else {
        $error = "Ancien mot de passe incorect";
    }

}

if (isset($_POST['m'])) {
    extract($_POST);

    $m = $bdd->prepare("UPDATE `users` SET `mail` = ? WHERE `login` = ?");
    $m->execute(array($email,$data["login"]));

    $ook = "Mail changer (rechargez pour voir les changements)";
}

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <center><h1><?php echo $data["login"]; ?></h1></center>

                <h2>changer email</h2>
                <span style="color:green;"><?php echo $ook; ?></span>
                <form role="form" method="POST" action="">
                   <div class="form-group">
                       <input type="text" value="<?php echo $data['mail']; ?>" class="form-control" name="email">
                   </div>
                   <input type="submit" value="Valider" name="m" class="btn btn-success">
                </form>

                <h2>Changement mot de passe</h2>
                <span style="color:red;"><?php echo $error; ?></span><span style="color:green;"><?php echo $ok; ?></span>
                <form role="form" method="POST" action="">
                    <div class="form-group">
                        <input class="form-control" type="password" name="old" placeholder="Ancien mot de passe">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="newone" placeholder="Nouveau mot de passe">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="newtwo" placeholder="Nouveau mot de passe">
                    </div>
                    <input type="submit" value="Valider" name="nmdp" class="btn btn-success">
                </form>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>
