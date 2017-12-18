<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171218065211 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('ALTER TABLE `feed` MODIFY COLUMN `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL AFTER `id`;');
        $this->addSql('ALTER TABLE `feed_comment` MODIFY COLUMN `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL AFTER `author`;');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feed CHANGE content content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE feed_comment CHANGE payload payload LONGTEXT NOT NULL');
    }
}
