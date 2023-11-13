<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231024132202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE account (id INT NOT NULL, uid VARCHAR(180) NOT NULL, roles JSON NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, mailperso VARCHAR(400) DEFAULT NULL, mail VARCHAR(400) DEFAULT NULL, tel VARCHAR(255) DEFAULT NULL, datenais VARCHAR(255) DEFAULT NULL, genre VARCHAR(255) DEFAULT NULL, nationalite VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, diplome_prepare VARCHAR(400) DEFAULT NULL, derniere_diplome VARCHAR(400) DEFAULT NULL, derniere_filiere VARCHAR(400) DEFAULT NULL, adresse_fixe VARCHAR(400) DEFAULT NULL, adresse_actu VARCHAR(400) DEFAULT NULL, pratique_art VARCHAR(255) DEFAULT NULL, other_comments TEXT DEFAULT NULL, is_verified VARCHAR(255) DEFAULT NULL, derniere_filiere_hors VARCHAR(400) DEFAULT NULL, echange_inter VARCHAR(255) DEFAULT NULL, created_at_u TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, cod_etu VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A4539B0606 ON account (uid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE account_id_seq CASCADE');
        $this->addSql('DROP TABLE account');
    }
}
