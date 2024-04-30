<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Hide in form as it's automatically generated
            TextField::new('title_recipe', 'Recipe Title'),
            AssociationField::new('category', 'Category')
                ->setCrudController(CategoryCrudController::class),
            IntegerField::new('prep_time', 'Preparation Time (minutes)'),
            IntegerField::new('cook_time', 'Cooking Time (minutes)'),
            IntegerField::new('number_serving', 'Number of Servings'),
            TextareaField::new('description_recipe', 'Description'),
            TextareaField::new('procedure', 'Procedure'),
            ImageField::new('picture_recipe', 'Picture')
                ->setBasePath('/assets/images')
                ->setUploadDir('public/assets/images')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            AssociationField::new('creator_recipe', 'Recipe Creator')
                ->setCrudController(UserCrudController::class),
            AssociationField::new('ingredient', 'Ingredients')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->hideOnIndex(), // Optionally hide on index to avoid clutter
        ];
    }



}



