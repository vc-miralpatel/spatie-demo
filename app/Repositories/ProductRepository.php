<?php

namespace App\Repositories;

use App\Repositories\Core\Repository;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;



class ProductRepository extends Repository
{
    public function __construct()
    {
        $this->model = config('model-variables.models.product.class');
    }

     /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        try {
            $products = $this->model::all()->toArray();
            return $products;
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }

     /**
     * storing of the resource.
     *
     * @return
     */
    public function store(array $data)
    {
        try {
            $product = $this->model::create([
                'name' => $data['name'],
                'detail' => $data['detail'],
            ]);
            return $product;
        } catch (Exception $e) {
            Log::info($e->getMessage());
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
            $product = $this->model::find($id);
            return $product;
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }


    /**
     * editing of the resource.
     *
     * @return
     */
    public function edit(int $id)
    {
        try {
            $product = $this->model::find($id);
            return $product;
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * upadting of the resource.
     *
     * @return
     */
    public function update(array $data,$id)
    {
        try {
            $product = $this->model::find($id);
            $product->update([
                'name' => $data['name'],
                'detail' => $data['detail'],
            ]);
            return $product;
        } catch (Exception $e) {
            Log::info($e->getMessage());
            dd("product upadte repocc");
        }
    }

     /**
     * destroying of the resource.
     *
     * @return
     */
    public function destroy(int $id)
    {
        //dd("uoioio destroy");
        try {
            $product = $this->model::find($id)->delete();
            return $product;
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}



