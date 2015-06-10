<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class BuildingAdmin extends Admin
{
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
            ->add('reference')
            ->add('location')
            ->add('price')
            ->add('propertyType')
            ->add('neighborhood')
            ->add('detail')
            ->add('description')
            ->add('featured')
            ->add('services')
            ->add('address')
            ->add('operationType')
            ->add('frontMts')
            ->add('backMts')
            ->add('surfaceM2')
            ->add('coveredSurface')
            ->add('semicoveredSurface')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('reference', null, array('label' => 'Referencia'))
            ->add('location', null, array('label' => 'Ubicacion'))
            ->add('price', null, array('label' => 'Precio'))
            ->add('propertyType', null, array('label' => 'Tipo de Propiedad'))
            ->add('featured', null, array('label' => 'Destacado?'))
            ->add('operationType', null, array('label' => 'Tipo de Operacion'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
                'label' => 'Acciones'
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('reference', null, array('label' => 'Referencia'))
            ->add('location', null, array('label' => 'Ubicacion', 'required' => true, 'empty_value' => 'Seleccionar...'))
            ->add('price', null, array('label' => 'Precio', 'help' => '(en dolares)'))
            ->add('propertyType', null, array(
                'label' => 'Tipo de Propiedad',
                'required' => true,
                'empty_value' => 'Seleccionar...'
            ))
            ->add('neighborhood', null, array('label' => 'Zona / Barrio', 'required' => false))
            ->add('detail', null, array('label' => 'Detalle', 'required' => false))
            ->add('description', null, array('label' => 'Descripcion', 'required' => false))
            ->add('featured', null, array('label' => 'Destacado?', 'required' => false))
            ->add('services', null, array('label' => 'Servicios', 'required' => false))
            ->add('address', null, array('label' => 'Domicilio', 'required' => false))
            ->add('operationType', 'choice', array(
                'label' => 'Tipo de Operacion',
                'required' => true,
                'choices' => array('venta' => 'Venta', 'alquiler' => 'Alquiler'),
                'empty_value' => 'Seleccionar...'
            ))
            ->add('frontMts', null, array('label' => 'Frente (mts)', 'required' => false))
            ->add('backMts', null, array('label' => 'Fondo (mts)', 'required' => false))
            ->add('surfaceM2', null, array('label' => 'Superficie (mts2)', 'required' => false))
            ->add('coveredSurface', null, array('label' => 'Sup. Cubierta (mts2)', 'required' => false))
            ->add('semicoveredSurface', null, array('label' => 'Sup. Semicubierta (mts2)', 'required' => false))
            ->end()
                ->with('Fotos')
                ->add('images', 'sonata_type_collection', array(
                    'label' => false,
                    //'by_reference' => false,
                ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'id',
                ))
            ->end()
                ->with('Mapa')
                ->add('latlng', 'oh_google_maps', array(
                    'required' => false,
                    'map_width' => 600,
                    'map_height' => 400,
                    'default_lat' => -32.16956899,
                    'default_lng' => -64.11639129,
                    'label' => 'Latitud y Longitud'
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
            ->add('reference', null, array('label' => 'Referencia'))
            ->add('location', null, array('label' => 'Ubicacion'))
            ->add('price', null, array('label' => 'Precio'))
            ->add('propertyType', null, array('label' => 'Tipo de Propiedad'))
            ->add('neighborhood', null, array('label' => 'Zona / Barrio'))
            ->add('detail', null, array('label' => 'Detalle'))
            ->add('description', null, array('label' => 'Descripcion'))
            ->add('featured', null, array('label' => 'Destacado?'))
            ->add('services', null, array('label' => 'Servicios'))
            ->add('address', null, array('label' => 'Domicilio'))
            ->add('operationType', null, array('label' => 'Tipo de Operacion'))
            ->add('frontMts', null, array('label' => 'Frente (mts)'))
            ->add('backMts', null, array('label' => 'Fondo (mts)'))
            ->add('surfaceM2', null, array('label' => 'Superficie (mts2)'))
            ->add('coveredSurface', null, array('label' => 'Sup. Cubierta (mts2)'))
            ->add('semicoveredSurface', null, array('label' => 'Sup. Semicubierta (mts2)'))
        ;
    }

    /**
     * prePersist() function
     */
    public function prePersist($building)
    {
        foreach ($building->getImages() as $media) {
            $media->setBuilding($building);
        }
    }

    /**
     * preUpdate() function
     */
    public function preUpdate($building)
    {
        foreach ($building->getImages() as $media) {
            $media->setBuilding($building);
        }
    }
}
