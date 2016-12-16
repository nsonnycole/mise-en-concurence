@checked
Feature: En tant que visiteur, je peux visiter la page d'accueil

    Scenario: En tant que visiteur, je peux aller sur la page d'accueil.
        Given I am not logged in
        When I am on "/"
        Then the response status code should be 200

    Scenario: En tant que visiteur, je peux aller consulter les FAQ
        Given I am not logged in
        And I go to "/"
        When I follow "FAQ"
        Then I should see "A qui s'adresse" in the "h2" element
        And the url should match "/faq"

    Scenario: En tant que visiteur, je peux télécharger les CGU
        Given I am not logged in
        And I go to "/"
        When I follow "CGU"
        Then the response status code should be 200

    Scenario: En tant que visiteur, je peux consulter les mentions légales
        Given I am not logged in
        And I go to "/"
        When I follow "Mentions légales"
        Then the response status code should be 200
        And the url should match "/mentions-legales"
        And I should see "Mentions légales" in the "h2" element
