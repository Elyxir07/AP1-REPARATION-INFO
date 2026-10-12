<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261002134217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
    }
}
