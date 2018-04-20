<?php

/**
 * This is the model class for table "MAE_PRODU".
 *
 * The followings are the available columns in table 'MAE_PRODU':
 * @property string $COD_PROD
 * @property string $COD_LINE
 * @property string $DES_LARG
 * @property string $DES_CORT
 * @property string $COD_ESTA
 * @property string $COD_MEDI
 * @property integer $VAL_PESO
 * @property string $VAL_PROD
 * @property integer $VAL_CONV
 * @property string $VAL_PORC
 * @property string $VAL_COST
 * @property integer $VAL_REPO
 * @property integer $COD_LOTE
 * @property string $USU_DIGI
 * @property string $FEC_DIGI
 * @property string $USU_MODI
 * @property string $FEC_MODI
 *
 * The followings are the available model relations:
 * @property FACDETALFACTU[] $fACDETALFACTUs
 * @property FACDETALGUIAREMIS[] $fACDETALGUIAREMISes
 * @property FACDETALORDENCOMPR[] $fACDETALORDENCOMPRs
 * @property MAELINEAPRODU $cODLINE
 * @property MAEPRODUTIEND[] $mAEPRODUTIENDs
 */
class MAEPRODU extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'mae_produ';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('COD_PROD, COD_LINE', 'required'),
            array('VAL_PESO, VAL_CONV, VAL_REPO, COD_LOTE', 'numerical', 'integerOnly' => true),
            array('COD_PROD, VAL_PROD, VAL_PORC, VAL_COST', 'length', 'max' => 12),
            array('COD_LINE', 'length', 'max' => 2),
            array('DES_LARG, DES_CORT', 'length', 'max' => 100),
            array('COD_ESTA, COD_MEDI', 'length', 'max' => 1),
            array('USU_DIGI, USU_MODI', 'length', 'max' => 20),
            array('FEC_DIGI, FEC_MODI', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('COD_PROD, COD_LINE, DES_LARG, DES_CORT, COD_ESTA, COD_MEDI, VAL_PESO, VAL_PROD, VAL_CONV, VAL_PORC, VAL_COST, VAL_REPO, COD_LOTE, USU_DIGI, FEC_DIGI, USU_MODI, FEC_MODI', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'fACDETALFACTUs' => array(self::HAS_MANY, 'FACDETALFACTU', 'COD_PROD'),
            'fACDETALGUIAREMISes' => array(self::HAS_MANY, 'FACDETALGUIAREMIS', 'COD_PROD'),
            'fACDETALORDENCOMPRs' => array(self::HAS_MANY, 'FACDETALORDENCOMPR', 'COD_PROD'),
            'cODLINE' => array(self::BELONGS_TO, 'MAELINEAPRODU', 'COD_LINE'),
            'mAEPRODUTIENDs' => array(self::HAS_MANY, 'MAEPRODUTIEND', 'COD_PROD'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'COD_PROD' => 'Codigo Producto',
            'COD_LINE' => 'Codigo Linea',
            'DES_LARG' => 'Descripción',
            'DES_CORT' => 'Des Cort',
            'COD_ESTA' => 'Estado',
            'COD_MEDI' => 'Medida',
            'VAL_PESO' => 'Val Peso',
            'VAL_PROD' => 'Val Prod',
            'VAL_CONV' => 'Val Conv',
            'VAL_PORC' => 'Val Porc',
            'VAL_COST' => 'Costo',
            'VAL_REPO' => 'Val Repo',
            'COD_LOTE' => 'Cod Lote',
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

        $criteria->compare('COD_PROD', $this->COD_PROD, true);
        $criteria->compare('COD_LINE', $this->COD_LINE, true);
        $criteria->compare('DES_LARG', $this->DES_LARG, true);
        $criteria->compare('DES_CORT', $this->DES_CORT, true);
        $criteria->compare('COD_ESTA', $this->COD_ESTA, true);
        $criteria->compare('COD_MEDI', $this->COD_MEDI, true);
        $criteria->compare('VAL_PESO', $this->VAL_PESO);
        $criteria->compare('VAL_PROD', $this->VAL_PROD, true);
        $criteria->compare('VAL_CONV', $this->VAL_CONV);
        $criteria->compare('VAL_PORC', $this->VAL_PORC, true);
        $criteria->compare('VAL_COST', $this->VAL_COST, true);
        $criteria->compare('VAL_REPO', $this->VAL_REPO);
        $criteria->compare('COD_LOTE', $this->COD_LOTE);
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
     * @return MAEPRODU the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
