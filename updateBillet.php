<?php
require_once("config.php");

// Récupération de la liste des clients
$clients = $client->read();

// Récupération de la liste des trajets
$trajets = $trajets->getTrajet();

// Vérification de l'existence de l'identifiant du billet dans la requête GET

    $id = $_GET['id'];

    // Vérification de la méthode de requête HTTP
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des valeurs soumises par le formulaire
        $date_heure_reservation = htmlspecialchars($_POST['date_heure_reservation']);
        $statut = htmlspecialchars($_POST['statut']);
        $id_client = htmlspecialchars($_POST['id_client']);
        $id__trajet = htmlspecialchars($_POST['id__trajet']);

        // Vérification que toutes les données sont fournies
       
            $updateBillet = $billet->update($id, $date_heure_reservation, $statut, $id_client, $id__trajet);
              
        
    }

    // Sélection du billet à modifier dans la base de données
    $sql = "SELECT * FROM billets JOIN clients ON billets.id_client = clients.id JOIN trajets ON trajets.id = billets.id__trajet WHERE billets.id= :id";
    $req = $connection->prepare($sql);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();

    // Récupération des données du billet
    $billets = $req->fetch(PDO::FETCH_ASSOC);

?>

<?php require('header.php') ?>

<div class="banniere-create">
    <h1>Nous vous remercions de votre intérêt pour notre plateforme de réservation.</h1>
</div>
<div class="container">
    <h2>Modifier un billet</h2>
    <form method="post" action="" class="reservation-form">
        <div class="form-row">
            <div class="form-group">
                <label for="date_heure_reservation">Date de réservation :</label>
                <input type="datetime-local" id="date_heure_reservation" name="date_heure_reservation" value="<?php echo $billets['date_heure_reservation']; ?>" required>
            </div>
            <div class="form-group">
                <label for="statut">Statut :</label>
                <select type='text' id="statut" name="statut" required>
                    <option value="confirmée" <?php if ($billets['statut'] == "confirmée") echo "selected"; ?>>Confirmée</option>
                    <option value="en attente" <?php if ($billets['statut'] == "en attente") echo "selected"; ?>>En attente</option>
                    <option value="annulée" <?php if ($billets['statut'] == "annulée") echo "selected"; ?>>Annulée</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="id__trajet">Le trajet :</label>
                <select type='text' name="id__trajet" id="id__trajet" required>
                    <option value="<?php echo $billets['id']; ?>"><?php echo $billets['trajet']; ?> (<?php echo $billets['prix']; ?> CFA)</option>
                    <?php foreach ($trajets as $trajet) : ?>
                        <option value="<?php echo $trajet->id; ?>"><?php echo $trajet->trajet; ?> (<?php echo $trajet->prix; ?> CFA) </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_client">Client</label>
                <select type='text' name="id_client" id="id_client" required>
                    <option value="<?php echo $billets['id_client']; ?>"><?php echo $billets['email']; ?> - <?php echo $billets['prenom']; ?> <?php echo $billets['nom']; ?></option>
                    <?php foreach ($clients as $client) : ?>
                        <option value="<?php echo $client->id; ?>"><?php echo $client->email; ?> - <?php echo $client->prenom; ?> <?php echo $client->nom; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <button type="submit">Mettre à jour</button>
        </div>
    </form>
</div>
<?php require('footer.php') ?>