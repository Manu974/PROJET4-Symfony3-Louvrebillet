<?php

namespace LOUVRE\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class VisiteurType extends AbstractType
{
    /**
    * {@inheritdoc}
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add(
                'pays', ChoiceType::class, array(
                'choices' =>array(
                'France' => 'France',
                'Espagne' => 'Espagne',
                'Allemagne' => 'Allemagne',
                'Brésil' => 'Brésil',
                'Portugal' => 'Portugal',
                ),
                )
            )
            ->add(
                'datedenaissance', BirthdayType::class, array(
                'placeholder' => array(
                'Année' => 'Année', 'Mois' => 'Mois', 'Jour' => 'Jour',
                )
                )
            )
            ->add(
                'tarifreduit', CheckboxType::class, array(
                'label'    => 'Tarif Réduit ?',
                'required' => false,
                )
            );

            

    }

    /**
    * {@inheritdoc}
    */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
            'data_class' => 'LOUVRE\TicketBundle\Entity\Visiteur'
            )
        );
    }

    /**
    * {@inheritdoc}
    */
    public function getBlockPrefix()
    {
        return 'louvre_ticketbundle_visiteur';
    }


}
