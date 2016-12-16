<?php

namespace Flair\CoreBundle\Controller;

use Flair\UserBundle\Entity\AbstractUtilisateur;
use Flair\UserBundle\Entity\Organisme;
use Flair\UserBundle\Entity\Prestataire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CoreController extends Controller
{
    protected function getEm()
    {
        return $this->getDoctrine()->getManager();
    }

    protected function encryptPassword(AbstractUtilisateur $user, $password, $salt)
    {
        $encoder =  $this->get('security.encoder_factory')->getEncoder($user);
        $password = $encoder->encodePassword($password, $salt);

        return $password;
    }

    protected function getRepo($name)
    {
        return $this->getDoctrine()->getRepository($name);
    }

    protected function isOrganisme($user = null)
    {
        if (is_null($user)) {
            $user = $this->getUser();
        }

        return $user instanceof Organisme;
    }

    protected function isPrestataire($user = null)
    {
        if (is_null($user)) {
            $user = $this->getUser();
        }

        return $user instanceof Prestataire;
    }

    public function isGranted($action, $entity)
    {
        if (false === $this->get('security.context')->isGranted($action, $entity)) {
            throw new AccessDeniedException('Accès non autorisé');
        }
    }
}
