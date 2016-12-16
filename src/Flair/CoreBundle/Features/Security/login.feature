@with-organismes @with-prestataires @login
Feature: As a user I can log in to the application.

    Scenario: I can browse to the login form
        Given I am on "/login"
        Then I can see the login form

    Scenario: Je peux me connecter en tant qu'organisme
        Given I am not logged in
        And I go to "/login"
        And I can see the login form
        When I fill in "username" with "organism@example.com"
        And I fill in "password" with "organism@example.com"
        And I press "Connexion"
        Then I should see "Bonjour"

    Scenario: Je peux me connecter en tant que prestataire
        Given I am not logged in
        And I go to "/login"
        And I can see the login form
        When I fill in "username" with "prestataire@example.com"
        And I fill in "password" with "prestataire@example.com"
        And I press "Connexion"
        Then I should see "Bonjour"

