<?php

/**
 * This is the model class for table "FAC_DETAL_FACTU".
 *
 * The followings are the available columns in table 'FAC_DETAL_FACTU':
 * @property string $COD_FACT
 * @property string $COD_PROD
 * @property string $UNI_SOLI
 * @property string $VAL_PROD
 * @property string $IMP_PROD
 * @property string $IGV_PROD
 * @property string $IMP_TOTA_PROD
 * @property string $USU_DIGI
 * @property string $FEC_DIGI
 * @property string $USU_MODI
 * @property string $FEC_MODI
 * @property string $FACT_DET
 *
 * The followings are the available model relations:
 * @property FACFACTU $cODFACT
 * @property MAEPRODU $cODPROD
 */
class FACDETALFACTU extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fac_detal_factu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COD_PROD', 'required'),
			array('COD_FACT, COD_PROD, UNI_SOLI, VAL_PROD, IMP_PROD, IGV_PROD, IMP_TOTA_PROD', 'length', 'max'=>12),
			array('USU_DIGI, USU_MODI', 'length', 'max'=>20),
			array('FEC_DIGI, FEC_MODI', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('COD_FACT, COD_PROD, UNI_SOLI, VAL_PROD, IMP_PROD, IGV_PROD, IMP_TOTA_PROD, USU_DIGI, FEC_DIGI, USU_MODI, FEC_MODI, FACT_DET', 'safe', 'on'=>'search'),
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
			'cODFACT' => array(self::BELONGS_TO, 'FACFACTU', 'COD_FACT'),
			'cODPROD' => array(self::BELONGS_TO, 'MAEPRODU', 'COD_PROD'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'COD_FACT' => 'Cod Fact',
			'COD_PROD' => 'Cod Prod',
			'UNI_SOLI' => 'Uni Soli',
			'VAL_PROD' => 'Val Prod',
			'IMP_PROD' => 'Imp Prod',
			'IGV_PROD' => 'Igv Prod',
			'IMP_TOTA_PROD' => 'Imp Tota Prod',
			'USU_DIGI' => 'Usu Digi',
			'FEC_DIGI' => 'Fec Digi',
			'USU_MODI' => 'Usu Modi',
			'FEC_MODI' => 'Fec Modi',
			'FACT_DET' => 'Fact Det',
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

		$criteria->compare('COD_FACT',$this->COD_FACT,true);
		$criteria->compare('COD_PROD',$this->COD_PROD,true);
		$criteria->compare('UNI_SOLI',$this->UNI_SOLI,true);
		$criteria->compare('VAL_PROD',$this->VAL_PROD,true);
		$criteria->compare('IMP_PROD',$this->IMP_PROD,true);
		$criteria->compare('IGV_PROD',$this->IGV_PROD,true);
		$criteria->compare('IMP_TOTA_PROD',$this->IMP_TOTA_PROD,true);
		$criteria->compare('USU_DIGI',$this->USU_DIGI,true);
		$criteria->compare('FEC_DIGI',$this->FEC_DIGI,true);
		$criteria->compare('USU_MODI',$this->USU_MODI,true);
		$criteria->compare('FEC_MODI',$this->FEC_MODI,true);
		$criteria->compare('FACT_DET',$this->FACT_DET,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FACDETALFACTU the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
