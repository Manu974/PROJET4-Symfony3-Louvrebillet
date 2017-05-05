<?php

namespace LOUVRE\TicketBundle\Form;

use LOUVRE\TicketBundle\Entity\Billet;
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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class BilletType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'datedevisite', DateType::class, [
                'label'=> 'Date de votre visite',
                ]
            )
            ->add(
                'journeecomplete', ChoiceType::class, [
                'label' => 'Journée complète ou Demi-journée ?',          
                'choices' => [

                    'Journée' => 'Journée',
                    'Demi-journée' => 'Demi-journée',
                ],
                ]
            )
            ->add(
                'email', EmailType::class, [

                'label' =>'E-mail',

                ]
            )
            
            ->add(
                'visiteurs', CollectionType::class, [
                'label' =>' ',
                'entry_type' => VisiteurType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                ]
            )
            ->add('valider',   SubmitType::class);
           
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
            'data_class' => 'LOUVRE\TicketBundle\Entity\Billet'
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'louvre_ticketbundle_billet';
    }
    
    


}