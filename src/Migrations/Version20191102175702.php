<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191102175702 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE user_users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE wallet_currencies_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE wallet_wallets_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_users (id INT NOT NULL, wallet_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F6415EB1712520F3 ON user_users (wallet_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F6415EB1F85E0677 ON user_users (username)');
        $this->addSql('CREATE TABLE wallet_currencies (id INT NOT NULL, code VARCHAR(255) NOT NULL, value DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B09B795177153098 ON wallet_currencies (code)');
        $this->addSql('CREATE TABLE wallet_wallets (id INT NOT NULL, currency_id INT DEFAULT NULL, balance DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E77B8F7A38248176 ON wallet_wallets (currency_id)');
        $this->addSql('ALTER TABLE user_users ADD CONSTRAINT FK_F6415EB1712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet_wallets (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wallet_wallets ADD CONSTRAINT FK_E77B8F7A38248176 FOREIGN KEY (currency_id) REFERENCES wallet_currencies (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE wallet_wallets DROP CONSTRAINT FK_E77B8F7A38248176');
        $this->addSql('ALTER TABLE user_users DROP CONSTRAINT FK_F6415EB1712520F3');
        $this->addSql('DROP SEQUENCE user_users_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE wallet_currencies_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE wallet_wallets_id_seq CASCADE');
        $this->addSql('DROP TABLE user_users');
        $this->addSql('DROP TABLE wallet_currencies');
        $this->addSql('DROP TABLE wallet_wallets');
    }
}
