<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Pickpoint;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

use function Termwind\style;

class ProductController extends Controller
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
            $imgurl ="public/files/product";
            $product="";
            $query=DB::table('products')->leftJoin('categories','products.category_id','categories.id')
                  ->leftJoin('sub_categories','products.subcategory_id','sub_categories.id')
                  ->leftJoin('brands','products.brand_id','brands.id');

              if ($request->category_id) {
                  $query->where('products.category_id',$request->category_id);
               }

              if ($request->brand_id) {
                  $query->where('products.brand_id',$request->brand_id);
              }

              if ($request->warehouse) {
                  $query->where('products.warehouse',$request->warehouse);
              }
              if ($request->status==1 && $request->status==0 ) {
                $query->where('products.status',2);
            }
              
              if ($request->status==1) {
                  $query->where('products.status',1);
              }
              if ($request->status==0) {
                  $query->where('products.status',0);
              }

          $product=$query->select('products.*','categories.category_name','sub_categories.subcategory_name','brands.brand_name')
                  ->get();
              
              return DataTables::of($product)
                      ->addIndexColumn()
                      ->editColumn('thumbnail',function($row) use($imgurl){
                        return '<img src="'.$imgurl.'/'.$row->thumbnail.'" height="30" width="20"  alt="">';
                      })
                      
                      ->editColumn('featured',function($row){
                        if($row->featured == 1){
                            return '<a href="#" data-id="'.$row->id.'" class="deactive_featured" ><i class="fa fa-thumbs-down text-danger"></i><span class="badge badge-success">Active</span></a>';
                        }else{
                            return '<a href="#" data-id="'.$row->id.'"  class="active_featured"><i class="fa fa-thumbs-up text-success"></i><span class="badge badge-danger">Deactive</span></a>';
                        }
                    })
                    ->editColumn('today_deal',function($row){
                        if($row->today_deal == 1){
                            return '<a href="" data-id="'.$row->id.'"  class="deactive_today" ><i class="fa fa-thumbs-down text-danger"></i><span class="badge badge-success">Active</span></a>';
                        }else{
                            return '<a href="" data-id="'.$row->id.'"  class="active_today"><i class="fa fa-thumbs-up text-success"></i><span class="badge badge-danger">Inactive</span></a>';
                        }
                    })
                    ->editColumn('status',function($row){
                        if($row->status == 1){
                            return '<a href="" data-id="'.$row->id.'"  class="deactive_status" ><i class="fa fa-thumbs-down text-danger"></i><span class="badge badge-success">Active</span></a>';
                        }else{
                            return '<a href="" data-id="'.$row->id.'"  class="active_status"><i class="fa fa-thumbs-up text-success"></i><span class="badge badge-danger">Inactive</span></a>';
                        }
                    })
                      ->addColumn('action', function($row){
                          $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" ><i class="fas fa-edit"></i></a>
                          <a href="'.route('product.edit',[$row->id]).'" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" ><i class="fas fa-eye"></i></a>
                          <a href="'.route('product.delete',[$row->id]).'"  class="btn btn-danger btn-sm" id="delete_category"><i class="fas fa-trash"></i>
                          </a>';
                         return $actionbtn;   
                      })
                      ->rawColumns(['action','thumbnail','featured','today_deal','status'])
                      ->make(true);       
          }
          $category =DB::table('categories')->get();
          $brand =DB::table('brands')->get();
          $warehouse =DB::table('warehoues')->get();
          return view('admin.product.index',compact(['category','brand','warehouse']));
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category =DB::table('categories')->get();
        $brand =DB::table('brands')->get();
        $warehoues =DB::table('warehoues')->get();
        $pickpoint =DB::table('pickpoints')->get();

        return view('admin.product.create',compact('category','brand','warehoues','pickpoint'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products|max:55',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'color' => 'required',
            'description' => 'required',
        ]);
 
        //subcategory call for category id
        $subcategory=DB::table('sub_categories')->where('id',$request->subcategory_id)->first();
        $slug=Str::slug($request->name, '-');
 
 
        $data=array();
        $data['name']=$request->name;
        $data['slug']=Str::slug($request->name, '-');
        $data['code']=$request->code;
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_id']=$request->childcategory_id;
        $data['brand_id']=$request->brand_id;
        $data['pickup_point_id']=$request->pickup_point_id;
        $data['unit']=$request->unit;
        $data['tags']=$request->tags;
        $data['purchase_price']=$request->purchase_price;
        $data['selling_price']=$request->selling_price;
        $data['discount_price']=$request->discount_price;
        $data['warehouse']=$request->warehouse;
        $data['stock_quantity']=$request->stock_quantity;
        $data['color']=$request->color;
        $data['size']=$request->size;
        $data['description']=$request->description;
        $data['video']=$request->video;
        $data['featured']=$request->featured;
        $data['today_deal']=$request->today_deal;
        $data['product_slider']=$request->product_slider;
        $data['status']=$request->status;
        $data['trendy']=$request->trendy;
        $data['admin_id']=Auth::id();
        $data['date']=date('d-m-Y');
        $data['month']=date('F');
        //single thumbnail
        if ($request->thumbnail) {
              $thumbnail=$request->thumbnail;
              $photoname=$slug.'.'.$thumbnail->getClientOriginalExtension();
              Image::make($thumbnail)->resize(600,600)->save('public/files/product/'.$photoname);
              $data['thumbnail']=$photoname;   // public/files/product/plus-point.jpg
        }
        //multiple images
        $images = array();
        if($request->hasFile('images')){
            foreach ($request->file('images') as $key => $image) {
                $imageName= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(600,600)->save('public/files/product/'.$imageName);
                array_push($images, $imageName);
            }
            $data['images'] = json_encode($images);
        }

        DB::table('products')->insert($data);
        $notification=array('messege' => 'Product Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
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
        $product = DB::table('products')->where('id',$id)->first();
        $category =DB::table('categories')->get();
        $brand =DB::table('brands')->get();
        $warehoues =DB::table('warehoues')->get();
        $pickpoint =DB::table('pickpoints')->get();
        return view('admin.product.edit',compact('product','category','brand','warehoues','pickpoint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // deactive featured
    public function onfeatured($id){
        DB::table('products')->where('id',$id)->update(['featured'=>0]);
        return response()->json('product no featured ');
        
    }
    //active featured
    public function activefeatured($id){
        DB::table('products')->where('id',$id)->update(['featured'=>1]);
        return response()->json('product featured actived ');
        
    }

     // deactive to day
     public function ontoday($id){
        DB::table('products')->where('id',$id)->update(['today_deal'=>0]);
        return response()->json('product no today_deal ');
        
    }

      // active to day
      public function activetoday($id){
        DB::table('products')->where('id',$id)->update(['today_deal'=>1]);
        return response()->json('product actived today_deal ');
        
    }

    // deactive to day
    public function onstatus($id){
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        return response()->json('product no status ');
        
    }

      // active to day
      public function activestatus($id){
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        return response()->json('product actived status ');
        
    }
}
