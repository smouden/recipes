<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319104214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_community ADD poster_id INT NOT NULL');
        $this->addSql('ALTER TABLE post_community ADD CONSTRAINT FK_BA0E3EC45BB66C05 FOREIGN KEY (poster_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BA0E3EC45BB66C05 ON post_community (poster_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE post_community DROP CONSTRAINT FK_BA0E3EC45BB66C05');
        $this->addSql('DROP INDEX IDX_BA0E3EC45BB66C05');
        $this->addSql('ALTER TABLE post_community DROP poster_id');
    }
}
