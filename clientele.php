<?php
require_once("config.php");

$clients  = $client->read();
?>
<?php require('header.php') ?>
<div class="_banniere">
    <h1>Ils nous ont fait confiance !</h1>
</div>

<div class="container">
<p><a href="addClient.php">Ajouter un client</a></p>
    <h2>Liste des clients</h2>
    
    <div class="card-body">
        <table class="table">
            <tr>
                <th>Identifiant du client</th>
                <th>Nom Complet</th>
                <th>Numéro téléphone</th>
                <th>Adresse email</th>
                <th>Adresse postale</th>
                <th>Action</th>
            </tr>
            <?php foreach ($clients as $client) : ?>
                <tr>
                    <td><?= $client->id ?></td>
                    <td><?= $client->prenom ?> <?= $client->nom ?></td>
                    <td><?= $client->telephone ?></td>
                    <td><?= $client->email ?></td>
                    <td><?= $client->adresse ?></td>
                    <td>
                        <a href="updateClient.php?id=<?= $client->id ?>" class="btn btn-info">Modifier</a>
                        <a onclick="return confirm('Confirmer la suppression')" href="deleteClient.php?id=<?= $client->id ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
   
    <h2>Des destinations qu'on adore</h2>
    <ul class="ma-liste">
        <li><span class="ville">Dakar</span> - La belle capitale sénégalaise</li>
        <li><span class="ville">Diourbel</span> - Charmante ville du Sénégal</li>
        <li><span class="ville">Ziguinchor</span> - Nichée au cœur de la Casamance</li>
        <li><span class="ville">Ouagadougou</span> - La capitale culturelle du Burkina Faso</li>
        <li><span class="ville">Abidjan</span> - Perle des lagunes en Côte d'Ivoire</li>
        <li><span class="ville">Bissau</span> - La tranquille capitale de la Guinée-Bissau</li>
    </ul>

</div>
<?php require('footer.php') ?>