<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210419083709 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles CHANGE label label VARCHAR(128) NOT NULL, CHANGE contenu contenu LONGTEXT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD3168EA750E8 ON articles (label)');
        $this->addSql('ALTER TABLE categories CHANGE label label VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE mots_cles CHANGE label label VARCHAR(128) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4E4C6CAEA750E8 ON mots_cles (label)');
        $this->addSql('ALTER TABLE users ADD name VARCHAR(100) NOT NULL, ADD firstname VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_BFDD3168EA750E8 ON articles');
        $this->addSql('ALTER TABLE articles CHANGE label label VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE contenu contenu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE categories CHANGE label label VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_D4E4C6CAEA750E8 ON mots_cles');
        $this->addSql('ALTER TABLE mots_cles CHANGE label label VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users DROP name, DROP firstname');
    }
}
