<?php

namespace app\query;

use app\models\Staff;

/**
 * This is the ActiveQuery class for [[\app\models\User]].
 *
 * @see \app\models\Staff
 */
class StaffQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return \app\models\Staff[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Staff|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}

