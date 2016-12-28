<?php

namespace Flair\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represente une ligne du devis saisi en ligne.
 *
 * @ORM\Entity
 * @ORM\Table(name = "reponses_devis")
 */
class LigneDevis
{
    /**
     * @var integer L'identifiant technique.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(
     *      name = "id_reponse_devis",
     *      type = "integer"
     * )
     */
    private $id;

    /**
     * @var String Le code de l'élément.
     *
     * @ORM\Column(
     *      name   = "code",
     *      type   = "string",
     *      length = 255
     * )
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      max        = 20,
     *      maxMessage = "La longueur du code ne peut excéder 20 caractères"
     * )
     */
    private $code;

    /**
     * @var String Le libelle.
     *
     * @ORM\Column(
     *      name   = "libelle",
     *      type   = "string",
     *      length = 255
     * )
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le libellé ne peut excéder 255 caractères"
     * )
     */
    private $libelle;

    /**
     * @var integer La quantite.
     *
     * @ORM\Column(
     *      name = "quantite",
     *      type = "integer"
     * )
     *
     * @Assert\NotBlank(message = "La quantité est obligatoire")
     * @Assert\Range(min = 0)
     */
    private $quantite;

    /**
     * @var integer Le prix unitaire.
     *
     * @ORM\Column(name = "prix_unitaire", type = "integer")
     * @Assert\NotBlank(message = "Le prix est obligatoire")
     * @Assert\Range(min = 0)
     */
    private $prixUnitaire;

    /**
     * @var integer Le taux de tva.
     *
     * @ORM\Column(
     *      name   = "taux_tva",
     *      type   = "string",
     *      length = 5
     * )
     *
     * @Assert\NotBlank(message = "Le taux de TVA est obligatoire")
     */
    private $tva;

    /**
     * @var Reponse La réponse à laquelle est rattaché cette ligne.
     *
     * @ORM\ManyToOne(targetEntity = "Flair\CoreBundle\Entity\Reponse", inversedBy = "lignesDevis")
     * @ORM\JoinColumn(name = "id_reponse", referencedColumnName = "id_reponse")
     */
    private $reponse;

    /**
     * @param String $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return String
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param String $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return String
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * @param int $prixUnitaire
     */
    public function setPrixUnitaire($prixUnitaire)
    {
        $this->prixUnitaire = $prixUnitaire;
    }

    /**
     * @return int
     */
    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }

    /**
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param \Flair\CoreBundle\Entity\Reponse $reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    }

    /**
     * @return \Flair\CoreBundle\Entity\Reponse
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * @param int $tva
     */
    public function setTva($tva)
    {
        $this->tva = $tva;
    }

    /**
     * @return int
     */
    public function getTva()
    {
        return $this->tva;
    }
}
