<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
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
             $data=SubCategory::latest()->get();
            
             return DataTables::of($data)
                     ->addIndexColumn()
                     ->editColumn('category_name',function($row){
                         return $row->category->category_name;
                     })
                     ->addColumn('action', function($row){
                         $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                         <a href="'.route('subcategory.delete',[$row->id]).'"  class="btn btn-danger btn-sm" id="delete_category"><i class="fas fa-trash"></i>
                         </a>';
                        return $actionbtn;   
                     })
                     ->rawColumns(['action','category_name'])
                     ->make(true);       
         }
         return view('admin.category.subcategory.index');
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
            
            $data = array(
                 'subcategory_name' => $request->subcategory_name,
                 'subcategory_slug' => Str::slug($request->subcategory_name, '-'),
                 'category_id' => $request->category_id,
             );
       
            DB::table('sub_categories')->insert($data);
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
           $data=DB::table('sub_categories')->where('id',$id)->first();
          
           return view('admin.category.subcategory.edit',compact('data'));
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
           $data = array(
               'subcategory_name' => $request->subcategory_name,
               'subcategory_slug' => Str::slug($request->subcategory_name, '-'),
               'category_id' => $request->category_id,
           );
           DB::table('sub_categories')->where('id',$request->id)->update($data);
           return response()->json('sub cateogry Updated!');
       }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory($id)
       {
        
        DB::table('sub_categories')->where('id',$id)->delete();
        return response()->json('sub cateogry Updated!');
   
       }
   
}
