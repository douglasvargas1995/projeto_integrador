<?php

class ItemBannerPostagemList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private $filter_criteria;
    private static $database = 'microerp';
    private static $activeRecord = 'ItemBannerPostagem';
    private static $primaryKey = 'id';
    private static $formName = 'form_ItemBannerPostagemList';
    private $showMethods = ['onReload', 'onSearch', 'onRefresh', 'onClearFilters'];
    private $limit = 20;

    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct($param = null)
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);

        // define the form title
        $this->form->setFormTitle("Autorização auditoria");
        $this->limit = 20;

        $id = new TEntry('id');
        $tipo_postagem_id = new TDBCombo('tipo_postagem_id', 'microerp', 'TipoPostagem', 'id', '{descricao}','id asc'  );
        $banner_id = new TDBCombo('banner_id', 'microerp', 'Banner', 'id', '{id}','id asc'  );
        $pessoa_id = new TDBCombo('pessoa_id', 'microerp', 'Pessoa', 'id', '{nome}','nome asc'  );


        $banner_id->enableSearch();
        $pessoa_id->enableSearch();
        $tipo_postagem_id->enableSearch();

        $id->setSize(100);
        $banner_id->setSize('100%');
        $pessoa_id->setSize('100%');
        $tipo_postagem_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id],[new TLabel("Tipo postagem:", null, '14px', null)],[$tipo_postagem_id]);
        $row2 = $this->form->addFields([new TLabel("Banner id:", null, '14px', null)],[$banner_id],[new TLabel("Pessoa id:", null, '14px', null)],[$pessoa_id]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_onsearch = $this->form->addAction("Buscar", new TAction([$this, 'onSearch']), 'fas:search #ffffff');
        $this->btn_onsearch = $btn_onsearch;
        $btn_onsearch->addStyleClass('btn-primary'); 

        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        $this->datagrid->disableHtmlConversion();

        $this->datagrid_form = new TForm('datagrid_'.self::$formName);
        $this->datagrid_form->onsubmit = 'return false';

        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);
        $this->filter_criteria = new TCriteria;

        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(250);

        $column_id = new TDataGridColumn('id', "Id", 'center' , '70px');
        $column_tipo_postagem_descricao = new TDataGridColumn('tipo_postagem->descricao', "Tipo postagem", 'left');
        $column_banner_id = new TDataGridColumn('banner_id', "Banner id", 'left');
        $column_data_inicio_transformed = new TDataGridColumn('data_inicio', "Data inicio", 'left');
        $column_data_fim_transformed = new TDataGridColumn('data_fim', "Data fim", 'left');
        $column_foto = new TDataGridColumn('foto', "Foto", 'left');
        $column_status_transformed = new TDataGridColumn('status', "Status", 'left');

        $column_data_inicio_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
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

        $column_data_fim_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
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

        $column_status_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
        {
            if($value === 'SIM')
            {
                return '<span class="label label-success">SIM</span>';
            }

            else if($value === 'NAO')
            {
                return '<span class="label label-danger">NÃO</span>';
            }

        });        

        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'id');
        $column_id->setAction($order_id);

        $this->builder_datagrid_check_all = new TCheckButton('builder_datagrid_check_all');
        $this->builder_datagrid_check_all->setIndexValue('on');
        $this->builder_datagrid_check_all->onclick = "Builder.checkAll(this)";
        $this->builder_datagrid_check_all->style = 'cursor:pointer';
        $this->builder_datagrid_check_all->setProperty('class', 'filled-in');
        $this->builder_datagrid_check_all->id = 'builder_datagrid_check_all';

        $label = new TLabel('');
        $label->style = 'margin:0';
        $label->class = 'checklist-label';
        $this->builder_datagrid_check_all->after($label);
        $label->for = 'builder_datagrid_check_all';

        $this->builder_datagrid_check = $this->datagrid->addColumn( new TDataGridColumn('builder_datagrid_check', $this->builder_datagrid_check_all, 'center',  '1%') );

        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_tipo_postagem_descricao);
        $this->datagrid->addColumn($column_banner_id);
        $this->datagrid->addColumn($column_data_inicio_transformed);
        $this->datagrid->addColumn($column_data_fim_transformed);
        $this->datagrid->addColumn($column_foto);
        $this->datagrid->addColumn($column_status_transformed);


        // create the datagrid model
        $this->datagrid->createModel();

        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->enableCounters();
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());

        $panel = new TPanelGroup("Autorização auditoria");
        $panel->datagrid = 'datagrid-container';
        $this->datagridPanel = $panel;
        $this->datagrid_form->add($this->datagrid);
        $panel->add($this->datagrid_form);

        $panel->getBody()->class .= ' table-responsive';

        $panel->addFooter($this->pageNavigation);

        $headerActions = new TElement('div');
        $headerActions->class = ' datagrid-header-actions ';
        $headerActions->style = 'justify-content: space-between;';

        $head_left_actions = new TElement('div');
        $head_left_actions->class = ' datagrid-header-actions-left-actions ';

        $head_right_actions = new TElement('div');
        $head_right_actions->class = ' datagrid-header-actions-left-actions ';

        $headerActions->add($head_left_actions);
        $headerActions->add($head_right_actions);

        $panel->getBody()->insert(0, $headerActions);

        $button_autorizar = new TButton('button_button_autorizar');
        $button_autorizar->setAction(new TAction(['AuditoriaLoteForm', 'onShow']), "Autorizar");
        $button_autorizar->addStyleClass('btn-default');
        $button_autorizar->setImage('fas:check #4CAF50');

        $this->datagrid_form->addField($button_autorizar);

        $button_atualizar = new TButton('button_button_atualizar');
        $button_atualizar->setAction(new TAction(['ItemBannerPostagemList', 'onRefresh']), "Atualizar");
        $button_atualizar->addStyleClass('btn-default');
        $button_atualizar->setImage('fas:sync-alt #03a9f4');

        $this->datagrid_form->addField($button_atualizar);

        $btnShowCurtainFilters = new TButton('button_btnShowCurtainFilters');
        $btnShowCurtainFilters->setAction(new TAction(['ItemBannerPostagemList', 'onShowCurtainFilters']), "Filtros");
        $btnShowCurtainFilters->addStyleClass('btn-default');
        $btnShowCurtainFilters->setImage('fas:filter #000000');

        $this->datagrid_form->addField($btnShowCurtainFilters);

        $head_left_actions->add($button_autorizar);
        $head_left_actions->add($button_atualizar);
        $head_left_actions->add($btnShowCurtainFilters);

        $this->btnShowCurtainFilters = $btnShowCurtainFilters;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Banner","Autorização auditoria"]));
        }

        $container->add($panel);

        parent::add($container);

    }

    public function onRefresh($param = null) 
    {
        $this->onReload([]);
    }
    public static function onShowCurtainFilters($param = null) 
    {
        try 
        {
            //code here

                        $filter = new self([]);

            $btnClose = new TButton('closeCurtain');
            $btnClose->class = 'btn btn-sm btn-default';
            $btnClose->style = 'margin-right:10px;';
            $btnClose->onClick = "Template.closeRightPanel();";
            $btnClose->setLabel("Fechar");
            $btnClose->setImage('fas:times');

            $filter->form->addHeaderWidget($btnClose);

            $page = new TPage();
            $page->setTargetContainer('adianti_right_panel');
            $page->setProperty('page-name', 'ItemBannerPostagemListSearch');
            $page->setProperty('page_name', 'ItemBannerPostagemListSearch');
            $page->adianti_target_container = 'adianti_right_panel';
            $page->target_container = 'adianti_right_panel';
            $page->add($filter->form);
            $page->setIsWrapped(true);
            $page->show();

            //</autoCode>
        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    /**
     * Register the filter in the session
     */
    public function onSearch($param = null)
    {
        $data = $this->form->getData();
        $filters = [];

        TSession::setValue(__CLASS__.'_filter_data', NULL);
        TSession::setValue(__CLASS__.'_filters', NULL);

        if (isset($data->id) AND ( (is_scalar($data->id) AND $data->id !== '') OR (is_array($data->id) AND (!empty($data->id)) )) )
        {

            $filters[] = new TFilter('id', '=', $data->id);// create the filter 
        }

        if (isset($data->tipo_postagem_id) AND ( (is_scalar($data->tipo_postagem_id) AND $data->tipo_postagem_id !== '') OR (is_array($data->tipo_postagem_id) AND (!empty($data->tipo_postagem_id)) )) )
        {

            $filters[] = new TFilter('tipo_postagem_id', '=', $data->tipo_postagem_id);// create the filter 
        }

        if (isset($data->banner_id) AND ( (is_scalar($data->banner_id) AND $data->banner_id !== '') OR (is_array($data->banner_id) AND (!empty($data->banner_id)) )) )
        {

            $filters[] = new TFilter('banner_id', '=', $data->banner_id);// create the filter 
        }

        if (isset($data->pessoa_id) AND ( (is_scalar($data->pessoa_id) AND $data->pessoa_id !== '') OR (is_array($data->pessoa_id) AND (!empty($data->pessoa_id)) )) )
        {

            $filters[] = new TFilter('pessoa_id', '=', $data->pessoa_id);// create the filter 
        }

        // fill the form with data again
        $this->form->setData($data);

        // keep the search data in the session
        TSession::setValue(__CLASS__.'_filter_data', $data);
        TSession::setValue(__CLASS__.'_filters', $filters);

        $this->onReload(['offset' => 0, 'first_page' => 1]);
    }

    /**
     * Load the datagrid with data
     */
    public function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'microerp'
            TTransaction::open(self::$database);

            // creates a repository for ItemBannerPostagem
            $repository = new TRepository(self::$activeRecord);

            $criteria = clone $this->filter_criteria;

            if (empty($param['order']))
            {
                $param['order'] = 'id';    
            }

            if (empty($param['direction']))
            {
                $param['direction'] = 'desc';
            }

            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $this->limit);

            if($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            $session_checks = TSession::getValue(__CLASS__.'builder_datagrid_check');

            //</blockLine><btnShowCurtainFiltersAutoCode>
            if(!empty($this->btnShowCurtainFilters) && empty($this->btnShowCurtainFiltersAdjusted))
            {
                $this->btnShowCurtainFiltersAdjusted = true;
                $this->btnShowCurtainFilters->style = 'position: relative';
                $countFilters = count($filters ?? []);
                $this->btnShowCurtainFilters->setLabel($this->btnShowCurtainFilters->getLabel(). "<span class='badge badge-success' style='position: absolute'>{$countFilters}<span>");
            }
            //</blockLine></btnShowCurtainFiltersAutoCode>

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {
                    $check = new TCheckGroup('builder_datagrid_check');
                    $check->addItems([$object->id => '']);
                    $check->getButtons()[$object->id]->onclick = 'event.stopPropagation()';

                    if(!$this->datagrid_form->getField('builder_datagrid_check[]'))
                    {
                        $this->datagrid_form->setFields([$check]);
                    }

                    $check->setChangeAction(new TAction([$this, 'builderSelectCheck']));
                    $object->builder_datagrid_check = $check;

                    if(!empty($session_checks[$object->id]))
                    {
                        $object->builder_datagrid_check->setValue([$object->id=>$object->id]);
                    }

                    if($object->status == 'SIM')
                    {
                        unset($object->builder_datagrid_check);
                    }
                    $row = $this->datagrid->addItem($object);
                    $row->id = "row_{$object->id}";

                }
            }

            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);

            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($this->limit); // limit

            // close the transaction
            TTransaction::close();
            $this->loaded = true;

            return $objects;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    public function onShow($param = null)
    {

    }

    /**
     * method show()
     * Shows the page
     */
    public function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded AND (!isset($_GET['method']) OR !(in_array($_GET['method'],  $this->showMethods))) )
        {
            if (func_num_args() > 0)
            {
                $this->onReload( func_get_arg(0) );
            }
            else
            {
                $this->onReload();
            }
        }
        parent::show();
    }

    public static function builderSelectCheck($param)
    {
        $session_checks = TSession::getValue(__CLASS__.'builder_datagrid_check');
        $key = $param['key'];

        if(empty($param['builder_datagrid_check']) && !empty($session_checks[$key]))
        {
            unset($session_checks[$key]);
        }
        elseif(!empty($param['builder_datagrid_check']) && !in_array($key, $param['builder_datagrid_check']) && !empty($session_checks[$key]))
        {
            unset($session_checks[$key]);
        }
        elseif(!empty($param['builder_datagrid_check']) && in_array($key, $param['builder_datagrid_check']))
        {
            $session_checks[$key] = $key;
        }

        TSession::setValue(__CLASS__.'builder_datagrid_check', $session_checks);
    }

}

