<?php

class TipoPostagem extends TRecord
{
    const TABLENAME  = 'tipo_postagem';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const DELETEDAT  = 'delete_at';
    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'update_at';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('descricao');
        parent::addAttribute('cor');
        parent::addAttribute('created_at');
        parent::addAttribute('update_at');
        parent::addAttribute('delete_at');
        parent::addAttribute('icone');
            
    }

    /**
     * Method getItemBannerPostagems
     */
    public function getItemBannerPostagems()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_postagem_id', '=', $this->id));
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
    
        $values = ItemBannerPostagem::where('tipo_postagem_id', '=', $this->id)->getIndexedArray('tipo_postagem_id','{tipo_postagem->id}');
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
    
        $values = ItemBannerPostagem::where('tipo_postagem_id', '=', $this->id)->getIndexedArray('banner_id','{banner->id}');
        return implode(', ', $values);
    }

    public function set_item_banner_postagem_pessoa_to_string($item_banner_postagem_pessoa_to_string)
    {
        if(is_array($item_banner_postagem_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $item_banner_postagem_pessoa_to_string)->getIndexedArray('nome', 'nome');
            $this->item_banner_postagem_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->item_banner_postagem_pessoa_to_string = $item_banner_postagem_pessoa_to_string;
        }

        $this->vdata['item_banner_postagem_pessoa_to_string'] = $this->item_banner_postagem_pessoa_to_string;
    }

    public function get_item_banner_postagem_pessoa_to_string()
    {
        if(!empty($this->item_banner_postagem_pessoa_to_string))
        {
            return $this->item_banner_postagem_pessoa_to_string;
        }
    
        $values = ItemBannerPostagem::where('tipo_postagem_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->nome}');
        return implode(', ', $values);
    }

    
}

