<?php
/**
 * Created by PhpStorm.
 * User: pauldossantos
 * Date: 13/09/17
 * Time: 11:01
 */
session_start();
// var_dump($_SESSION['form']);
$FORM = $_SESSION['form'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>Mon formulaire</title>
</head>
<body>
    <p><img src="http://goo.gl/NVdRoV" alt="validation" /></p>
    <div id="success">
        <h2>Votre message à été envoyé avec succès</h2>
        <p>Merci <b><?php echo $FORM['user_name']; ?></b>, voici votre e-mail ayant comme sujet : <b>"<?php echo ucfirst ( $FORM['user_theme']); ?>"</b><?php echo $FORM['user_message']; ?>
            <br/>
            <br/>Nous pourrons vous contacter par e-mail à
            <br/><b><?php echo $FORM['user_email']; ?></b> ou au: <b><?php echo $FORM['user_phone']; ?></b>
        </p>

        <p class="aide">
            <b>Ma boucle foreach</b><br/>
            <?php

            foreach ($FORM as $key => $item) {
                echo $key . ' : ' . $item . '<br/>';
            };
            ?>
        </p>
</div>
</body>
</html>