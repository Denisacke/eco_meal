<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260626050955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE business (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, phone VARCHAR(50) NOT NULL, location VARCHAR(255) NOT NULL, type_id INT NOT NULL, INDEX IDX_8D36E38C54C8C93 (type_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE business_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE consumer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, consumer_id INT NOT NULL, package_id INT NOT NULL, INDEX IDX_F529939837FDBD6D (consumer_id), UNIQUE INDEX UNIQ_F5299398F44CABFF (package_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE package (id INT AUTO_INCREMENT NOT NULL, package VARCHAR(255) NOT NULL, description VARCHAR(200) NOT NULL, start_pickup DATETIME NOT NULL, end_pickup DATETIME NOT NULL, price DOUBLE PRECISION NOT NULL, product_category_id INT NOT NULL, business_id INT DEFAULT NULL, INDEX IDX_DE686795BE6903FD (product_category_id), INDEX IDX_DE686795A89DB457 (business_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE business ADD CONSTRAINT FK_8D36E38C54C8C93 FOREIGN KEY (type_id) REFERENCES business_type (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939837FDBD6D FOREIGN KEY (consumer_id) REFERENCES consumer (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398F44CABFF FOREIGN KEY (package_id) REFERENCES package (id)');
        $this->addSql('ALTER TABLE package ADD CONSTRAINT FK_DE686795BE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id)');
        $this->addSql('ALTER TABLE package ADD CONSTRAINT FK_DE686795A89DB457 FOREIGN KEY (business_id) REFERENCES business (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE business DROP FOREIGN KEY FK_8D36E38C54C8C93');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939837FDBD6D');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398F44CABFF');
        $this->addSql('ALTER TABLE package DROP FOREIGN KEY FK_DE686795BE6903FD');
        $this->addSql('ALTER TABLE package DROP FOREIGN KEY FK_DE686795A89DB457');
        $this->addSql('DROP TABLE business');
        $this->addSql('DROP TABLE business_type');
        $this->addSql('DROP TABLE consumer');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE package');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
