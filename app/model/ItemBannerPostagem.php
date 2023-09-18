<?php

class ItemBannerPostagem extends TRecord
{
    const TABLENAME  = 'item_banner_postagem';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $tipo_postagem;
    private $banner;
    private $pessoa;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo_postagem_id');
        parent::addAttribute('banner_id');
        parent::addAttribute('pessoa_id');
        parent::addAttribute('valor');
        parent::addAttribute('data_inicio');
        parent::addAttribute('data_fim');
        parent::addAttribute('foto');
        parent::addAttribute('obs');
            
    }

    /**
     * Method set_tipo_postagem
     * Sample of usage: $var->tipo_postagem = $object;
     * @param $object Instance of TipoPostagem
     */
    public function set_tipo_postagem(TipoPostagem $object)
    {
        $this->tipo_postagem = $object;
        $this->tipo_postagem_id = $object->id;
    }

    /**
     * Method get_tipo_postagem
     * Sample of usage: $var->tipo_postagem->attribute;
     * @returns TipoPostagem instance
     */
    public function get_tipo_postagem()
    {
    
        // loads the associated object
        if (empty($this->tipo_postagem))
            $this->tipo_postagem = new TipoPostagem($this->tipo_postagem_id);
    
        // returns the associated object
        return $this->tipo_postagem;
    }
    /**
     * Method set_banner
     * Sample of usage: $var->banner = $object;
     * @param $object Instance of Banner
     */
    public function set_banner(Banner $object)
    {
        $this->banner = $object;
        $this->banner_id = $object->id;
    }

    /**
     * Method get_banner
     * Sample of usage: $var->banner->attribute;
     * @returns Banner instance
     */
    public function get_banner()
    {
    
        // loads the associated object
        if (empty($this->banner))
            $this->banner = new Banner($this->banner_id);
    
        // returns the associated object
        return $this->banner;
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

    
}

