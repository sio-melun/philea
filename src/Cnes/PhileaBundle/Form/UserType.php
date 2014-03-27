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
        $roles = array("ROLE_GESTIONNAIRE"=>"Gestionnaire","ROLE_REDACTEUR"=>"Rédacteur");
        $builder
            ->add('username','text',array('label'=>'Login','attr'=> array('class'=>'form-control')))
            ->add('email','email',array('attr'=> array('class'=>'form-control')))
            ->add('password','password',array('label'=>'Mot de passe','attr'=> array('class'=>'form-control')))
            ->add('enabled','checkbox',array('label'=>'Compte actif','attr'=>array('checked'=>true)))
            ->add('locked','checkbox',array('label'=>'Bloquer','required'=> false,'attr'=> array('class'=>'')))
             ->add('roles', 'choice', array(
            'choices' => $roles,
            'multiple' => true,
            'expanded' => true,
        )) ;
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
