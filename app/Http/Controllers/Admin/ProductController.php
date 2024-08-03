<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Facades\File ;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{    
    public function __construct()
    {
        $this->middleware('permission:products-read,guard:admin')->only('index');
        $this->middleware('permission:products-create,guard:admin')->only('create');
        $this->middleware('permission:products-update,guard:admin')->only('edit');
        $this->middleware('permission:products-delete,guard:admin')->only('destory');
    }
    public function index(){
        $products = Product::paginate(100);
        return view('admin.products.index',compact('products'));
    }
    public function create(){
        $categories = Category :: all();
        $colors = Color::where('status','0')->get();
        return view('admin.products.create',compact('categories','colors'));
    }
    public function store(ProductFormRequest $request){
        $validateData = $request->validated();
        $category = Category::findOrFail($validateData['category_id']);
        $product =  $category->products();
        if($request->colors){
            $totalofcolorquantity= 0;
              foreach($request->colors as $key =>$color){
                  $totalofcolorquantity = $totalofcolorquantity + $request->colorquantity[$key];
                  if ($totalofcolorquantity > $request->quantity) {
                      return redirect()->back()->with(['error'=>'Total ColorsQuantity must be smaller than all quantity']);
                  } 
               
           } 
    
        }
        $product=Product::create([
            'category_id'=>$validateData['category_id'],
            'name'=>$validateData['name'],
            'description'=>$validateData['description'],
            'selling_price'=>$validateData['selling_price'],
            'original_price'=>$validateData['original_price'],
            'discount_price'=>$validateData['discount_price'],
            'quantity'=>$validateData['quantity'],
            'tranding'=>$request->tranding == true ?'1':'0',
            'status'=>$request->status == true ?'1':'0',

        ]);
        if($request->colors){
            foreach($request->colors as $key=>$color){
                $product->productColors()->create([
                    'product_id'=>$product->id,
                    'color_id'=>$color,
                    'quantity'=> $request->colorquantity[$key] ??0

                ]);
               }
        }
        if($request->hasFile('image')){
       
            $uploadpath = 'Admins/products/uploads';
            $i=1;
           foreach($request->file('image') as $imageFile){
            $ext=$imageFile->getClientOriginalExtension();
            $filename =$imageFile->getClientOriginalName().$i++;
            $path = $imageFile->storeAs($uploadpath,$filename,'public');
            // $imageFile->move($uploadpath,$filename);
            // $finalImagePatName = $uploadpath.$filename ;
            $product->productImages()->create([
                'product_id'=>$product->id,
                'image'=>$path,
            ]);

           }
       
    
        }
    

      return redirect()->back()->with(['message'=>'Product Add Successfully']);
      

    }
    public function edit(int $product_id){
        $categories= Category::all();
        $product = Product::findOrFail($product_id);
     
       $product_color= $product->productColors->pluck('color_id')->toArray();
       $colors= Color::whereNotIn('id',$product_color)->get();
        return view('admin.products.edit' ,compact('categories','product' ,'colors'));
    }   
    
    
    public function update(ProductFormRequest $request, int $product_id ){
        $validateData = $request->validated();
        $category = Category::findOrFail($validateData['category_id']);
        $product = Product::findOrFail($product_id);
     
        if($product){
            $product->update([
                'category_id'=>$validateData['category_id'],
                'name'=>$validateData['name'],
                'description'=>$validateData['description'],
                'selling_price'=>$validateData['selling_price'],
                'original_price'=>$validateData['original_price'],
                'discount_price'=>$validateData['discount_price'],
                'quantity'=>$validateData['quantity'],
                'tranding'=>$request->tranding == true ?'1':'0',
                'status'=>$request->status == true ?'1':'0',

            ]);
            if($request->hasFile('image')){
        
                $uploadpath = 'Admins/products/uploads';
                $i=1;
               foreach($request->file('image') as $imageFile){
                $ext=$imageFile->getClientOriginalExtension();

                $filename =$imageFile->getClientOriginalName().$i++.'.'.$ext;
                $path = $imageFile->storeAs($uploadpath,$filename,'public');
                // $imageFile->move($uploadpath,$filename);
                // $finalImagePatName = $uploadpath.$filename ;
                $product->productImages()->create([
                    'product_id'=>$product->id,
                    'image'=>$path,
                ]);
    
               }
           
        
            }
            if($request->colors){
                $totalofcolorquantity= 0;
                  foreach($request->colors as $key =>$color){
                      $totalofcolorquantity = $totalofcolorquantity + $request->colorquantity[$key];
    
                      $sum = DB::table('products_colors')->where('product_id',$product_id)->sum('quantity');
                      if ($totalofcolorquantity > ($request->quantity - $sum)) {
                          return redirect()->back()->with(['error'=>'Total ColorsQuantity must be smaller than all quantity('.$request->quantity.')']);
                      } 
                 
               } 
               foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id'=>$product->id,
                    'color_id'=>$color,
                    'quantity'=> $request->colorquantity[$key] ??0
    
                ]);
               }
            }
          
             return redirect()->back()->with(['message'=>'Product Updated Successfully']);

        }else{
            return redirect('admin/products')->with('message','No such Product Id Found');
        }

    }
    
    
    public function destory(int $product_id){
        $product = Product::findOrfail($product_id);
        if($product->productImages()){
            foreach($product->productImages() as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
        
                }

            }
        }
        $product->delete();
        return redirect()->back()->with(['message'=>'Product Deleted with images Successfully']);
    }

    public function destoryImage($image_id){
        $productImage= ProductImage::findOrfail($image_id);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);

        }
        $productImage->delete();
        return redirect()->back()->with(['message'=>'Product Image Deleted Successfully']);
    }
    public function updateProdColorQty(Request $request,$prod_color_id){
        $product =  Product::findOrFail($request->product_id);
        $productColorData= Product::findOrFail($request->product_id)
                            ->productColors()->where('id',$prod_color_id)->first();
                          
        if($request->qty){
          $productQty= $product->quantity;
          $productColorQty = DB::table('products_colors')->where('product_id',$request->product_id)->sum('quantity');
          $sum = $productColorQty + $request->qty;
          if($productQty < ($sum - $productColorData->quantity)){
            return response()->json(['message'=>'Total ColorsQuantity must be smaller than all quantity('.$productQty.')']);
          }else{
            $productColorData->update([
                'quantity'=> $request->qty
            ]);  
            return response()->json(['message'=>'Product Color Qty Updated']) ;   
          }
      
        }           
     
                   

        
                            
    
    }
    public function deleteProdColor($prod_color_id){

        $prodColor= ProductColor::findOrfail($prod_color_id);
        $prodColor->delete();
        return response()->json(['message'=>'Product Color deleted']) ; 
    }
}
