<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171205073712 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE feed (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, owner INT NOT NULL, is_deleted TINYINT(1) NOT NULL, platform VARCHAR(64) NOT NULL, creation_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feed_comment (id INT AUTO_INCREMENT NOT NULL, feed INT NOT NULL, author INT NOT NULL, payload LONGTEXT NOT NULL, reply_to_user_id INT DEFAULT NULL, creationDate DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feed_likes (id INT AUTO_INCREMENT NOT NULL, feed INT NOT NULL, author INT NOT NULL, creation_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feed_attachment (id INT AUTO_INCREMENT NOT NULL, feed INT NOT NULL, content VARCHAR(256) NOT NULL, attachment_type VARCHAR(64) NOT NULL, filename VARCHAR(64) NOT NULL, preview VARCHAR(256) DEFAULT NULL, size INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE feed');
        $this->addSql('DROP TABLE feed_comment');
        $this->addSql('DROP TABLE feed_likes');
        $this->addSql('DROP TABLE feed_attachment');
    }
}
