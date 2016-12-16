<?php


namespace Flair\UserBundle\Form\Type;

use Flair\UserBundle\Form\ChoiceList\TypeInvitationChoiceList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Formulaire d'invitation d'un utilisateur.
 */
class InvitationFormType extends AbstractType
{
    const INVIT_PRESTATAIRE = 0; // Accessible pour les organismes
    const INVIT_SERVICE = 1; // Accessible pour le role gestionnaire

    private $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeInvitation', 'choice', array(
                'required'    => true,
                'label'       => "Invitation pour",
                'choices' => $this->getChoices(),
            ))
            ->add('nom', 'text', array(
                'label' => 'Nom de la société'
            ))
            ->add('email', 'email', array(
                'label' => 'Adresse e-mail'
            ));
    }

    private function getChoices()
    {
        $user = $this->securityContext->getToken()->getUser();
        $choices = array();

        if ($user->hasRole("ROLE_ORGANISME")) {
            $choices[self::INVIT_PRESTATAIRE] = "Prestataire";
        }

        if ($user->hasRole("ROLE_GESTIONNAIRE")) {
            $choices[self::INVIT_SERVICE] = "Service";
        }

        return $choices;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'invitation_form_type';
    }
}
