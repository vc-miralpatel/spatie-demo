<?php

namespace App\Repositories\Core;

class Repository
{
    /**
     * Model::class
     */
    protected $model;

     /**
     * get all the records from the table
     * @return mixed
     */
    public function findAll()
    {
        return $this->model::all();
    }

     /**
     * find record by uuid from the table
     * @param  string  $uuid
     * @return mixed
     */
    public function findByUuid(String $uuid)
    {
        return $this->model::where('uuid',$uuid);
    }

}
