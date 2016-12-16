@with-organismes
Feature: En tant qu'organisme, je peux naviguer avec mon menu

    Scenario: En tant qu'anonyme, je ne dois pas voir le menu
        Given I am not logged in
        And I am on "/"
        Then I should not see "Mes consultations"
        And I should not see "Mon compte"
        And I should not see "Se déconnecter"

    Scenario: En tant qu'organisme, je vois le menu approprié
        Given I am logged in as "organism@example.com"
        And I am on "/"
        Then I should see "Mes consultations"
        And I should see "Mes prestataires"
        And I should see "Mon compte"
