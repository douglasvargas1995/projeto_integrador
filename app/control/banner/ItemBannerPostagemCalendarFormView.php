<?php
/**
 * ItemBannerPostagemCalendarForm Form
 * @author  <your name here>
 */
class ItemBannerPostagemCalendarFormView extends TPage
{
    private $fc;

    /**
     * Page constructor
     */
    public function __construct($param = null)
    {
        parent::__construct();

        $this->fc = new TFullCalendar(date('Y-m-d'), 'month');
        $this->fc->enableDays([0,1,2,3,4,5,6]);
        $this->fc->setReloadAction(new TAction(array($this, 'getEvents'), $param));
        $this->fc->setDayClickAction(new TAction(array('ItemBannerPostagemCalendarForm', 'onStartEdit')));
        $this->fc->setEventClickAction(new TAction(array('ItemBannerPostagemCalendarForm', 'onEdit')));
        $this->fc->setEventUpdateAction(new TAction(array('ItemBannerPostagemCalendarForm', 'onUpdateEvent')));
        $this->fc->setCurrentView('agendaWeek');
        $this->fc->setTimeRange('00:00', '23:00');
        $this->fc->enablePopover('Informações Postagem', " INICIO - {data_inicio} <br> FIM -  {data_fim} <br> Obs:  {obs} ");
        $this->fc->setOption('slotTime', "00:30:00");
        $this->fc->setOption('slotDuration', "00:30:00");
        $this->fc->setOption('slotLabelInterval', 30);

        parent::add( $this->fc );
    }

    /**
     * Output events as an json
     */
    public static function getEvents($param=NULL)
    {
        $return = array();
        try
        {
            TTransaction::open('microerp');

            $criteria = new TCriteria(); 

            $criteria->add(new TFilter('data_inicio', '<=', substr($param['end'], 0, 10).' 23:59:59'));
            $criteria->add(new TFilter('data_fim', '>=', substr($param['start'], 0, 10).' 00:00:00'));

            $events = ItemBannerPostagem::getObjects($criteria);

            if ($events)
            {
                foreach ($events as $event)
                {
                    $event_array = $event->toArray();
                    $event_array['start'] = str_replace( ' ', 'T', $event_array['data_inicio']);
                    $event_array['end'] = str_replace( ' ', 'T', $event_array['data_fim']);
                    $event_array['id'] = $event->id;
                    $event_array['color'] = $event->render("{tipo_postagem->cor}");
                    $event_array['title'] = TFullCalendar::renderPopover($event->render(" {id} - {tipo_postagem->descricao}<br> {banner->pessoa->nome} "), $event->render("Informações Postagem"), $event->render(" INICIO - {data_inicio} <br> FIM -  {data_fim} <br> Obs:  {obs} "));

                    $return[] = $event_array;
                }
            }
            TTransaction::close();
            echo json_encode($return);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }

    /**
     * Reconfigure the callendar
     */
    public function onReload($param = null)
    {
        if (isset($param['view']))
        {
            $this->fc->setCurrentView($param['view']);
        }

        if (isset($param['date']))
        {
            $this->fc->setCurrentDate($param['date']);
        }
    }

}

