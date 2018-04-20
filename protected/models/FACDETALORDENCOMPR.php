<?php

/**
 * This is the model class for table "FAC_DETAL_ORDEN_COMPR".
 *
 * The followings are the available columns in table 'FAC_DETAL_ORDEN_COMPR':
 * @property string $COD_CLIE
 * @property string $COD_TIEN
 * @property string $COD_ORDE
 * @property string $COD_PROD
 * @property integer $NRO_UNID
 * @property string $VAL_PREC
 * @property string $VAL_IGV
 * @property string $VAL_MONT_UNID
 * @property string $VAL_MONT_IGV
 * @property string $USU_DIGI
 * @property string $FEC_DIGI
 * @property string $USU_MODI
 * @property string $FEC_MODI
 * @property string $VAL_TOTAL
 *
 * The followings are the available model relations:
 * @property FACORDENCOMPR $cODCLIE
 * @property FACORDENCOMPR $cODTIEN
 * @property FACORDENCOMPR $cODORDE
 * @property MAEPRODU $cODPROD
 */
class FACDETALORDENCOMPR extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'fac_detal_orden_compr';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('COD_TIEN, COD_PROD', 'required'),
            array('NRO_UNID', 'numerical', 'integerOnly' => true),
            array('COD_CLIE, COD_TIEN', 'length', 'max' => 6),
            array('COD_ORDE, COD_PROD', 'length', 'max' => 12),
            array('VAL_PREC, VAL_MONT_UNID, VAL_MONT_IGV, VAL_TOTAL', 'length', 'max' => 10),
            array('VAL_IGV', 'length', 'max' => 5),
            array('USU_DIGI, USU_MODI', 'length', 'max' => 20),
            array('FEC_DIGI, FEC_MODI', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('COD_CLIE, COD_TIEN, COD_ORDE, COD_PROD, NRO_UNID, VAL_PREC, VAL_IGV, VAL_MONT_UNID, VAL_MONT_IGV, USU_DIGI, FEC_DIGI, USU_MODI, FEC_MODI, VAL_TOTAL', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'cODCLIE' => array(self::BELONGS_TO, 'FACORDENCOMPR', 'COD_CLIE'),
            'cODTIEN' => array(self::BELONGS_TO, 'FACORDENCOMPR', 'COD_TIEN'),
            'cODORDE' => array(self::BELONGS_TO, 'FACORDENCOMPR', 'COD_ORDE'),
            'cODPROD' => array(self::BELONGS_TO, 'MAEPRODU', 'COD_PROD'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'COD_CLIE' => 'Cod Clie',
            'COD_TIEN' => 'Cod Tien',
            'COD_ORDE' => 'Cod Orde',
            'COD_PROD' => 'Cod Prod',
            'NRO_UNID' => 'Nro Unid',
            'VAL_PREC' => 'Val Prec',
            'VAL_IGV' => 'Val Igv',
            'VAL_MONT_UNID' => 'Sub Total',
            'VAL_MONT_IGV' => 'IGV 0.18%',
            'USU_DIGI' => 'Usu Digi',
            'FEC_DIGI' => 'Fec Digi',
            'USU_MODI' => 'Usu Modi',
            'FEC_MODI' => 'Fec Modi',
            'VAL_TOTAL' => 'Total',
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


        $criteria->order = "FEC_MODI,NUM_ORDE desc";
        
        $criteria->compare('COD_CLIE', $this->COD_CLIE, true);
        $criteria->compare('COD_TIEN', $this->COD_TIEN, true);
        $criteria->compare('COD_ORDE', $this->COD_ORDE, true);
        $criteria->compare('COD_PROD', $this->COD_PROD, true);
        $criteria->compare('NRO_UNID', $this->NRO_UNID);
        $criteria->compare('VAL_PREC', $this->VAL_PREC, true);
        $criteria->compare('VAL_IGV', $this->VAL_IGV, true);
        $criteria->compare('VAL_MONT_UNID', $this->VAL_MONT_UNID, true);
        $criteria->compare('VAL_MONT_IGV', $this->VAL_MONT_IGV, true);
        $criteria->compare('USU_DIGI', $this->USU_DIGI, true);
        $criteria->compare('FEC_DIGI', $this->FEC_DIGI, true);
        $criteria->compare('USU_MODI', $this->USU_MODI, true);
        $criteria->compare('FEC_MODI', $this->FEC_MODI, true);
        $criteria->compare('VAL_TOTAL', $this->VAL_TOTAL, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FACDETALORDENCOMPR the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
