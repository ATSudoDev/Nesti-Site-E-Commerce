<html>

<head>
    <title>Formulaire</title>
</head>

<body>
    <?= $validation->listErrors() ?>

    <?= form_open('form') ?>

    <h5>Nom d'utilisateur</h5>
    <input type="text" name="username" value="" size="50" />

    <h5>Mot de passe</h5>
    <input type="text" name="password" value="" size="50" />

    <h5>Confirmation mot de passe</h5>
    <input type="text" name="passconf" value="" size="50" />

    <h5>Adresse email</h5>
    <input type="text" name="email" value="" size="50" />

    <div><input type="submit" value="Submit" /></div>
    
    </form>
</body>

</html>