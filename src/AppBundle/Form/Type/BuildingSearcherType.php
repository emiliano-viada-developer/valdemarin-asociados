<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\Building;

class BuildingSearcherType extends AbstractType
{
    /**
	 * buildForm() method
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('propertyType', 'entity', array(
            	'class' => 'AppBundle:PropertyType',
            	'empty_value' => 'Seleccionar..'
        	))
        	->add('location', 'entity', array(
            	'class' => 'AppBundle:Location',
            	'empty_value' => 'Seleccionar..'
        	))
        	->add('operationType', 'choice', array(
            	'choices' => Building::$operationTypeOptions,
            	'empty_value' => 'Seleccionar..'
        	))
        	->add('surfaceM2', 'choice', array(
            	'choices' => array(
            		100 => '0-100',
            		200 => '101-200',
            		300 => '201-300',
            		400 => '301-400',
            		500 => '401-500',
            		1000 => '+500',
        		),
            	'empty_value' => 'Seleccionar..',
                'mapped' => false
        	))
        	->add('price_min', null, array('mapped' => false))
        	->add('price_max', null, array('mapped' => false))
        ;
    }

    /**
	 * getName() method
     */
    public function getName()
    {
        return 'building_searcher';
    }
}
