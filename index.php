<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];

    if (strlen($_POST['user_name']) <= 2) {
        $errors['user_name_empty'] = 'Votre nom doit contenir plus de 2 caractères!';
    }

    $phone = "/[0-9]{2}[[:space:]][0-9]{2}[[:space:]][0-9]{2}[[:space:]][0-9]{2}[[:space:]][0-9]{2}/";
    if (!preg_match($phone, ($_POST['user_phone']))) {
        $errors['user_phone_empty'] = 'Ecrivez votre numéro comme ceci: xx xx xx xx xx';
    }

    if (empty($_POST['user_theme'])) {
        $errors['user_theme_empty'] = 'Votre thème ne peut être vide!';
    }

    if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
        $errors['user_email_empty'] = 'Votre e-mail est invalide mail@domaine.fr!';
    }

    if (empty($_POST['user_message'])) {
        $errors['user_message_empty'] = 'Votre message ne peut être vide!';
    }

    if (count($errors) == 0) {
        session_start();
        $_SESSION['form'] = $_POST;
        // Redirection vers page de validation
        header("Location: success.php");
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mon formulaire</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>MON FORMULAIRE</h1>
        <p>Je me suis amusé à faire un peut de REGEX, c'était plutôt amusant, au lieu de faire trop de conditions
            inutiles. Test mon formulaire et amuse toi. Quand tout sera respecté, tu aura le résumé de ta requête.</p>
        <br/>
    </header>
    <form action="" method="post">
        <fieldset>
            <legend>Mon Formulaire</legend>
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="user_name"
                       value="<?php if (isset($_POST['user_name'])) echo $_POST['user_name']; ?>"/>
                <p class="error"><?php if (isset($errors['user_name_empty'])) echo $errors['user_name_empty']; ?></p>
            </div>
            <div>
                <label for="phone">Téléphone :</label>
                <input type="tel" id="phone" name="user_phone"
                       value="<?php if (isset($_POST['user_phone'])) echo $_POST['user_phone']; ?>"/>
                <p class="error"><?php if (isset($errors['user_phone_empty'])) echo $errors['user_phone_empty']; ?></p>
                <p class="error"><?php if (isset($errors['user_phone_good'])) echo $errors['user_phone_good']; ?></p>
            </div>
            <div>
                <label for="user_theme">Thèmes :</label>
                <select name="user_theme" id="user_theme">
                    <option value=""></option>
                    <option value="comedy" <?php if (isset($_POST['user_theme']) && $_POST['user_theme'] == 'comedy') echo 'selected'; ?>>
                        Comedy
                    </option>
                    <option value="horror" <?php if (isset($_POST['user_theme']) && $_POST['user_theme'] == 'horror') echo 'selected'; ?>>
                        Horror
                    </option>
                    <option value="fantastic" <?php if (isset($_POST['user_theme']) && $_POST['user_theme'] == 'fantastic') echo 'selected'; ?>>
                        Fantastic
                    </option>
                </select>
                <p class="error"><?php if (isset($errors['user_theme_empty'])) echo $errors['user_theme_empty']; ?></p>
            </div>
            <div>
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="user_email"
                       value="<?php if (isset($_POST['user_email'])) echo $_POST['user_email']; ?>"/>
                <p class="error"><?php if (isset($errors['user_email_empty'])) echo $errors['user_email_empty']; ?></p>
            </div>
            <div>
                <label for="message">Message :</label>
                <textarea id="message"
                          name="user_message"><?php if (isset($_POST['user_message'])) echo $_POST['user_message']; ?></textarea>
            </div>
            <p class="error"><?php if (isset($errors['user_message_empty'])) echo $errors['user_message_empty']; ?></p>
            <br/>
            <div class="button">
                <button type="submit">Envoyer</button>
                <button type="reset">Reset</button>
            </div>
        </fieldset>
    </form>
</body>
</html>