<?php

/**
 * This is the model class for table "seg_usuar".
 *
 * The followings are the available columns in table 'seg_usuar':
 * @property string $COD_USUA
 * @property string $COD_LOCA
 * @property string $NOM_USUA
 * @property string $APE_USUA
 * @property string $USE_USUA
 * @property string $PAS_USUA
 * @property string $EMA_USUA
 * @property string $EST_USUA
 * @property string $FEC_ULTI_INGR
 * @property string $FEC_ULTI_MODI_PASS
 * @property string $VAL_INTE_FALL_PASS
 * @property string $USU_DIGI
 * @property string $FEC_DIGI
 * @property string $USU_MODI
 * @property string $FEC_MODI
 * @property string $VAL_IP
 * @property string $IND_ACCE
 */
class Usuario extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'seg_usuar';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('COD_LOCA', 'length', 'max' => 2),
            array('NOM_USUA, APE_USUA', 'length', 'max' => 60),
            array('USE_USUA, USU_DIGI, USU_MODI', 'length', 'max' => 20),
            array('PAS_USUA, EMA_USUA', 'length', 'max' => 50),
            array('EST_USUA, VAL_INTE_FALL_PASS, IND_ACCE', 'length', 'max' => 1),
            array('VAL_IP', 'length', 'max' => 15),
            array('FEC_ULTI_INGR, FEC_ULTI_MODI_PASS, FEC_DIGI, FEC_MODI', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'COD_USUA, COD_LOCA, NOM_USUA, APE_USUA, USE_USUA, PAS_USUA, EMA_USUA, EST_USUA, FEC_ULTI_INGR, FEC_ULTI_MODI_PASS, VAL_INTE_FALL_PASS, USU_DIGI, FEC_DIGI, USU_MODI, FEC_MODI, VAL_IP, IND_ACCE',
                'safe',
                'on' => 'search'
            ),
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
            'COD_USUA' => 'Cod Usua',
            'COD_LOCA' => 'Cod Loca',
            'NOM_USUA' => 'Nom Usua',
            'APE_USUA' => 'Ape Usua',
            'USE_USUA' => 'Use Usua',
            'PAS_USUA' => 'Pas Usua',
            'EMA_USUA' => 'Ema Usua',
            'EST_USUA' => 'Est Usua',
            'FEC_ULTI_INGR' => 'Fec Ulti Ingr',
            'FEC_ULTI_MODI_PASS' => 'Fec Ulti Modi Pass',
            'VAL_INTE_FALL_PASS' => 'Val Inte Fall Pass',
            'USU_DIGI' => 'Usu Digi',
            'FEC_DIGI' => 'Fec Digi',
            'USU_MODI' => 'Usu Modi',
            'FEC_MODI' => 'Fec Modi',
            'VAL_IP' => 'Val Ip',
            'IND_ACCE' => 'Ind Acce',
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

        $criteria->compare('COD_USUA', $this->COD_USUA, true);
        $criteria->compare('COD_LOCA', $this->COD_LOCA, true);
        $criteria->compare('NOM_USUA', $this->NOM_USUA, true);
        $criteria->compare('APE_USUA', $this->APE_USUA, true);
        $criteria->compare('USE_USUA', $this->USE_USUA, true);
        $criteria->compare('PAS_USUA', $this->PAS_USUA, true);
        $criteria->compare('EMA_USUA', $this->EMA_USUA, true);
        $criteria->compare('EST_USUA', $this->EST_USUA, true);
        $criteria->compare('FEC_ULTI_INGR', $this->FEC_ULTI_INGR, true);
        $criteria->compare('FEC_ULTI_MODI_PASS', $this->FEC_ULTI_MODI_PASS, true);
        $criteria->compare('VAL_INTE_FALL_PASS', $this->VAL_INTE_FALL_PASS, true);
        $criteria->compare('USU_DIGI', $this->USU_DIGI, true);
        $criteria->compare('FEC_DIGI', $this->FEC_DIGI, true);
        $criteria->compare('USU_MODI', $this->USU_MODI, true);
        $criteria->compare('FEC_MODI', $this->FEC_MODI, true);
        $criteria->compare('VAL_IP', $this->VAL_IP, true);
        $criteria->compare('IND_ACCE', $this->IND_ACCE, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Usuario the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
