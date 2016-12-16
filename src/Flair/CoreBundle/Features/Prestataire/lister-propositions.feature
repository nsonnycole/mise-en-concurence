Feature: En tant que prestataire, j'ai accès à mes propositions

    Scenario: En tant qu'anonyme, je ne dois pas avoir accès à mes propositions
        Given I am not logged in
        When I go to "/mes-propositions"
        Then I should not see "Mes propositions"
        And the url should match "/login"

    Scenario: En tant qu'organisme, je ne dois pas avoir accès à mes propositions
        Given I am logged in as "organism@example.com"
        When I go to "/mes-propositions"
        Then I should not see "Mes propositions"
        And the url should match "/mes-consultations"