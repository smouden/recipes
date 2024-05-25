<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240525141653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe ALTER description_recipe TYPE TEXT');
        $this->addSql('ALTER TABLE recipe ALTER description_recipe TYPE TEXT');
        $this->addSql('ALTER TABLE recipe ALTER procedure TYPE TEXT');
        $this->addSql('ALTER TABLE recipe ALTER procedure TYPE TEXT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE recipe ALTER description_recipe TYPE VARCHAR(800)');
        $this->addSql('ALTER TABLE recipe ALTER procedure TYPE VARCHAR(800)');
    }
}
