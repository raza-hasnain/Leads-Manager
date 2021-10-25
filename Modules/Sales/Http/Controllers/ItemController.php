<?php

namespace Modules\Sales\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Sales\Entities\Item;
use Modules\Sales\Entities\ItemCategory;
Use Modules\Sales\Http\Requests\ItemStoreRequest;
Use Modules\Sales\Http\Requests\ItemCategoryStoreRequest;
Use Modules\Sales\Http\Requests\ItemCategoryUpdateRequest;
Use Modules\Sales\Http\Requests\ItemUpdateRequest;
use App\Exports\ItemExport;
use App\Imports\ItemImport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\User;
use DataTables;
use Auth;
use DB;
use App\Http\Controllers\BaseController;

class ItemController extends BaseController
{
    public function index(Request $request){
        if(!$this->user->can('browse_items',app('Modules\Sales\Entities\Estimate'))){
            return redirect()->route('home')->with('flash',array('status'=>'error','message'=>'permission denied'));
        }
        if ($request->ajax()) {
            $data = Item::with('item_category')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btnEdit ="";
                    $btnDel ="";
                if($this->user->can('edit_items',app('Modules\Sales\Entities\Estimate'))){
                    $btnEdit = '<a class="btn btn-primary-soft btn-sm mr-1 edit-tr" id="edit-tr-'.$row->id.'"><i class="fas fa-edit text-primary"></i></a>';
                    }
                    if($this->user->can('delete_items',app('Modules\Sales\Entities\Estimate'))){
                    $btnDel = '<a class="btn btn-danger-soft btn-sm delete-tr" id="delete-tr-'.$row->id.'"><i class="far fa-trash-alt cursor-pointer text-danger"></i></a>';
                    }
                    return $btnEdit.$btnDel;
                })
                ->addColumn('input',function($row){
                    $input = '<input type="checkbox" class="data-input ml-1"  name="data[]"  value="'.$row->id.'" >';
                    return $input;
                })
                ->editColumn('item_category.name', function($row) {
                    $category_name = "";
                    if ($row->item_category_id == null) {
                        $category_name = "N/A";
                    }else{
                        $category_name = clean($row->item_category->name);
                    }
                    return clean($category_name);
                })->editColumn('name',function($row){
                    $name = clean($row->name);
                    return $name;
                })->editColumn('description', function ($row){
                     return clean($row->description);
                })
            ->rawColumns(['action','input'])
            ->make(true); exit;
        }
        return view('sales::item.index') ;
    }

     public function createitem(ItemStoreRequest $request){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('add_items',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        if($request->isMethod('post')){
            try{
                $data=$request->all();
                $data['created_by']= Auth::user()->id;
                $data['item_id']= generateRandomStr();
                $item = Item::createItem($data);
                return response()->json(['status'=>'success'], 200);
            }
            catch(\Exception $e){
                return response()->json(['status'=>$e->getMessage()], 500);
            }
        }else{
            $categories = ItemCategory::get();
            return view('sales::item.addItem',compact('categories'));
        }

     } 
    public function edititem(ItemUpdateRequest $request,$item_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('edit_items',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        if($request->isMethod('post')){

            try{  
                $item=Item::findOrFail($item_id);
                $data=$request->all();  
                $data['updated_by']=Auth::user()->id;
                Item::updateItem($data,$item_id);
                return response()->json(['status'=>'success'], 200);

            }catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }   

        }else{

            $item=Item::findOrFail($item_id);
            $categories = ItemCategory::get();
            return view('sales::item.edit',compact('item','categories'));exit;
            
        }
    }

    public function deleteitem(Request $request,$item_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('delete_items',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        try{
            $item=Item::findOrFail($item_id);
            $item->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }   
    }
    /**
    * Export Controllers
    */

    public function export_excel_file() 
    {
        $excel = Excel::download(new ItemExport, 'items.xlsx');
        ob_end_clean();
        return $excel;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export_csv_file() 
    {
        $csv = Excel::download(new ItemExport, 'items.csv');
        ob_end_clean();
        return $csv;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export_pdf_file() 
    {
        $pdf_style = '<style>
            *{
        font-size:12px;
            }
        </style>';
        $title = __('menu.Items');
        $items = Item::get_items();
        $pdf = PDF::loadView('sales::item.items',compact('items','title','pdf_style'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream("Items.pdf");
       
    }

    public function print_file() 
    {
        $pdf_style = '<style>
            *{
        font-size:12px;
            }
        </style>';
        $title = __('menu.Items');
        $items = Item::get_items();
        $pdf = PDF::loadView('sales::item.items',compact('items','pdf_style','title'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream("items.pdf", array("Attachment" => false));
    }

    // Import Controllers

    public function import_file(Request $request,$file_type='')
    {
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('add_items',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        if($request->isMethod('post')){
            $request->validate([
                'import_file' => 'required',
                ]);
            try{
                $files = $request->file('import_file');  
                $import = Excel::import(new ItemImport,$files);
                return response()->json(['status'=>'success'], 200);
            }catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }   
        }else{
            $file_type_id = $file_type;
            return view('sales::item.import_file',compact('file_type_id'));exit;  
        }     
    }
    public function download($file_type_id)
    {
        try {
            if ($file_type_id == 1) {
                $excel = Storage::download('excel/demo/items.xlsx');
                  ob_end_clean();
        return $excel;
            }else{
                $csv = Storage::download('csv/demo/items.csv');
                ob_end_clean();
        return $csv;
            }
            

        } catch (DecryptException $e) {
            //
            abort(404);
        }
    }

/*Item_Categories_Settings*/
    public function settings(){
        return view('sales::settings');
    }
    public function viewcategory()
    {
        return view('sales::item.categories') ;
    }
    public function categories(Request $request){
        if ($request->ajax()) {
            $data = ItemCategory::with('parent_category')->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $btnEdit ="";
                    $btnDel ="";
                    $btnEdit = '<a class="btn btn-primary-soft btn-sm mr-1 edit-tr" id="edit-tr-'.$row->id.'"><i class="fas fa-edit text-primary"></i></a>';
                    $btnDel = '<a class="btn btn-danger-soft btn-sm delete-tr" id="delete-tr-'.$row->id.'"><i class="far fa-trash-alt cursor-pointer text-danger"></i></a>';
                        
                    return $btnEdit.$btnDel;
                })->editColumn('name',function($row){
                    return clean($row->name);
                })
                ->editColumn('parent_category.name', function($row){
                    if ($row->parent_category) {
                        $name =clean($row->parent_category->name);
                    }else{
                        $name = 'N/A';
                    }
                    return $name;
                })
            ->rawColumns(['parent_category.name','action'])
            ->make(true); exit;
        }
    }
    public function createcategory(ItemCategoryStoreRequest $request){

        if($request->isMethod('post')){
            try{
                $request->validate([
                'name' => 'required'
                ]);
               
                $data=$request->all();
                $item = ItemCategory::createItemCategory($data);
                  $msg = __('msg.create_successfully');
                return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'sales'], 200);exit;
            }
            catch(\Exception $e){
                return response()->json(['status'=>$e->getMessage()], 500);
            }
        }else{
            $categories = ItemCategory::select('id','name')->where('parent_id',null)->get();
            return view('sales::item.addcategories',compact('categories'));
        }

     } 
    public function editcategory(ItemCategoryUpdateRequest $request,$item_id){

        if($request->isMethod('post')){

            try{  
                $item=ItemCategory::findOrFail($item_id);
                $data=$request->all();  
                ItemCategory::updateItemCategory($data,$item_id);
                $msg = __('msg.create_successfully');
                return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'sales'], 200);exit;

            }catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }   

        }else{
            $item=ItemCategory::findOrFail($item_id);
            $categories = ItemCategory::select('id','name')->where('parent_id',null)->get();
            return view('sales::item.editcategory',compact('item','categories'));exit;
            
        }
    }
    function deleteitemCategory(Request $request,$item_id){

        try{
            $item=ItemCategory::findOrFail($item_id);
            $item->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }   
    }
    public function get_item(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("items")
                    ->select("id","name")
                    ->where('name','LIKE',"%$search%")
                    ->get();
        }
        return response()->json($data);
    }
    public function get_item_details($item_id)
    {
        $item = Item::whereId($item_id)->select(DB::raw('id,name,description,rate,unit'))->first();
        $item_details=json_encode( $item);
        return $item_details;
    }

}
