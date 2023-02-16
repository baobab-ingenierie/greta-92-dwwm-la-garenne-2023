<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Owners</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body class="container">
    <h1>Owners</h1>

    <form method="post" action="save_owner.php">
        <div class="mb-3">
            <label class="form-label" for="lname">Nom</label>
            <input class="form-control" type="text" name="lname" id="lname" pattern="^[A-Za-zÀ-ÿ\- ]{1,30}$" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="fname">Prénom</label>
            <input class="form-control" type="text" name="fname" id="fname" pattern="^[A-Za-zÀ-ÿ\- ]{1,30}$" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">Courriel</label>
            <input class="form-control" type="email" name="email" id="email">
        </div>
        <input class="btn btn-success" type="submit" value="Enregistrer">
    </form>
</body>

</html>