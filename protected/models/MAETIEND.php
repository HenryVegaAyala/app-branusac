<?php

/**
 * This is the model class for table "MAE_TIEND".
 *
 * The followings are the available columns in table 'MAE_TIEND':
 * @property string $COD_CLIE
 * @property string $COD_TIEN
 * @property string $DES_TIEN
 * @property string $DIR_TIEN
 * @property string $COD_ESTA
 * @property string $USU_DIGI
 * @property string $FEC_DIGI
 * @property string $USU_MODI
 * @property string $FEC_MODI
 *
 * The followings are the available model relations:
 * @property CROOPERATIEND[] $cROOPERATIENDs
 * @property CROOPERATIEND[] $cROOPERATIENDs1
 * @property FACORDENCOMPR[] $fACORDENCOMPRs
 * @property FACORDENCOMPR[] $fACORDENCOMPRs1
 * @property MAEPRODUTIEND[] $mAEPRODUTIENDs
 * @property MAEPRODUTIEND[] $mAEPRODUTIENDs1
 * @property MAECLIEN $cODCLIE
 */
class MAETIEND extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'mae_tiend';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('COD_CLIE, COD_TIEN', 'required'),
            array('COD_CLIE, COD_TIEN', 'length', 'max' => 6),
            array('DES_TIEN, DIR_TIEN', 'length', 'max' => 100),
            array('COD_ESTA', 'length', 'max' => 1),
            array('USU_DIGI, USU_MODI', 'length', 'max' => 20),
            array('FEC_DIGI, FEC_MODI', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('COD_CLIE, COD_TIEN, DES_TIEN, DIR_TIEN, COD_ESTA, USU_DIGI, FEC_DIGI, USU_MODI, FEC_MODI', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'cROOPERATIENDs' => array(self::HAS_MANY, 'CROOPERATIEND', 'COD_CLIE'),
            'cROOPERATIENDs1' => array(self::HAS_MANY, 'CROOPERATIEND', 'COD_TIEN'),
            'fACORDENCOMPRs' => array(self::HAS_MANY, 'FACORDENCOMPR', 'COD_CLIE'),
            'fACORDENCOMPRs1' => array(self::HAS_MANY, 'FACORDENCOMPR', 'COD_TIEN'),
            'mAEPRODUTIENDs' => array(self::HAS_MANY, 'MAEPRODUTIEND', 'COD_CLIE'),
            'mAEPRODUTIENDs1' => array(self::HAS_MANY, 'MAEPRODUTIEND', 'COD_TIEN'),
            'cODCLIE' => array(self::BELONGS_TO, 'MAECLIEN', 'COD_CLIE'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'COD_CLIE' => 'Cod Clie',
            'COD_TIEN' => 'Cod Tien',
            'DES_TIEN' => 'Des Tien',
            'DIR_TIEN' => 'Dir Tien',
            'COD_ESTA' => 'Cod Esta',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('COD_CLIE', $this->COD_CLIE, true);
        $criteria->compare('COD_TIEN', $this->COD_TIEN, true);
        $criteria->compare('DES_TIEN', $this->DES_TIEN, true);
        $criteria->compare('DIR_TIEN', $this->DIR_TIEN, true);
        $criteria->compare('COD_ESTA', $this->COD_ESTA, true);
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
     * @return MAETIEND the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
