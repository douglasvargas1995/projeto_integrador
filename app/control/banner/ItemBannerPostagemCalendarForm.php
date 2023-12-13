<?php

class ItemBannerPostagemCalendarForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'microerp';
    private static $activeRecord = 'ItemBannerPostagem';
    private static $primaryKey = 'id';
    private static $formName = 'form_ItemBannerPostagemCalendarForm';
    private static $startDateField = 'data_inicio';
    private static $endDateField = 'data_fim';

    use Adianti\Base\AdiantiFileSaveTrait;

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
        $this->form->setFormTitle("Agendamento Postagens");

        $view = new THidden('view');

        $criteria_banner_id = new TCriteria();

        $id = new TEntry('id');
        $tipo_postagem_id = new TDBCombo('tipo_postagem_id', 'microerp', 'TipoPostagem', 'id', '{descricao}','id asc'  );
        $banner_id = new TDBCombo('banner_id', 'microerp', 'Banner', 'id', '{id}  - {descricao}','id asc' , $criteria_banner_id );
        $pessoa_id = new TDBCombo('pessoa_id', 'microerp', 'Pessoa', 'id', '{nome}','nome asc'  );
        $valor = new TNumeric('valor', '2', ',', '.' );
        $foto = new TImageCropper('foto');
        $data_inicio = new TDateTime('data_inicio');
        $data_fim = new TDateTime('data_fim');
        $obs = new TText('obs');

        $tipo_postagem_id->addValidation("Tipo postagem id", new TRequiredValidator()); 
        $banner_id->addValidation("Banner id", new TRequiredValidator()); 

        $id->setEditable(false);
        $valor->setValue('10');
        $foto->enableFileHandling();
        $foto->setAllowedExtensions(["jpg","jpeg","png","gif"]);
        $foto->setImagePlaceholder(new TImage("fas:file-upload #dde5ec"));
        $data_fim->setMask('dd/mm/yyyy hh:ii');
        $data_inicio->setMask('dd/mm/yyyy hh:ii');

        $data_fim->setDatabaseMask('yyyy-mm-dd hh:ii');
        $data_inicio->setDatabaseMask('yyyy-mm-dd hh:ii');

        $banner_id->enableSearch();
        $pessoa_id->enableSearch();
        $tipo_postagem_id->enableSearch();

        $id->setSize(100);
        $valor->setSize('100%');
        $data_fim->setSize(150);
        $foto->setSize('100%', 80);
        $data_inicio->setSize(150);
        $obs->setSize('100%', 100);
        $banner_id->setSize('100%');
        $pessoa_id->setSize('100%');
        $tipo_postagem_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null),$id],[new TLabel("Tipo:", null, '14px', null),$tipo_postagem_id],[new TLabel("Banner:", null, '14px', null),$banner_id]);
        $row1->layout = ['col-sm-3','col-sm-3','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Pessoa:", null, '14px', null),$pessoa_id],[new TLabel("Valor:", null, '14px', null),$valor],[new TLabel("Foto:", null, '14px', null),$foto]);
        $row2->layout = [' col-sm-4',' col-sm-4',' col-sm-4'];

        $row3 = $this->form->addFields([new TLabel("Data inicio:", null, '14px', null),$data_inicio],[new TLabel("Data fim:", null, '14px', null),$data_fim]);
        $row3->layout = [' col-sm-4',' col-sm-4'];

        $row4 = $this->form->addContent([new TFormSeparator("", '#333', '18', '#eee')]);
        $row5 = $this->form->addFields([new TLabel("Observação:", null, '14px', null),$obs]);
        $row5->layout = [' col-sm-12'];

        $this->form->addFields([$view]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        parent::setTargetContainer('adianti_right_panel');

        $btnClose = new TButton('closeCurtain');
        $btnClose->class = 'btn btn-sm btn-default';
        $btnClose->style = 'margin-right:10px;';
        $btnClose->onClick = "Template.closeRightPanel();";
        $btnClose->setLabel("Fechar");
        $btnClose->setImage('fas:times');

        $this->form->addHeaderWidget($btnClose);

        parent::add($this->form);

        $style = new TStyle('right-panel > .container-part[page-name=ItemBannerPostagemCalendarForm]');
        $style->width = '50% !important';   
        $style->show(true);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new ItemBannerPostagem(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $foto_dir = 'app/fotos/banner'; 

            $object->store(); // save the object 

            $this->saveFile($object, $data, 'foto', $foto_dir);
            $messageAction = new TAction(['ItemBannerPostagemCalendarFormView', 'onReload']);
            $messageAction->setParameter('view', $data->view);
            $messageAction->setParameter('date', explode(' ', $data->data_inicio)[0]);

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            new TMessage('info', "Registro salvo", $messageAction); 

                        TScript::create("Template.closeRightPanel();"); 
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

                $object = new ItemBannerPostagem($key); // instantiates the Active Record 

                                $object->view = !empty($param['view']) ? $param['view'] : 'agendaWeek'; 

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

    }

    public function onShow($param = null)
    {

    } 

    public function onStartEdit($param)
    {

        $this->form->clear(true);

        $data = new stdClass;
        $data->view = $param['view'] ?? 'agendaWeek'; // calendar view
        $data->tipo_postagem = new stdClass();
        $data->tipo_postagem->cor = '#3a87ad';

        if (!empty($param['date']))
        {
            if(strlen($param['date']) == '10')
                $param['date'].= ' 09:00';

            $data->data_inicio = str_replace('T', ' ', $param['date']);

            $data_fim = new DateTime($data->data_inicio);
            $data_fim->add(new DateInterval('PT1H'));
            $data->data_fim = $data_fim->format('Y-m-d H:i:s');

        }

        $this->form->setData( $data );
    }

    public static function onUpdateEvent($param)
    {
        try
        {
            if (isset($param['id']))
            {
                TTransaction::open(self::$database);

                $class = self::$activeRecord;
                $object = new $class($param['id']);

                $object->data_inicio = str_replace('T', ' ', $param['start_time']);
                $object->data_fim   = str_replace('T', ' ', $param['end_time']);

                $object->store();

                // close the transaction
                TTransaction::close();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            TTransaction::rollback();
        }
    }

    public static function getFormName()
    {
        return self::$formName;
    }

}

