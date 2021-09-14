<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210914120833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin_user_sector (admin_user_id INT NOT NULL, sector_id INT NOT NULL, INDEX IDX_B3EB8BDC6352511C (admin_user_id), INDEX IDX_B3EB8BDCDE95C867 (sector_id), PRIMARY KEY(admin_user_id, sector_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_user_sector ADD CONSTRAINT FK_B3EB8BDC6352511C FOREIGN KEY (admin_user_id) REFERENCES admin_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_user_sector ADD CONSTRAINT FK_B3EB8BDCDE95C867 FOREIGN KEY (sector_id) REFERENCES sector (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE admin_user_sector');
    }
}
