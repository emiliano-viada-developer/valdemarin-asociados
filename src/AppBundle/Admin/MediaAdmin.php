<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MediaAdmin extends Admin
{
    protected $baseRouteName = 'media';

    protected $baseRoutePattern = 'media';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('path')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('path')
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
        // Get the Media object
        $image = $this->getSubject();

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = array('required' => false);
        if ($image && ($webPath = $image->getWebPath())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request')->getBasePath().'/'.$webPath;

            // add a 'help' option containing the preview's img tag
            $fileFieldOptions['help'] = '<img src="'.$fullPath.'" class="admin-preview" />';
            $fileFieldOptions['label'] = 'Foto';
        }

        $formMapper
            ->add('file', 'file', $fileFieldOptions)
        ;

        if($this->hasParentFieldDescription()) { // this Admin is embedded
            $parentAdmin = $this->getParentFieldDescription()->getAdmin();
            if ($parentAdmin->getCode() === 'app.admin.building') {
                $formMapper->add('building', 'sonata_type_model_hidden');
            } elseif ($parentAdmin->getCode() === 'app.admin.auction') {
                $formMapper->add('auction', 'sonata_type_model_hidden');
            }
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('path')
        ;
    }

    /**
     * prePersist() function
     */
    public function prePersist($image)
    {
        $this->manageFileUpload($image);
    }

    /**
     * preUpdate() function
     */
    public function preUpdate($image)
    {
        $this->manageFileUpload($image);
    }

    /**
     * manageFileUpload() function
     */
    private function manageFileUpload($image)
    {
        if ($image->getFile()) {
            $image->refreshUpdated();
        }
    }
}
