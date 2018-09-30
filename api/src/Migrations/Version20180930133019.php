<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180930133019 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE address (id INT NOT NULL, site_id INT DEFAULT NULL, line1 VARCHAR(255) DEFAULT NULL, line2 VARCHAR(255) DEFAULT NULL, postcode VARCHAR(16) NOT NULL, town VARCHAR(128) NOT NULL, country VARCHAR(128) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4E6F81F6BD1646 ON address (site_id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE address_id_seq CASCADE');
        $this->addSql('DROP TABLE address');
    }
}
