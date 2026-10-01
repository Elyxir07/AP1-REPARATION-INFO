<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261001133941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demande (etat_demande VARCHAR(100) NOT NULL, objet VARCHAR(255) NOT NULL, raison VARCHAR(100) NOT NULL, commentaire VARCHAR(300) NOT NULL, id_util_id INT NOT NULL, ref_presta_id VARCHAR(50) NOT NULL, INDEX IDX_2694D7A511C087F0 (id_util_id), INDEX IDX_2694D7A5C97596B5 (ref_presta_id), PRIMARY KEY (id_util_id, ref_presta_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE materiel (reference VARCHAR(50) NOT NULL, type VARCHAR(30) NOT NULL, marque VARCHAR(100) NOT NULL, stock INT NOT NULL, PRIMARY KEY (reference)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE prestation (reference VARCHAR(50) NOT NULL, nom VARCHAR(255) NOT NULL, prix NUMERIC(10, 2) NOT NULL, PRIMARY KEY (reference)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(320) NOT NULL, mdp VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, rue VARCHAR(255) NOT NULL, cp VARCHAR(40) NOT NULL, ville VARCHAR(255) NOT NULL, num_tel VARCHAR(15) NOT NULL, type VARCHAR(30) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utiliser (quantite INT NOT NULL, ref_presta_id VARCHAR(50) NOT NULL, ref_mat_id VARCHAR(50) NOT NULL, INDEX IDX_5C949109C97596B5 (ref_presta_id), INDEX IDX_5C949109A9BEA0CA (ref_mat_id), PRIMARY KEY (ref_presta_id, ref_mat_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A511C087F0 FOREIGN KEY (id_util_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5C97596B5 FOREIGN KEY (ref_presta_id) REFERENCES prestation (Reference)');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C949109C97596B5 FOREIGN KEY (ref_presta_id) REFERENCES prestation (Reference)');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C949109A9BEA0CA FOREIGN KEY (ref_mat_id) REFERENCES materiel (Reference)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A511C087F0');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5C97596B5');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C949109C97596B5');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C949109A9BEA0CA');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utiliser');
    }
}
