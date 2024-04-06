<?php
require_once("config.php");

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs soumises par le formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $telephone = htmlspecialchars($_POST['telephone']);
    

    if ($client->validerChaine($nom) && $client->validerChaine($prenom) && $client->validerEmail($email) && $client->validerTelephone($telephone)) {
        $addclient = $client->update($id, $nom, $prenom, $email, $adresse, $telephone);
    } else {
        echo 'Données invalides. Veuillez vérifier à nouveau avant de soumettre';
    }
}

try {
    $sql = 'SELECT * FROM clients WHERE id = :id';

    $statement = $connection->prepare($sql);
    $statement->bindValue("id", $id, PDO::PARAM_INT);
    $statement->execute();
    $clients = $statement->fetch(PDO::FETCH_OBJ);
    
} catch (PDOException $erreur) {
    die("Erreur !: " . $erreur->getMessage() . "<br/>");
}

?>

<?php require('header.php') ?>

<div class="banniere-create">
<h1>Nous vous remercions de votre intérêt pour notre plateforme de réservation.</h1>
</div>
<div class="container">
    <h2>Modifier les informations d'un client</h2>
    <form method="post" class="reservation-form">
    <div class="form-row">
        <div class="form-group">
            <label for="nom">Nom du client :</label>
            <input type="text" id="nom" name="nom" value="<?= $clients->nom; ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom du client :</label>
            <input type="text" id="prenom" name="prenom" value="<?= $clients->prenom; ?>"  required>
        </div>
    </div>
   
    
    <div class="form-row">
        <div class="form-group">
            <label for="adresse">Adresse postale :</label>
            <input type="text" id="adresse" name="adresse" value="<?= $clients->adresse; ?>"  required>
        </div>
        <div class="form-group">
            <label for="telephone">Numéro téléphone :</label>
            <input type="tel" id="telephone" name="telephone" value="<?= $clients->telephone; ?>"  required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="email">Adresse email :</label>
            <input type="email" id="email" name="email" value="<?= $clients->email; ?>"  required>
        </div>
    </div>
    
   
    <div class="form-row">
        <button type="submit">Valider les modifications</button>
    </div>
</form>

</div>
<?php require('footer.php') ?>