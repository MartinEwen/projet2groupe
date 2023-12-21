<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221095002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ticket_language (ticket_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_51B28D34700047D2 (ticket_id), INDEX IDX_51B28D3482F1BAF4 (language_id), PRIMARY KEY(ticket_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket_language ADD CONSTRAINT FK_51B28D34700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket_language ADD CONSTRAINT FK_51B28D3482F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE language_ticket DROP FOREIGN KEY FK_8BB394C5700047D2');
        $this->addSql('ALTER TABLE language_ticket DROP FOREIGN KEY FK_8BB394C582F1BAF4');
        $this->addSql('DROP TABLE language_ticket');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE language_ticket (language_id INT NOT NULL, ticket_id INT NOT NULL, INDEX IDX_8BB394C582F1BAF4 (language_id), INDEX IDX_8BB394C5700047D2 (ticket_id), PRIMARY KEY(language_id, ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE language_ticket ADD CONSTRAINT FK_8BB394C5700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE language_ticket ADD CONSTRAINT FK_8BB394C582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket_language DROP FOREIGN KEY FK_51B28D34700047D2');
        $this->addSql('ALTER TABLE ticket_language DROP FOREIGN KEY FK_51B28D3482F1BAF4');
        $this->addSql('DROP TABLE ticket_language');
    }
}
