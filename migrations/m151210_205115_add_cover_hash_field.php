<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_205115_add_cover_hash_field extends Migration
{
    CONST TABLE_NAME = 'books';
    CONST COLUMN = 'preview_path_hash';

    /**
     *
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE_NAME, self::COLUMN, 'TEXT');
    }

    /**
     *
     */
    public function safeDown()
    {
        $this->dropColumn(self::TABLE_NAME, self::COLUMN);
    }
}

