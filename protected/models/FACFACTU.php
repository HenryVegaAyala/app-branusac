<?php

/**
 * This is the model class for table "FAC_FACTU".
 *
 * The followings are the available columns in table 'FAC_FACTU':
 * @property string $COD_FACT
 * @property string $COD_CLIE
 * @property string $COD_GUIA
 * @property string $FEC_FACT
 * @property string $FEC_PAGO
 * @property string $IND_ESTA
 * @property string $VAL_IGV
 * @property string $TOT_UNID_FACT
 * @property string $TOT_FACT_SIN_IGV
 * @property string $TOT_IGV
 * @property string $TOT_FACT
 * @property string $USU_DIGI
 * @property string $FEC_DIGI
 * @property string $USU_MODI
 * @property string $FEC_MODI
 *
 * The followings are the available model relations:
 * @property FACDETALFACTU[] $fACDETALFACTUs
 * @property FACGUIAREMIS $cODGUIA
 * @property MAECLIEN $cODCLIE
 */
class FACFACTU extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'fac_factu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('COD_FACT, COD_CLIE, COD_GUIA', 'required'),
            array('COD_FACT, COD_GUIA, TOT_UNID_FACT, TOT_FACT_SIN_IGV, TOT_IGV, TOT_FACT', 'length', 'max' => 12),
            array('COD_CLIE', 'length', 'max' => 6),
            array('IND_ESTA', 'length', 'max' => 1),
            array('VAL_IGV', 'length', 'max' => 5),
            array('USU_DIGI, USU_MODI', 'length', 'max' => 20),
            array('FEC_FACT, FEC_PAGO, FEC_DIGI, FEC_MODI', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('COD_FACT, COD_CLIE, COD_GUIA, FEC_FACT, FEC_PAGO, IND_ESTA, VAL_IGV, TOT_UNID_FACT, TOT_FACT_SIN_IGV, TOT_IGV, TOT_FACT, USU_DIGI, FEC_DIGI, USU_MODI, FEC_MODI', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'fACDETALFACTUs' => array(self::HAS_MANY, 'FACDETALFACTU', 'COD_FACT'),
            'cODGUIA' => array(self::BELONGS_TO, 'FACGUIAREMIS', 'COD_GUIA'),
            'cODCLIE' => array(self::BELONGS_TO, 'MAECLIEN', 'COD_CLIE'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'COD_FACT' => 'N° de Factura',
            'COD_CLIE' => 'Cliente',
            'COD_GUIA' => 'N° de Guia',
            'FEC_FACT' => 'Fecha de Factura',
            'FEC_PAGO' => 'Fecha de Pago',
            'IND_ESTA' => 'Estado',
            'VAL_IGV' => 'Val Igv',
            'TOT_UNID_FACT' => 'Tot Unid Fact',
            'TOT_FACT_SIN_IGV' => 'Sub Total',
            'TOT_IGV' => 'IGV',
            'TOT_FACT' => 'Total',
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

        if (strrpos($this->FEC_FACT, "/") > 0) {
            $this->FEC_FACT = substr($this->FEC_FACT, 6, 4) . '-' . substr($this->FEC_FACT, 3, 2) . '-' . substr($this->FEC_FACT, 0, 2); //'2016-06-09' ;
        }

        if (strrpos($this->FEC_PAGO, "/") > 0) {
            $this->FEC_PAGO = substr($this->FEC_PAGO, 6, 4) . '-' . substr($this->FEC_PAGO, 3, 2) . '-' . substr($this->FEC_PAGO, 0, 2); //'2016-06-09' ;
        }

        $criteria->order = "COD_FACT DESC";
        $criteria->compare('COD_FACT', $this->COD_FACT, true);
        $criteria->compare('COD_CLIE', $this->COD_CLIE, true);
        $criteria->compare('COD_GUIA', $this->COD_GUIA, true);
        $criteria->compare('FEC_FACT', $this->FEC_FACT, true);
        $criteria->compare('FEC_PAGO', $this->FEC_PAGO, true);
        $criteria->compare('IND_ESTA', $this->IND_ESTA, true);
        $criteria->compare('VAL_IGV', $this->VAL_IGV, true);
        $criteria->compare('TOT_UNID_FACT', $this->TOT_UNID_FACT, true);
        $criteria->compare('TOT_FACT_SIN_IGV', $this->TOT_FACT_SIN_IGV, true);
        $criteria->compare('TOT_IGV', $this->TOT_IGV, true);
        $criteria->compare('TOT_FACT', $this->TOT_FACT, true);
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
     * @return FACFACTU the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function Estado() {
        $model = array(
            array('IND_ESTA' => '1', 'value' => 'Emitida/Pendiente de Cobro'),
            array('IND_ESTA' => '2', 'value' => 'Cobrada/Cerrada'),
            array('IND_ESTA' => '9', 'value' => 'Anulado'),
            array('IND_ESTA' => '0', 'value' => 'Creado'),
        );
        return cHtml::listData($model, 'IND_ESTA', 'value');
    }

    public function ListaCliente() {

        $Cliente = MAECLIEN::model()->findAll("COD_ESTA=?", array(1));
        return CHtml::listData($Cliente, "COD_CLIE", "DES_CLIE");
    }

    public function getCliente($var) {

        $max = Yii::app()->db->createCommand()
                ->select('DES_CLIE')
                ->from('mae_clien')
                ->where("COD_CLIE = '" . $var . "';")
                ->queryScalar();

        $id = ($max);
        return $id;
    }

    public function getOC($id) {

        $Factura = Yii::app()->db->createCommand()
                ->select('NUM_ORDE')
                ->from('fac_factu F , fac_guia_remis x , fac_orden_compr y')
                ->where("F.COD_GUIA = x.COD_GUIA and F.COD_FACT  =  '" . $id . "' and x.COD_ORDE = y.COD_ORDE 
                    ;")
                ->queryScalar();

        return $Factura;
    }

}
