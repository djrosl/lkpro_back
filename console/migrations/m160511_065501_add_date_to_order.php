<?php

use yii\db\Migration;

/**
 * Handles adding date to table `order`.
 */
class m160511_065501_add_date_to_order extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('order', 'date', 'datetime');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        return true;
    }
}
