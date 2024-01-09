<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108172252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, co_cl_id_id INT NOT NULL, co_id INT NOT NULL, co_date DATE NOT NULL, co_prix_total DOUBLE PRECISION NOT NULL, INDEX IDX_6EEAA67D797AC22E (co_cl_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D797AC22E FOREIGN KEY (co_cl_id_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client ADD email VARCHAR(180) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD postal VARCHAR(255) NOT NULL, ADD ville VARCHAR(255) NOT NULL, ADD roles JSON NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, DROP name');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455E7927C74 ON client (email)');
        $this->addSql('ALTER TABLE comm_prod ADD CONSTRAINT FK_FA94BCE89E3702D6 FOREIGN KEY (cp_co_id_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE comm_prod ADD CONSTRAINT FK_FA94BCE86A0AC910 FOREIGN KEY (cp_pr_id_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comm_prod DROP FOREIGN KEY FK_FA94BCE89E3702D6');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D797AC22E');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP INDEX UNIQ_C7440455E7927C74 ON client');
        $this->addSql('ALTER TABLE client ADD name VARCHAR(30) NOT NULL, DROP email, DROP nom, DROP prenom, DROP adresse, DROP postal, DROP ville, DROP roles, DROP password');
        $this->addSql('ALTER TABLE comm_prod DROP FOREIGN KEY FK_FA94BCE86A0AC910');
    }
}
