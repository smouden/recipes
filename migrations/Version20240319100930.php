<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319100930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE post_community_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE topic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE post_community (id INT NOT NULL, topic_id INT NOT NULL, poster_id INT NOT NULL, content_post VARCHAR(255) NOT NULL, date_post TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BA0E3EC41F55203D ON post_community (topic_id)');
        $this->addSql('CREATE INDEX IDX_BA0E3EC45BB66C05 ON post_community (poster_id)');
        $this->addSql('CREATE TABLE topic (id INT NOT NULL, title_topic VARCHAR(255) NOT NULL, description_topic VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE post_community ADD CONSTRAINT FK_BA0E3EC41F55203D FOREIGN KEY (topic_id) REFERENCES topic (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_community ADD CONSTRAINT FK_BA0E3EC45BB66C05 FOREIGN KEY (poster_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE post_community_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE topic_id_seq CASCADE');
        $this->addSql('ALTER TABLE post_community DROP CONSTRAINT FK_BA0E3EC41F55203D');
        $this->addSql('ALTER TABLE post_community DROP CONSTRAINT FK_BA0E3EC45BB66C05');
        $this->addSql('DROP TABLE post_community');
        $this->addSql('DROP TABLE topic');
    }
}
