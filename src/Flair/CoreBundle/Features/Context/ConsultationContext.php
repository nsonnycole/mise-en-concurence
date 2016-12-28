<?php

namespace Flair\CoreBundle\Features\Context;

use Behat\Behat\Event\ScenarioEvent;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Flair\CoreBundle\Entity\Consultation;
use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Behat\Hook\Annotation\BeforeScenario;
use Behat\Behat\Context\Step;

use Faker\Factory;

/**
 * Contexte de gestion des consultations.
 */
class ConsultationContext extends RawMinkContext implements KernelAwareInterface
{
    /**
     * @var KernelInterface Le kernel de l'application.
     */
    private $kernel;

    /**
     * @inheritdoc
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Supprime les utiliasteurs de la base de données avant les scénarios avec l'annotation.
     *
     * @BeforeScenario @with-consultations
     */
    public function withConsultations(ScenarioEvent $event)
    {
        $em = $this->kernel->getContainer()->get('doctrine.orm.entity_manager');
        $categories = $em->getRepository('FlairUserBundle:CategoriePrestataire')->findAll();
        $organisme = $em->getRepository('FlairUserBundle:Organisme')->findOneBy(array());

        $faker = Factory::create();

        for ($i = 0; $i != 10; $i++) {
            $consultation = new Consultation();
            $consultation->setTitre($faker->catchPhrase);
            $consultation->setCategorie($categories[array_rand($categories)]);
            $consultation->setDescription($faker->paragraph);
            $consultation->setDateLimite($faker->dateTimeBetween('now', '1 year'));
            $consultation->setStatut(Consultation::DRAFT);
            $consultation->setOrganisme($organisme);

            $em->persist($consultation);
        }

        $em->flush();
    }

    /**
     * @Given /^I select the first consultation$/
     */
    public function iSelectTheFirstConsultation()
    {
        $this
            ->getSession()
            ->getDriver()
            ->click('(//td/a)[1]');
    }
}
