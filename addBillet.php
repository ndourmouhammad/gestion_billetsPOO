<?php
require_once("config.php");
$clients = $client->read();
$trajets = $trajets->getTrajet();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs soumises par le formulaire
    $date = htmlspecialchars($_POST['date']);
    $statut = htmlspecialchars($_POST['statut']);
    $id_client = htmlspecialchars($_POST['id_client']);
    $id__trajet = htmlspecialchars($_POST['id__trajet']);
    
    

    if ($date != "" && $statut != "" && $id_client != "" && $id__trajet != "") {
        $addBillet = $billet->create($date, $statut, $id_client, $id__trajet);
    }
}
?>

<?php require('header.php') ?>

<div class="banniere-create">
<h1>Nous vous remercions de votre intérêt pour notre plateforme de réservation.</h1>
</div>
<div class="container">
    <h2>Ajouter un billet</h2>
    <form method="post" class="reservation-form">
    <div class="form-row">
        <div class="form-group">
            <label for="date">Date de réservation :</label>
            <input type="datetime-local" id="date" name="date" required>
        </div>
        <div class="form-group">
    <label for="statut">Statut :</label>
    <select type='text' id="statut" name="statut" required>
        <option value="confirmée">Confirmée</option>
        <option value="en attente">En attente</option>
        <option value="annulée">Annulée</option>
    </select>
</div>


    </div>
   
    
    <div class="form-row">
        <div class="form-group">
            <label for="id__trajet">Le trajet :</label>
            <select type='text' name="id__trajet" id="id__trajet" required>
                <option value="">Choisis le trajet</option>
                <?php foreach ($trajets as $trajet) : ?>
                    <option value="<?php echo $trajet->id; ?>"><?php echo $trajet->trajet; ?> (<?php echo $trajet->prix?> CFA<?php ?>) </option>
                <?php endforeach; ?>
            </select><br><br>
        </div>
        <div class="form-group">
        <label for="id_client">Client</label>
            <select type='text' name="id_client" id="id_client" required>
                <option value="">Choisis le client</option>
                <?php foreach ($clients as $client) : ?>
                    <option value="<?php echo $client->id; ?>"><?php echo $client->email; ?> - <?php echo $client->prenom; ?>  <?php echo $client->nom; ?></option>
                <?php endforeach; ?>
            </select><br><br>
        </div>
    </div>
    
    
   
    <div class="form-row">
        <button type="submit">Réserver</button>
    </div>
</form>

</div>
<?php require('footer.php') ?>