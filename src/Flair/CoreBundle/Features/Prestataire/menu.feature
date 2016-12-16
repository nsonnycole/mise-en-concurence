@with-prestataires
Feature: En tant aue prestataire, je peux acceder au menu

    Scenario: En tant que non connecte, je ne dois pas voir le menu
        Given I am not logged in
        And I go to "/"
        Then I should not see "Bonjour"

    Scenario: En tant que prestataire, je peux voir le menu du prestataire
        Given I am logged in as "prestataire@example.com"
        And I am on "/"
        Then I should see "Mes propositions"
        And I should see "Mon compte"
