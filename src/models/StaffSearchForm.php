<?php

namespace app\models;

use app\query\StaffQuery;
use Yii;


class StaffSearchForm extends \yii\db\ActiveRecord
{
    public $query;

    public function rules()
    {
        return [
            [['query'], 'string'],
            [['query'], 'required']
        ];
    }
}
