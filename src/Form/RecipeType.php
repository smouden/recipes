<?php

namespace App\Form;

use App\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType; // pour images 
use Symfony\Component\Validator\Constraints\NotBlank; // Importer la contrainte NotBlank


class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title_recipe', null, [
                'constraints' => new NotBlank(), // Ajouter la contrainte NotBlank
            ])
            ->add('description_recipe', null, [
                'constraints' => new NotBlank(),
            ])
            ->add('procedure', null, [
                'constraints' => new NotBlank(),
            ])
            ->add('prep_time', null, [
                'constraints' => new NotBlank(),
            ])
            ->add('cook_time', null, [
                'constraints' => new NotBlank(),
            ])
            ->add('number_serving', null, [
                'constraints' => new NotBlank(),
            ])
            ->add('picture_recipe', FileType::class, [
                'label' => 'Picture of the recipe',
                'mapped' => false,
                'required' => true,
                'constraints' => new NotBlank(), // Ajouter la contrainte NotBlank
            ])
            // ->add('creator_recipe') //  ->add('ingredient')
            ->add('category', null, [
                'constraints' => new NotBlank(),
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
