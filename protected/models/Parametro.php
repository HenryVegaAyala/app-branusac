<?php

/**
 * This is the model class for table "bas_param".
 *
 * The followings are the available columns in table 'bas_param':
 * @property string $COD_PARA
 * @property string $VAL_PARA
 * @property string $DES_PARA
 * @property string $USU_DIGI
 * @property string $FEC_DIGI
 * @property string $USU_MODI
 * @property string $FEC_MODI
 */
class Parametro extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'bas_param';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('COD_PARA', 'required'),
            array('COD_PARA', 'length', 'max' => 2),
            array('DES_PARA', 'length', 'max' => 100),
            array('USU_DIGI, USU_MODI', 'length', 'max' => 20),
            array('VAL_PARA', 'length', 'max' => 2),
            array('FEC_DIGI, FEC_MODI', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('COD_PARA, VAL_PARA, DES_PARA, USU_DIGI, FEC_DIGI, USU_MODI, FEC_MODI', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'COD_PARA' => 'Cod Para',
            'VAL_PARA' => 'Valor Actual',
            'DES_PARA' => 'Descripción',
            'USU_DIGI' => 'Usu Digi',
            'FEC_DIGI' => 'Fec Digi',
            'USU_MODI' => 'Usuario Modificado',
            'FEC_MODI' => 'Fecha Modicada',
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

        $criteria = new CDbCriteria;

        $criteria->compare('COD_PARA', 1, true);
        $criteria->compare('VAL_PARA', $this->VAL_PARA, true);
        $criteria->compare('DES_PARA', $this->DES_PARA, true);
        $criteria->compare('USU_DIGI', $this->USU_DIGI, true);
        $criteria->compare('FEC_DIGI', $this->FEC_DIGI, true);
        $criteria->compare('USU_MODI', $this->USU_MODI, true);
        $criteria->compare('FEC_MODI', $this->FEC_MODI, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Parametro the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
