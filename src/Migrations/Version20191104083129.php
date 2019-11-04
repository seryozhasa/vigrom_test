<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191104083129 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP INDEX uniq_e77b8f7a38248176');
        $this->addSql('CREATE INDEX IDX_E77B8F7A38248176 ON wallet_wallets (currency_id)');
        $this->addSql('DROP INDEX uniq_eaa81a4c38248176');
        $this->addSql('DROP INDEX uniq_eaa81a4c712520f3');
        $this->addSql('CREATE INDEX IDX_EAA81A4C712520F3 ON transactions (wallet_id)');
        $this->addSql('CREATE INDEX IDX_EAA81A4C38248176 ON transactions (currency_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP INDEX IDX_E77B8F7A38248176');
        $this->addSql('CREATE UNIQUE INDEX uniq_e77b8f7a38248176 ON wallet_wallets (currency_id)');
        $this->addSql('DROP INDEX IDX_EAA81A4C712520F3');
        $this->addSql('DROP INDEX IDX_EAA81A4C38248176');
        $this->addSql('CREATE UNIQUE INDEX uniq_eaa81a4c38248176 ON transactions (currency_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_eaa81a4c712520f3 ON transactions (wallet_id)');
    }
}
