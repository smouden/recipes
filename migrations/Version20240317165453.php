<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240317165453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, commentator_id INT NOT NULL, recipe_id INT NOT NULL, date_comment TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, content_comment VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526C506AFCC0 ON comment (commentator_id)');
        $this->addSql('CREATE INDEX IDX_9474526C59D8A214 ON comment (recipe_id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C506AFCC0 FOREIGN KEY (commentator_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C506AFCC0');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C59D8A214');
        $this->addSql('DROP TABLE comment');
    }
}
