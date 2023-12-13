<?php
class MyMap extends TField implements AdiantiWidgetInterface
{
    protected $name;
    protected $id;
    protected $required;
    protected $labelRequired;
    protected $validatorLabel;
    protected $editable;
    protected $value;
    protected $width;
    protected $height;
    protected $latitude;
    protected $longitude;
    public function __construct($name)
    {
        parent::__construct($name);
        $this->setName($name);
        $this->id = 'MyMap'.mt_rand(1000000000, 1999999999);
        $this->latitude = -29.451923;
        $this->longitude = -51.966069;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setRequired($required)
    {
        $this->required = $required;
    }
    public function getRequired()
    {
        return $this->required;
    }
    public function setLabelRequired($labelRequired)
    {
        $this->labelRequired = $labelRequired;
    }
    public function getLabelRequired()
    {
        return $this->labelRequired;
    }
    public function setValidatorLabel($validatorLabel)
    {
        $this->validatorLabel = $validatorLabel;
    }
    public function getValidatorLabel()
    {
        return $this->validatorLabel;
    }
    public function setEditable($editable)
    {
        $this->editable = $editable;
    }
    public function getEditable()
    {
        return $this->editable;
    }
    public function setValue($latLang)
    {
        $this->value = $latLang;
        $this->latitude = $latLang->latitude;
        $this->longitude = $latLang->longitude;
    }
    public function getValue()
    {
        return $this->value;
    }
    public function setWidth($width)
    {
        $this->width = $width;
    }
    public function getWidth()
    {
        return $this->width;
    }
    public function setHeight($height)
    {
        $this->height = $height;
    }
    public function getHeight()
    {
        return $this->height;
    }
    public function getSize()
    {
        return [$this->width, $this->height];
    }
    public function getPostData()
    {
        if (isset($_POST[$this->name]))
        {
            return json_decode($_POST[$this->name]);
        }
        return '';
    }
    public function show()
    {
        $mapElement = new TElement('div');
        $mapElement->id = $this->id.'-map';
        if ($this->width)
        {
            $width = (strstr((string) $this->width, '%') !== FALSE) ? $this->width : "{$this->width}";
            $mapElement->setProperty('style', "width:{$width};", FALSE);
        }
        if ($this->height)
        {
            $height = (strstr($this->height, '%') !== FALSE) ? $this->height : "{$this->height}";
            $mapElement->setProperty('style', "height:{$height}", FALSE);
        }
        $this->tag->type = 'hidden';
        $this->tag->id = $this->id;
        $this->tag->name = $this->name;
        $script = TScript::create("
            var myMap = new MyMap();
            myMap.init({
                containerId:'{$this->id}-map',
                fieldId:'{$this->id}',
                name: '{$this->name}',
                width: '{$this->width}',
                height: '{$this->height}',
                latitude: '{$this->latitude}',
                longitude: '{$this->longitude}'
            });
            myMap.render();
        ", false);
        $mapContainer = new TElement('div');
        $mapContainer->add($mapElement);
        $mapContainer->add($this->tag);
        $mapContainer->add($script);
        $mapContainer->show();
    }
}