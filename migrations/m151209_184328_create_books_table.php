<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m151209_184328_create_books_table
 */
class m151209_184328_create_books_table extends Migration
{
    CONST TABLE_NAME = 'books';

    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => Schema::TYPE_PK,
            'name' => 'TEXT',
            'author_id' => 'INTEGER NOT NULL',
            'preview_path' => 'TEXT',
            'release_date' => 'INTEGER',
            'created_at' => 'INTEGER NOT NULL',
            'updated_at' => 'INTEGER NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
