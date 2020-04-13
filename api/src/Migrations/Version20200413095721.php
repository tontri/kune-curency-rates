<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200413095721 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'ohlc_track has been added';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        $this->addSql('
            CREATE TABLE `ohlc_track` (
                `id` SERIAL,
                `provider_id` TINYINT UNSIGNED NOT NULL,
                `symbol_code` TINYINT UNSIGNED NOT NULL,
                `price_bid` DECIMAL(18,8) NOT NULL,
                `vol_bid` DECIMAL(18,8) NOT NULL,
                `price_ask` DECIMAL(18,8) NOT NULL,
                `vol_ask` DECIMAL(18,8) NOT NULL,
                `last_price` DECIMAL(18,8) NOT NULL,
                `vol_24_hours` DECIMAL(18,8) NOT NULL,
                `max_price_24_hours` DECIMAL(18,8) NOT NULL,
                `min_price_24_hours` DECIMAL(18,8) NOT NULL,
                `created_at` DATETIME NOT NULL
            );
       ');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE `ohlc_track`');

    }
}
