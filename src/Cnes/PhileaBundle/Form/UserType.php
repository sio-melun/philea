<?php

namespace Cnes\PhileaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
       
        $builder
            ->add('username','text',array('attr'=> array('class'=>'form-control')))
            ->add('email','email',array('attr'=> array('class'=>'form-control')))
            ->add('enabled','checkbox',array('attr'=> array('class'=>'')))
            ->add('password','password',array('attr'=> array('class'=>'form-control')))
            ->add('locked','checkbox',array('required'=> false,'attr'=> array('class'=>'')))
            ->add('roles', 'collection', array(
                'type'   => 'choice',
                'options'  => array(
                'choices'  => array('ROLE_GESTIONNAIRE' => 'Gestionnaire', 'ROLE_REDACTEUR' => 'Rédacteur'),
                    'label' => false,
                    'attr'=> array('class'=>'form-control'),)))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cnes\PhileaBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cnes_phileabundle_user';
    }
}
