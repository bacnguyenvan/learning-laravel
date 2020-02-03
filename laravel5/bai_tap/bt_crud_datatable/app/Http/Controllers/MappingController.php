<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
// use Validator;
class MappingController extends Controller
{
    public function list()
    {
        $lists = Group::getListGroup();
       
    	return view('mapping_master.list',['lists'=>$lists]);
    }

    public function new(Request $request)
    {
    	$inputs = [
    		'group_name' => $request->group_name,
            'group_parent_id' => $request->select_group 
    	];
        $msg ='';

        $select_group = $request->select_group;
        
        $list = Group::getListGroup(true);

    	$success = false;
    	if($request->isMethod('post')){
    		$this->validateGroup($request);
            $msg = $this->checkValidateUnique($inputs['group_name']);


            if(!$msg){
                $newGroup = Group::new($inputs);
                if($newGroup){
                    $msg = 'Tạo nhóm thành công';
                    $success = true;
                }

            }else { }
    		
    		
    	}

    	if($success) return redirect()->route('mapping-list')->with('msg',$msg);


    	return view('mapping_master.new',['list'=>$list,'msg'=>$msg]);
    }

    public function edit(Request $request,$id)
    {
        $group = Group::getByPK($id);
        if(empty($group)) abort('404');

        $data = $group->getAttributes();
        

        $data['list'] = Group::getListGroup(true);

        if($request->isMethod('post')){
            $this->validateGroup($request);

            $inputs = [
                'group_name' => $request->group_name,
                'group_parent_id' => $request->select_group,

            ];


            $msg = Group::checkUniqueMultiple('groups',$inputs,['delete_flag',1],'Tên nhóm đã được đăng kí trong nhóm này , vui lòng đăng kí tên khác.');

            if($msg == ''){
                $resultUpdate = Group::updateGroup($inputs,$id);
                if($resultUpdate){

                    return redirect()->route('mapping-list')->with('msg','Cập nhật thành công');
                }
            }else {
                $data['msg'] = $msg;
            }
            


        }

        return view('mapping_master.edit',$data);
    }

    public function delete($id)
    {
        $group = Group::getByPK($id);
        
        $hasChild = $group->getListChild()->count();
        $msg = '';
        $msg_err = '';
        if($hasChild == 0){
            
            $group->delete_flag = 1;
            if($group->save()){
                $msg = 'Xóa thành công !';
            }

        }else{
            $msg_err = 'Dữ liệu không thể bị xóa vì có dữ liệu liên kết với nhóm này.';
        }

        return redirect()->route('mapping-list')->with(['msg'=>$msg,'msg_err'=>$msg_err]);
       
    }
    public function validateGroup($request)
    {
    	$request->validate([
    		'group_name' => 'required'
    	],['required' => 'Vui lòng nhập vào group name']);
    }

    public function checkValidateUnique($name)
    {
        $getName = Group::getNameGroup($name);
        $msg = '';
        if(count($getName)>0)
            $msg = 'Tên Nhóm đã tồn tại, vui lòng nhập lại tên khác';
        return $msg;
    }

}
