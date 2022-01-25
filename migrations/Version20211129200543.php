<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211129200543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15DC342DFB');
        $this->addSql('DROP INDEX IDX_2449BA15DC342DFB ON equipe');
        $this->addSql('ALTER TABLE equipe DROP equipe_tournoi_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe ADD equipe_tournoi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15DC342DFB FOREIGN KEY (equipe_tournoi_id) REFERENCES tournoi (id)');
        $this->addSql('CREATE INDEX IDX_2449BA15DC342DFB ON equipe (equipe_tournoi_id)');
    }
}
