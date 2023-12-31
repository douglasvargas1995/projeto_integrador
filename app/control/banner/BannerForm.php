<?php

class BannerForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'microerp';
    private static $activeRecord = 'Banner';
    private static $primaryKey = 'id';
    private static $formName = 'form_BannerForm';

    use Adianti\Base\AdiantiFileSaveTrait;
    use BuilderMasterDetailFieldListTrait;

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.70, null);
        parent::setTitle("Cadastro de banner");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de banner");


        $id = new TEntry('id');
        $foto = new TImageCropper('foto');
        $status = new TRadioGroup('status');
        $pessoa_id = new TDBCombo('pessoa_id', 'microerp', 'Pessoa', 'id', '{nome}','nome asc'  );
        $descricao = new TEntry('descricao');
        $longitude = new TEntry('longitude');
        $latitude = new TEntry('latitude');
        $lat_lng = new MyMap('lat_lng');
        $item_banner_postagem_banner_id = new THidden('item_banner_postagem_banner_id[]');
        $item_banner_postagem_banner___row__id = new THidden('item_banner_postagem_banner___row__id[]');
        $item_banner_postagem_banner___row__data = new THidden('item_banner_postagem_banner___row__data[]');
        $item_banner_postagem_banner_tipo_postagem_id = new TDBCombo('item_banner_postagem_banner_tipo_postagem_id[]', 'microerp', 'TipoPostagem', 'id', '{descricao}','id asc'  );
        $item_banner_postagem_banner_data_inicio = new TDateTime('item_banner_postagem_banner_data_inicio[]');
        $item_banner_postagem_banner_data_fim = new TDateTime('item_banner_postagem_banner_data_fim[]');
        $item_banner_postagem_banner_valor = new TNumeric('item_banner_postagem_banner_valor[]', '2', ',', '.' );
        $this->fieldList_6502521f54c1e = new TFieldList();
        $obs = new TText('obs');

        $this->fieldList_6502521f54c1e->addField(null, $item_banner_postagem_banner_id, []);
        $this->fieldList_6502521f54c1e->addField(null, $item_banner_postagem_banner___row__id, ['uniqid' => true]);
        $this->fieldList_6502521f54c1e->addField(null, $item_banner_postagem_banner___row__data, []);
        $this->fieldList_6502521f54c1e->addField(new TLabel("Tipo", null, '14px', null), $item_banner_postagem_banner_tipo_postagem_id, ['width' => '25%']);
        $this->fieldList_6502521f54c1e->addField(new TLabel("Data início", null, '14px', null), $item_banner_postagem_banner_data_inicio, ['width' => '25%']);
        $this->fieldList_6502521f54c1e->addField(new TLabel("Data fim", null, '14px', null), $item_banner_postagem_banner_data_fim, ['width' => '25%']);
        $this->fieldList_6502521f54c1e->addField(new TLabel("Valor", null, '14px', null), $item_banner_postagem_banner_valor, ['width' => '25%']);

        $this->fieldList_6502521f54c1e->width = '100%';
        $this->fieldList_6502521f54c1e->setFieldPrefix('item_banner_postagem_banner');
        $this->fieldList_6502521f54c1e->name = 'fieldList_6502521f54c1e';

        $this->criteria_fieldList_6502521f54c1e = new TCriteria();
        $this->default_item_fieldList_6502521f54c1e = new stdClass();

        $this->form->addField($item_banner_postagem_banner_id);
        $this->form->addField($item_banner_postagem_banner___row__id);
        $this->form->addField($item_banner_postagem_banner___row__data);
        $this->form->addField($item_banner_postagem_banner_tipo_postagem_id);
        $this->form->addField($item_banner_postagem_banner_data_inicio);
        $this->form->addField($item_banner_postagem_banner_data_fim);
        $this->form->addField($item_banner_postagem_banner_valor);

        $this->fieldList_6502521f54c1e->setRemoveAction(null, 'fas:times #dd5a43', "Excluír");

        $status->addValidation("Status", new TRequiredValidator()); 
        $pessoa_id->addValidation("Pessoa", new TRequiredValidator()); 
        $descricao->addValidation("Descrição", new TRequiredValidator()); 

        $foto->enableFileHandling();
        $foto->setAllowedExtensions(["jpg","jpeg","png","gif"]);
        $foto->setImagePlaceholder(new TImage("fas:file-upload #dde5ec"));
        $status->addItems(["ATIVO"=>"ATIVO","INATIVO"=>"INATIVO"]);
        $status->setLayout('horizontal');
        $lat_lng->setWidth('100%');
        $lat_lng->setHeight('300px');
        $pessoa_id->enableSearch();
        $item_banner_postagem_banner_tipo_postagem_id->enableSearch();

        $item_banner_postagem_banner_data_fim->setMask('dd/mm/yyyy hh:ii');
        $item_banner_postagem_banner_data_inicio->setMask('dd/mm/yyyy hh:ii');

        $item_banner_postagem_banner_data_fim->setDatabaseMask('yyyy-mm-dd hh:ii');
        $item_banner_postagem_banner_data_inicio->setDatabaseMask('yyyy-mm-dd hh:ii');

        $id->setEditable(false);
        $latitude->setEditable(false);
        $longitude->setEditable(false);

        $id->setSize(100);
        $status->setSize(80);
        $foto->setSize(160, 80);
        $obs->setSize('100%', 70);
        $latitude->setSize('100%');
        $pessoa_id->setSize('100%');
        $descricao->setSize('100%');
        $longitude->setSize('100%');
        $item_banner_postagem_banner_valor->setSize(100);
        $item_banner_postagem_banner_data_fim->setSize(100);
        $item_banner_postagem_banner_data_inicio->setSize(100);
        $item_banner_postagem_banner_tipo_postagem_id->setSize(100);

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[$foto],[new TLabel("Status:", null, '14px', null, '100%'),$status]);
        $row1->layout = [' col-sm-4',' col-sm-4',' col-sm-4'];

        $row2 = $this->form->addFields([new TLabel("Pessoa:", null, '14px', null, '100%'),$pessoa_id],[new TLabel("Descrição:", null, '14px', null, '100%'),$descricao]);
        $row2->layout = ['col-sm-6',' col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Longitude:", null, '14px', null, '100%'),$longitude],[new TLabel("Latitude:", null, '14px', null, '100%'),$latitude]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addContent([new TFormSeparator("", '#333', '18', '#eee')]);
        $row5 = $this->form->addFields([$lat_lng]);
        $row5->layout = [' col-sm-12'];

        $row6 = $this->form->addContent([new TFormSeparator("", '#333', '18', '#eee')]);
        $row7 = $this->form->addContent([new TFormSeparator("Postagens", '#333', '18', '#eee')]);
        $row8 = $this->form->addFields([$this->fieldList_6502521f54c1e]);
        $row8->layout = ['col-sm-12'];

        $row9 = $this->form->addFields([new TLabel("Obs:", null, '14px', null, '100%'),$obs]);
        $row9->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave'],['static' => 1]), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['BannerHeaderList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        parent::add($this->form);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Banner(); // create an empty object 

            $data = $this->form->getData(); // get form data as array

            $object->fromArray( (array) $data); // load the object with data

            $object->latitude = $data->lat_lng->latitude;
            $object->longitude = $data->lat_lng->longitude;

            $foto_dir = 'app/fotos/banner';  

            $object->valor_total = 0;

            TTransaction::open('microerp');
            $obj = Pessoa::find($data->pessoa_id);
            TTransaction::close();

            if(!$data->id)
            {
                $object->mes = date('m');
                $object->ano = date('Y');
                $object->mes_ano = date('m/Y');

                if($obj->email)
                {
                    $tos     = $obj->email;
                    $subject = "O Banner foi criado.";
                    $body    = "Status : {$data->status}\nLatitude : {$data->latitude}\nLongitude : {$data->longitude}";
                    MailService::send($tos, $subject, $body);
                }

            }else
            {
                if($obj->email)
                {
                    $tos     = $obj->email;
                    $subject = "O Banner id #{$data->id} foi editado.";
                    $body    = "Status : {$data->status}\nLatitude : {$data->latitude}\nLongitude : {$data->longitude}";
                    MailService::send($tos, $subject, $body);
                }
            }

            $object->store(); // save the object 

            $this->saveFile($object, $data, 'foto', $foto_dir);
            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            $item_banner_postagem_banner_items = $this->storeItems('ItemBannerPostagem', 'banner_id', $object, $this->fieldList_6502521f54c1e, function($masterObject, $detailObject){ 

            $masterObject->valor_total += $detailObject->valor;

            if(!$detailObject->id)
            {
                $detailObject->status = 'NAO';
            }

            }, $this->criteria_fieldList_6502521f54c1e); 

            $object->store();

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('BannerHeaderList', 'onShow', $loadPageParam); 

                TWindow::closeWindow(parent::getId());
            TForm::sendData(self::$formName, (object)['id' => $object->id]);

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Banner($key); // instantiates the Active Record 

                if($object->latitude && $object->longitude)
                {
                    $lat_lng = new stdClass();
                    $lat_lng->latitude = $object->latitude;
                    $lat_lng->longitude = $object->longitude;
                    $object->lat_lng = $lat_lng;
                }
                $this->fieldList_6502521f54c1e_items = $this->loadItems('ItemBannerPostagem', 'banner_id', $object, $this->fieldList_6502521f54c1e, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }, $this->criteria_fieldList_6502521f54c1e); 

                $this->form->setData($object); // fill the form 

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

        $this->fieldList_6502521f54c1e->addHeader();
        $this->fieldList_6502521f54c1e->addDetail($this->default_item_fieldList_6502521f54c1e);

        $this->fieldList_6502521f54c1e->addCloneAction(null, 'fas:plus #69aa46', "Clonar");

    }

    public function onShow($param = null)
    {
        $this->fieldList_6502521f54c1e->addHeader();
        $this->fieldList_6502521f54c1e->addDetail($this->default_item_fieldList_6502521f54c1e);

        $this->fieldList_6502521f54c1e->addCloneAction(null, 'fas:plus #69aa46', "Clonar");

    } 

    public static function getFormName()
    {
        return self::$formName;
    }

}

