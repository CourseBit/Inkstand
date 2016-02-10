<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160206185018 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('UPDATE lms_resource SET rating_id = NULL');
        $this->addSql('ALTER TABLE lms_resource ADD CONSTRAINT FK_A4EBA79AA32EFC6 FOREIGN KEY (rating_id) REFERENCES lib_rating (rating_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A4EBA79AA32EFC6 ON lms_resource (rating_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lms_resource DROP FOREIGN KEY FK_A4EBA79AA32EFC6');
        $this->addSql('DROP INDEX UNIQ_A4EBA79AA32EFC6 ON lms_resource');
        $this->addSql('ALTER TABLE lrs_statement CHANGE timestamp timestamp DATETIME DEFAULT NULL, CHANGE stored stored DATETIME DEFAULT NULL');
    }
}
