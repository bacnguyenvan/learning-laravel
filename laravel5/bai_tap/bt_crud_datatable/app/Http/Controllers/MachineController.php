<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Machine;
use Validator;
use App\Http\Requests\MachineRequest;
use Response; 

class MachineController extends Controller
{
    
    public function list(Request $request)
    {
        
        $isExport = ($request->export == 'false'|| !isset($request->export)) ? false : true;
        $inputs = [
            'group_id' => $request->input('group_id',[]),
            'from_date' => $request->input('from_date',''),
            'to_date' => $request->input('to_date',''),
            'machine_id' => $request->input('machine_id',''),
            'free_word' => $request->input('free_word',''),

        ];

        if($isExport){
            return $this->export($request);
        }else{
            $data['listMachine'] = Machine::getListMachine();
        
            
            $data['lists'] = Machine::search($inputs);
            
            return view('machine.list',$data);
            }
        
    }

    public function new(Request $request)
    {
    	
        $msg = '';
        $sucess = false;
    	$inputs = [
            'machine_name' => $request->machine_name,
            'id_group' =>  $request->input('group_id','')
        ];

    	if($request->isMethod('post')){
    		
            $validation = new MachineRequest();
            $rules = $validation->rules();
            $messages = $validation->messages();

            if(!$inputs['machine_name']==''){
                $rules['machine_name'] = 'unique:machine';
            }

            $validator = Validator::make($inputs,$rules,$messages);
            if(!$validator->fails()){
               
                $newMachine = Machine::new($inputs);
                if($newMachine){
                    $msg = 'Tạo máy thành công';
                    $sucess = true;
                }else{ }

                
            }else{
                $msg = $this->_buildErrorMessages($validator); 
            }

    	}

        if($sucess){
            return redirect()->route('machine-list')->with('msg',$msg);
        }
        
    	return view('machine.new')->with('msg',$msg);
    }

    public function edit(Request $request,$id)
    {
        $machine = Machine::getByPK($id);
        $success = false;
        $msg = '';
        if(empty($machine)) abort('404');

        $data = $machine->getAttributes();

        $group = Group::getByPK($machine->id_group);
        if($group){
            $data['group_name'] = $group->group_name;
        }else{
            $data['group_name'] = '';
        }

        if($request->isMethod('post')){
            $inputs = [
                'machine_name' => $request->machine_name,
                'id_group' =>  $request->group_id
            ];

            
            $validate = new MachineRequest();
            $rules = $validate->rules();
            $messages = $validate->messages();

            $validator = Validator::make($inputs,$rules,$messages);
            if(!$validator->fails()){

                //check unique 
                $msg = Group::checkUniqueMultiple('machine',$inputs,['delete_flag',1],'Tên máy đã được đăng kí trong nhóm này , vui lòng đăng kí tên khác.');
                if($msg == ''){
                    
                    $resultUpdate = Machine::updateMachine($inputs,$id);
                    if($resultUpdate){
                        $success = true;
                        $msg = 'Chỉnh sửa thành công';
                    }else{}
                }else{
                    $data['msg'] = $msg;
                }

            }else{
                $data['msg'] = $this->_buildErrorMessages($validator);
            }
            
            

        }


        if($success) return redirect()->route('machine-list')->with('msg',$msg);
       

        return view('machine.edit',$data);
    }

    public function delete(Request $request)
    {

        $listDelete = $request->listDelete;
        if(!empty($listDelete)){
            $resultDelete = Machine::deleteMachine($listDelete);

        }else{ }

        if($resultDelete) return redirect()->route('machine-list')->with('msg','Xóa thành công !');


    }

    public function export(Request $request)
    {
        
        $headers = array(
            "Content-type"          => "text/csv;charset=UTF-8",
            'Content-Encoding: UTF-8',
            "Content-Disposition"   => "attachment; filename=file.csv",
            "Pragma"                => "no-cache",
            "Cache-Control"         => "must-revalidate, post-check=0, pre-check=0",
            "Expires"               => "0"
        );

        $inputs = [
            'from_date' => $request->input('from_date',''),
            'to_date' => $request->input('to_date',''),
            'machine_id' => $request->input('machine_id',''),
            
        ];

        $dataExport = Machine::search($inputs);

        
        if(count($dataExport)!=0){
            
            $columns = [ 'ID machine','Name','Group','Start date' ];
            // $columns = Machine::changeCharset($columns);

            $fileName = "Machine";
            $getFile  = Machine::setFileName($fileName);
            $file     = fopen($getFile['pathFileName'],'w+');

            fputcsv($file,$columns);
            foreach($dataExport as $items){
                $rows = [
                    $items->machine_id,
                    $items->machine_name,
                    $items->id_group,
                    $items->created_at
                ];
                $rows = Machine::changeCharset($rows);
                fputcsv($file,$rows);

            }
            fclose($file);

            return Response::download($getFile['pathFileName'],$getFile['fileName'],$headers);

        }else{  //result hasn't record
            // Session::flash('error', 'không có kết quả record');  -> use Session
            return redirect()->back()->with('error','không có kết quả record');

        }



    }

    

    // public function validateMachine($request)
    // {
    // 	$request->validate([
    // 		'machine_name'=>'required|unique:machine'],['required' => 'Vui lòng nhập vào machine name',
    // 		'unique' => 'Machine name đã tồn tại, vui lòng nhập name khác.'
    // 	]);
    // }
   
}