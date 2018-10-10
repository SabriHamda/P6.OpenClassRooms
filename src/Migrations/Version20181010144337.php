<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181010144337 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_users ADD image_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', DROP image');
        $this->addSql('ALTER TABLE app_users ADD CONSTRAINT FK_C25028243DA5256D FOREIGN KEY (image_id) REFERENCES snowtricks_media (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C25028243DA5256D ON app_users (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_users DROP FOREIGN KEY FK_C25028243DA5256D');
        $this->addSql('DROP INDEX UNIQ_C25028243DA5256D ON app_users');
        $this->addSql('ALTER TABLE app_users ADD image VARCHAR(255) DEFAULT \'
                                    img/avatar/default-user-avatar.png
                                \' COLLATE utf8mb4_unicode_ci, DROP image_id');
    }
}
