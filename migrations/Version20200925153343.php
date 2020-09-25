<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200925153343 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Change Record column name release to releaseDate (reserved word)';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE record CHANGE id id VARCHAR(255) NOT NULL, CHANGE `release` releaseDate DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE record CHANGE id id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE releasedate `release` DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\'');
    }
}
