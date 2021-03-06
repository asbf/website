<?php

require_once __DIR__ . '/pages/header.php';

$error = NULL;
$ook = NULL;
$ok = NULL;

if (isset($_POST['nmdp'])) {
    $old = htmlspecialchars($_POST['old']);
    $newone = htmlspecialchars($_POST['newone']);
    $newtwo = htmlspecialchars($_POST['newtwo']);

    if(Password::hash($old) === $user->pass) {
        if ($newone === $newtwo) {
            $hmdp = Password::hash($newone);
            $bdd->execute('UPDATE users SET pass = :pass WHERE login = :login', [':pass' => $hmdp, ':login' => $user->login]);
            $ok = 'Mot de passe changé';
        } else {
            $error = 'Les deux mot de passes sont pas identique';
        }
    } else {
        $error = 'Ancien mot de passe incorrect';
    }

}

if (isset($_POST['m'])) {
    extract($_POST);

    $email = htmlspecialchars($_POST['email']);

    $bdd->execute('UPDATE users SET mail = :email WHERE login = :login', [':email' => $email, ':login' => $user->login]);

    $ook = 'Mail changé (rechargez pour voir les changements)';
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
                <center><h1><?= $user->login ?></h1></center>

                <h2>Changer email</h2>
                <span style="color:green;"><?= $ook ?></span>
                <form role="form" method="POST" action="">
                   <div class="form-group">
                       <input type="text" value="<?= $user->mail ?>" class="form-control" name="email">
                   </div>
                   <input type="submit" value="Valider" name="m" class="btn btn-success">
                </form>

                <h2>Changement mot de passe</h2>
                <span style="color:red;"><?= $error ?></span><span style="color:green;"><?= $ok ?></span>
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
