<?php

namespace App\Form;

use App\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType; // pour images 


class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title_recipe')
            ->add('description_recipe')
            ->add('procedure')
            ->add('prep_time')
            ->add('cook_time')
            ->add('number_serving')
            ->add('picture_recipe', FileType::class, [
                'label' => 'Picture of the recipe',
                'mapped' => false, // pour dire à Symfony de ne pas associer ce champ à la propriété de l'entité
                'required' => false,
            ])
            // ->add('creator_recipe')
            //  ->add('ingredient')
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
