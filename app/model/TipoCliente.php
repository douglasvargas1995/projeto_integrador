<?php

class TipoCliente extends TRecord
{
    const TABLENAME  = 'tipo_cliente';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const FISICA = '1';
    const JURIDICA = '2';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
            
    }

    /**
     * Method getPessoas
     */
    public function getPessoas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_cliente_id', '=', $this->id));
        return Pessoa::getObjects( $criteria );
    }

    public function set_pessoa_tipo_cliente_to_string($pessoa_tipo_cliente_to_string)
    {
        if(is_array($pessoa_tipo_cliente_to_string))
        {
            $values = TipoCliente::where('id', 'in', $pessoa_tipo_cliente_to_string)->getIndexedArray('nome', 'nome');
            $this->pessoa_tipo_cliente_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_tipo_cliente_to_string = $pessoa_tipo_cliente_to_string;
        }

        $this->vdata['pessoa_tipo_cliente_to_string'] = $this->pessoa_tipo_cliente_to_string;
    }

    public function get_pessoa_tipo_cliente_to_string()
    {
        if(!empty($this->pessoa_tipo_cliente_to_string))
        {
            return $this->pessoa_tipo_cliente_to_string;
        }
    
        $values = Pessoa::where('tipo_cliente_id', '=', $this->id)->getIndexedArray('tipo_cliente_id','{tipo_cliente->nome}');
        return implode(', ', $values);
    }

    
}

