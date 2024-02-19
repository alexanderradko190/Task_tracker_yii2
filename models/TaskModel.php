<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string|null $date_end
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TaskModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['date_end', 'created_at', 'updated_at', 'user_id'], 'safe'],
            [['name', 'description', 'status', 'story_point'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название задачи',
            'description' => 'Описание задачи',
            'date_end' => 'Дедлайн',
            'status' => 'Статус',
            'story_point' => 'Story point',
            'created_at' => 'Создана',
            'updated_at' => 'Updated At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
