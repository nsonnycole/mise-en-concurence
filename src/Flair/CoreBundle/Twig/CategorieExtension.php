<?php

namespace Flair\CoreBundle\Twig;
/**
 * Affichage en une ligne de la categorie.
 */
class CategorieExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        parent::getFilters();

        return array(
            'categorie' => new \Twig_Filter_Method($this, 'categorie')
        );
    }

    /**
     * Affiche les categories en une seule ligne. Sur deux niveaux uniquement.
     */
    public function categorie($categorie)
    {
        if (get_class($categorie) == "Doctrine\ORM\PersistentCollection")
        {
                foreach($categorie as $cat)
                {
                    $helper = function ($cat) use (&$helper) {
                        if ($cat->getParent() == null) {
                                return $cat->getNom();
                        }
                        else {
                            return $helper($cat->getParent()) .     ' / ' . $cat->getNom();
                            
                        }
                    };
                    return $helper($cat);
                }            
                }
                else
                {
                    $helper = function ($categorie) use (&$helper) {
                        if ($categorie->getParent() == null) {
                            return $categorie->getNom();
                        }
                        else {
                            return $helper($categorie->getParent()) .     ' / ' . $categorie->getNom();
                                
                        }
                    };
                    return $helper($categorie);
                }
        }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'categorie_extension';
    }
}
