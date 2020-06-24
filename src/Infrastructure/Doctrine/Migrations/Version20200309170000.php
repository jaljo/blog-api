<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200309170000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create the article table.';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (
            id INT AUTO_INCREMENT NOT NULL,
            title VARCHAR(100) NOT NULL,
            slug VARCHAR(100) NOT NULL,
            content LONGTEXT NOT NULL,
            date_creation DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
            draft TINYINT(1) NOT NULL,
            UNIQUE INDEX unique_slug (slug),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE article');
    }
}
