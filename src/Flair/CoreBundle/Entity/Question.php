<?php

namespace Flair\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Poser une question sur une consultation.
 *
 * @ORM\Entity(repositoryClass = "Flair\CoreBundle\Repository\QuestionRepository")
 * @ORM\Table(name = "reponses_questions")
 */
class Question
{
    /**
     * @var integer L'identifiant technique de la question.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name = "id_question", type = "integer")
     */
    private $id;

    /**
     * @var String Le titre de la question.
     *
     * @ORM\Column(
     *      name   = "titre",
     *      type   = "string",
     *      length = 255
     * )
     *
     * @Assert\NotBlank(message = "Le titre est obligatoire", groups = { "prestataire" })
     */
    private $titre;

    /**
     * @var \DateTimne La date à laquelle la question est posée.
     *
     * @ORM\Column(
     *      name = "date_question",
     *      type = "datetime"
     * )
     */
    private $dateQuestion;

    /**
     * @var String La question posé par le prestataire.
     *
     * @ORM\Column(
     *      name = "question",
     *      type = "text"
     * )
     *
     * @Assert\NotBlank(message = "La question est obligatoire", groups = { "prestataire" })
     */
    private $question;

    /**
     * @var \DateTime La date de la réponse de l'organisme.
     *
     * @ORM\Column(
     *      name     = "date_reponse",
     *      type     = "datetime",
     *      nullable = true
     * )
     */
    private $dateReponse;

    /**
     * @var String La réponse apporté par l'organisme.
     *
     * @ORM\Column(
     *      name     = "reponse_organisme",
     *      type     = "text",
     *      nullable = true
     * )
     */
    private $reponseOrganisme;

    /**
     * @var Reponse La reponse à laquelle est relié la question.
     *
     * @ORM\ManyToOne(targetEntity = "Flair\CoreBundle\Entity\Reponse", inversedBy = "questions")
     * @ORM\JoinColumn(name = "id_reponse", referencedColumnName = "id_reponse")
     */
    private $reponse;

    /**
     * Initialisation de la date à laquelle la question est posée.
     */
    public function __construct()
    {
        $this->dateQuestion = new \DateTime();
    }

    /**
     * Retourn vrai si la question est sans réponse.
     *
     * @return bool
     */
    public function isUnanswered()
    {
        return $this->dateReponse == null;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param String $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return String
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param \DateTimne $dateQuestion
     */
    public function setDateQuestion($dateQuestion)
    {
        $this->dateQuestion = $dateQuestion;
    }

    /**
     * @return \DateTimne
     */
    public function getDateQuestion()
    {
        return $this->dateQuestion;
    }

    /**
     * @param \DateTime $dateReponse
     */
    public function setDateReponse($dateReponse)
    {
        $this->dateReponse = $dateReponse;
    }

    /**
     * @return \DateTime
     */
    public function getDateReponse()
    {
        return $this->dateReponse;
    }

    /**
     * @param String $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return String
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param Reponse $reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    }

    /**
     * @return Reponse La reponse.
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * @param String $reponseOrganisme
     */
    public function setReponseOrganisme($reponseOrganisme)
    {
        $this->reponseOrganisme = $reponseOrganisme;
    }

    /**
     * @return String
     */
    public function getReponseOrganisme()
    {
        return $this->reponseOrganisme;
    }
}
