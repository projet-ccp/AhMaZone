<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108144446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comm_prod (id INT AUTO_INCREMENT NOT NULL, cp_co_id_id INT NOT NULL, cp_pr_id_id INT NOT NULL, cp_id INT NOT NULL, cp_quantite INT NOT NULL, INDEX IDX_FA94BCE89E3702D6 (cp_co_id_id), INDEX IDX_FA94BCE86A0AC910 (cp_pr_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, pr_id INT NOT NULL, pr_label VARCHAR(50) NOT NULL, pr_prix_unit DOUBLE PRECISION NOT NULL, pr_quantite_stock INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comm_prod ADD CONSTRAINT FK_FA94BCE89E3702D6 FOREIGN KEY (cp_co_id_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE comm_prod ADD CONSTRAINT FK_FA94BCE86A0AC910 FOREIGN KEY (cp_pr_id_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE client ADD nom VARCHAR(50) NOT NULL, ADD postal INT NOT NULL, DROP cl_id, DROP cl_code_postal, CHANGE cl_nom email VARCHAR(50) NOT NULL, CHANGE cl_adresse adresse VARCHAR(255) NOT NULL, CHANGE cl_ville ville VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comm_prod DROP FOREIGN KEY FK_FA94BCE89E3702D6');
        $this->addSql('ALTER TABLE comm_prod DROP FOREIGN KEY FK_FA94BCE86A0AC910');
        $this->addSql('DROP TABLE comm_prod');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE client ADD cl_nom VARCHAR(50) NOT NULL, ADD cl_code_postal INT NOT NULL, DROP email, DROP nom, CHANGE postal cl_id INT NOT NULL, CHANGE adresse cl_adresse VARCHAR(255) NOT NULL, CHANGE ville cl_ville VARCHAR(100) NOT NULL');
    }
}
