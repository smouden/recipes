<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231201025553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE car ADD color VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE car ADD consumption INT NOT NULL');
        $this->addSql('ALTER TABLE car ADD transmission BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE car ADD speed INT NOT NULL');
        $this->addSql('ALTER TABLE car ADD maps BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE car ADD category VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE car ADD fuel BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE car ADD name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE car DROP description');
        $this->addSql('ALTER TABLE car DROP color');
        $this->addSql('ALTER TABLE car DROP consumption');
        $this->addSql('ALTER TABLE car DROP transmission');
        $this->addSql('ALTER TABLE car DROP speed');
        $this->addSql('ALTER TABLE car DROP maps');
        $this->addSql('ALTER TABLE car DROP category');
        $this->addSql('ALTER TABLE car DROP fuel');
        $this->addSql('ALTER TABLE car DROP name');
    }
}
