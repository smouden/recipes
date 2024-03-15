<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240311020037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe_instruction (recipe_id INT NOT NULL, instruction_id INT NOT NULL, PRIMARY KEY(recipe_id, instruction_id))');
        $this->addSql('CREATE INDEX IDX_AF48AF3259D8A214 ON recipe_instruction (recipe_id)');
        $this->addSql('CREATE INDEX IDX_AF48AF3262A10F76 ON recipe_instruction (instruction_id)');
        $this->addSql('CREATE TABLE recipe_ingredient (recipe_id INT NOT NULL, ingredient_id INT NOT NULL, PRIMARY KEY(recipe_id, ingredient_id))');
        $this->addSql('CREATE INDEX IDX_22D1FE1359D8A214 ON recipe_ingredient (recipe_id)');
        $this->addSql('CREATE INDEX IDX_22D1FE13933FE08C ON recipe_ingredient (ingredient_id)');
        $this->addSql('ALTER TABLE recipe_instruction ADD CONSTRAINT FK_AF48AF3259D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_instruction ADD CONSTRAINT FK_AF48AF3262A10F76 FOREIGN KEY (instruction_id) REFERENCES instruction (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE1359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE13933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe ADD creator_recipe_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137A0369B5C FOREIGN KEY (creator_recipe_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DA88B137A0369B5C ON recipe (creator_recipe_id)');
        $this->addSql('CREATE INDEX IDX_DA88B13712469DE2 ON recipe (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE recipe_instruction DROP CONSTRAINT FK_AF48AF3259D8A214');
        $this->addSql('ALTER TABLE recipe_instruction DROP CONSTRAINT FK_AF48AF3262A10F76');
        $this->addSql('ALTER TABLE recipe_ingredient DROP CONSTRAINT FK_22D1FE1359D8A214');
        $this->addSql('ALTER TABLE recipe_ingredient DROP CONSTRAINT FK_22D1FE13933FE08C');
        $this->addSql('DROP TABLE recipe_instruction');
        $this->addSql('DROP TABLE recipe_ingredient');
        $this->addSql('ALTER TABLE recipe DROP CONSTRAINT FK_DA88B137A0369B5C');
        $this->addSql('ALTER TABLE recipe DROP CONSTRAINT FK_DA88B13712469DE2');
        $this->addSql('DROP INDEX IDX_DA88B137A0369B5C');
        $this->addSql('DROP INDEX IDX_DA88B13712469DE2');
        $this->addSql('ALTER TABLE recipe DROP creator_recipe_id');
        $this->addSql('ALTER TABLE recipe DROP category_id');
    }
}
