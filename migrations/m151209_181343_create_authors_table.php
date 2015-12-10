<?php

use yii\db\pgsql\Schema;
use yii\db\Migration;

/**
 * Class m151209_181343_create_authors_table
 */
class m151209_181343_create_authors_table extends Migration
{
    CONST TABLE_NAME = 'authors';

    public function safeUp()
    {
        $this->createTable(
            self::TABLE_NAME,
            [
                'id' => Schema::TYPE_PK,
                'first_name' => 'character varying(255) NOT NULL',
                'last_name' => 'character varying(255) NOT NULL'
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }

}
