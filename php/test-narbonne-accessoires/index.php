<?php include('header.php'); ?>

<h1 class="text-center mb-5">Bienvenue sur le jeu concours organisé par narbonne accessoires</h1>

<div class="container">
    <h2 class="text-center">Veuillez répondre au questionnaire suivant pour tenter votre chance !</h2>

    <div class="card p-5">
        <h5>Les champs en rouge sont obligatoires</h5>

        <form method="post" action="back-end/formulaire.php">
            <!-- radio -->
            <h3>Quelle est la nouvelle attraction du Futuroscope inaugurée en 2020 ? </h3>
            <input class="form-check-input" type="radio" name="radio" id="exampleRadios1" value="arthur" required>
            <label class="form-check-label" for="exampleRadios1">
                Arthur, l’aventure 4D
            </label>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio" id="exampleRadios2" value="mars" required>
                <label class="form-check-label" for="exampleRadios2">
                    Objectif Mars
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio" id="exampleRadios3" value="robot" required>
                <label class="form-check-label" for="exampleRadios3">
                    Danse avec les robots
                </label>
            </div>
            <!-- <div class="form-check">
                <input class="form-check-input" type="hidden" name="radio" id="exampleRadios4" value="" checked>
            </div> -->

            <!-- Info utilisateur -->
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Votre nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Votre prénom" required>
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Votre téléphone" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Votre adresse">
            </div>
            <div class="form-group">
                <label for="code-postal">Code postal</label>
                <input type="text" class="form-control" name="cp" id="code-postal" placeholder="Votre code postal" required>
            </div>
            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" class="form-control" name="ville" id="ville" placeholder="Votre ville">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="consentement" name="consentement" required>
                <label class="form-check-label" for="consentement">J'accepte de recevoir les actualités et les bons plans Narbonne Accessoire</label>
            </div>

            <!-- checkbox -->
            <h3>Votre véhicule de loisirs :</h3>
            <div class="form-check">
                <input class="form-check-input" name="checkbox[]" type="checkbox" value="camping-car" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Camping-car
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="checkbox[]" type="checkbox" value="fourgon" id="defaultCheck2">
                <label class="form-check-label" for="defaultCheck2">
                    Fourgon
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="checkbox[]" type="checkbox" value="caravane" id="defaultCheck2">
                <label class="form-check-label" for="defaultCheck2">
                    Caravane
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="checkbox[]" type="checkbox" value="4x4" id="defaultCheck2">
                <label class="form-check-label" for="defaultCheck2">
                    4x4
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="checkbox[]" type="checkbox" value="bateau" id="defaultCheck2">
                <label class="form-check-label" for="defaultCheck2">
                    Bateau
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="checkbox[]" type="checkbox" value="autres" id="defaultCheck2">
                <label class="form-check-label" for="defaultCheck2">
                    Autres
                </label>
            </div>

            <button type="submit" class="btn btn-primary text-center d-block mx-auto mt-5">Envoyer</button>

        </form>

    </div>

</div>

<?php include('footer.php'); ?>