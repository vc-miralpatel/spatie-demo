<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Repositories\ProductRepository;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ProductController extends Controller
{
    /**
     * @var $productRepository
     */
    protected $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        //edit articles,delete articles,publish articles,unpublish articles

        // $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);

        //$this->middleware(['role:writer','permission:publish articles'], ['only' => ['index']]);
        //$this->middleware(['role:writer','permission:edit articles'], ['only' => ['show']]);
        //$this->middleware(['role_or_permission:Writer|publish articles']);
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = $this->productRepository->index();
            return view('backend.products.index',compact('products'));
         } catch(Exception $e){
            Log::info($e->getMessage());
             dd('product index catche');
             return view('backend.products.index');
         }

        //$products = Product::latest()->paginate(5);
        //return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$checkRole = Auth::user()->hasAnyRole('Super-Admin', 'admin') ? true : null;
        //if($checkRole) {
            $roles = Role::pluck('name','name')->all();
            return view('backend.products.create',compact('roles'));
       // } else {
          //  return redirect()->route('backend.products.index')->with('info',"Your role doesn't enough to create product");
       //}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        //dd("in stor fun of pro cont");
        try {
            $this->productRepository->store($request->all());
            //dd("in pro cont");
            return redirect()->route('backend.products.index')->with('success','Product created successfully');
         } catch(Exception $e){
            dd('product store catche');
             return view('backend.products.index');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = $this->productRepository->show($id);
            return view('backend.products.show',compact('product'));
        } catch(Exception $e){
            dd('user contro delete catche');
            return view('backend.products.index')->with('error','Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$checkRole = Auth::user()->hasAnyRole('Super-Admin', 'admin') ? true : null;
        //if($checkRole) {
            try {
                $product = $this->productRepository->edit($id);
                return view('backend.products.edit',compact('product'));
            }
            catch(Exception $e){
                dd('product edit catche');
                return view('backend.products.index');
            }
        //} else {
          //  return redirect()->route('backend.products.index')->with('info',"Your role doesn't enough to edit product");
        //}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $this->productRepository->update($request->all(),$id);
            return redirect()->route('backend.products.index')->with('success','Product updated successfully');
        } catch(Exception $e){
            dd('product contro store catche');
             return view('backend.products.index')->with('error','Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkRole = Auth::user()->hasAnyRole('Super-Admin', 'admin') ? true : null;
        if($checkRole) {
            try {
                $this->productRepository->destroy($id);
                return redirect()->route('backend.products.index')->with('success','Product deleted successfully');
            } catch(Exception $e){
                dd('Product contro delete catche');
                return view('backend.products.index')->with('error','Something went wrong');
            }
        } else {
            return redirect()->route('backend.products.index')->with('info',"Your role doesn't enough to destroy product");
        }
    }
}
