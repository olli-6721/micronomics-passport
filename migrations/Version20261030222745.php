<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261030222745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE battery_entity (serial_number VARCHAR(100) NOT NULL, batch_number VARCHAR(100) NOT NULL, model_id VARCHAR(255) NOT NULL, owner_id VARCHAR(255) NOT NULL, manufactured_at DATE NOT NULL, manufacturing_country VARCHAR(3) NOT NULL, lifecycle_stage VARCHAR(255) NOT NULL, id UUID NOT NULL, warranty_id UUID DEFAULT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3629782B2EC1782C ON battery_entity (warranty_id)');
        $this->addSql('CREATE TABLE battery_warranty_entity (issuer VARCHAR(255) NOT NULL, start_date DATE NOT NULL, duration_years INT NOT NULL, max_energy_throughput_mwh INT DEFAULT NULL, min_guaranteed_so_h INT DEFAULT NULL, max_distance INT DEFAULT NULL, reference VARCHAR(255) DEFAULT NULL, id UUID NOT NULL, PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE battery_entity ADD CONSTRAINT FK_3629782B2EC1782C FOREIGN KEY (warranty_id) REFERENCES battery_warranty_entity (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE battery_entity DROP CONSTRAINT FK_3629782B2EC1782C');
        $this->addSql('DROP TABLE battery_entity');
        $this->addSql('DROP TABLE battery_warranty_entity');
    }
}
