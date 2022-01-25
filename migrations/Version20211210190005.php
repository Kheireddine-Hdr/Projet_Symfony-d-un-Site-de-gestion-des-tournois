<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211210190005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tours (id INT AUTO_INCREMENT NOT NULL, tour_tournoi_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_2F0AC70E10DB6195 (tour_tournoi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tours_equipe (tours_id INT NOT NULL, equipe_id INT NOT NULL, INDEX IDX_3349AF0E8B14082 (tours_id), INDEX IDX_3349AF0E6D861B89 (equipe_id), PRIMARY KEY(tours_id, equipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tours_groupe (tours_id INT NOT NULL, groupe_id INT NOT NULL, INDEX IDX_13B9993A8B14082 (tours_id), INDEX IDX_13B9993A7A45358C (groupe_id), PRIMARY KEY(tours_id, groupe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tours ADD CONSTRAINT FK_2F0AC70E10DB6195 FOREIGN KEY (tour_tournoi_id) REFERENCES tournoi (id)');
        $this->addSql('ALTER TABLE tours_equipe ADD CONSTRAINT FK_3349AF0E8B14082 FOREIGN KEY (tours_id) REFERENCES tours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tours_equipe ADD CONSTRAINT FK_3349AF0E6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tours_groupe ADD CONSTRAINT FK_13B9993A8B14082 FOREIGN KEY (tours_id) REFERENCES tours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tours_groupe ADD CONSTRAINT FK_13B9993A7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tours_equipe DROP FOREIGN KEY FK_3349AF0E8B14082');
        $this->addSql('ALTER TABLE tours_groupe DROP FOREIGN KEY FK_13B9993A8B14082');
        $this->addSql('DROP TABLE tours');
        $this->addSql('DROP TABLE tours_equipe');
        $this->addSql('DROP TABLE tours_groupe');
    }
}
