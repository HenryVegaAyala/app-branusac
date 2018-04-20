<?php

/**
 * This is the model class for table "fac_orden_compr".
 *
 * The followings are the available columns in table 'fac_orden_compr':
 * @property string $COD_CLIE
 * @property string $COD_TIEN
 * @property string $COD_ORDE
 * @property string $NUM_ORDE
 * @property string $IND_TIPO
 * @property string $TIP_MONE
 * @property string $TOT_UNID_SOLI
 * @property string $TOT_MONT_ORDE
 * @property string $TOT_MONT_IGV
 * @property string $TOT_FACT
 * @property string $FEC_PAGO
 * @property string $IND_ESTA
 * @property string $FEC_INGR
 * @property string $FEC_ENVI
 * @property string $FEC_ANUL
 * @property string $USU_DIGI
 * @property string $FEC_DIGI
 * @property string $USU_MODI
 * @property string $FEC_MODI
 *
 * The followings are the available model relations:
 * @property FacDetalOrdenCompr[] $facDetalOrdenComprs
 * @property FacDetalOrdenCompr[] $facDetalOrdenComprs1
 * @property FacDetalOrdenCompr[] $facDetalOrdenComprs2
 * @property FacGuiaRemis[] $facGuiaRemises
 * @property FacGuiaRemis[] $facGuiaRemises1
 * @property FacGuiaRemis[] $facGuiaRemises2
 * @property MaeTiend $cODCLIE
 * @property MaeTiend $cODTIEN
 */
class OC extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'fac_orden_compr';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NUM_ORDE', 'required'),
            array('FEC_INGR', 'required'),
            array('FEC_ENVI', 'required'),
