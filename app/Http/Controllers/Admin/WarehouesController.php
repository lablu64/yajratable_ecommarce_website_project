<?php

namespace App\Http\Controllers\Admin;

use App\Models\Warehoues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class WarehouesController extends Controller
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
                $data=Warehoues::latest()->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                            <a href="'.route('warehoues.delete',[$row->id]).'"  class="btn btn-danger btn-sm" id="delete_category"><i class="fas fa-trash"></i>
                            </a>';
                           return $actionbtn;   
                        })
                        ->rawColumns(['action'])
                        ->make(true);       
            }
            return view('admin.category.warehoues.index');
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
                 'warehouse_name' => $request->warehouse_name,
                 'warehouse_slug' => Str::slug($request->warehouse_name, '-'),
                 'warehouse_address' => $request->warehouse_address,
                 'warehouse_phone' => $request->warehouse_phone,
             );
       
            DB::table('warehoues')->insert($data);
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
            $data=DB::table('warehoues')->where('id',$id)->first();
           
            return view('admin.category.warehoues.edit',compact('data'));
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
            'warehouse_name' => $request->warehouse_name,
            'warehouse_slug' => Str::slug($request->warehouse_name, '-'),
            'warehouse_address' => $request->warehouse_address,
            'warehouse_phone' => $request->warehouse_phone,
           );
           DB::table('warehoues')->where('id',$request->id)->update($data);
           return response()->json(' warehoues Updated!');
       }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destory($id)
      {
        DB::table('warehoues')->where('id',$id)->delete();
        return response()->json(' warehoues Updated!');
  
      }
  
}
