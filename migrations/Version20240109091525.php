<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<< HEAD:migrations/Version20240109094242.php
final class Version20240109094242 extends AbstractMigration
=======
final class Version20240109091525 extends AbstractMigration
>>>>>>> df70cd67f37aecdb24acdf93bffb9166b7327c20:migrations/Version20240109091525.php
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C7440455E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comm_prod (id INT AUTO_INCREMENT NOT NULL, cp_co_id_id INT NOT NULL, cp_pr_id_id INT NOT NULL, cp_quantite INT NOT NULL, INDEX IDX_FA94BCE89E3702D6 (cp_co_id_id), INDEX IDX_FA94BCE86A0AC910 (cp_pr_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, co_cl_id_id INT NOT NULL, co_date DATE NOT NULL, co_prix_total DOUBLE PRECISION NOT NULL, INDEX IDX_6EEAA67D797AC22E (co_cl_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, pr_label VARCHAR(50) NOT NULL, pr_prix_unit DOUBLE PRECISION NOT NULL, pr_quantite_stock INT NOT NULL, pr_image VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comm_prod ADD CONSTRAINT FK_FA94BCE89E3702D6 FOREIGN KEY (cp_co_id_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE comm_prod ADD CONSTRAINT FK_FA94BCE86A0AC910 FOREIGN KEY (cp_pr_id_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D797AC22E FOREIGN KEY (co_cl_id_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comm_prod DROP FOREIGN KEY FK_FA94BCE89E3702D6');
        $this->addSql('ALTER TABLE comm_prod DROP FOREIGN KEY FK_FA94BCE86A0AC910');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D797AC22E');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE comm_prod');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE produit');
    }
}
