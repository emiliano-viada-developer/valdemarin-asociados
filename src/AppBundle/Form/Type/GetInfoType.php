<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class GetInfoType extends ContactType
{
    /**
	 * buildForm() method
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('locality', 'text', array(
            'required' => true,
            'label' => 'Lugar / Ciudad:',
            'constraints' => array(new NotBlank(array('message' => 'Ingresa alguna ciudad.'))),
            'attr' => array('class' => 'formDropdown')
        ));
        $builder->add('interest', 'choice', array(
            'choices' => array(
                'subastas'   => 'Subastas',
                'inmuebles' => 'Inmuebles',
            ),
            'label' => 'Interesado en:',
            'multiple' => true,
            'expanded' => true
        ));
    }

    /**
	 * getName() method
     */
    public function getName()
    {
        return 'get_info';
    }
}
