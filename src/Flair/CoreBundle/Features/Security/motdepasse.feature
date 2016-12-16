@with-organismes @with-prestataires
Feature: En tant qu'utilisateur, je peux changer mon mot de passe

    Scenario: En tant qu'utilisateur non renregistré, je n'ai pas accès à la page de changement de mot de passe.
        Given I am not logged in
        When I go to "/mon-compte/mot-de-passe"
        Then I should see "connexion"
        And the url should match "/login"

    Scenario: En tant qu'organisme, je peux changer accéder à la page de changement de mot de passe
        Given I am logged in as "organism@example.com"
        And I go to "/"
        And I follow "Mon compte"
        When I follow "Changer mon mot de passe"
        Then I should see "Changement de mot de passe"
        And I should see "Mot de passe"
        And I should see "Confirmation"
        And the url should match "/mon-compte/mot-de-passe"

    Scenario: En tant qu'organisme, je peux changer mon mot de passe
        Given I am logged in as "organism@example.com"
        And I go to "/"
        And I follow "Mon compte"
        And I follow "Changer mon mot de passe"
        When I fill in "Mot de passe" with "test"
        And I fill in "Confirmation" with "test"
        And I press "Enregistrer"
        Then the url should match "/mon-compte"

    Scenario: En tant qu'organisme, après avoir changé mon mot de passe, je ne peux plus me connecter avec l'ancien mot de passe.
        Given I am logged in as "organism@example.com"
        And I go to "/mon-compte/mot-de-passe"
        And I fill in "Mot de passe" with "test"
        And I fill in "Confirmation" with "test"
        And I press "Enregistrer"
        Then I go to "/logout"
        And the url should match "/login"
        And I fill in "username" with "organism@example.com"
        And I fill in "password" with "organsim@example.com"
        And I press "Connexion"
        Then the url should match "/login"
        And I should see "Connexion"

    Scenario: En tant qu'organisme, après avoir changé mon mot de passe, je ne peux me connecter qu'avec le nouveau mot de passe.
        Given I am logged in as "organism@example.com"
        And I go to "/mon-compte/mot-de-passe"
        And I fill in "Mot de passe" with "test"
        And I fill in "Confirmation" with "test"
        And I press "Enregistrer"
        Then I go to "/logout"
        And the url should match "/login"
        And I fill in "username" with "organism@example.com"
        And I fill in "password" with "test"
        And I press "Connexion"
        Then the url should match "/mes-consultations"
        And I should see "Bonjour"