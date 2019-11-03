<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191103121740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE transactions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE transactions (id INT NOT NULL, wallet_id INT DEFAULT NULL, currency_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, cause VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EAA81A4C712520F3 ON transactions (wallet_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EAA81A4C38248176 ON transactions (currency_id)');
        $this->addSql('COMMENT ON COLUMN transactions.type IS \'(DC2Type:transaction_type)\'');
        $this->addSql('COMMENT ON COLUMN transactions.cause IS \'(DC2Type:transaction_cause)\'');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet_wallets (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C38248176 FOREIGN KEY (currency_id) REFERENCES wallet_currencies (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE transactions_id_seq CASCADE');
        $this->addSql('DROP TABLE transactions');
    }
}
