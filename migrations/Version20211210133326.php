<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211210133326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE match_jouer (id INT AUTO_INCREMENT NOT NULL, equipe01_id INT DEFAULT NULL, equipe02_id INT DEFAULT NULL, matchs_degroupe_id INT DEFAULT NULL, score01 INT DEFAULT NULL, score02 INT DEFAULT NULL, INDEX IDX_3C34254CE2F82D98 (equipe01_id), INDEX IDX_3C34254CF04D8276 (equipe02_id), INDEX IDX_3C34254C62F6CB3B (matchs_degroupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE match_jouer ADD CONSTRAINT FK_3C34254CE2F82D98 FOREIGN KEY (equipe01_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE match_jouer ADD CONSTRAINT FK_3C34254CF04D8276 FOREIGN KEY (equipe02_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE match_jouer ADD CONSTRAINT FK_3C34254C62F6CB3B FOREIGN KEY (matchs_degroupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C2115ED8D43');
        $this->addSql('DROP INDEX IDX_4B98C2115ED8D43 ON groupe');
        $this->addSql('ALTER TABLE groupe DROP tour_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE match_jouer');
        $this->addSql('ALTER TABLE groupe ADD tour_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C2115ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id)');
        $this->addSql('CREATE INDEX IDX_4B98C2115ED8D43 ON groupe (tour_id)');
    }
}
