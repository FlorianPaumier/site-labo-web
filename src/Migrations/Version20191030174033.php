<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191030174033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE themes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sondage (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sondage_themes (sondage_id INT NOT NULL, themes_id INT NOT NULL, INDEX IDX_A0699D41BAF4AE56 (sondage_id), INDEX IDX_A0699D4194F4A9D2 (themes_id), PRIMARY KEY(sondage_id, themes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sondage_answer (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, themes_id INT DEFAULT NULL, INDEX IDX_6FF6E5BAA76ED395 (user_id), INDEX IDX_6FF6E5BA94F4A9D2 (themes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sondage_themes ADD CONSTRAINT FK_A0699D41BAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sondage_themes ADD CONSTRAINT FK_A0699D4194F4A9D2 FOREIGN KEY (themes_id) REFERENCES themes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sondage_answer ADD CONSTRAINT FK_6FF6E5BAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sondage_answer ADD CONSTRAINT FK_6FF6E5BA94F4A9D2 FOREIGN KEY (themes_id) REFERENCES themes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sondage_themes DROP FOREIGN KEY FK_A0699D4194F4A9D2');
        $this->addSql('ALTER TABLE sondage_answer DROP FOREIGN KEY FK_6FF6E5BA94F4A9D2');
        $this->addSql('ALTER TABLE sondage_themes DROP FOREIGN KEY FK_A0699D41BAF4AE56');
        $this->addSql('DROP TABLE themes');
        $this->addSql('DROP TABLE sondage');
        $this->addSql('DROP TABLE sondage_themes');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE sondage_answer');
    }
}
