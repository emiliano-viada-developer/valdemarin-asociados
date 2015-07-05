<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use AppBundle\Entity\Auction;

class AuctionAdmin extends Admin
{
    protected $baseRouteName = 'auction';

    protected $baseRoutePattern = 'subastas';

    /**
     * Overide getFormTheme()
     */
    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('AppBundle:Admin:admin.theme.html.twig')
        );
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title')
            ->add('possessions')
            ->add('status')
            ->add('description')
            ->add('pdf')
            ->add('location')
            ->add('conditions')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('title', null, array('label' => 'Nombre'))
            ->add('status', null, array('label' => 'Estado'))
            ->add('location', null, array('label' => 'Localidad'))
            ->add('_action', 'actions', array(
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
        $auction = $this->getSubject();

        $formMapper
            ->with('General', array('class' => 'col-md-6'))
                ->add('title', null, array('label' => 'Nombre'))
                ->add('possessions', null, array(
                    'label' => 'Bienes',
                    'required' => false,
                    'attr' => array('class' => 'ckeditor')
                ))
                ->add('status', 'choice', array(
                    'label' => 'Estado',
                    'required' => false,
                    'choices' => Auction::$statusOptions,
                    'empty_value' => 'Seleccionar...'
                ))
                ->add('description', null, array(
                    'label' => 'Descripcion',
                    'required' => false,
                    'attr' => array('class' => 'ckeditor')
                ))
            ->end()
            ->with('Ubicacion', array('class' => 'col-md-6'))
                ->add('file', 'file', array(
                    'label' => 'Archivo PDF',
                    'required' => false,
                    'help' => ($auction->getPdf())? $auction->getPdf() : ''
                ))
                ->add('location', null, array('label' => 'Localidad', 'required' => true, 'empty_value' => 'Seleccionar...'))
                ->add('conditions', null, array(
                    'label' => 'Condiciones',
                    'attr' => array('class' => 'ckeditor')
                ))
            ->end()
            ->with('Fotos')
                ->add('images', 'sonata_type_collection', array(
                    'label' => false,
                ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'id',
                ))
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
            ->add('possessions')
            ->add('status')
            ->add('description')
            ->add('pdf')
            ->add('location')
            ->add('conditions')
        ;
    }

    /**
     * prePersist() function
     */
    public function prePersist($auction)
    {
        $this->manageFileUpload($auction);
        foreach ($auction->getImages() as $media) {
            $media->setAuction($auction);
        }
    }

    /**
     * preUpdate() function
     */
    public function preUpdate($auction)
    {
        $this->manageFileUpload($auction);
        foreach ($auction->getImages() as $media) {
            $media->setAuction($auction);
        }
    }

    /**
     * manageFileUpload() function
     */
    private function manageFileUpload($auction)
    {
        if ($auction->getFile()) {
            $auction->refreshPdfUpdated();
        }
    }
}