//            array('NUM_ORDE', 'Validacion'),
            array('COD_ORDE', 'unique'),
            array('NUM_ORDE', 'numerical', 'integerOnly' => true),
            array('COD_CLIE, COD_TIEN, COD_ORDE', 'required'),
            array('COD_CLIE, COD_TIEN', 'length', 'max' => 6),
            array('COD_ORDE, NUM_ORDE', 'length', 'max' => 12),
            array('IND_TIPO, TIP_MONE, IND_ESTA', 'length', 'max' => 1),
            array('TOT_UNID_SOLI, TOT_MONT_ORDE, TOT_MONT_IGV, TOT_FACT', 'length', 'max' => 10),
            array('USU_DIGI, USU_MODI', 'length', 'max' => 20),
            array('FEC_PAGO, FEC_INGR, FEC_ENVI, FEC_ANUL, FEC_DIGI, FEC_MODI', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('COD_CLIE, COD_TIEN, COD_ORDE, NUM_ORDE, IND_TIPO, TIP_MONE, TOT_UNID_SOLI, TOT_MONT_ORDE, TOT_MONT_IGV, TOT_FACT, FEC_PAGO, IND_ESTA, FEC_INGR, FEC_ENVI, FEC_ANUL, USU_DIGI, FEC_DIGI, USU_MODI, FEC_MODI', 'safe', 'on' => 'search'),
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
            'facDetalOrdenComprs' => array(self::HAS_MANY, 'FacDetalOrdenCompr', 'COD_CLIE'),
            'facDetalOrdenComprs1' => array(self::HAS_MANY, 'FacDetalOrdenCompr', 'COD_TIEN'),
            'facDetalOrdenComprs2' => array(self::HAS_MANY, 'FacDetalOrdenCompr', 'COD_ORDE'),
            'facGuiaRemises' => array(self::HAS_MANY, 'FacGuiaRemis', 'COD_CLIE'),
            'facGuiaRemises1' => array(self::HAS_MANY, 'FacGuiaRemis', 'COD_TIEN'),
            'facGuiaRemises2' => array(self::HAS_MANY, 'FacGuiaRemis', 'COD_ORDE'),
            'cODCLIE' => array(self::BELONGS_TO, 'MaeTiend', 'COD_CLIE'),
            'cODTIEN' => array(self::BELONGS_TO, 'MaeTiend', 'COD_TIEN'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'COD_CLIE' => 'Cliente',
            'COD_TIEN' => 'Tienda',
            'COD_ORDE' => 'Código de Orden',
            'NUM_ORDE' => 'N° de Orden',
            'IND_TIPO' => 'Ind Tipo',
            'TIP_MONE' => 'Moneda',
            'TOT_UNID_SOLI' => 'Tot Unid Soli',
            'TOT_MONT_ORDE' => 'Sub-Total',
            'TOT_MONT_IGV' => 'I.G.V ' . $this->ValorActualIGV(),
            'TOT_FACT' => 'Total',
            'FEC_PAGO' => 'Fec Pago',
            'IND_ESTA' => 'Estado',
            'FEC_INGR' => 'Fecha de Ingreso',
            'FEC_ENVI' => 'Fecha de Envio',
            'FEC_ANUL' => 'Fec Anul',
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

        $criteria = new CDbCriteria;

        if (strrpos($this->FEC_ENVI, "/") > 0) {
            $this->FEC_ENVI = substr($this->FEC_ENVI, 6, 4) . '-' . substr($this->FEC_ENVI, 3, 2) . '-' . substr($this->FEC_ENVI, 0, 2); //'2016-06-09' ;
        }

        if (strrpos($this->FEC_INGR, "/") > 0) {
            $this->FEC_INGR = substr($this->FEC_INGR, 6, 4) . '-' . substr($this->FEC_INGR, 3, 2) . '-' . substr($this->FEC_INGR, 0, 2); //'2016-06-09' ;
        }

        $criteria->order = "FEC_DIGI DESC";

        $criteria->compare('COD_CLIE', $this->COD_CLIE, true);
        $criteria->compare('COD_TIEN', $this->COD_TIEN, true);
        $criteria->compare('COD_ORDE', $this->COD_ORDE, true);
        $criteria->compare('NUM_ORDE', $this->NUM_ORDE, true);
        $criteria->compare('IND_TIPO', $this->IND_TIPO, true);
        $criteria->compare('TIP_MONE', $this->TIP_MONE, true);
        $criteria->compare('TOT_UNID_SOLI', $this->TOT_UNID_SOLI, true);
        $criteria->compare('TOT_MONT_ORDE', $this->TOT_MONT_ORDE, true);
        $criteria->compare('TOT_MONT_IGV', $this->TOT_MONT_IGV, true);
        $criteria->compare('TOT_FACT', $this->TOT_FACT, true);
        $criteria->compare('FEC_PAGO', $this->FEC_PAGO, true);
        $criteria->compare('IND_ESTA', $this->IND_ESTA, true);
        $criteria->compare('FEC_INGR', $this->FEC_INGR, true);
        $criteria->compare('FEC_ENVI', $this->FEC_ENVI, true);
        $criteria->compare('FEC_ANUL', $this->FEC_ANUL, true);
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
     * @return OC the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    private function ValorActualIGV()
    {

        $Valor = Yii::app()->db->createCommand()
            ->select('VAL_PARA')
            ->from('bas_param')
            ->queryScalar();

        $IGV = ($Valor . '%');

        return $IGV;
    }

    public function ListaCliente()
    {
        $Cliente = Cliente::model()->findAll("COD_ESTA=?", array(1));
        return CHtml::listData($Cliente, "COD_CLIE", "DES_CLIE");
    }

    public function Moneda()
    {
        $model = array(
            array('TIP_MONE' => '0', 'value' => 'PE – Nuevo Soles'),
            array('TIP_MONE' => '1', 'value' => 'US –Dólares Americanos'),
        );
        return cHtml::listData($model, 'TIP_MONE', 'value');
    }

    public function Estado()
    {
        $model = array(
            array('IND_ESTA' => '1', 'value' => 'En Proceso'),
            array('IND_ESTA' => '2', 'value' => 'Despachadado/Atendido'),
            array('IND_ESTA' => '9', 'value' => 'Anulado'),
            array('IND_ESTA' => '0', 'value' => 'Creado'),
        );
        return cHtml::listData($model, 'IND_ESTA', 'value');
    }

    public function ListaTienda($defaultTienda)
    {

        $Tienda = Tienda::model()->findAll("COD_ESTA=? AND COD_CLIE=?", array(1, $defaultTienda));
        return CHtml::listData($Tienda, "COD_TIEN", "DES_TIEN");
    }

    public function getFactura($id)
    {

        $Factura = Yii::app()->db->createCommand()
            ->select('COD_FACT')
            ->from('fac_factu F , fac_guia_remis x')
            ->where("F.COD_GUIA = x.COD_GUIA and x.COD_ORDE = '" . $id . "' and F.IND_ESTA <> '9' and x.IND_ESTA <> '9';")
            ->queryScalar();

        return $Factura;
    }

    public function getGuia($id)
    {

        $Guia = Yii::app()->db->createCommand()
            ->select('COD_GUIA')
            ->from('fac_guia_remis')
            ->where("COD_ORDE = '" . $id . "' and IND_ESTA <> '9';")
            ->queryScalar();

        return $Guia;
    }

    public function getTienda($id)
    {

        $Tienda = Yii::app()->db->createCommand()
            ->select('DES_TIEN')
            ->from('mae_tiend')
            ->where("COD_TIEN = '" . $id . "';")
            ->queryScalar();

        return $Tienda;
    }

    public function getCliente($id)
    {

        $Tienda = Yii::app()->db->createCommand()
            ->select('DES_CLIE')
            ->from('mae_clien')
            ->where("COD_CLIE = '" . $id . "';")
            ->queryScalar();

        return $Tienda;
    }

    public function au()
    {
        $max = Yii::app()->db->createCommand()
            ->select('max(COD_ORDE) as max')
            ->from('fac_orden_compr')
            ->queryScalar();

        $id = ($max + 1);

        return $id;
    }

    public function VistaTienda()
    {
        $models = Tienda::model()->findAll();
        $list = CHtml::listData($models, 'COD_TIEN', 'DES_TIEN');
        return ($list);
    }

    public function VistaCliente()
    {
        $models = Cliente::model()->findAll();
        $list = CHtml::listData($models, 'COD_CLIE', 'DES_CLIE');
        return ($list);
    }

    public function getOC($id)
    {

        $OC = Yii::app()->db->createCommand()
            ->select('NUM_ORDE')
            ->from('fac_orden_compr')
            ->where("COD_ORDE = '" . $id . "' and IND_ESTA <> '9';")
            ->queryScalar();

        return $OC;
    }


}