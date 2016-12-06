<?php

namespace LP\PlatformBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use NDP\DateFieldsBundle\Form\Type\YearType;

class CarAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('brand')
            ->add('model')
            ->add('price')
            ->add('year')
            ->add('km')
            ->add('energy')

        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('brand',null ,array(
                'label' => 'Marque'
            ))
            ->add('model',null ,array(
                'label' => 'Modèle'
            ))
            ->add('price',null ,array(
                'label' => 'Prix'
            ))
            ->add('year')
            ->add('km')
            ->add('energy',null ,array(
                'label' => 'Energie'
            ))
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
            ->add('brand',null ,array(
                'label' => 'Marque'
            ))
            ->add('model',null ,array(
                'label' => 'Modèle'
            ))
            ->add('price',null ,array(
                'label' => 'Prix'
            ))
            ->add('year', YearType::class, array(
                'years' => range(1980, date('Y')),
                'label' => 'Année'

            ))
            ->add('km')
            ->add('energy',null ,array(
                'label' => 'Energie'
            ))
            ->end()
//            ->with('Image')
//            ->add('image', imageType::class, array(
//                'label' => 'Image'
//            ))
//            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('brand',null ,array(
                'label' => 'Marque'
            ))
            ->add('model',null ,array(
                'label' => 'Modèle'
            ))
            ->add('price',null ,array(
                'label' => 'Prix'
            ))
            ->add('year')
//            ->add('year', YearType::class)
            ->add('km')
            ->add('energy',null ,array(
                'label' => 'Energie'
            ))
            ->end()
//            ->with('Image liée')
//            ->add('image', 'entity', array(
//                'class' => 'LP\PlatformBundle\Entity\Image',
//                'template' => 'LPCoreBundle:Admin:image_preview_embedded.html.twig'
//            ))
//            ->end()
        ;
    }
}
