<?php

namespace app\models;

use app\query\StaffQuery;
use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string|null $staffName
 * @property string|null $staffPosition
 * @property string|null $staffSpecialization
 * @property string|null $age
 * @property string|null $imageFile
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['staffName', 'staffPosition', 'staffSpecialization', 'age'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'staffName' => 'Staff Name',
            'staffPosition' => 'Staff Position',
            'staffSpecialization' => 'Staff Specialization',
            'age' => 'Age',
        ];
    }
    /**
     * {@inheritdoc}
     * @return StaffQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffQuery(static::class);
    }
}
