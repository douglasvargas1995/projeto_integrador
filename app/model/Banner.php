<?php

class Banner extends TRecord
{
    const TABLENAME  = 'banner';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const DELETEDAT  = 'delete_at';
    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'update_at';

    private $pessoa;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('pessoa_id');
        parent::addAttribute('foto');
        parent::addAttribute('descricao');
        parent::addAttribute('status');
        parent::addAttribute('longitude');
        parent::addAttribute('latitude');
        parent::addAttribute('obs');
        parent::addAttribute('mes');
        parent::addAttribute('ano');
        parent::addAttribute('mes_ano');
        parent::addAttribute('created_at');
        parent::addAttribute('update_at');
        parent::addAttribute('delete_at');
            
    }

    /**
     * Method set_pessoa
     * Sample of usage: $var->pessoa = $object;
     * @param $object Instance of Pessoa
     */
    public function set_pessoa(Pessoa $object)
    {
        $this->pessoa = $object;
        $this->pessoa_id = $object->id;
    }

    /**
     * Method get_pessoa
     * Sample of usage: $var->pessoa->attribute;
     * @returns Pessoa instance
     */
    public function get_pessoa()
    {
    
        // loads the associated object
        if (empty($this->pessoa))
            $this->pessoa = new Pessoa($this->pessoa_id);
    
        // returns the associated object
        return $this->pessoa;
    }

    /**
     * Method getItemBannerPostagems
     */
    public function getItemBannerPostagems()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('banner_id', '=', $this->id));
        return ItemBannerPostagem::getObjects( $criteria );
    }

    public function set_item_banner_postagem_tipo_postagem_to_string($item_banner_postagem_tipo_postagem_to_string)
    {
        if(is_array($item_banner_postagem_tipo_postagem_to_string))
        {
            $values = TipoPostagem::where('id', 'in', $item_banner_postagem_tipo_postagem_to_string)->getIndexedArray('id', 'id');
            $this->item_banner_postagem_tipo_postagem_to_string = implode(', ', $values);
        }
        else
        {
            $this->item_banner_postagem_tipo_postagem_to_string = $item_banner_postagem_tipo_postagem_to_string;
        }

        $this->vdata['item_banner_postagem_tipo_postagem_to_string'] = $this->item_banner_postagem_tipo_postagem_to_string;
    }

    public function get_item_banner_postagem_tipo_postagem_to_string()
    {
        if(!empty($this->item_banner_postagem_tipo_postagem_to_string))
        {
            return $this->item_banner_postagem_tipo_postagem_to_string;
        }
    
        $values = ItemBannerPostagem::where('banner_id', '=', $this->id)->getIndexedArray('tipo_postagem_id','{tipo_postagem->id}');
        return implode(', ', $values);
    }

    public function set_item_banner_postagem_banner_to_string($item_banner_postagem_banner_to_string)
    {
        if(is_array($item_banner_postagem_banner_to_string))
        {
            $values = Banner::where('id', 'in', $item_banner_postagem_banner_to_string)->getIndexedArray('id', 'id');
            $this->item_banner_postagem_banner_to_string = implode(', ', $values);
        }
        else
        {
            $this->item_banner_postagem_banner_to_string = $item_banner_postagem_banner_to_string;
        }

        $this->vdata['item_banner_postagem_banner_to_string'] = $this->item_banner_postagem_banner_to_string;
    }

    public function get_item_banner_postagem_banner_to_string()
    {
        if(!empty($this->item_banner_postagem_banner_to_string))
        {
            return $this->item_banner_postagem_banner_to_string;
        }
    
        $values = ItemBannerPostagem::where('banner_id', '=', $this->id)->getIndexedArray('banner_id','{banner->id}');
        return implode(', ', $values);
    }

    
}

