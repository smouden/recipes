<?php

namespace App\Controller\Admin;

use App\Entity\Car;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;


class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('name'),
            IntegerField::new('model', 'Model Year'),
            NumberField::new('price'),
            TextField::new('color'),
            IntegerField::new('rating')
                ->setFormTypeOptions([
                    'attr' => [
                        'min' => 0, // valeur minimale
                        'max' => 5, // valeur maximale
                    ]
                ]),
            IntegerField::new('consumption'),
            TextEditorField::new('description'),
            IntegerField::new('speed'),
            BooleanField::new('maps'),
            TextField::new('category'),
            ChoiceField::new('fuel')
                ->setChoices([
                    'Diesel' => 'diesel',
                    'Gasoline' => 'gasoline'
                ]),
            ChoiceField::new('transmission')
                ->setChoices([
                    'Manual' => 'manual',
                    'Automatic' => 'automatic'
                ]),
        ];
    }
}
