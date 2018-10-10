<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181010124401 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_users CHANGE validation_token validation_token VARCHAR(64) NOT NULL, CHANGE image image VARCHAR(255) DEFAULT \'
                            img/avatar/default-user-avatar.png
                        \', CHANGE reset_password_token reset_password_token VARCHAR(64) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_users CHANGE image image VARCHAR(255) DEFAULT \'
                                    img/avatar/default-user-avatar.png
                                \' COLLATE utf8mb4_unicode_ci, CHANGE validation_token validation_token VARCHAR(64) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE reset_password_token reset_password_token VARCHAR(64) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
