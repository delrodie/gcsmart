<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class RechagentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control recherche',
                      'placeholder' => "Entrez votre matricule...",
                      'autocomplete'  => 'off',
                      'maxlength' => '7'
                  ),
            ))
            ->add('pass', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control recherche',
                      'placeholder' => "Entrez votre mot de passe...",
                      'autocomplete'  => 'off',
                      'maxlength' => '8'
                  ),
            ))
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Rechagent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_rechagent';
    }


}
