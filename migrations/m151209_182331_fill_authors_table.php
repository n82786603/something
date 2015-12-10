<?php

namespace {

    use m151209_182331_fill_authors_table\Mock\Authors;
    use m151209_182331_fill_authors_table\Mock\IAuthors;
    use yii\db\Migration;

    /**
     * Class m151209_182331_fill_authors_table
     */
    class m151209_182331_fill_authors_table extends Migration
    {
        CONST TABLE_NAME = 'authors';


        public function safeUp()
        {
            foreach ($this->getAuthorsMocks() as $mock) {
                $this->insert(self::TABLE_NAME, [
                    'first_name' => $mock->getFirstName(),
                    'last_name' => $mock->getLastName()
                ]);
            }
        }


        public function safeDown()
        {
            $this->truncateTable(self::TABLE_NAME);
        }


        /**
         * @return IAuthors[]
         */
        private function getAuthorsMocks()
        {
            return Authors::getAll();
        }
    }
}

namespace m151209_182331_fill_authors_table\Mock {

    /**
     * Interface IAuthors
     * @package m151209_182331_fill_authors_table\Mock
     */
    interface IAuthors
    {
        /**
         * @return string
         */
        public function getFirstName();

        /**
         * @return string
         */
        public function  getLastName();
    }

    /**
     * Class Authors
     * @package m151209_182331_fill_authors_table\Mock
     */
    class Authors implements IAuthors
    {

        protected $first_name = null;
        protected $last_name = null;


        /**
         * Authors constructor.
         * @param null $first_name
         * @param $last_name
         */
        public function __construct($first_name, $last_name)
        {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
        }


        /**
         * @return string
         */
        public function getFirstName()
        {
            return $this->first_name;
        }


        /**
         * @return string
         */
        public function  getLastName()
        {
            return $this->last_name;
        }


        /**
         * @return Authors[]
         */
        public static function getAll()
        {
            $result = [];
            foreach ([
                         [
                             'first_name' => 'Sir Arthur Charles',
                             'last_name' => 'Clarke'
                         ],
                         [
                             'first_name' => 'Raymond Douglas',
                             'last_name' => 'Bradbury'
                         ]
                     ] as $mock) {
                $result[] = new static($mock['first_name'], $mock['last_name']);
            }
            return $result;
        }
    }
}

