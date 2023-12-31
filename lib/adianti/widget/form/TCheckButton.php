<?php
namespace Adianti\Widget\Form;

use Adianti\Widget\Base\TElement;
use Adianti\Widget\Form\AdiantiWidgetInterface;
use Adianti\Widget\Form\TField;
use Adianti\Widget\Form\TLabel;
use Adianti\Control\TAction;

/**
 * CheckButton widget
 *
 * @version    7.5
 * @package    widget
 * @subpackage form
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class TCheckButton extends TField implements AdiantiWidgetInterface
{
    private $indexValue;
    private $useSwitch;
    private $labelClass;
    private $inactiveIndexValue;
    private $changeAction;
    protected $changeFunction;
    
    /**
     * Class Constructor
     * @param $name Name of the widget
     */
    public function __construct($name)
    {
        parent::__construct($name);
        $this->id = 'tcheckbutton_' . mt_rand(1000000000, 1999999999);
        $this->tag->{'class'} = '';
        $this->useSwitch  = FALSE;
    }
    
    /**
     * Show as switch
     */
    public function setUseSwitch($useSwitch = TRUE, $labelClass = 'blue')
    {
       $this->labelClass = 'tswitch ' . $labelClass;
       $this->useSwitch  = $useSwitch;
    }

    /**
     * Define the index value for check button
     * @index Index value
     */
    public function setIndexValue($index)
    {        
        $this->indexValue = $index;
    }

    /**
     * Define the index value for check button when inactive
     * @inactiveIndexValue Inactive index value
     */
    public function setInactiveIndexValue($inactiveIndexValue)
    {        
        $this->inactiveIndexValue = $inactiveIndexValue;
    }

    /**
     * Define the action to be executed when the user changes the combo
     * @param $action TAction object
     */
    public function setChangeAction(TAction $action)
    {
        if ($action->isStatic())
        {
            $this->changeAction = $action;
        }
        else
        {
            $string_action = $action->toString();
            throw new Exception(AdiantiCoreTranslator::translate('Action (^1) must be static to be used in ^2', $string_action, __METHOD__));
        }
    }
    
    /**
     * Set change function
     */
    public function setChangeFunction($function)
    {
        $this->changeFunction = $function;
    }

    /**
     * Return the post data
     */
    public function getPostData()
    {
        if (isset($_POST[$this->name]))
        {
            return $_POST[$this->name];
        }
        elseif($this->inactiveIndexValue)
        {
            return $this->inactiveIndexValue;
        }

        return '';
    }
    
    /**
     * Shows the widget at the screen
     */
    public function show()
    {
        // define the tag properties for the checkbutton
        $this->tag->{'name'}  = $this->name;    // tag name
        $this->tag->{'type'}  = 'checkbox';     // input type
        $this->tag->{'value'} = $this->indexValue;   // value
        
        if ($this->id and empty($this->tag->{'id'}))
        {
            $this->tag->{'id'} = $this->id;
        }
        
        // compare current value with indexValue
        if ($this->indexValue == $this->value AND !(is_null($this->value)) AND strlen((string) $this->value) > 0)
        {
            $this->tag->{'checked'} = '1';
        }
        
        $this->tag->{"data-value-on"} = '';
        $this->tag->{"data-value-off"} = '';
        if($this->indexValue)
        {
            $this->tag->{"data-value-on"} = $this->indexValue;
        }
        
        if($this->inactiveIndexValue)
        {
            $this->tag->{"data-value-off"} = $this->inactiveIndexValue;
        }
        
        if (isset($this->changeAction))
        {
            if (!TForm::getFormByName($this->formName) instanceof TForm)
            {
                throw new Exception(AdiantiCoreTranslator::translate('You must pass the ^1 (^2) as a parameter to ^3', __CLASS__, $this->name, 'TForm::setFields()') );
            }
            $string_action = $this->changeAction->serialize(FALSE);
            
            $this->tag->setProperty('changeaction', "__adianti_post_lookup('{$this->formName}', '{$string_action}', '{$this->id}', 'callback')");
            $this->tag->setProperty('onChange', $this->tag->getProperty('changeaction'), FALSE);
        }
        
        if (isset($this->changeFunction))
        {
            $this->tag->setProperty('changeaction', $this->changeFunction, FALSE);
            $this->tag->setProperty('onChange', $this->changeFunction, FALSE);
        }

        // check whether the widget is non-editable
        if (!parent::getEditable())
        {
            // make the widget read-only
            //$this->tag-> disabled   = "1"; // the value don't post
            $this->tag->{'onclick'} = "return false;";
            $this->tag->{'style'}   = 'pointer-events:none';
            $this->tag->{'tabindex'} = '-1';
        }
        
        if ($this->useSwitch)
        {
            $obj = new TLabel('');
            $obj->{'class'} = 'tswitch ' . $this->labelClass;
            $obj->{'for'} = $this->id;

            $this->tag->{'class'} = 'filled-in btn-tswitch';

            $wrapper = new TElement('div');
            $wrapper->{'style'} = 'display:inline-flex;align-items:center;';
            $wrapper->add($this->tag);
            $wrapper->add($obj);
            $wrapper->show();
        }
        else
        {
            // shows the tag
            $this->tag->show();
        }

    }
}
