<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class OfferPropertyType extends ContactType
{
    /**
	 * buildForm() method
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->remove('message');
        $builder->add('message', 'textarea', array(
            'required' => true,
            'label' => '* Datos de la Propiedad:',
            'constraints' => array(new NotBlank(array('message' => 'Ingresa los datos de su propiedad.'))),
            'attr' => array('class' => 'formDropdown')
        ));
    }

    /**
	 * getName() method
     */
    public function getName()
    {
        return 'offer_property';
    }
}
