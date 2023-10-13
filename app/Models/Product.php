<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // protected $guarded = [];  
    protected $fillable = ['category_id','subcategory_id','chailcategory_id','brand_id','pickup_point_id','name','code','unit','tags','color','size','video','purchase_price','selling_price','discount_price','stock_quantity','warehouse','description','thumbnail','images','featured','today_deal','status','trendy','admin_id'];

    public function category(){
    	return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory(){
    	return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
    
    public function pickpoint(){
    	return $this->belongsTo(Pickpoint::class,'pickup_point_id');
    }
    public function warehouse(){
    	return $this->belongsTo(Warehoues::class,'warehoues_id');
    }

    public function brand(){
    	return $this->belongsTo(Brand::class);
    }
    public function chail(){
    	return $this->belongsTo(ChailCategory::class);
    }
}
