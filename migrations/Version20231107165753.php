<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231107165753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE assurance_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contact_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE options_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE utilisateur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voiture_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_assurance_id_seq CASCADE');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT fk_42c84955ff6f3098');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT fk_42c84955b288c3e3');
        $this->addSql('ALTER TABLE contact DROP CONSTRAINT fk_4c62e6384795a786');
        $this->addSql('ALTER TABLE reservation_options DROP CONSTRAINT fk_b7a04102b83297e7');
        $this->addSql('ALTER TABLE reservation_options DROP CONSTRAINT fk_b7a041023adb05f1');
        $this->addSql('ALTER TABLE utilisateur_voiture DROP CONSTRAINT fk_93e9769dfb88e14f');
        $this->addSql('ALTER TABLE utilisateur_voiture DROP CONSTRAINT fk_93e9769d181a8ba');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('DROP TABLE assurance');
        $this->addSql('DROP TABLE type_assurance');
        $this->addSql('DROP TABLE options');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE reservation_options');
        $this->addSql('DROP TABLE utilisateur_voiture');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE assurance_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contact_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE options_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE utilisateur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voiture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_assurance_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE voiture (id INT NOT NULL, boite_vitesse VARCHAR(255) NOT NULL, nom_marque VARCHAR(255) NOT NULL, nbr_places BIGINT NOT NULL, prix_jour DOUBLE PRECISION NOT NULL, kilometrage DOUBLE PRECISION NOT NULL, climatise BOOLEAN NOT NULL, bluetooth BOOLEAN NOT NULL, nombre_portes BIGINT NOT NULL, categorie_v VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE assurance (id INT NOT NULL, nom_assurance VARCHAR(255) NOT NULL, description_assurance VARCHAR(255) NOT NULL, type_assurance VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_assurance (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE options (id INT NOT NULL, type_option VARCHAR(255) NOT NULL, prix_option DOUBLE PRECISION NOT NULL, descriptif_option VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE utilisateur (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom_u VARCHAR(100) NOT NULL, prenom_u VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_1d1c63b3e7927c74 ON utilisateur (email)');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, reservateur_id INT NOT NULL, assurance_id INT NOT NULL, nom_reservation VARCHAR(255) NOT NULL, prenom_reservation VARCHAR(255) NOT NULL, mail_reservation VARCHAR(255) NOT NULL, age_conducteur BIGINT NOT NULL, tel_reservation BIGINT NOT NULL, adresse_depart VARCHAR(255) NOT NULL, adresse_retour VARCHAR(255) NOT NULL, date_depart DATE NOT NULL, date_retour DATE NOT NULL, heure_depart TIME(0) WITHOUT TIME ZONE NOT NULL, heure_retour TIME(0) WITHOUT TIME ZONE NOT NULL, date_reservation DATE NOT NULL, statut_reservation VARCHAR(255) NOT NULL, nom_admin_refus VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_42c84955b288c3e3 ON reservation (assurance_id)');
        $this->addSql('CREATE INDEX idx_42c84955ff6f3098 ON reservation (reservateur_id)');
        $this->addSql('CREATE TABLE contact (id INT NOT NULL, envoyeur_id INT NOT NULL, nom_contact VARCHAR(255) NOT NULL, prenom_contact VARCHAR(255) NOT NULL, objet_contact VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_4c62e6384795a786 ON contact (envoyeur_id)');
        $this->addSql('CREATE TABLE reservation_options (reservation_id INT NOT NULL, options_id INT NOT NULL, PRIMARY KEY(reservation_id, options_id))');
        $this->addSql('CREATE INDEX idx_b7a041023adb05f1 ON reservation_options (options_id)');
        $this->addSql('CREATE INDEX idx_b7a04102b83297e7 ON reservation_options (reservation_id)');
        $this->addSql('CREATE TABLE utilisateur_voiture (utilisateur_id INT NOT NULL, voiture_id INT NOT NULL, PRIMARY KEY(utilisateur_id, voiture_id))');
        $this->addSql('CREATE INDEX idx_93e9769d181a8ba ON utilisateur_voiture (voiture_id)');
        $this->addSql('CREATE INDEX idx_93e9769dfb88e14f ON utilisateur_voiture (utilisateur_id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT fk_42c84955ff6f3098 FOREIGN KEY (reservateur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT fk_42c84955b288c3e3 FOREIGN KEY (assurance_id) REFERENCES assurance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT fk_4c62e6384795a786 FOREIGN KEY (envoyeur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation_options ADD CONSTRAINT fk_b7a04102b83297e7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation_options ADD CONSTRAINT fk_b7a041023adb05f1 FOREIGN KEY (options_id) REFERENCES options (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utilisateur_voiture ADD CONSTRAINT fk_93e9769dfb88e14f FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utilisateur_voiture ADD CONSTRAINT fk_93e9769d181a8ba FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
