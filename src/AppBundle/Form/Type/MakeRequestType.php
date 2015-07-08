<?php

namespace AppBundle\Form\Type;

//use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
/*use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
*/
class MakeRequestType extends ContactType
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
            'label' => 'Inquietud:',
            'constraints' => array(new NotBlank(array('message' => 'Ingresa alguna inquietud.'))),
            'attr' => array('class' => 'formDropdown')
        ));
    }

    /**
	 * getName() method
     */
    public function getName()
    {
        return 'make_request';
    }
}
