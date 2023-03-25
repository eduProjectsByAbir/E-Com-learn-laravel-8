<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AddressCity;
use App\Models\AddressDistrict;
use App\Models\AddressDivision;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WebsiteController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->subDays(7);
        $sliders = Slider::where('status', 1)->latest()->take(3)->get();
        $latestproducts = Product::where('status', 1)->where('created_at', '>=', $date)->latest('id')->limit(6)->get();
        $specialoffers = Product::where('status', 1)->where('special_offer', 1)->latest('id')->limit(3)->get();
        $specialdeals = Product::where('status', 1)->where('special_deals', 1)->latest('id')->limit(3)->get();
        // $cat_products = Category::with('productsLimit')->latest('id')->get();
        $catproducts = Category::latest('id')->get();
        // $cat_products = Category::with(['products' => function($query){
        //                         $query->where('status', 1)->limit(10);
        //                     }])->latest('id')->get();
        // $cat_products = Product::with(['category.products' => function($query){
        //                         $query->where('products.status', 1)->limit(10);
        //                     }])->get();

        return view('frontend.home', compact('sliders', 'latestproducts', 'catproducts', 'specialoffers', 'specialdeals'));
    }

    public function showProduct($product)
    {
        $productDetails = Product::whereSlug($product)->with('brand', 'category', 'subcategory', 'sub_subcategory', 'product_images')->firstOrFail();
        return view('frontend.pages.product-details', compact('productDetails'));
    }

    public function showProducts(Request $request)
    {
        $query = Product::with('brand', 'category', 'subcategory', 'sub_subcategory', 'product_images');

        if ($request->has('category') && request('category') != null && request('category') != '0') {
            $id = $request->category;
            $query->where('category_id', $id);
        }

        if ($request->has('subcategory') && request('subcategory') != null && request('subcategory') != '0') {
            $id = $request->subcategory;
            $query->where('sub_category_id', $id);
        }

        if ($request->has('subsubcat') && request('subsubcat') != null && request('subsubcat') != '0') {
            $id = $request->subsubcat;
            $query->where('sub_subcategory_id', $id);
        }

        // brand search
        if ($request->has('brand') && request('brand') != null && request('brand') != '0') {
            $id = $request->brand;
            $query->where('brand_id', $id);
        }

        // tag search
        if ($request->has('tags') && $request->tags != null) {
            $query->where('tags', 'LIKE', "%$request->tags%");
        }

        // keyword search
        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('name', 'LIKE', "%$request->keyword%");
        }

        // color search
        if ($request->has('color') && $request->color != null) {
            $query->where('color', 'LIKE', "%$request->color%");
        }

        $colors = Product::groupBy('color')->pluck('color')->implode(', ');
        $colors = (array_map('trim', array_unique(explode(',', $colors))));
        $brands = Brand::latest()->get();

        $products = $query->latest()->paginate(12)->onEachSide(1)->appends($request->all());
        return view('frontend.pages.products', compact('products', 'colors', 'brands'));
    }

    public function getProductJson($id)
    {
        $productData = Product::with('category', 'brand')->findOrFail($id);
        return response()->json($productData);
    }

    public function divisionListJson(Request $request)
    {
        $divisions = AddressDivision::where('address_country_id', $request->id)->get();
        return response()->json($divisions);
    }

    public function districtListJson(Request $request)
    {
        $districts = AddressDistrict::where('address_division_id', $request->id)->get();
        return response()->json($districts);
    }

    public function cityListJson(Request $request)
    {
        $cities = AddressCity::where('address_district_id', $request->id)->get();
        return response()->json($cities);
    }
}
