<?php
namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
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
            TextEditorField::new('content_post', 'Contenu du Post'),
            AssociationField::new('topic', 'Sujet')
                ->setCrudController(TopicCrudController::class), // Assurez-vous d'avoir un contrôleur CRUD pour Topic
            AssociationField::new('poster', 'Posteur')
                ->setCrudController(UserCrudController::class) // Assurez-vous d'avoir un contrôleur CRUD pour User
        ];
    }
}
