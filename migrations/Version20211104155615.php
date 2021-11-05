<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211104155615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD title VARCHAR(255) NOT NULL, ADD description VARCHAR(255) NOT NULL, ADD author VARCHAR(255) NOT NULL, ADD recipe VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE comment comments VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP title, DROP description, DROP author, DROP recipe');
        $this->addSql('ALTER TABLE user CHANGE comments comment VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
