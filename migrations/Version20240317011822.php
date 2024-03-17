<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240317011822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe_comment (recipe_id INT NOT NULL, comment_id INT NOT NULL, PRIMARY KEY(recipe_id, comment_id))');
        $this->addSql('CREATE INDEX IDX_D8905C2C59D8A214 ON recipe_comment (recipe_id)');
        $this->addSql('CREATE INDEX IDX_D8905C2CF8697D13 ON recipe_comment (comment_id)');
        $this->addSql('ALTER TABLE recipe_comment ADD CONSTRAINT FK_D8905C2C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_comment ADD CONSTRAINT FK_D8905C2CF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD comment_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C541DB185 FOREIGN KEY (comment_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9474526C541DB185 ON comment (comment_user_id)');
        $this->addSql('ALTER TABLE "user" ADD picture_user VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE recipe_comment DROP CONSTRAINT FK_D8905C2C59D8A214');
        $this->addSql('ALTER TABLE recipe_comment DROP CONSTRAINT FK_D8905C2CF8697D13');
        $this->addSql('DROP TABLE recipe_comment');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C541DB185');
        $this->addSql('DROP INDEX IDX_9474526C541DB185');
        $this->addSql('ALTER TABLE comment DROP comment_user_id');
        $this->addSql('ALTER TABLE "user" DROP picture_user');
    }
}
