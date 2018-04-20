<?php

/**
 * This is the model class for table "fac_guia_remis".
 *
 * The followings are the available columns in table 'fac_guia_remis':
 * @property string $COD_GUIA
 * @property string $COD_ORDE
 * @property string $COD_TIEN
 * @property string $COD_CLIE
 * @property string $FEC_EMIS
 * @property string $DIR_PART
 * @property string $FEC_TRAS
 * @property string $COS_FLET
 * @property string $COD_EMPR_TRAN
 * @property string $COD_UNID_TRAN
 * @property string $COD_MOTI_TRAS
 * @property string $IND_ESTA
 * @property string $USU_DIGI
 * @property string $FEC_DIGI
 * @property string $USU_MODI
 * @property string $FEC_MODI
 *
 * The followings are the available model relations:
 * @property FacDetalGuiaRemis[] $facDetalGuiaRemises
 * @property FacFactu[] $facFactus
 * @property FacOrdenCompr $cODCLIE
 * @property FacOrdenCompr $cODTIEN
 * @property FacOrdenCompr $cODORDE
 */
class Guia extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'fac_guia_remis';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('COD_GUIA, COD_ORDE, COD_TIEN, COD_CLIE', 'required'),
            array('COD_GUIA, COD_ORDE', 'length', 'max' => 12),
            array('COD_TIEN, COD_CLIE', 'length', 'max' => 6),
            array('DIR_PART', 'length', 'max' => 100),
            array('COS_FLET', 'length', 'max' => 10),
            array('COD_EMPR_TRAN, COD_UNID_TRAN, COD_MOTI_TRAS', 'length', 'max' => 2),
            array('IND_ESTA', 'length', 'max' => 1),
            array('USU_DIGI, USU_MODI', 'length', 'max' => 20),
            array('FEC_EMIS, FEC_TRAS, FEC_DIGI, FEC_MODI', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('COD_GUIA, COD_ORDE, COD_TIEN, COD_CLIE, FEC_EMIS, DIR_PART, FEC_TRAS, COS_FLET, COD_EMPR_TRAN, COD_UNID_TRAN, COD_MOTI_TRAS, IND_ESTA, USU_DIGI, FEC_DIGI, USU_MODI, FEC_MODI', 'safe', 'on' => 'search'),
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
            'facDetalGuiaRemises' => array(self::HAS_MANY, 'FacDetalGuiaRemis', 'COD_GUIA'),
            'facFactus' => array(self::HAS_MANY, 'FacFactu', 'COD_GUIA'),
            'cODCLIE' => array(self::BELONGS_TO, 'FacOrdenCompr', 'COD_CLIE'),
            'cODTIEN' => array(self::BELONGS_TO, 'FacOrdenCompr', 'COD_TIEN'),
            'cODORDE' => array(self::BELONGS_TO, 'FacOrdenCompr', 'COD_ORDE'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'COD_GUIA' => 'N° Guia',
            'COD_ORDE' => 'N° O/C',
            'COD_TIEN' => 'Tienda',
            'COD_CLIE' => 'Cliente',
            'FEC_EMIS' => 'Fecha Envio',
            'DIR_PART' => 'Dir Part',
            'FEC_TRAS' => 'Fecha Transporte',
            'COS_FLET' => 'Cos Flet',
            'COD_EMPR_TRAN' => 'Cod Empr Tran',
            'COD_UNID_TRAN' => 'Cod Unid Tran',
            'COD_MOTI_TRAS' => 'Cod Moti Tras',
            'IND_ESTA' => 'Estado',
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

        if (strrpos($this->FEC_EMIS, "/") > 0) {
            $this->FEC_EMIS = substr($this->FEC_EMIS, 6, 4) . '-' . substr($this->FEC_EMIS, 3, 2) . '-' . substr($this->FEC_EMIS, 0, 2); //'2016-06-09' ;
        }

        $criteria->order = "COD_GUIA DESC";
        $criteria->compare('COD_GUIA', $this->COD_GUIA, true);
        $criteria->compare('COD_ORDE', $this->COD_ORDE, true);
        $criteria->compare('COD_TIEN', $this->COD_TIEN, true);
        $criteria->compare('COD_CLIE', $this->COD_CLIE, true);
        $criteria->compare('FEC_EMIS', $this->FEC_EMIS, true);
        $criteria->compare('DIR_PART', $this->DIR_PART, true);
        $criteria->compare('FEC_TRAS', $this->FEC_TRAS, true);
        $criteria->compare('COS_FLET', $this->COS_FLET, true);
        $criteria->compare('COD_EMPR_TRAN', $this->COD_EMPR_TRAN, true);
        $criteria->compare('COD_UNID_TRAN', $this->COD_UNID_TRAN, true);
        $criteria->compare('COD_MOTI_TRAS', $this->COD_MOTI_TRAS, true);
        $criteria->compare('IND_ESTA', $this->IND_ESTA, true);
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
     * @return Guia the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function ListaTiendaUpdate()
    {

        $Tienda = Cliente::model()->findAll();
        return CHtml::listData($Tienda, "COD_CLIE", "DES_CLIE");
    }

    public function Estado()
    {
        $model = array(
            array('IND_ESTA' => '1', 'value' => 'Emitida / Pendiente de cobro'),
            array('IND_ESTA' => '2', 'value' => 'Cobrada / Cerrada'),
            array('IND_ESTA' => '9', 'value' => 'Anulado'),
            array('IND_ESTA' => '0', 'value' => 'Creado'),
        );
        return cHtml::listData($model, 'IND_ESTA', 'value');
    }

    public function getOc($id)
    {

        $oc = Yii::app()->db->createCommand()
            ->select('f.NUM_ORDE')
            ->from('fac_guia_remis g')
            ->join('fac_orden_compr f', 'g.COD_ORDE = f.COD_ORDE')
            ->where("COD_GUIA = '" . $id . "';")
            ->queryScalar();

        return $oc;
    }

    public function GetGuia($id)
    {

        $Guia = Yii::app()->db->createCommand()
            ->select('NUM_ORDE')
            ->from('fac_orden_compr')
            ->where("COD_ORDE = '" . $id . "';")
            ->queryScalar();

        return $Guia;
    }

    public function GetTienda($tienda)
    {
        $out = Yii::app()->db->createCommand()
            ->select("DISTINCT concat(mc.DES_CLIE,' - ',mt.DES_TIEN)")
            ->from('mae_tiend mt')
            ->join('mae_clien mc', 'mt.COD_CLIE = mc.COD_CLIE')
            ->where("mc.COD_CLIE = '" . $tienda . "' AND mc.COD_ESTA ='1' AND  mt.COD_ESTA='1';")
            ->queryScalar();

        return $out;
    }

    public function GetCliente($Cliente)
    {
        $out = Yii::app()->db->createCommand()
            ->select('DES_CLIE')
            ->from('MAE_CLIEN')
            ->where("COD_CLIE = '" . $Cliente . "';")
            ->queryScalar();

        return $out;
    }

    public function GetFactura($Factura)
    {
        $out = Yii::app()->db->createCommand()
            ->select('COD_FACT')
            ->from('fac_factu')
            ->where("COD_GUIA = '" . $Factura . "';")
            ->queryScalar();

        return $out;
    }

    public function OrdenCompra()
    {

        $CODORDE = OC::model()->findAll();
        return CHtml::listData($CODORDE, "COD_ORDE", "NUM_ORDE");
    }

    public function ListaClienteUpdate()
    {

        $Cliente = Cliente::model()->findAll();
        return CHtml::listData($Cliente, "COD_CLIE", "DES_CLIE");
    }
}
