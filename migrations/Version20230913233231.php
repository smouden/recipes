<?php


declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230913233231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Drop tables in reverse order to avoid foreign key constraints
        $this->addSql('DROP TABLE IF EXISTS options_reservation');
        $this->addSql('DROP TABLE IF EXISTS reservation');
        $this->addSql('DROP TABLE IF EXISTS options');
        $this->addSql('DROP TABLE IF EXISTS image');
        $this->addSql('DROP TABLE IF EXISTS contact');
        $this->addSql('DROP TABLE IF EXISTS assurance');
        $this->addSql('DROP TABLE IF EXISTS messenger_messages');
        $this->addSql('DROP TABLE IF EXISTS voiture');
        $this->addSql('DROP TABLE IF EXISTS utilisateur');

        // Drop sequences
        $this->addSql('DROP SEQUENCE IF EXISTS options_reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE IF EXISTS reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE IF EXISTS options_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE IF EXISTS image_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE IF EXISTS contact_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE IF EXISTS assurance_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE IF EXISTS messenger_messages_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE IF EXISTS voiture_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE IF EXISTS utilisateur_id_seq CASCADE');
    }

    public function down(Schema $schema): void
    {
        // You can add the SQL statements to recreate the tables and sequences here,
        // but it's recommended to keep this empty if you only want to support rolling forward migrations.
    }
}
