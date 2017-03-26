<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use AppBundle\Entity\Avatar;
use AppBundle\Form\AvatarType;

class AgentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '7'
                  )
            ))
            ->add('cni', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '11'
                  )
            ))
            ->add('nom', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '25'
                  )
            ))
            ->add('prenoms', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '75'
                  )
            ))
            ->add('sexe', ChoiceType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'placeholder' => 'Selectionnez le sexe'
                  ),
                  'choices'  => array(
                    'MASCULIN' => 'M',
                    'FEMININ' => 'F'
                  ),
                  'required' => true
            ))
            ->add('datenaiss', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      //'maxlength' => '30'
                  )
            ))
            ->add('lieunaiss', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '30'
                  )
            ))
            ->add('fonction', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '50'
                  )
            ))
            ->add('datefonc', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      //'maxlength' => '50'
                  )
            ))
            ->add('lieufonc', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '25'
                  )
            ))
            ->add('email', EmailType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '75'
                  ),
                  'required'  => false
            ))
            ->add('contact', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '8'
                  )
            ))
            ->add('statut')
            //->add('slug')->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ->add('classe', EntityType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                  ),
                'class' => 'AppBundle:Classe'
            ))
            ->add('echelon', EntityType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                  ),
                'class' => 'AppBundle:Echelon'
            ))
            ->add('grade', EntityType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                  ),
                'class' => 'AppBundle:Grade'
            ))
            ->add('service', EntityType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                  ),
                'class' => 'AppBundle:Service'
            ))
            ->add('avatar', AvatarType::class)
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Agent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_agent';
    }


}
