@with-organismes
Feature: En tant qu'organisme, je peux accéder à mes consultations

    Scenario: En tant que personne non connecté, je ne peux pas accéder à la page des consultations
        Given I am not logged in
        When I go to "/mes-consultations"
        Then the url should match "/login"
        And I can see the login form

    @with-consultations
    Scenario: En tant qu'organisme, je peux accéder à mes consultations
        Given I am logged in as "organism@example.com"
        And I am on "/mes-consultations"
        Then I should see 2 times "Mes consultations"

    Scenario: En tant qu'organisme, si je n'ai pas de consultations, je dois voir le tableau vide.
        Given I am logged in as "organism@example.com"
        And I am on "/mes-consultations"
        Then I should see "Vous n'avez pas de consultations pour l'instant..."


