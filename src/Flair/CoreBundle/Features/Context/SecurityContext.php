<?php

namespace Flair\CoreBundle\Features\Context;

use Behat\MinkExtension\Context\RawMinkContext;
use Flair\UserBundle\Entity\Organisme;
use Flair\UserBundle\Entity\Prestataire;
use Symfony\Component\HttpKernel\KernelInterface;

use Behat\Behat\Context\Step;
use Behat\Behat\Hook\Annotation\BeforeScenario;
use Behat\Behat\Event\ScenarioEvent;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Contexte relatif à la sécurité (login/logout/connexion)
 */
class SecurityContext extends RawMinkContext implements KernelAwareInterface
{
    /** @var \Symfony\Component\HttpKernel\KernelInterface */
    protected $kernel;

    /**
     * @inheritdoc
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Disconnects the current user.
     *
     * @Given /^I am not logged in$/
     *
     * @return Step\Then
     */
    public function iAmNotLoggedIn()
    {
        return new Step\Given('I am on "/logout"');
    }

    /**
     * @Then /^I can see the login form$/
     */
    public function iCanSeeTheLoginForm()
    {
        return array(
            new Step\Then('I should see "Nom d\'utilisateur"'),
            new Step\Then('I should see "Mot de passe"')
        );
    }

    /**
     * Logged in the given user.
     *
     * @Given /^I am logged in as "([^"]*)"$/
     *
     * @param string $user The given user.
     *
     * @return array An array of step.
     */
    public function iAmLoggedInAs($user)
    {
        return array(
            new Step\Given('I am on "/logout"'),
            new Step\Given('I go to "/login"'),
            new Step\Given(sprintf('I fill in "username" with "%s"', $user)),
            new Step\Given(sprintf('I fill in "password" with "%s"', $user)),
            new Step\Given('I press "Connexion"'),
        );
    }

    /**
     * Supprime les utilisateurs de la base de données avant les scénarios avec l'annotation.
     *
     * @BeforeScenario @with-organismes
     */
    public function withOrganismes(ScenarioEvent $event)
    {
        $em = $this->kernel->getContainer()->get('doctrine.orm.entity_manager');
        $encoder = $this->kernel->getContainer()->get('security.encoder_factory')->getEncoder(new prestataire());

        // Suppression des utilisateurs.
        $em->getRepository('FlairUserBundle:Organisme')->createQueryBuilder('c')->delete()->getQuery()->execute();
        $categories = $em->getRepository('FlairUserBundle:CategorieOrganisme')->findAll();

        // Création des prestataires.
        $organismes = Yaml::parse(file_get_contents(__DIR__.'/../../DataFixtures/YAML/organismes.yml'));
        foreach ($organismes as $data) {
            $organisme = new Organisme();
            $organisme->setEmailValide(true);
            $organisme->setEmail($data['email']);
            $organisme->setNom($data['nom']);
            $organisme->setSiret($data['siret']);
            $organisme->setAdresse($data['adresse']);
            $organisme->setVille($data['ville']);
            $organisme->setCodePostal($data['codePostal']);
            $organisme->setTelephone($data['telephone']);
            $organisme->setMobile($data['mobile']);
            $organisme->setPrenomContact($data['prenomContact']);
            $organisme->setNomContact($data['nomContact']);
            $organisme->setCategorie($categories[array_rand($categories, 1)]);

            $password = $encoder->encodePassword($data['email'], $organisme->getSalt());
            $organisme->setPassword($password);

            $em->persist($organisme);
        }

        $em->flush();
    }

    /**
     * Supprime les uitilsateurs de type prestataires et les re-cree.
     *
     * @BeforeScenario @with-prestataires
     */
    public function withPrestataires(ScenarioEvent $event)
    {
        $em = $this->kernel->getContainer()->get('doctrine.orm.entity_manager');
        $encoder = $this->kernel->getContainer()->get('security.encoder_factory')->getEncoder(new Prestataire());

        $em->getRepository('FlairUserBundle:Prestataire')->createQueryBuilder('c')->delete()->getQuery()->execute();
        $categories = $em->getRepository('FlairUserBundle:CategoriePrestataire')->findAll();

        // Création des prestataires.
        $prestataires = Yaml::parse(file_get_contents(__DIR__.'/../../DataFixtures/YAML/prestataires.yml'));
        foreach ($prestataires as $data) {
            $prestataire = new Prestataire();
            $prestataire->setEmailValide(true);
            $prestataire->setEmail($data['email']);
            $prestataire->setNom($data['nom']);
            $prestataire->setSiret($data['siret']);
            $prestataire->setAdresse($data['adresse']);
            $prestataire->setVille($data['ville']);
            $prestataire->setCodePostal($data['codePostal']);
            $prestataire->setDateCreation(\DateTime::createFromFormat('d/m/Y', $data['dateCreation']));
            $prestataire->setPerimetreIntervention($data['perimetre']);
            $prestataire->setTelephone($data['telephone']);
            $prestataire->setMobile($data['mobile']);
            $prestataire->setPrenomContact($data['prenomContact']);
            $prestataire->setNomContact($data['nomContact']);
            $prestataire->setCategorie($categories[array_rand($categories, 1)]);

            $password = $encoder->encodePassword($data['email'], $prestataire->getSalt());
            $prestataire->setPassword($password);

            $em->persist($prestataire);
        }

        $em->flush();
    }

    /**
     * Valide les prestaaires pour un organisme donné.
     *
     * @BeforeScenario @with-prestataires-valides
     */
    public function withValidatedPrestataires(ScenarioEvent $event)
    {
        $this->withPrestataires($event);

        $em = $this->kernel->getContainer()->get('doctrine.orm.entity_manager');

        $organismes = $em->getRepository('FlairUserBundle:Organisme')->findAll();
        $prestataires = $em->getRepository('FlairUserBundle:Prestataire')->findAll();

        foreach ($organismes as $organisme) {
            foreach ($prestataires as $prestataire) {
                $organisme->getPrestataires()->add($prestataire);
            }
        }

        $em->flush();
    }

    /**
     * Supprime les utiliasteurs de la base de données avant les scénarios avec l'annotation.
     *
     * @BeforeScenario @without-users
     */
    public function withoutUsers(ScenarioEvent $event)
    {
        $em = $this->kernel->getContainer()->get('doctrine.orm.entity_manager');
        $em->getRepository('FlairUserBundle:Prestataire')->createQueryBuilder('c')->delete()->getQuery()->execute();
        $em->getRepository('FlairUserBundle:Organisme')->createQueryBuilder('c')->delete()->getQuery()->execute();
    }
}
