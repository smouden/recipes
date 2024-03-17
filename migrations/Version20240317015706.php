<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240317015706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('ALTER TABLE recipe_comment DROP CONSTRAINT fk_d8905c2cf8697d13');
        $this->addSql('ALTER TABLE recipe_comment DROP CONSTRAINT fk_d8905c2c59d8a214');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526c541db185');
        $this->addSql('DROP TABLE recipe_comment');
        $this->addSql('DROP TABLE comment');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE recipe_comment (recipe_id INT NOT NULL, comment_id INT NOT NULL, PRIMARY KEY(recipe_id, comment_id))');
        $this->addSql('CREATE INDEX idx_d8905c2cf8697d13 ON recipe_comment (comment_id)');
        $this->addSql('CREATE INDEX idx_d8905c2c59d8a214 ON recipe_comment (recipe_id)');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, comment_user_id INT NOT NULL, date_comment TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, content_comment VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_9474526c541db185 ON comment (comment_user_id)');
        $this->addSql('ALTER TABLE recipe_comment ADD CONSTRAINT fk_d8905c2cf8697d13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_comment ADD CONSTRAINT fk_d8905c2c59d8a214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526c541db185 FOREIGN KEY (comment_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
