<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;


class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('date_comment', 'Comment Date'),
            TextField::new('content_comment', 'Comment Content'),
            AssociationField::new('commentator', 'Commentator')
                ->setCrudController(UserCrudController::class), // Replace UserCrudController with your User entity's CRUD controller, if necessary
            AssociationField::new('recipe', 'Recipe')
                ->setCrudController(RecipeCrudController::class), // Replace RecipeCrudController with your Recipe entity's CRUD controller, if necessary
        ];
    }


}
