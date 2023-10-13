<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChailCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ChailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
   public function index(Request $request)
       {
           if ($request->ajax()) {
               $data=ChailCategory::latest()->get();
               return DataTables::of($data)
                       ->addIndexColumn()
                       ->editColumn('category_name',function($row){
                           return $row->category->category_name;
                       })
                      ->editColumn('subcategory_name',function($row){
                           return $row->subcategory->subcategory_name;
                       })
                       ->addColumn('action', function($row){
                           $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                           <a href="'.route('chailcategory.delete',[$row->id]).'"  class="btn btn-danger btn-sm" id="delete_category"><i class="fas fa-trash"></i>
                           </a>';
                          return $actionbtn;   
                       })
                       ->rawColumns(['action','category_name','subcategory_name'])
                       ->make(true);       
           }
           return view('admin.category.chail.index');
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Request $request)
        {
            $cat=DB::table('sub_categories')->where('id',$request->subcategory_id)->first();

           $data = array(
                'chail_name' => $request->chail_name,
                'chail_slug' => Str::slug($request->chail_name, '-'),
                'category_id' => $cat->category_id,
                'subcategory_id' => $request->subcategory_id,
            );
      
           DB::table('chail_categories')->insert($data);
           return response()->json('successfully Insert!');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
        {
            $data=DB::table('chail_categories')->where('id',$id)->first();
           
            return view('admin.category.chail.edit',compact('data'));
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
        {
            $cat=DB::table('sub_categories')->where('id',$request->subcategory_id)->first();

            $data = array(
                'chail_name' => $request->chail_name,
                'chail_slug' => Str::slug($request->chail_name, '-'),
                'category_id' =>$cat->category_id,
                'subcategory_id' => $request->subcategory_id,
            );
            DB::table('chail_categories')->where('id',$request->id)->update($data);
            return response()->json('chail cateogry Updated!');
        }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory($id)
       {
        DB::table('chail_categories')->where('id',$id)->delete();
        return response()->json('chail cateogry deteted!');
   
       }
   
}
