@with-organismes @with-consultations
Feature: En tant qu'organisme, je peux envoyer ma consultation a plusieurs prestataire.

    Scenario: En tant qu'organisme, je peux accéder à la page de diffusion d'une consultation
        Given I am logged in as "organism@example.com"
        And I am on "/mes-consultations"
        And I select the first consultation
        Then I should see "Diffuser"
        And I follow "Diffuser"
        And the url should match "/demandes/publier"
        And I should see "SÉLECTIONNER LES DESTINATAIRES"
