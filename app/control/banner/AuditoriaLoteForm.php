<?php

class AuditoriaLoteForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = '';
    private static $activeRecord = '';
    private static $primaryKey = '';
    private static $formName = 'form_AuditoriaLoteForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param = null)
    {
        parent::__construct();
        parent::setSize(0.8, null);
        parent::setTitle("Auditoria confirmação");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Auditoria confirmação");

        $criteria_posts = new TCriteria();

        $filterVar = TSession::getValue('ItemBannerPostagemListbuilder_datagrid_check');
        $criteria_posts->add(new TFilter('id', 'in', $filterVar)); 

        $posts = new TCheckList('posts');


        $posts->setValue(TSession::getValue('ItemBannerPostagemListbuilder_datagrid_check'));

        $posts->setIdColumn('id');

        $column_posts_id = $posts->addColumn('id', "Id", 'center' , '25%');
        $column_posts_banner_id = $posts->addColumn('banner_id', "Banner id", 'center' , '25%');
        $column_posts_data_inicio = $posts->addColumn('data_inicio', "Data inicio", 'center' , '25%');
        $column_posts_data_fim = $posts->addColumn('data_fim', "Data fim", 'center' , '25%');

        $posts->setHeight(150);
        $posts->makeScrollable();

        $posts->fillWith('microerp', 'ItemBannerPostagem', 'id', 'id asc' , $criteria_posts);


        $row1 = $this->form->addFields([$posts]);
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

            TTransaction::open('microerp'); // open a transaction

            $messageAction = null;

            if(empty($param['salvar'])) {
                    $action = new TAction(array($this, 'confirmSave'));
                    new TQuestion('DESEJA AUTORIZAR POSTAGENS ' . '?', $action,NULL,'ATENÇÃO!','SIM','NÃO');
                    TTransaction::close();
                    return;
            }

            $data = $this->form->getData(); // get form data as array

            $ids_itens = $data->posts ?? [];

            if ($ids_itens) {
                foreach ($ids_itens as $id_item) {
                    $item = new ItemBannerPostagem($id_item);
                    $item->status = 'SIM';
                    $item->store();

                    TSession::setValue('ItemBannerPostagemListbuilder_datagrid_check', []);
                    new TMessage ('info', 'Postagens autorizadas com sucesso!', new TAction(['ItemBannerPostagemList','onShow']));
                }

                TTransaction::close();
            } else {
                throw new Exception('Nenhuma postagem selecionada');
            }

        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }

    public function onShow($param = null)
    {               

    } 

    public static function confirmSave($param)
    {
        TApplication::postData(self::$formName, static::class, 'onSave', ['salvar' => 1, 'static' => 1]);
    }

}

