<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230914103055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE assurance_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contact_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE options_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE utilisateur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voiture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE assurance (id INT NOT NULL, nom_assurance VARCHAR(255) NOT NULL, description_assurance VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contact (id INT NOT NULL, envoyeur_id INT NOT NULL, nom_contact VARCHAR(255) NOT NULL, prenom_contact VARCHAR(255) NOT NULL, objet_contact VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C62E6384795A786 ON contact (envoyeur_id)');
        $this->addSql('CREATE TABLE image (id INT NOT NULL, avoir_voiture_id INT NOT NULL, image BYTEA NOT NULL, titre_image VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C53D045FCD274431 ON image (avoir_voiture_id)');
        $this->addSql('CREATE TABLE options (id INT NOT NULL, type_option VARCHAR(255) NOT NULL, prix_option DOUBLE PRECISION NOT NULL, descriptif_option VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, reservateur_id INT NOT NULL, assurance_id INT NOT NULL, nom_reservation VARCHAR(255) NOT NULL, prenom_reservation VARCHAR(255) NOT NULL, mail_reservation VARCHAR(255) NOT NULL, age_conducteur BIGINT NOT NULL, tel_reservation BIGINT NOT NULL, adresse_depart VARCHAR(255) NOT NULL, adresse_retour VARCHAR(255) NOT NULL, date_depart DATE NOT NULL, date_retour DATE NOT NULL, heure_depart TIME(0) WITHOUT TIME ZONE NOT NULL, heure_retour TIME(0) WITHOUT TIME ZONE NOT NULL, date_reservation DATE NOT NULL, statut_reservation VARCHAR(255) NOT NULL, nom_admin_refus VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C84955FF6F3098 ON reservation (reservateur_id)');
        $this->addSql('CREATE INDEX IDX_42C84955B288C3E3 ON reservation (assurance_id)');
        $this->addSql('CREATE TABLE reservation_options (reservation_id INT NOT NULL, options_id INT NOT NULL, PRIMARY KEY(reservation_id, options_id))');
        $this->addSql('CREATE INDEX IDX_B7A04102B83297E7 ON reservation_options (reservation_id)');
        $this->addSql('CREATE INDEX IDX_B7A041023ADB05F1 ON reservation_options (options_id)');
        $this->addSql('CREATE TABLE utilisateur (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom_u VARCHAR(100) NOT NULL, prenom_u VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur (email)');
        $this->addSql('CREATE TABLE utilisateur_voiture (utilisateur_id INT NOT NULL, voiture_id INT NOT NULL, PRIMARY KEY(utilisateur_id, voiture_id))');
        $this->addSql('CREATE INDEX IDX_93E9769DFB88E14F ON utilisateur_voiture (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_93E9769D181A8BA ON utilisateur_voiture (voiture_id)');
        $this->addSql('CREATE TABLE voiture (id INT NOT NULL, boite_vitesse VARCHAR(255) NOT NULL, nom_marque VARCHAR(255) NOT NULL, nbr_places BIGINT NOT NULL, prix_jour DOUBLE PRECISION NOT NULL, kilometrage DOUBLE PRECISION NOT NULL, climatise BOOLEAN NOT NULL, bluetooth BOOLEAN NOT NULL, nombre_portes BIGINT NOT NULL, categorie_v VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6384795A786 FOREIGN KEY (envoyeur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FCD274431 FOREIGN KEY (avoir_voiture_id) REFERENCES voiture (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FF6F3098 FOREIGN KEY (reservateur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B288C3E3 FOREIGN KEY (assurance_id) REFERENCES assurance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation_options ADD CONSTRAINT FK_B7A04102B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation_options ADD CONSTRAINT FK_B7A041023ADB05F1 FOREIGN KEY (options_id) REFERENCES options (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utilisateur_voiture ADD CONSTRAINT FK_93E9769DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utilisateur_voiture ADD CONSTRAINT FK_93E9769D181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE assurance_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contact_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE image_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE options_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE utilisateur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voiture_id_seq CASCADE');
        $this->addSql('ALTER TABLE contact DROP CONSTRAINT FK_4C62E6384795A786');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045FCD274431');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955FF6F3098');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955B288C3E3');
        $this->addSql('ALTER TABLE reservation_options DROP CONSTRAINT FK_B7A04102B83297E7');
        $this->addSql('ALTER TABLE reservation_options DROP CONSTRAINT FK_B7A041023ADB05F1');
        $this->addSql('ALTER TABLE utilisateur_voiture DROP CONSTRAINT FK_93E9769DFB88E14F');
        $this->addSql('ALTER TABLE utilisateur_voiture DROP CONSTRAINT FK_93E9769D181A8BA');
        $this->addSql('DROP TABLE assurance');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE options');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_options');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_voiture');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
