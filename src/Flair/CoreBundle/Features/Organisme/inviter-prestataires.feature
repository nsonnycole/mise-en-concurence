Feature: En tant qu'organisme, je peux gérer mes prestataires

    Scenario: En tant au'anonyme, je ne peux accéder à la page pour inviter un prestataire
        Given I am not logged in
        When I go to "/mes-prestataires/inviter"
        Then I should see "Se connecter"
        And I should not see "Mes prestataires"

    Scenario: En tant que prestataire, je ne peux accéder à la page pour inviter un prestataire
        Given I am logged in as "prestataire@example.com"
        When I go to "/mes-prestataires/inviter"
        Then the url should match "/login"

    Scenario: En tant qu'organisme, je peux accéder à l'écran pour inviter un prestataire
        Given I am logged in as "organism@example.com"
        And I go to "/"
        When I follow "Mes prestataires"
        And I follow "Inviter un prestataire"
        Then I should see "Mes prestataires"
        And the url should match "/mes-prestataires/inviter"
        And I should see "Nom de la société"
        And I should see "Adresse e-mail"

    Scenario: En tant qu'organisme, je peux inviter un prestataire tiers
        Given I am logged in as "organism@example.com"
        And I go to "/"
        And I follow "Mes prestataires"
        And I follow "Inviter un prestataire"
        When I fill in "Nom de la société" with "Widop"
        And I fill in "Adresse e-mail" with "test@test.com"
        And I press "Inviter"
        Then I should see "Mes invitations"
        And the url should match "/mes-prestataires/invitations"
        And I should see "Widop"
        And I should see "test@test.com"

