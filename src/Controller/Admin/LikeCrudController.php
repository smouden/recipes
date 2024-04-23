<?php

namespace App\Controller\Admin;

use App\Entity\Like;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class LikeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Like::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Cache le champ ID lors de la création ou de l'édition
            AssociationField::new('liker', 'User')
                ->setCrudController(UserCrudController::class), // Configure le contrôleur CRUD pour User
            AssociationField::new('recipe', 'Recipe')
                ->setCrudController(RecipeCrudController::class), // Configure le contrôleur CRUD pour Recipe
            BooleanField::new('status_like', 'Like Status') // Champ booléen pour le statut du "like"
        ];
    }

}
