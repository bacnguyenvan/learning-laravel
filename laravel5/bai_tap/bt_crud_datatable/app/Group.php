<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Group extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'group_id'; 

    public static function new($inputs)
    {
    	$newGroup = new Group();
    	if($newGroup->insert($inputs)) return true;

    	return false;
    }

    public static function updateGroup($inputs,$id)
    {
        return self::where('group_id',$id)->update($inputs);

    }

    public static function getByPK($id)
    {
        return self::find($id);
    }

    public static function getParentId($id){
        return self::where('delete_flag','<>',1)->where('group_parent_id',$id)->get();
    }

    public static function getNameGroup($name){
        return self::where('delete_flag','<>',1)->where('group_name',$name)->get();
    }

    public static function getGroupId($id){
        return self::where('delete_flag','<>',1)->where('group_id',$id)->first();
    }

    public static function checkUniqueMultiple($tableName,$params,$isEdit = [] , $msg = '')
    {
        $msgPR = '';
        $query = DB::table($tableName);
        foreach($params as $key => $val){
            $query = $query->where($key,$val);
        }
        if(count($isEdit)>0){
            $query = $query->where($isEdit[0],'<>',$isEdit[1]);
        }
    
        $query = $query->get();
        if(count($query)>0){
            $msgPR = $msg;
        }
        return $msgPR;
    }
    

    public static function getListGroup($checkIsShowEdit=false,$showEditDelete=true)
    {
    	$html = '';
    	$lists = Group::where('delete_flag','<>',1)->whereNull('group_parent_id')->get();
        
      
    	$html .= '<ul class="dropdown_group col-lg-12" style="padding-left: 0px;">';
        
    	foreach($lists as $item){

            $lists_child = self::getParentId($item->group_id);

            if($checkIsShowEdit){
        		$html .= '<li class="mt-1"><input type="radio" id="group_'.$item['group_id'].'" name="group" value="'.$item['group_id'].'">';
                if(count($lists_child)>0){
                    $html .='<label for="group_'.$item['group_id'].'">
                        <span data-toggle="collapse" data-target="#selectGroupList_'.$item['group_id'].'" class="fa fa-plus mr-2"></span>'.$item['group_name'].'</label>
                    <ul class="dropdown_group collapse" id="selectGroupList_'.$item['group_id'].'">';
                    foreach($lists_child as $item_child){

                        $html .='<li>
                            <input type="radio" id="group_'.$item_child['group_id'].'" name="group" value="'.$item_child['group_id'].'">
                            <label for="group_'.$item_child['group_id'].'">'.$item_child['group_name'].'</label>
                        </li>';

                       
                    
                    }
                    $html .='</ul>';
                }else{
                    $html .='<label for="group_'.$item['group_id'].'">'.$item['group_name'].'</label>';
                }
                  
                $html .= '</li>';
                   
            }else{
                $html .= '<li class="mt-1">
                            <input type="checkbox" id="group_'.$item['group_id'].'" name="group_id[]" value="'.$item['group_id'].'" class="input_group">';
                            
                if(count($lists_child)>0){
                    $html .='<label for="group_'.$item['group_id'].'">
                        <span data-toggle="collapse" data-target="#selectGroupList_'.$item['group_id'].'" class="fa fa-plus mr-2"></span>'.$item['group_name'];

                            if($showEditDelete){
                                
                                $html .= '<div class="float-right"> 
                                    <a class="mr-2" href="'.route('mapping_edit',['id'=>$item['group_id']]).'"><i class="fa fa-pencil"></i></a>
                                    <a class="btn_delete" href="'.route('mapping_delete',['id'=>$item['group_id'] ]).'"><i class="fa fa-close"></i></a>
                                </div>';
                            }
                            $html.='

                        </label>
                    <ul class="dropdown_group collapse" id="selectGroupList_'.$item['group_id'].'">';
                    foreach($lists_child as $item_child){

                        $html .='<li>
                            <input type="checkbox" id="group_'.$item_child['group_id'].'" name="group_id[]" value="'.$item_child['group_id'].'" class="input_group">
                            <label for="group_'.$item_child['group_id'].'">'.$item_child['group_name'];
                                if($showEditDelete){
                                
                                    $html .= '<div class="float-right"> 
                                        <a class="mr-2" href="'.route('mapping_edit',['id'=>$item_child['group_id']]).'"><i class="fa fa-pencil"></i></a>
                                        <a class="btn_delete" href="'.route('mapping_delete',['id'=>$item_child['group_id'] ]).'"><i class="fa fa-close"></i></a>
                                    </div>';
                                }

                                $html .= '

                            </label>
                        </li>';
                    }
                    $html .='</ul>';
                }else{
                    $html .='<label for="group_'.$item['group_id'].'">'.$item['group_name'];
                        
                        if($showEditDelete){
                                
                            $html .= '<div class="float-right"> 
                                <a class="mr-2" href="'.route('mapping_edit',['id'=>$item['group_id']]).'"><i class="fa fa-pencil"></i></a>
                                <a class="btn_delete" href="'.route('mapping_delete',['id'=>$item['group_id'] ]).'"><i class="fa fa-close"></i></a>
                            </div>';
                        }
                                
                            $html .= '

                    </label>';
                }

                $html .= '</li>';
            }

            
    	}
				
		$html .= '</ul>';

		return $html;

// <span data-toggle="collapse" data-target="#selectGroupList_3">
// 	<b><i class="fa fa-plus"></i></b>
// </span>
// <ul class="collapse" id="selectGroupList_3">
// 						<li  class="form-control mt-2">Nhóm 3-1</li>
// 						<li  class="form-control mt-2">Nhóm 3-2</li>
// 						<li  class="form-control mt-2 mb-2">Nhóm 3-3</li>
// </ul>


// <ul class="dropdown_group col-lg-12" style="padding-left: 0px;">
//      <li class="mt-1">
//          <input type="radio" id="group_1" name="group" value="1">
//              <label for="group_1">
//                  <span data-toggle="collapse" data-target="#selectGroupList_1" class="fa fa-plus mr-2"></span>Nhóm 1
//              </label>

        // <ul class="dropdown_group collapse" id="selectGroupList_1">
        //     <li>
        //         <input type="radio" id="group_3" name="group" value="3">
        //         <label for="group_3">Nhóm 1-1</label>
        //     </li>
        //     <li>
        //         <input type="radio" id="group_4" name="group" value="4">
        //         <label for="group_4">Nhóm 1-2</label>
        //     </li>
        // </ul>
// 
//</li> </ul>

    }

    public function getListChild(){
        return $this->hasMany('App\Group','group_parent_id','group_id')
                    ->where('delete_flag',0);
    }
}
