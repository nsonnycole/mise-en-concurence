<?php

namespace Flair\OrganismeBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formulaire pour la publication d'une consultation.
 */
class PublicationFormType extends AbstractType
{
    public function __construct($data = null)
    {
        $this->request = (is_null($data)) ? false : true;
        $this->categories = $data['categories'];
        $this->exclusive = $data['exclusive'];
        $this->ape = $data['ape'];
        $this->perimetreIntervention = $data['perimetreIntervention'];
        $this->tags = $data['tags'];
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $categories = $this->categories;
            $tags = $this->tags;
            $exclusive = $this->exclusive;
            $consultation = $event->getData()->getConsultation();
            $prestataires = array();
            $ape= $this->ape;
            $perimetreIntervention = $this->perimetreIntervention;
            if (!$this->request) {
                $categories = array($consultation->getCategorie());
            }

            foreach ($consultation->getReponses() as $reponse) {
                $prestataires[] = $reponse->getPrestataire();
            }

            $event->getForm()->add('prestataires', 'entity', array(
                'class'         => 'FlairUserBundle:Prestataire',
                'multiple'      => true,
                'expanded'      => true,
                'property'      => 'nom',
                'query_builder' =>
                    function (EntityRepository $er) use ($prestataires, $consultation, $categories, $exclusive, $tags, $ape, $perimetreIntervention) {
                        $qb = $er->createQueryBuilder('p');

                        if (!is_null($exclusive) && $exclusive) {
                            $qb->join('p.organismes', 'o')
                                ->andWhere('o.id = :organisme')
                                ->setParameter('organisme', $consultation->getOrganisme()->getId());
                        }

                        if (sizeof($categories) === 0) {
                            $categories = array($consultation->getCategorie());
                        }
                        $cats = array();
                        foreach ($categories as $categorie) {
                            array_push($cats, $categorie->getId());

                            foreach ($categorie->getSousCategories() as $c) {
                                array_push($cats, $c->getId());

                                foreach ($c->getSousCategories() as $sousCat) {
                                    array_push($cats, $sousCat->getId());
                                }
                            }
                        }
                        $qb
                            ->join('p.categories', 'c')
                            ->andWhere('c.id in (:cats)')
                            ->setParameter('cats', $cats);    

                        if (sizeof($tags) > 0) {
                           $qb
                                ->join('p.tags', 't')
                                ->andWhere('t.id in (:tags)')
                                ->setParameter('tags', $tags);  
                        }
                        if (sizeof($ape) > 0) {
                           $qb
                                ->andWhere('p.ape in (:ape)')
                                ->setParameter('ape', $ape);  
                        }
                        if ($perimetreIntervention != null) {
                           $qb
                                ->andWhere('p.perimetreIntervention = :perimetreIntervention')
                                ->setParameter('perimetreIntervention', $perimetreIntervention);  
                        }
                        if (!empty($prestataires)) {
                            $qb->andWhere('p.id not in (:prestataires)')->setParameter('prestataires', $prestataires);
                        }

                        return $qb;
                    },
            ));
        });
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'publication_form_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Flair\OrganismeBundle\Model\PublicationModel'
        ));
    }
}
