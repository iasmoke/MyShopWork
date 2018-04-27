<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180427144218 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ordersItems (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, order_id INT DEFAULT NULL, quantity_order INT DEFAULT 0 NOT NULL, price NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, value_order NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, INDEX IDX_D32F77F94584665A (product_id), INDEX IDX_D32F77F98D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ordersitem ADD CONSTRAINT FK_D32F77F94584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE ordersitem ADD CONSTRAINT FK_D32F77F98D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id)');
        $this->addSql('DROP TABLE ordersitem');
        $this->addSql('ALTER TABLE products CHANGE is_top is_top TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE image_name image_name VARCHAR(255) DEFAULT NULL, CHANGE image_size image_size INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE image_type image_type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE orders ADD user_id INT DEFAULT NULL, DROP user, CHANGE date_time date_time DATETIME NOT NULL, CHANGE status status SMALLINT DEFAULT 0 NOT NULL, CHANGE payment_state payment_state TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE sum_order sum_order NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEEA76ED395 ON orders (user_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ordersitem (id INT AUTO_INCREMENT NOT NULL, product VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, quantity_order VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, price_order VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, value_order VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE ordersitem');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('DROP INDEX IDX_E52FFDEEA76ED395 ON orders');
        $this->addSql('ALTER TABLE orders ADD user VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP user_id, CHANGE date_time date_time VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE status status VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE payment_state payment_state VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE sum_order sum_order VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE products CHANGE is_top is_top TINYINT(1) DEFAULT \'0\', CHANGE image_name image_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE image_size image_size INT NOT NULL, CHANGE image_type image_type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE updated_at updated_at DATETIME NOT NULL');
    }
}
