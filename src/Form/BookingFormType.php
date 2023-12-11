<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class BookingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('phone')
            ->add('email')
            ->add('date_birth')
            ->add('start_date')
            ->add('return_date')
            ->add('start_time')
            ->add('return_time')
            ->add('Insurance', EntityType::class, [
                'class' => Insurance::class,
                'choice_label' => 'name', // name propriété qui represente la classe d'assurance 
            ])
            ->add('Car')
            ->add('Insurance')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
