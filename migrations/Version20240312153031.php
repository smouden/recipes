<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240312153031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE instruction_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, date_comment TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, content_comment VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE recipe_instruction DROP CONSTRAINT fk_af48af3262a10f76');
        $this->addSql('ALTER TABLE recipe_instruction DROP CONSTRAINT fk_af48af3259d8a214');
        $this->addSql('DROP TABLE recipe_instruction');
        $this->addSql('DROP TABLE instruction');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE instruction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE recipe_instruction (recipe_id INT NOT NULL, instruction_id INT NOT NULL, PRIMARY KEY(recipe_id, instruction_id))');
        $this->addSql('CREATE INDEX idx_af48af3262a10f76 ON recipe_instruction (instruction_id)');
        $this->addSql('CREATE INDEX idx_af48af3259d8a214 ON recipe_instruction (recipe_id)');
        $this->addSql('CREATE TABLE instruction (id INT NOT NULL, name_instruction VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE recipe_instruction ADD CONSTRAINT fk_af48af3262a10f76 FOREIGN KEY (instruction_id) REFERENCES instruction (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_instruction ADD CONSTRAINT fk_af48af3259d8a214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE comment');
    }
}
