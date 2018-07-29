<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Formula_Contract_Types;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

use App\EventBackend;

class EventsExport implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;
    public function __construct($ids=null){
        $this->ids=$ids;
    }




        public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->Bolding('A1:E1');
                $event->sheet->Right();
            }
        ];
    }
    
    public  function collection()
    {   
        $eventsArray = array(['رقم','اسم المنظم','اسم الايفينت','فئه الايفينت','مجانى/مدفوع','عدد الحاضرين']) ;
        if(is_null($this->ids)){

        $events = EventBackend::all();
        foreach($events as $event)
        {
            $is_paid = $event['is_paid'] ? 'مدفوع' : 'مجانى';
            $class='';
            foreach($event->categories as $category){
                $class .= $category['name'].'|';
            }
            array_push($eventsArray,[$event->id,$event->user->username,$event->name,$class,$is_paid,100]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            $event = EventBackend::find($select);
            $is_paid = $event['is_paid'] ? 'مدفوع' : 'مجانى';
            $class='';
            foreach($event->categories as $category){
                $class .= $category['name'].'|';
            }
            array_push($eventsArray,[$event->id,$event->user->username,$event->name,$class,$is_paid,100]);
            } 
        }
        
        return collect($eventsArray);
    }

}
