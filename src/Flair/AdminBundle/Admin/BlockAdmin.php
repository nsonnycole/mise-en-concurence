<?php

namespace Flair\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;

use Flair\UserBundle\Entity\CategorieOrganisme;
use Flair\UserBundle\Entity\CategoriePrestataire;



class BlockAdmin extends BaseBlockService
{

    public function getDefaultSettings()
    {
        return array(
            'template' => 'SonataBlockBundle:Block:block_base.html.twig',
        );
    }

    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
    }

    public function execute(BlockContextInterface $block, Response $response = null)
    {
        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());

        return $this->renderResponse('FlairAdminBundle::block_admin_list.html.twig', array(
            'block'     => $block->getBlock(),
            'settings'  => $settings
            ), $response);
    }
}
