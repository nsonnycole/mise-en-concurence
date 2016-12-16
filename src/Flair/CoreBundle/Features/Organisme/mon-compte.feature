@with-organismes
Feature: En tant qu'organisme, je peux editer les informations de mon compte

    Scenario: En tant qu'anonyme, je n'ai pas accès à la page "Mon compte"
        Given I am not logged in
        When I go to "/mon-compte"
        Then I should see "Connexion"
        And the url should match "/login"

    Scenario: En tant qu'organisme, je peux alle à la page "Mon profil"
        Given I am logged in as "organism@example.com"
        And I go to "/"
        When I follow "Mon compte"
        Then the url should match "/mon-compte"
        And I should see 2 times "Mon compte"

    Scenario: En tant au'organisme, la page mon compte doit afficher mes informations
        Given I am logged in as "organism@example.com"
        And I go to "/"
        And I follow "Mon compte"
        Then I should see "organism@example.com"
        And I should see 2 times "Prince Bernhard"
        And I should see 2 times "Lippe-Biesterfeld"
        And I should see "WWF"
        And I should see "Rue de la paix"
        And I should see "Paris"

    Scenario: En tant qu'organisme, je peux accéder au formulaire pour modifier les informations de mon compte
        Given I am logged in as "organism@example.com"
        And I go to "/"
        And I follow "Mon compte"
        When I follow "Modifier"
        Then I should see "Modifier mon compte"
        And the url should match "/mon-compte/modifier"

    Scenario: En tant qu'organisme, je peux modifier les informations de l'organisme
        Given I am logged in as "organism@example.com"
        And I go to "/"
        And I follow "Mon compte"
        And I follow "Modifier"
        And I fill in "Nom de l'organisme" with "Greenpeace"
        And I fill in "SIRET/SIREN/RNA" with "987654321"
        And I fill in "Adresse" with "Nouvelle adresse"
        And I fill in "Code postal" with "99999"
        And I fill in "Ville" with "Bagdad"
        And I fill in "Téléphone" with "0000000000"
        And I fill in "Mobile" with "1111111111"
        And I fill in "Prénom du contact" with "Francois"
        And I fill in "Nom du contact" with "Hollande"
        And I press "Enregistrer"
        Then the url should match "/mon-compte"
        And I should see "Greenpeace"
        And I should see "987654321"
        And I should see "Nouvelle adresse"
        And I should see "99999"
        And I should see "Bagdad"
        And I should see "0000000000"
        And I should see "1111111111"
        And I should see "Francois"
        And I should see "Hollande"

    Scenario: En tant qu'organisme, certains champs sont obligatoires dans mon profil
        Given I am logged in as "organism@example.com"
        And I go to "/"
        And I follow "Mon compte"
        And I follow "Modifier"
        And I fill in "Nom de l'organisme" with ""
        And I fill in "SIRET/SIREN/RNA" with ""
        And I fill in "Adresse" with ""
        And I fill in "Code postal" with ""
        And I fill in "Ville" with ""
        And I fill in "Prénom du contact" with ""
        And I fill in "Nom du contact" with ""
        And I press "Enregistrer"
        Then the url should match "/mon-compte/modifier"
        And I should see 7 times "Cette valeur ne doit pas être vide"


