<?php

class ConfirmarPostagemForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'microerp';
    private static $activeRecord = 'Banner';
    private static $primaryKey = 'id';
    private static $formName = 'form_ConfirmarPostagemForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.8, null);
        parent::setTitle("Confirmação Auditoria");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Confirmação Auditoria");

        $criteria_postagem = new TCriteria();

        $filterVar = TSession::getValue('ItemBannerPostagemListbuilder_datagrid_check');
        $criteria_postagem->add(new TFilter('id', 'in', $filterVar)); 

        $postagem = new TCheckList('postagem');


        $postagem->setValue(TSession::getValue('ItemBannerPostagemListbuilder_datagrid_check'));

        $postagem->setIdColumn('id');

        $column_postagem_id = $postagem->addColumn('id', "Id", 'center' , '25%');
        $column_postagem_banner_id = $postagem->addColumn('banner_id', "Banner id", 'center' , '25%');
        $column_postagem_data_inicio_transformed = $postagem->addColumn('data_inicio', "Data inicio", 'center' , '25%');
        $column_postagem_data_fim_transformed = $postagem->addColumn('data_fim', "Data fim", 'center' , '25%');

        $column_postagem_data_inicio_transformed->setTransformer(function($value, $object, $row)
        {
            if(!empty(trim($value)))
            {
                try
                {
                    $date = new DateTime($value);
                    return $date->format('d/m/Y H:i');
                }
                catch (Exception $e)
                {
                    return $value;
                }
            }
        });

        $column_postagem_data_fim_transformed->setTransformer(function($value, $object, $row)
        {
            if(!empty(trim($value)))
            {
                try
                {
                    $date = new DateTime($value);
                    return $date->format('d/m/Y H:i');
                }
                catch (Exception $e)
                {
                    return $value;
                }
            }
        });        

        $postagem->setHeight(250);
        $postagem->makeScrollable();

        $postagem->fillWith('microerp', 'ItemBannerPostagem', 'id', 'id asc' , $criteria_postagem);

        $row1 = $this->form->addFields([$postagem]);
        $row1->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

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

            $ids_itens = $data->postagem ?? [];
            if ($ids_itens) {
                foreach ($ids_itens as $id_item) {
                    $item = new ItemBannerPostagem($id_item);
                    $item->status = 'SIM';
                    $item->store();

                    TSession::setValue('ItemBannerPostagemListbuilder_datagrid_check', []);
                }
            } else {
                throw new Exception('Nenhuma postagem selecionada');
            }

            $object->store(); // save the object 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            new TMessage('info', "Registro salvo", $messageAction); 

                TWindow::closeWindow(parent::getId()); 

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

    public static function getFormName()
    {
        return self::$formName;
    }

    public static function confirmSave($param)
    {
        TApplication::postData(self::$formName, static::class, 'onSave', ['salvar' => 1, 'static' => 1]);
    }

}

