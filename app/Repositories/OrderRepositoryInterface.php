<?php

namespace App\Repositories;

interface OrderRepositoryInterface {

    public function selectAll($paginate = 0);

    public function find($id);

    public function findBy($query );

    public function save($obj);


//    public function errors();
//
//    public function all(array $related = null);
//
//    public function get($id, array $related = null);
//
//    public function getWhere($column, $value, array $related = null);
//
//    public function getRecent($limit, array $related = null);
//
//    public function create(array $data);
//
    public function update( $query);
//
//    public function delete($id);
//
//    public function deleteWhere($column, $value);

}
