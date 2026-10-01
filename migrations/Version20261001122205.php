<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261001122205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utiliser (quantite INT NOT NULL, ref_presta_id VARCHAR(50) NOT NULL, ref_mat_id VARCHAR(50) NOT NULL, INDEX IDX_5C949109C97596B5 (ref_presta_id), INDEX IDX_5C949109A9BEA0CA (ref_mat_id), PRIMARY KEY (ref_presta_id, ref_mat_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C949109C97596B5 FOREIGN KEY (ref_presta_id) REFERENCES prestation (reference)');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C949109A9BEA0CA FOREIGN KEY (ref_mat_id) REFERENCES materiel (Reference)');
        $this->addSql('ALTER TABLE demande MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE demande DROP id, CHANGE ref_presta_id ref_presta_id VARCHAR(50) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_util_id, ref_presta_id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A511C087F0 FOREIGN KEY (id_util_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5C97596B5 FOREIGN KEY (ref_presta_id) REFERENCES prestation (Reference)');
        $this->addSql('ALTER TABLE prestation MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE prestation DROP id, CHANGE reference reference VARCHAR(50) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (reference)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C949109C97596B5');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C949109A9BEA0CA');
        $this->addSql('DROP TABLE utiliser');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A511C087F0');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5C97596B5');
        $this->addSql('ALTER TABLE demande ADD id INT AUTO_INCREMENT NOT NULL, CHANGE ref_presta_id ref_presta_id INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE prestation ADD id INT AUTO_INCREMENT NOT NULL, CHANGE reference reference VARCHAR(255) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
