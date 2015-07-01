<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\Auction;

class AuctionSearcherType extends AbstractType
{
    /**
	 * buildForm() method
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', 'choice', array(
                'choices' => Auction::$statusOptions,
                'empty_value' => 'Seleccionar..'
            ))
        	->add('location', 'entity', array(
            	'class' => 'AppBundle:Location',
            	'empty_value' => 'Seleccionar..'
        	))
        ;
    }

    /**
	 * getName() method
     */
    public function getName()
    {
        return 'auction_searcher';
    }
}
