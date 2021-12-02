<?php include('header.php');
require('back-end/users.php');
?>

<div class="container">
    <h1 class="text-center mb-5">Bienvenue sur le dashboard</h1>

    <div class="card">
        <h2 class="text-center">Liste des utilisateurs</h2>
        <button onclick="exportTableToCSV('test-narbonne.csv')" class="btn btn-primary w-25 d-block mx-auto">Télécharger la base de données</button>

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th>Code postal</th>
                        <th>Téléphone</th>
                        <th>Consentement</th>
                        <th>Véhicules</th>
                        <th>Réponse</th>
                    </tr>
                </thead>
                <?php foreach ($users as $user) : ?>
                    <tbody>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['nom'] ?></td>
                            <td><?= $user['prenom'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['adresse'] ?></td>
                            <td><?= $user['ville'] ?></td>
                            <td><?= $user['cp'] ?></td>
                            <td><?= $user['telephone'] ?></td>
                            <td><?php if ($user['consentement'] = true) {
                                    echo 'oui';
                                } else {
                                    echo 'non';
                                } ?></td>
                            <td><?= $user['vehicules'] ?></td>
                            <td><?= $user['reponse'] ?></td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>


<?php include('footer.php'); ?>