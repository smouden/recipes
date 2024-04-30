<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424135257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE post_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE topic_id_seq CASCADE');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT fk_5a8a6c8d5bb66c05');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT fk_5a8a6c8d1f55203d');
        $this->addSql('DROP TABLE topic');
        $this->addSql('DROP TABLE post');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE post_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE topic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE topic (id INT NOT NULL, title_topic VARCHAR(255) NOT NULL, description_topic VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE post (id INT NOT NULL, poster_id INT NOT NULL, topic_id INT DEFAULT NULL, content_post VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_5a8a6c8d1f55203d ON post (topic_id)');
        $this->addSql('CREATE INDEX idx_5a8a6c8d5bb66c05 ON post (poster_id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT fk_5a8a6c8d5bb66c05 FOREIGN KEY (poster_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT fk_5a8a6c8d1f55203d FOREIGN KEY (topic_id) REFERENCES topic (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
