<?php

class BannerForm extends TPage
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

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de banner");


        $id = new TEntry('id');
        $pessoa_id = new TDBCombo('pessoa_id', 'microerp', 'Pessoa', 'id', '{nome}','nome asc'  );
        $foto = new TImageCropper('foto');
        $descricao = new TEntry('descricao');
        $status = new TRadioGroup('status');
        $longitude = new TNumeric('longitude', '0', '', '' );
        $latitude = new TNumeric('latitude', '0', '', '' );
        $item_banner_postagem_banner_id = new THidden('item_banner_postagem_banner_id[]');
        $item_banner_postagem_banner___row__id = new THidden('item_banner_postagem_banner___row__id[]');
        $item_banner_postagem_banner___row__data = new THidden('item_banner_postagem_banner___row__data[]');
        $item_banner_postagem_banner_tipo_postagem_id = new TDBCombo('item_banner_postagem_banner_tipo_postagem_id[]', 'microerp', 'TipoPostagem', 'id', '{descricao}','id asc'  );
        $item_banner_postagem_banner_data_inicio = new TDateTime('item_banner_postagem_banner_data_inicio[]');
        $item_banner_postagem_banner_data_fim = new TDateTime('item_banner_postagem_banner_data_fim[]');
        $this->fieldList_64e3f439fff35 = new TFieldList();
        $obs = new TText('obs');

        $this->fieldList_64e3f439fff35->addField(null, $item_banner_postagem_banner_id, []);
        $this->fieldList_64e3f439fff35->addField(null, $item_banner_postagem_banner___row__id, ['uniqid' => true]);
        $this->fieldList_64e3f439fff35->addField(null, $item_banner_postagem_banner___row__data, []);
        $this->fieldList_64e3f439fff35->addField(new TLabel("Tipo", null, '14px', null), $item_banner_postagem_banner_tipo_postagem_id, ['width' => '35%']);
        $this->fieldList_64e3f439fff35->addField(new TLabel("Início", null, '14px', null), $item_banner_postagem_banner_data_inicio, ['width' => '35%']);
        $this->fieldList_64e3f439fff35->addField(new TLabel("Fim", null, '14px', null), $item_banner_postagem_banner_data_fim, ['width' => '35%']);

        $this->fieldList_64e3f439fff35->width = '100%';
        $this->fieldList_64e3f439fff35->setFieldPrefix('item_banner_postagem_banner');
        $this->fieldList_64e3f439fff35->name = 'fieldList_64e3f439fff35';
        $this->fieldList_64e3f439fff35->class .= ' table-responsive';

        $this->criteria_fieldList_64e3f439fff35 = new TCriteria();

        $this->form->addField($item_banner_postagem_banner_id);
        $this->form->addField($item_banner_postagem_banner___row__id);
        $this->form->addField($item_banner_postagem_banner___row__data);
        $this->form->addField($item_banner_postagem_banner_tipo_postagem_id);
        $this->form->addField($item_banner_postagem_banner_data_inicio);
        $this->form->addField($item_banner_postagem_banner_data_fim);

        $this->fieldList_64e3f439fff35->setRemoveAction(null, 'fas:times #dd5a43', "Excluír");

        $pessoa_id->addValidation("Pessoa", new TRequiredValidator()); 
        $descricao->addValidation("Descrição", new TRequiredValidator()); 
        $status->addValidation("Status", new TRequiredValidator()); 
        $longitude->addValidation("Latitude", new TRequiredValidator()); 
        $latitude->addValidation("Longitude", new TRequiredValidator()); 

        $id->setEditable(false);
        $foto->enableFileHandling();
        $foto->setAllowedExtensions(["jpg","jpeg","png","gif"]);
        $foto->setImagePlaceholder(new TImage("fas:file-upload #dde5ec"));
        $status->addItems(["ATIVO"=>"ATIVO","INATIVO"=>"INATIVO"]);
        $status->setLayout('horizontal');
        $pessoa_id->enableSearch();
        $item_banner_postagem_banner_tipo_postagem_id->enableSearch();

        $item_banner_postagem_banner_data_fim->setMask('dd/mm/yyyy hh:ii');
        $item_banner_postagem_banner_data_inicio->setMask('dd/mm/yyyy hh:ii');

        $item_banner_postagem_banner_data_fim->setDatabaseMask('yyyy-mm-dd hh:ii');
        $item_banner_postagem_banner_data_inicio->setDatabaseMask('yyyy-mm-dd hh:ii');

        $id->setSize(100);
        $status->setSize(80);
        $foto->setSize(160, 80);
        $obs->setSize('100%', 70);
        $latitude->setSize('100%');
        $pessoa_id->setSize('100%');
        $descricao->setSize('100%');
        $longitude->setSize('100%');
        $item_banner_postagem_banner_data_fim->setSize(150);
        $item_banner_postagem_banner_data_inicio->setSize(150);
        $item_banner_postagem_banner_tipo_postagem_id->setSize('100%');


        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Pessoa:", null, '14px', null, '100%'),$pessoa_id]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([$foto]);
        $row2->layout = ['col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Descrição:", null, '14px', null, '100%'),$descricao],[new TLabel("Status:", null, '14px', null, '100%'),$status]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Longitude:", null, '14px', null, '100%'),$longitude],[new TLabel("Latitude:", null, '14px', null, '100%'),$latitude]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addContent([new TFormSeparator("", '#333', '18', '#eee')]);
        $row6 = $this->form->addContent([new TFormSeparator("Postagens", '#333', '18', '#eee')]);
        $row7 = $this->form->addFields([$this->fieldList_64e3f439fff35]);
        $row7->layout = [' col-sm-12'];

        $row8 = $this->form->addFields([new TLabel("Obs:", null, '14px', null, '100%'),$obs]);
        $row8->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave'],['static' => 1]), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['BannerHeaderList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        parent::setTargetContainer('adianti_right_panel');

        $btnClose = new TButton('closeCurtain');
        $btnClose->class = 'btn btn-sm btn-default';
        $btnClose->style = 'margin-right:10px;';
        $btnClose->onClick = "Template.closeRightPanel();";
        $btnClose->setLabel("Fechar");
        $btnClose->setImage('fas:times');

        $this->form->addHeaderWidget($btnClose);

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

            $foto_dir = 'app/fotos/banner'; 

            $object->store(); // save the object 

            $this->saveFile($object, $data, 'foto', $foto_dir);
            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            $item_banner_postagem_banner_items = $this->storeItems('ItemBannerPostagem', 'banner_id', $object, $this->fieldList_64e3f439fff35, function($masterObject, $detailObject){ 

                //code here

            }, $this->criteria_fieldList_64e3f439fff35); 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('BannerHeaderList', 'onShow', $loadPageParam); 

                        TScript::create("Template.closeRightPanel();");
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

                $this->fieldList_64e3f439fff35_items = $this->loadItems('ItemBannerPostagem', 'banner_id', $object, $this->fieldList_64e3f439fff35, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }, $this->criteria_fieldList_64e3f439fff35); 

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

        $this->fieldList_64e3f439fff35->addHeader();
        $this->fieldList_64e3f439fff35->addDetail( new stdClass );

        $this->fieldList_64e3f439fff35->addCloneAction(null, 'fas:plus #69aa46', "Clonar");

    }

    public function onShow($param = null)
    {
        $this->fieldList_64e3f439fff35->addHeader();
        $this->fieldList_64e3f439fff35->addDetail( new stdClass );

        $this->fieldList_64e3f439fff35->addCloneAction(null, 'fas:plus #69aa46', "Clonar");

    } 

}

