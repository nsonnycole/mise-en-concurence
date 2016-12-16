@with-organismes
Feature: En tant qu'organisme, je peux créer une demande de consultation

    Scenario: En tant qu'organisme, je peux accéder au formulaire de création de consultation
        Given I am logged in as "organism@example.com"
        And I am on "/mes-consultations"
        And I follow "Créer une consultation"
        Then the url should match "/creation-demande"

    Scenario: En tant que visiteur anonyme, je ne dois pas avoir accès au formulaire de création de la demande
        Given I am not logged in
        And I am on "/creation-demande/etape-1"
        Then the url should match "/login"
        And I should see "Connexion"

    Scenario: En tant qu'organisme, je ne peux créer une demande en renseignant aucune information
        Given I am logged in as "organism@example.com"
        And I am on "/creation-demande/etape-1"
        And I press "Suivant"
        Then I should see 4 times "Cette valeur ne doit pas être vide"
        And the url should match "/creation-demande"

    Scenario: En tant qu'organisme, je peux annuler toute création de demande tant que je n'ai pas validé
        Given I am logged in as "organism@example.com"
        And I am on "/creation-demande/etape-1"
        And I follow "Annuler"
        Then I should see 2 times "Mes consultations"
        And the url should match "/mes-consultations"

    Scenario: En tant qu'organisme, la date de cloture doit etre superieur a la date du jour
        Given I am logged in as "organism@example.com"
        And I am on "/creation-demande/etape-1"
        And I fill in "Date de clôture de la mise en concurrence" with "01/01/2013"
        And I press "Suivant"
        Then I should see "étape 1"
        And I should see "La date limite doit être supérieure à la date du jour"
        And the url should match "/creation-demande"

    Scenario: En tant qu'organisme, je peux créer une demande en renseignant tout les champs
        Given I am logged in as "organism@example.com"
        And I am on "/creation-demande/etape-1"
        And I fill in "Titre" with "Titre de la consultation"
        And I fill in "Description" with "Description de la consultation"
        And I fill in "Date de clôture de la mise en concurrence" with "01/01/2020"
        And I select "Informatique" from "Secteur d'activité de la prestation"
        And I press "Suivant"
        Then I should see "étape 2"
        And the url should match "/creation-demande/etape-2"

    Scenario: En tant qu'organisme, je ne peux renseigner le prix minimum ou le prix maximum sans l'autre
        Given I am logged in as "organism@example.com"
        And I am on "/creation-demande/etape-1"
        And I fill in "Titre" with "Titre de la consultation"
        And I fill in "Description" with "Description de la consultation"
        And I fill in "Date de clôture de la mise en concurrence" with "01/01/2020"
        And I select "Informatique" from "Secteur d'activité de la prestation"
        And I press "Suivant"
        And I fill in "Fourchette de prix estimée entre" with "100"
        And I press "Suivant"
        Then I should see "Le prix minimum et le prix maximum doivent être renseignés ensemble"

        When I fill in "Fourchette de prix estimée entre" with ""
        And I fill in "consultation_etape2_form_type_prixMaximum" with "100"
        And I press "Suivant"
        Then I should see "Le prix minimum et le prix maximum doivent être renseignés ensemble"

        And I fill in "Fourchette de prix estimée entre" with "100"
        And I fill in "consultation_etape2_form_type_prixMaximum" with "50"
        And I press "Suivant"
        Then I should see "Le prix minimum ne peut être supérieur au prix maximum"

    Scenario: En tant qu'organisme, je peux passer sans rien renseigner a l'etape 2.
        Given I am logged in as "organism@example.com"
        And I am on "/creation-demande/etape-1"
        And I fill in "Titre" with "Titre de la consultation"
        And I fill in "Description" with "Description de la consultation"
        And I fill in "Date de clôture de la mise en concurrence" with "01/01/2020"
        And I select "Informatique" from "Secteur d'activité de la prestation"
        And I press "Suivant"
        And I press "Suivant"
        Then I should see "étape 3"

    Scenario: En tant qu'organisme, je ne dois pas renseigner la date de debut si je sélectionne ASAP.
        Given I am logged in as "organism@example.com"
        And I am on "/creation-demande/etape-1"
        And I fill in "Titre" with "Titre de la consultation"
        And I fill in "Description" with "Description de la consultation"
        And I fill in "Date de clôture de la mise en concurrence" with "01/01/2020"
        And I select "Informatique" from "Secteur d'activité de la prestation"
        And I press "Suivant"
        And I select "Dès que possible" from "La prestation doit commencer"
        And I press "Suivant"
        Then I should see "étape 3"

    Scenario: En tant qu'organisme, je ne dois pas renseigner la date de livraison si je sélectionne ASAP.
        Given I am logged in as "organism@example.com"
        And I am on "/creation-demande/etape-1"
        And I fill in "Titre" with "Titre de la consultation"
        And I fill in "Description" with "Description de la consultation"
        And I fill in "Date de clôture de la mise en concurrence" with "01/01/2020"
        And I select "Informatique" from "Secteur d'activité de la prestation"
        And I press "Suivant"
        And I select "Dès que possible" from "La prestation doit se terminer"
        And I press "Suivant"
        Then I should see "étape 3"

    Scenario: En tant qu'organisme, je dois renseigner une date de debut si je selectionne autre chose que ASAP.
        Given I am logged in as "organism@example.com"
        And I am on "/creation-demande/etape-1"
        And I fill in "Titre" with "Titre de la consultation"
        And I fill in "Description" with "Description de la consultation"
        And I fill in "Date de clôture de la mise en concurrence" with "01/01/2020"
        And I select "Informatique" from "Secteur d'activité de la prestation"
        And I press "Suivant"

        And I select "Au plus tard le" from "La prestation doit commencer"
        And I press "Suivant"
        Then I should see "étape 2"
        And I should see "La date de début doit être renseignée"

        And I select "A partir de" from "La prestation doit commencer"
        And I press "Suivant"
        Then I should see "étape 2"
        And I should see "La date de début doit être renseignée"

        And I select "A cette date précise" from "La prestation doit commencer"
        And I press "Suivant"
        Then I should see "étape 2"
        And I should see "La date de début doit être renseignée"

    Scenario: En tant qu'organisme, je dois renseigner une date de debut si je selectionne autre chose que ASAP.
        Given I am logged in as "organism@example.com"
        And I am on "/creation-demande/etape-1"
        And I fill in "Titre" with "Titre de la consultation"
        And I fill in "Description" with "Description de la consultation"
        And I fill in "Date de clôture de la mise en concurrence" with "01/01/2020"
        And I select "Informatique" from "Secteur d'activité de la prestation"
        And I press "Suivant"

        And I select "Au plus tard le" from "La prestation doit se terminer"
        And I press "Suivant"
        Then I should see "étape 2"
        And I should see "La date de fin doit être renseignée"

        And I select "A partir de" from "La prestation doit se terminer"
        And I press "Suivant"
        Then I should see "étape 2"
        And I should see "La date de fin doit être renseignée"

        And I select "A cette date précise" from "La prestation doit se terminer"
        And I press "Suivant"
        Then I should see "étape 2"
        And I should see "La date de fin doit être renseignée"