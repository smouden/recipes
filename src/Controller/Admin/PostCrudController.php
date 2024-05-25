<?php
namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')
                ->hideOnForm(), // Cache dans le formulaire car généré automatiquement
            TextEditorField::new('content_post', 'Post Content'),
            AssociationField::new('topic', 'Topic')
                ->setCrudController(TopicCrudController::class), 
            AssociationField::new('poster', 'Poster')
                ->setCrudController(UserCrudController::class) 
            


            
            ];
    }
}
