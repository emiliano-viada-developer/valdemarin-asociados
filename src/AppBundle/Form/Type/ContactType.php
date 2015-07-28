<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class ContactType extends AbstractType
{
    /**
	 * buildForm() method
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'required' => true,
                'label' => '* Nombre y Apellido:',
                'constraints' => array(new NotBlank(array('message' => 'Ingresa tu nombre y tu apellido.')))
            ))
            ->add('email', 'email', array(
                'required' => true,
                'label' => '* E-mail:',
                'constraints' => array(
                    new NotBlank(array('message' => 'Ingresa tu E-mail.')),
                    new Email(array('message' => 'Ingresa un E-mail valido.'))
                )
            ))
            ->add('phone', 'text', array(
                'required' => true,
                'label' => '* Telefono:',
                'constraints' => array(new NotBlank(array('message' => 'Ingresa tu telefono.')))
            ))
            ->add('message', 'textarea', array(
                'required' => true,
                'label' => '* Sugerencias / Comentarios:',
                'constraints' => array(new NotBlank(array('message' => 'Ingresa alguna sugerencia o comentario.'))),
                'attr' => array('class' => 'formDropdown')
            ))
        ;
    }

    /**
     * setDefaultOptions() function
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'intention'       => 'contact_form',
        ));
    }

    /**
	 * getName() method
     */
    public function getName()
    {
        return 'contact';
    }
}
