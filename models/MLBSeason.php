<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mlbSeasons".
 *
 * @property string $id
 * @property string $GameID
 * @property string $season
 * @property string $status
 * @property string $day
 * @property string $DateTime
 * @property string $awayteam
 * @property string $hometeam
 * @property string $StadiumID
 */
class MLBSeason extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mlbSeasons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GameID', 'season', 'StadiumID'], 'integer'],
            [['DateTime'], 'safe'],
            [['day', 'status', 'awayteam', 'hometeam'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'GameID' => 'Game ID',
            'season' => 'Season',
            'status' => 'Status',
            'day' => 'Day',
            'DateTime' => 'Date Time',
            'awayteam' => 'Awayteam',
            'hometeam' => 'Hometeam',
            'StadiumID' => 'Stadium ID',
        ];
    }
}
