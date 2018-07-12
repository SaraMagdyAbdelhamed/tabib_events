<?php

namespace Modules\Shops\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Shop;
use App\ShopBranch;
use App\ShopDay;
use App\ShopMedia;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;
use App\ShopBranchTime;
use App\Day;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['shops']=Shop::with('shop_branch')->with('shop_day')->with('shop_media')->get();
        foreach ($data['shops'] as $key => $value) {
            $value['photo']=url('/').'\/'.$value['photo'];
            foreach ($value['shop_media'] as $key1 => $value1) {
                if($value1['type'] == 1)
               $value1['link']=url('/').'\/'.$value1['link'];
            }
            // foreach ($value['shop_day'] as $key1 => $value1) {
            //    $day=Day::find($value1['day_id']);
            //    // dd($day);
            //    $value1['name']=$day->name;
            // }
        }

          // dd($data['shops']);
    	
    	return view('shops::shops.index',$data);
    }
     public function add()
    {
        
        return view('shops::shops.add');
    }

    public function edit($id)
    {
        $data['shop']=Shop::find($id);
    	// dd($data['shop']);
    	return view('shops::shops.edit',$data);
    }

    public function destroy($id)
    {
        Shop::destroy($id);
        ShopBranch::where('shop_id',$id)->delete();
        ShopDay::where('shop_id',$id)->delete();
        ShopMedia::where('shop_id',$id)->delete();
        return redirect()->route('shops');
    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach($ids as $id)
        {
          Shop::destroy($id);
        ShopBranch::where('shop_id',$id)->delete();
        ShopDay::where('shop_id',$id)->delete();
        ShopMedia::where('shop_id',$id)->delete();
        } 
        return  redirect()->route('shops');
    }

    public function add_shop(Request $request)
    {
         // dd($request->all());
         if(isset($request['is_active']))
         {
            $is_active=1;
         }
         else
         {
            $is_active=0;
         }
        $shop=Shop::create([
            "name"=>$request['place_name'],
            "phone"=>$request['phone'],
            "website"=>$request['website'],
            "info"=>$request['info'],
            "address"=>$request['place_address'],
            "longitude"=>$request['shop_long'],
            "latitude"=>$request['shop_lat'],
            "is_active"=>$is_active
        ]);
        if(isset($request['images']))
        {
            foreach ($request->images as $key => $file) {
            
            $destinationPath='shops_images';
            $fileNameToStore=$destinationPath.'/'.time().rand(111,999).'.'.$file->getClientOriginalExtension();
            // dd($fileNameToStore);
            Input::file('images')[$key]->move($destinationPath,$fileNameToStore);
            $shop->update(["photo"=>$fileNameToStore]);
            $shop_media=ShopMedia::create([
                    "shop_id"=>$shop->id,
                    "link"=>$fileNameToStore,
                    "type"=>1
                ]);
                 if($request['images_ar'][$key] != null)
               {
                $destinationPath='shops_images';
            $fileNameToStore=$destinationPath.'/'.time().rand(111,999).'.'.$file->getClientOriginalExtension();
            // dd($fileNameToStore);
            Input::file('images_ar')[$key]->move($destinationPath,$fileNameToStore);
                Helper::add_localization(21,'link',$shop_media->id,$fileNameToStore,2);
                }
                else
                {
                    Helper::add_localization(21,'link',$shop_media->id,$fileNameToStore,2);
                }
        }
        }
        else
        {
            $shop->update(["photo"=>"img/default.jpg"]);
        }
        // dd($request->all());
        if(isset($request['place_name_ar']))
        {
            Helper::add_localization(10,'name',$shop->id,$request['place_name_ar'],2);
        }
        else
        {
            Helper::add_localization(10,'name',$shop->id,$request['place_name'],2);
        }
         if(isset($request['info_ar']))
        {
            Helper::add_localization(10,'info',$shop->id,$request['info_ar'],2);
        }
        else
        {
            Helper::add_localization(10,'info',$shop->id,$request['info'],2);
        }
        if(isset($request['days']))
        {
            foreach ($request['days'] as $key => $value) {
                ShopDay::create([
                    'shop_id'=>$shop->id,
                    'day_id'=>$key
                ]);
            }
        }
        if(isset($request['video']))
        {
            foreach ($request['video'] as $key => $value) {
                $value=str_replace('watch?v=', 'embed/', $value);
               if($value != null)
               {
                $shop_media=ShopMedia::create([
                    "shop_id"=>$shop->id,
                    "link"=>$value,
                    "type"=>2
                ]);
                 if($request['video_ar'][$key] != null)
               {
                //    dd( $request['video_ar'][$key]);
                // $value_ar= $request['video_ar'][$key];
                $value_ar=str_replace('watch?v=', 'embed/', $request['video_ar'][$key]);
                Helper::add_localization(21,'link',$shop_media->id,$value_ar,2);
                }
                else
                {
                    Helper::add_localization(21,'link',$shop_media->id,$value,2);
                }
               }
              
            }
        }
        if(isset($request['branch_name']))
        {
            foreach ($request['branch_name'] as $key => $value) {
               $branch= ShopBranch::create([
                    "shop_id"=>$shop->id,
                    "branch"=>$value,
                    "address"=>$request['branch_address'][$key],
                     "longtuide"=>$request['branch_long'][$key],
                    "latitude"=>$request['branch_lat'][$key]
                ]);
               foreach ($request['days'] as $key1 => $value1) {
                ShopBranchTime::create([
                    'branch_id'=>$branch->id,
                    'day_id'=>$key1,
                    'from'=>date("H:i:s a", strtotime($request['branch_start'][$key])),
                    'to'=>date("H:i:s a", strtotime($request['branch_end'][$key]))
                ]);
            }


            Helper::add_localization(20,'branch',$branch->id,$request['branch_name_ar'][$key],2);
            }
        }
    // dd($request->all());
    return  redirect()->route('shops');
    }

    public function edit_shop(Request $request,$id)
    {
        if(isset($request['is_active']))
         {
            $is_active=1;
         }
         else
         {
            $is_active=0;
         }
 $shop=Shop::find($id);
 $shop->update([
            "name"=>$request['place_name'],
            "phone"=>$request['phone'],
            "website"=>$request['website'],
            "info"=>$request['info'],
            "address"=>$request['place_address'],
            "longitude"=>$request['shop_long'],
            "latitude"=>$request['shop_lat'],
            "is_active"=>$is_active
 ]);
  if(isset($request['place_name_ar']))
        {
            Helper::edit_entity_localization('shops','name',$shop->id,2,$request['place_name_ar']);
        }
        else
        {
            Helper::edit_entity_localization('shops','name',$shop->id,2,$request['place_name']);
        }
         if(isset($request['info_ar']))
        {
            Helper::edit_entity_localization('shops','info',$shop->id,2,$request['info_ar']);
        }
        else
        {
            Helper::edit_entity_localization('shops','info',$shop->id,2,$request['info']);
        }
        if(isset($request['days']))
        {
            ShopDay::where('shop_id',$id)->delete();
            foreach ($request['days'] as $key => $value) {
                ShopDay::create([
                    'shop_id'=>$shop->id,
                    'day_id'=>$key
                ]);
            }
        }
  if(isset($request['images']))
        {
            foreach ($request->images as $key => $file) {
            
            $destinationPath='shops_images';
            $fileNameToStore=$destinationPath.'/'.time().rand(111,999).'.'.$file->getClientOriginalExtension();
            // dd($fileNameToStore);
            Input::file('images')[$key]->move($destinationPath,$fileNameToStore);
            $shop->update(["photo"=>$fileNameToStore]);
            $shop_media=ShopMedia::create([
                    "shop_id"=>$shop->id,
                    "link"=>$fileNameToStore,
                    "type"=>1
                ]);
                 if($request['images_ar'][$key] != null)
               {
                $destinationPath='shops_images';
            $fileNameToStore=$destinationPath.'/'.time().rand(111,999).'.'.$file->getClientOriginalExtension();
            // dd($fileNameToStore);
            Input::file('images_ar')[$key]->move($destinationPath,$fileNameToStore);
                Helper::add_localization(21,'link',$shop_media->id,$fileNameToStore,2);
                }
                else
                {
                    Helper::add_localization(21,'link',$shop_media->id,$fileNameToStore,2);
                }
        }
        }
          if(isset($request['video']))
        {
            ShopMedia::where('shop_id',$id)->where('type',2)->delete();
            foreach ($request['video'] as $key => $value) {
               if($value != null)
               {
                $shop_media=ShopMedia::create([
                    "shop_id"=>$shop->id,
                    "link"=>$value,
                    "type"=>2
                ]);
                 if($request['video_ar'][$key] != null)
               {
                Helper::add_localization(21,'link',$shop_media->id,$request['video_ar'][$key],2);
                }
                else
                {
                    Helper::add_localization(21,'link',$shop_media->id,$value,2);
                }
               }
              
            }
        }
        ShopBranch::where('shop_id',$shop->id)->delete();
         if(isset($request['branch_name']))
        {
            // dd($request['branch_name']);
            foreach ($request['branch_name'] as $key => $value) {
               $branch= ShopBranch::create([
                    "shop_id"=>$shop->id,
                    "branch"=>$value,
                    "address"=>$request['branch_address'][$key],
                    "longtuide"=>$request['branch_long'][$key],
                    "latitude"=>$request['branch_lat'][$key]
                ]);
               foreach ($request['days'] as $key1 => $value1) {
                ShopBranchTime::create([
                    'branch_id'=>$branch->id,
                    'day_id'=>$key1,
                    'from'=>date("H:i:s a", strtotime($request['branch_start'][$key])),
                    'to'=>date("H:i:s a", strtotime($request['branch_end'][$key]))
                ]);
            }

            // Helper::remove_localization(20, $field, $item_id, $lang_id);
            Helper::add_localization(20,'branch',$branch->id,$request['branch_name_ar'][$key],2);
            }
        }
 return  redirect()->route('shops');
    }
}
