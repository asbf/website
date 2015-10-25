<?php
include 'pages/header.php';

if (isset($_POST['m'])) {
    extract($_POST);
    $name = htmlspecialchars($name);
    $subject = htmlspecialchars($subject);
    $mail = htmlspecialchars($mail);
    //$msg = htmlspecialchars($msg);
    //CONTINUER LES MAILS

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) { // On filtre les serveurs qui présentent des bogues.
        $passage_ligne = "\r\n";
    } else {
        $passage_ligne = "\n";
    }

    //=====Déclaration des messages au format texte et au format HTML.
    $message_txt = "Nouveau message : ASBF ".$passage_ligne;
    $message_txt .= "Mail : ".$mail.$passage_ligne;
    $message_txt .= "Sujet :".$subject.$passage_ligne;
    $message_txt .= "Nom :".$name.$passage_ligne;
    $message_txt .= "Message :".$msg;

    $message_html = "<html><head></head><body><ul>";
    $message_html .= "<li>Mail : ".$mail."</li>";
    $message_html .= "<li>Sujet : ".$subject."</li>";
    $message_html .= "<li>Nom : ".$name."</li>";
    $message_html .= "<li>Message : ".$msg."</li></ul></body></html>";
    //==========


    //=====Création de la boundary.
    $boundary = "-----=".md5(rand());
    $boundary_alt = "-----=".md5(rand());
    //==========

    //=====Définition du sujet.
    $sujet = $subject;
    //=========

    //=====Création du header de l'e-mail.
    $header = "From: \"".$name."\"<".$mail.">".$passage_ligne;
    $header.= "Reply-to: \"".$name."\" <".$mail.">".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    //==========

    //=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
    //=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
    //==========

    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

    //=====Ajout du message au format HTML.
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
    //==========

    //=====On ferme la boundary alternative.
    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
    //==========

    $message.= $passage_ligne."--".$boundary.$passage_ligne;

    //=====Envoi de l'e-mail.
    mail($service,$sujet,$message,$header);

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
        <div class="jumbotron">
            <h3>Nous contacter</h3>
            <hr>
            <div align="right">
                <h6>ADRESSES MAIL</h6>
                <h5>contact@asbf.fr<br>secretaire@asbf.fr<br>tresorier@asbf.fr<br>tech@asbf.fr<br>rs@asbf.fr</h5>
            </div>
            <hr>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><b>Formulaire</b></h3>
                </div>
                <div class="panel-body">
                    <form method="POST" role="form" action="">
                        <div class="form-group">
                            <label>Nom/Pseudo</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Sujet</label>
                            <input type="text" class="form-control" name="subject">
                        </div>
                        <div class="form-group">
                            <label>Mail</label>
                            <input type="email" class="form-control" name="mail">
                        </div>
                        <div class="form-group">
                            <label>Service</label>
                            <select class="form-control" name="service">
                                <option value="secretaire@asbf.fr">Secrétariat</option>
                                <option value="tech@asbf.fr">Développement</option>
                                <option value="tresorier@asbf.fr">Trésorerie</option>
                                <option value="contact@asbf.fr">Bureau</option>
                                <option value="rs@asbf.fr">Communication</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" id="elm1" name="msg"></textarea>
                        </div>
                        <input type="submit" name="m" value="Envoyer" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
<?php include("pages/footer.php"); ?>
