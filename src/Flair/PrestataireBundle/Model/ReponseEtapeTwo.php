<?php

namespace Flair\PrestataireBundle\Model;

use Flair\CoreBundle\Entity\Reponse;
use Flair\OrganismeBundle\Form\ChoiceList\DisponibiliteChoiceList;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Le deuxieme etape de la reponse.
 */
class ReponseEtapeTwo
{
    /**
     * @var boolean Si oui ou non, l'utilisateur utilise ses propres documents.
     */
    private $hasDocuments;
    
    /**
     * @var integer Le montant hors taxe du devis.
     */
    private $montantHt;

    /**
     * @var integer Le montant hors taxe du devis.
     */
    private $montantTtc;

    /**
     * @var Document Le document si c'est un devis perso.
     */
    private $devisDocument;
    
    /**
     * @param Reponse $reponse
     */
    public function __construct(Reponse $reponse)
    {
        $this->hasDocuments = $reponse->getHasDocuments();
        $this->montantHt = $reponse->getMontantHt();
        $this->montantTtc = $reponse->getMontantTtc();
        $this->devisDocument = $reponse->getDevisDocument();
    }

    public function merge(Reponse $reponse)
    {
        $reponse->setHasDocuments(true);
        $reponse->setMontantHt($this->getMontantHt());
        $reponse->setMontantTtc($this->getMontantTtc());
        $reponse->setDevisDocument($this->getDevisDocument());

        return $reponse;
    }
    
    /**
     * @param boolean $hasDocuments
     */
    public function setHasDocuments($hasDocuments)
    {
        $this->hasDocuments = $hasDocuments;
    }
    /**
     * @return boolean
     */
    public function getHasDocuments()
    {
        return $this->hasDocuments;
    }

    /**
     * @param int $montantHt
     */
    public function setMontantHt($montantHt)
    {
        $this->montantHt = $montantHt;
    }

    /**
     * @return int
     */
    public function getMontantHt()
    {
        return $this->montantHt;
    }

    /**
     * @param int $montantTtc
     */
    public function setMontantTtc($montantTtc)
    {
        $this->montantTtc = $montantTtc;
    }

    /**
     * @return int
     */
    public function getMontantTtc()
    {
        return $this->montantTtc;
    }

    /**
     * @param \Flair\CoreBundle\Entity\Document $devisDocument
     */
    public function setDevisDocument($devisDocument)
    {
        $this->devisDocument = $devisDocument;
    }

    /**
     * @return \Flair\CoreBundle\Entity\Document
     */
    public function getDevisDocument()
    {
        return $this->devisDocument;
    }
}
