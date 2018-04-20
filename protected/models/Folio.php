<?php

/**
 * This is the model class for table "folio".
 *
 * The followings are the available columns in table 'folio':
 * @property integer $VAL_INI
 * @property integer $VAL_FIN
 * @property integer $VAL_ACTU
 * @property string $VAL_LLAVE
 * @property string $DESCRIPCION
 * @property string $FECHA
 * @property string $VALOR
 * @property string $USUARIO
 */
class Folio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'folio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('VAL_FIN', 'required'),
			array('VAL_INI, VAL_FIN, VAL_ACTU', 'numerical', 'integerOnly'=>true),
			array('VAL_LLAVE', 'length', 'max'=>255),
			array('DESCRIPCION, USUARIO', 'length', 'max'=>100),
			array('VALOR', 'length', 'max'=>1),
			array('FECHA', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('VAL_INI, VAL_FIN, VAL_ACTU, VAL_LLAVE, DESCRIPCION, FECHA, VALOR, USUARIO', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'VAL_INI' => 'Val Ini',
			'VAL_FIN' => 'Val Fin',
			'VAL_ACTU' => 'Valor Actual',
			'VAL_LLAVE' => 'Val Llave',
			'DESCRIPCION' => 'Descripcion',
			'FECHA' => 'Fecha',
			'VALOR' => 'Valor',
			'USUARIO' => 'Usuario',
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

		$criteria->compare('VAL_INI',$this->VAL_INI);
		$criteria->compare('VAL_FIN',$this->VAL_FIN);
		$criteria->compare('VAL_ACTU',$this->VAL_ACTU);
		$criteria->compare('VAL_LLAVE',$this->VAL_LLAVE,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('FECHA',$this->FECHA,true);
		$criteria->compare('VALOR',$this->VALOR,true);
		$criteria->compare('USUARIO',$this->USUARIO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Folio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
