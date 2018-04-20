<?php

/**
 * This is the model class for table "mae_clien".
 *
 * The followings are the available columns in table 'mae_clien':
 * @property string $COD_CLIE
 * @property string $DES_CLIE
 * @property string $COD_ESTA
 * @property string $DIR_FISC
 * @property string $NRO_RUC
 * @property string $COD_DEPT
 * @property string $COD_PROV
 * @property string $COD_DIST
 * @property string $NRO_TEL1
 * @property string $NRO_TEL2
 * @property string $NRO_TEL3
 * @property string $DIR_WEB
 * @property string $DIR_EMA1
 * @property string $DIR_EMA2
 * @property string $DIR_EMA3
 * @property string $USU_DIGI
 * @property string $FEC_DIGI
 * @property string $USU_MODI
 * @property string $FEC_MODI
 *
 * The followings are the available model relations:
 * @property FacFactu[] $facFactus
 * @property MaeTiend[] $maeTiends
 */
class Cliente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mae_clien';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COD_CLIE', 'required'),
			array('COD_CLIE', 'length', 'max'=>6),
			array('DES_CLIE, DIR_FISC, DIR_WEB, DIR_EMA1, DIR_EMA2, DIR_EMA3', 'length', 'max'=>100),
			array('COD_ESTA', 'length', 'max'=>1),
			array('NRO_RUC', 'length', 'max'=>50),
			array('COD_DEPT, COD_PROV, COD_DIST', 'length', 'max'=>2),
			array('NRO_TEL1, NRO_TEL2, NRO_TEL3, USU_DIGI, USU_MODI', 'length', 'max'=>20),
			array('FEC_DIGI, FEC_MODI', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('COD_CLIE, DES_CLIE, COD_ESTA, DIR_FISC, NRO_RUC, COD_DEPT, COD_PROV, COD_DIST, NRO_TEL1, NRO_TEL2, NRO_TEL3, DIR_WEB, DIR_EMA1, DIR_EMA2, DIR_EMA3, USU_DIGI, FEC_DIGI, USU_MODI, FEC_MODI', 'safe', 'on'=>'search'),
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
			'facFactus' => array(self::HAS_MANY, 'FacFactu', 'COD_CLIE'),
			'maeTiends' => array(self::HAS_MANY, 'MaeTiend', 'COD_CLIE'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'COD_CLIE' => 'Cod Clie',
			'DES_CLIE' => 'Des Clie',
			'COD_ESTA' => 'Cod Esta',
			'DIR_FISC' => 'Dir Fisc',
			'NRO_RUC' => 'Nro Ruc',
			'COD_DEPT' => 'Cod Dept',
			'COD_PROV' => 'Cod Prov',
			'COD_DIST' => 'Cod Dist',
			'NRO_TEL1' => 'Nro Tel1',
			'NRO_TEL2' => 'Nro Tel2',
			'NRO_TEL3' => 'Nro Tel3',
			'DIR_WEB' => 'Dir Web',
			'DIR_EMA1' => 'Dir Ema1',
			'DIR_EMA2' => 'Dir Ema2',
			'DIR_EMA3' => 'Dir Ema3',
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

		$criteria->compare('COD_CLIE',$this->COD_CLIE,true);
		$criteria->compare('DES_CLIE',$this->DES_CLIE,true);
		$criteria->compare('COD_ESTA',$this->COD_ESTA,true);
		$criteria->compare('DIR_FISC',$this->DIR_FISC,true);
		$criteria->compare('NRO_RUC',$this->NRO_RUC,true);
		$criteria->compare('COD_DEPT',$this->COD_DEPT,true);
		$criteria->compare('COD_PROV',$this->COD_PROV,true);
		$criteria->compare('COD_DIST',$this->COD_DIST,true);
		$criteria->compare('NRO_TEL1',$this->NRO_TEL1,true);
		$criteria->compare('NRO_TEL2',$this->NRO_TEL2,true);
		$criteria->compare('NRO_TEL3',$this->NRO_TEL3,true);
		$criteria->compare('DIR_WEB',$this->DIR_WEB,true);
		$criteria->compare('DIR_EMA1',$this->DIR_EMA1,true);
		$criteria->compare('DIR_EMA2',$this->DIR_EMA2,true);
		$criteria->compare('DIR_EMA3',$this->DIR_EMA3,true);
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
	 * @return Cliente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
