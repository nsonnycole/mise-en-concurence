@checked
Feature: En tant que visiteur, je peux m'inscrire sur le site

    @without-users
    Scenario: En tant que visiteur, je peux voir le formulaire d'inscription
        Given I am not logged in
        When I go to "/inscription"
        And I should see "Création d'un compte"
        And I should see "Email"
        And I should see "Mot de passe"
        And I should see "Confirmation"

        And I should see "Informations sur l'organisme"
        And I should see "Nom de l'organisme"
        And I should see "SIRET/SIREN/RNA"
        And I should see "Adresse"
        And I should see "Code postal"
        And I should see "Ville"
        And I should see "Téléphone"
        And I should see "Mobile"
        And I should see "Prénom du contact"
        And I should see "Nom du contact"
        And I should see "Domaine de compétence"
        And I should see "Acceptez-vous de recevoir des emails ne nos partenaires ?"
        And I should see "J'accepte les CGU"

    @without-users
    Scenario: En tant que visiteur, je dois renseigner un certain nombre de champs
        Given I am not logged in
        When I go to "/inscription"
        And I press "Enregistrer"
        Then I should be on "/inscription"
        And I should see 9 times "Cette valeur ne doit pas être vide"
        And I should see "Le numéro de téléphone est obligatoire"
        And I should see "Veuillez renseigner une catégorie d'activité!"
        And I should see "Vous devez accepter les CGU"

    @without-users @javascript
    Scenario: En tant que visiteur, je peux m'inscrire avec des valeurs correctes
        Given I am not logged in
        And I am on "/inscription"
        When I fill in "Email" with "m@m.com"
        And I fill in "Mot de passe" with "test"
        And I fill in "Confirmation" with "test"
        And I fill in "Nom de l'organisme" with "Greenpeace"
        And I fill in "SIRET" with "0123456789"
        And I fill in "Adresse" with "1 rue de Paris"
        And I fill in "Code postal" with "75000"
        And I fill in "Ville" with "Paris"
        And I fill in "Téléphone" with "0123456789"
        And I fill in "Mobile" with "0612345678"
        And I fill in "Prénom du contact" with "Kumi"
        And I fill in "Nom du contact" with "Naidoo"
        And I check "inscription_organisme_form_emailPartenaire_0"
        And I select "Secteur privé" from "Domaine de compétence"
        And I check "inscription_organisme_form_cgu"
        And I press "Enregistrer"
        Then I should see "Pour valider l'inscription, vous devez confirmer votre adresse email."

    @with-organismes
    Scenario: En tant que visiteur, je ne peux m'inscrire avec une adress email deja utilisé par un organisme
        Given I am not logged in
        And I am on "/inscription"
        And I fill in "Email" with "organism@example.com"
        And I press "Enregistrer"
        Then I should see "Cette adresse email est déjà utilisée"

    @with-prestataires
    Scenario: En tant que visiteur, je ne peux m'inscrire avec une adresse email déjà utilisée par un prestataire
        Given I am not logged in
        And I am on "/inscription"
        And I fill in "Email" with "prestataire@example.com"
        And I press "Enregistrer"
        Then I should see "Cette adresse email est déjà utilisée"
