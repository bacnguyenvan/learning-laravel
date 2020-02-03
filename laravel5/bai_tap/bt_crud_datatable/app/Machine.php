<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
class Machine extends Model
{
   const csv_path = 'storage/csv/';
   protected $table = 'machine';
   protected $primaryKey = 'machine_id';
   
   public static function new($inputs)
   {
   		$newMachine = new Machine();
   		if($newMachine->insert($inputs)) return true;
   		return false;
   }

   public static function getListMachine()
   {
   	return self::where('delete_flag',0)->get();	
   }

   public static function getByPK($id)
   {
      return self::find($id);
   }
   
   public static function updateMachine($inputs,$id)
   {
      return self::where('machine_id',$id)->update($inputs);
   }

   public static function deleteMachine($listDelete)
   {
      return self::whereIn('machine_id',$listDelete)->update(['delete_flag'=>1]);
   }

   public static function search($inputs)
   {
      $query = self::query();

      // default query
      $query->where('delete_flag',0);

      if(!empty($inputs['group_id'])){
         $query->whereIn('id_group',$inputs['group_id']);
      }

      if($inputs['from_date']){
         $query->whereDate('created_at',">=",$inputs['from_date']);
        
      }

      if($inputs['to_date']){
         $query->whereDate('created_at',"<=",$inputs['to_date']);
      }

      if($inputs['machine_id']){
         $query->where('machine_id',$inputs['machine_id']);
      }

      if(!empty($inputs['free_word'])){
         $query->where('machine_name','LIKE','%'.$inputs['free_word'].'%');
      }


      $lists = $query->get();

      return $lists;

   }

   public static function changeCharset($items)
   {
      $tmp = [];
      $value_utf8 = '';
      foreach($items as $value){
         // $value = (string)$value;
         // for($i = 0 ; $i < strlen($value); $i++){
         //    $value_utf8 .= $value[$i]."\x00";
         // }
         $value = implode('\x00', preg_split('//u', $value, null, PREG_SPLIT_NO_EMPTY));
         // $value = mb_convert_encoding($value, "UTF-16LE","UTf-8");
         
         array_push($tmp,$value);
      }
     dd($tmp);

      return $tmp;
   }
   public static function setFileName($fileName)
   {
      $data = [];
      $path = self::csv_path;

      if(!is_dir($path)){
         try{
            File::makeDirectory($path,0777,true);
         }catch(Exception $e){
            die($e->getMessage());
         }
      }

      $now = date("Y-m-d");
      $data['pathFileName'] = $path . $fileName  ."_" . $now . '.csv';
      $data['fileName'] = $fileName . "_" . $now . '.csv';

      return $data;
   }


}
