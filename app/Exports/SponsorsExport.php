<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Formula_Contract_Types;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

use App\Offer;

class SponsorsExport implements FromCollection,WithEvents
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
        $offersArray = array(['رقم','اسم الراعي','عنوان العرض','عدد المشاهدات','عدد الاتصالات']) ;
        if(is_null($this->ids)){

        $offers = Offer::all();
        foreach($offers as $offer)
        {
            array_push($offersArray,[$offer->id,$offer->user->username,$offer->name,$offer->number_of_views,$offer->number_of_calls]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            $offer = Offer::find($select);
            array_push($offersArray,[$offer->id,$offer->user->username,$offer->name,$offer->number_of_views,$offer->number_of_calls]);
            } 
        }
        
        return collect($offersArray);
    }

}
