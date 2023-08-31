<?php

class BannerFormView extends TPage
{
    protected $form; // form
    private static $database = 'microerp';
    private static $activeRecord = 'Banner';
    private static $primaryKey = 'id';
    private static $formName = 'formView_Banner';

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

        TTransaction::open(self::$database);
        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        $this->form->setTagName('div');

        $banner = new Banner($param['key']);
        // define the form title
        $this->form->setFormTitle("Consultar Banner");

        $transformed_banner_status = call_user_func(function($value, $object, $row)
        {
            if($value === 'ATIVO')
            {
                return '<span class="label label-success">ATIVO</span>';
            }

            else if($value === 'INATIVO')
            {
                return '<span class="label label-danger">INATIVO</span>';
            }

        }, $banner->status, $banner, null);

        $label1 = new TLabel("Id:", '', '12px', '');
        $text1 = new TTextDisplay($banner->id, '', '12px', '');
        $label2 = new TLabel("Pessoa id:", '', '12px', '');
        $text2 = new TTextDisplay($banner->pessoa->nome, '', '12px', '');
        $label3 = new TLabel("Foto:", '', '12px', '');
        $text3 = new TTextDisplay($banner->foto, '', '12px', '');
        $label4 = new TLabel("Descricao:", '', '12px', '');
        $text4 = new TTextDisplay($banner->descricao, '', '12px', '');
        $label5 = new TLabel("Status:", '', '12px', '');
        $text5 = new TTextDisplay($transformed_banner_status, '', '12px', '');
        $label6 = new TLabel("Longitude:", '', '12px', '');
        $text6 = new TTextDisplay(number_format($banner->longitude, '2', ',', '.'), '', '12px', '');



        $row1 = $this->form->addFields([$label1],[$text1],[$label2],[$text2]);
        $row2 = $this->form->addFields([$label3],[$text3],[$label4],[$text4]);
        $row3 = $this->form->addFields([$label5],[$text5],[$label6],[$text6]);

        $this->item_banner_postagem_banner_id_list = new TQuickGrid;
        $this->item_banner_postagem_banner_id_list->disableHtmlConversion();
        $this->item_banner_postagem_banner_id_list->style = 'width:100%';
        $this->item_banner_postagem_banner_id_list->disableDefaultClick();

        $column_tipo_postagem_descricao = $this->item_banner_postagem_banner_id_list->addQuickColumn("Tipo postagem", 'tipo_postagem->descricao', 'left');
        $column_data_inicio_transformed = $this->item_banner_postagem_banner_id_list->addQuickColumn("Data inicio", 'data_inicio', 'left');
        $column_data_fim_transformed = $this->item_banner_postagem_banner_id_list->addQuickColumn("Data fim", 'data_fim', 'left');

        $column_data_inicio_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
        {
            if(!empty(trim($value)))
            {
                try
                {
                    $date = new DateTime($value);
                    return $date->format('d/m/Y');
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
                    return $date->format('d/m/Y');
                }
                catch (Exception $e)
                {
                    return $value;
                }
            }
        });

        $this->item_banner_postagem_banner_id_list->createModel();

        $criteria_item_banner_postagem_banner_id = new TCriteria();
        $criteria_item_banner_postagem_banner_id->add(new TFilter('banner_id', '=', $banner->id));

        $criteria_item_banner_postagem_banner_id->setProperty('order', 'id desc');

        $item_banner_postagem_banner_id_items = ItemBannerPostagem::getObjects($criteria_item_banner_postagem_banner_id);

        $this->item_banner_postagem_banner_id_list->addItems($item_banner_postagem_banner_id_items);

        $panel = new TElement('div');
        $panel->class = 'formView-detail';
        $panel->add(new BootstrapDatagridWrapper($this->item_banner_postagem_banner_id_list));

        $this->form->addContent([$panel]);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Banner","Consultar Banner"]));
        }
        $container->add($this->form);

        TTransaction::close();
        parent::add($container);

    }

    public function onShow($param = null)
    {     

    }

}

