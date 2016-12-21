<?php

namespace LP\PlatformBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Show\ShowMapper;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;


class AdvertAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title')
            ->add('description')
            ->add('datePosted')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title')
            ->add('description')
            ->add('datePosted')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('description', CKEditorType::class)
            ->end()

         /*   ->with('Image')
            ->add('image', 'sonata_type_model_list', array(
                'label' => false,
                'required' => false,
                'btn_list' => false
            ))
            ->end() */

            ->with('Image')
            ->add('image', ModelListType::class, array(
                'label' => false,
                'required' => false,
                'btn_list' => false
            ))
            ->end()

            ->with('Voiture')
            ->add('car', ModelListType::class, array(
                'label' => false,
                'btn_list' => false
            ), array(
                'placeholder' => 'No car selected'
            ))
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('title')
            ->add('description')
            ->add('datePosted')
            ->end()

            ->with('Image liée')
            ->add('image', 'entity', array(
                'class' => 'LP\PlatformBundle\Entity\Image',
                'template' => 'LPCoreBundle:Admin:image_preview_embedded.html.twig'
            ))
            ->end()

            ->with('Voiture')
            ->add('car', ModelListType::class, array(
                'label' => false,
                'btn_list' => false
            ), array(
                'placeholder' => 'No car selected'
            ))
            ->end()
        ;
    }
}
