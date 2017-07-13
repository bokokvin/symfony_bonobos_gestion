<?php

namespace BK\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GestionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', 'text')
            ->add('mdp', 'text')
            ->add('age', 'text')
            ->add('famille', 'text')
            ->add('race', 'text')
            ->add('nourriture', 'text')
            ->add('gestions', 'text')
			->add('Annuler',      'reset')
			->add('Modifier',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BK\PlatformBundle\Entity\Gestion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bk_platformbundle_gestion';
    }
}
