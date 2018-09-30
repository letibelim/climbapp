<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180930135314 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE address DROP CONSTRAINT fk_d4e6f81f6bd1646');
        $this->addSql('DROP INDEX uniq_d4e6f81f6bd1646');
        $this->addSql('ALTER TABLE address DROP site_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE address ADD site_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT fk_d4e6f81f6bd1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_d4e6f81f6bd1646 ON address (site_id)');
    }
}
