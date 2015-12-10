<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m151210_200653_alter_realease_date_column
 */
class m151210_200653_alter_realease_date_column extends Migration
{
    CONST TABLE_NAME = 'books';

    public function safeUp()
    {
        $this->alterColumn(self::TABLE_NAME,'release_date','BIGINT');
    }

    public function safeDown()
    {
        $this->alterColumn(self::TABLE_NAME,'release_date','INTEGER');
    }
}
