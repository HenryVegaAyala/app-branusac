<?php

/**
 * This is the model class for table "MAE_LINEA_PRODU".
 *
 * The followings are the available columns in table 'MAE_LINEA_PRODU':
 * @property string $COD_LINE
 * @property string $DES_LARG
 * @property string $DES_CORT
 * @property string $USU_DIGI
 * @property string $FEC_DIGI
 * @property string $USU_MODI
 * @property string $FEC_MODI
 *
 * The followings are the available model relations:
 * @property MAEPRODU[] $mAEPRODUs
 * @property TEMPMAEPRODU[] $tEMPMAEPRODUs
 */
class MAELINEAPRODU extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mae_linea_produ';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COD_LINE', 'required'),
			array('COD_LINE', 'length', 'max'=>2),
			array('DES_LARG, DES_CORT', 'length', 'max'=>100),
			array('USU_DIGI, USU_MODI', 'length', 'max'=>20),
			array('FEC_DIGI, FEC_MODI', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('COD_LINE, DES_LARG, DES_CORT, USU_DIGI, FEC_DIGI, USU_MODI, FEC_MODI', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'mAEPRODUs' => array(self::HAS_MANY, 'MAEPRODU', 'COD_LINE'),
			'tEMPMAEPRODUs' => array(self::HAS_MANY, 'TEMPMAEPRODU', 'COD_LINE'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'COD_LINE' => 'Cod Line',
			'DES_LARG' => 'Des Larg',
			'DES_CORT' => 'Des Cort',
			'USU_DIGI' => 'Usu Digi',
			'FEC_DIGI' => 'Fec Digi',
			'USU_MODI' => 'Usu Modi',
			'FEC_MODI' => 'Fec Modi',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('COD_LINE',$this->COD_LINE,true);
		$criteria->compare('DES_LARG',$this->DES_LARG,true);
		$criteria->compare('DES_CORT',$this->DES_CORT,true);
		$criteria->compare('USU_DIGI',$this->USU_DIGI,true);
		$criteria->compare('FEC_DIGI',$this->FEC_DIGI,true);
		$criteria->compare('USU_MODI',$this->USU_MODI,true);
		$criteria->compare('FEC_MODI',$this->FEC_MODI,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MAELINEAPRODU the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
