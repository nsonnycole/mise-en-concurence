@with-organismes @with-prestataires
Feature: En tant qu'organisme, je peux accéder à la liste de mes prestataires

    Scenario: En tant au'anonyme, je ne peux accéder à la page des prestataires
        Given I am not logged in
        When I go to "/mes-prestataires"
        Then I should see "Se connecter"
        And I should not see "Mes prestataires"

    Scenario: En tant que prestataire, je ne peux accéder à la page des prestataires
        Given I am logged in as "prestataire@example.com"
        When I go to "/mes-prestataires"
        Then the url should match "/mes-propositions"

    Scenario: En tant qu'organisme, je peux accéder à la liste de mes prestataires
        Given I am logged in as "organism@example.com"
        And I go to "/"
        When I follow "Mes prestataires"
        Then I should see 2 times "Mes prestataires"
        And the url should match "/mes-prestataires"

    @with-prestataires-valides
    Scenario: En tant qu'organisme avec des prestataires, la liste ne doit pas être vide
        Given I am logged in as "organism@example.com"
        And I go to "/"
        When I follow "Mes prestataires"
        Then I should see 2 "tbody > tr" elements
        And I should see "Sensio labs"
        And I should see "Widop"