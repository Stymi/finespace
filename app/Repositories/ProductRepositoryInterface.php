<?php

namespace App\Repositories;

interface ProductRepositoryInterface{

    public function selectAll($paginate = 0);

    public function find($id);

//    public function findBy($query );


    public function save($obj);

    public function update($obj);



    public function getProductDetail($productId);
    public function addProduct($request);
    public function updateProduct($request);


    public function newProductSpecs($productId);
    public function addProductSpecs($request);

    public function editProductSpecs($productId);
    public function updateProductSpecs($request);

    public function loadSpecs($categoryId);

    public function getCategoryProduct($category_id);

    public function checkProductLimit($request);

    public function changeStatus($productId,$StatusName,$status);

    public function getHotProduct();
    public function getRecomProduct();

//    public function getNewProduct();


    public function getProductCount();
    public function getComboProduct();

    public function getSellCategory($type);

    public function getCategoryList();

    //获取产品排名
    public function productRank($rank,$category);
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
//    public function update(array $data);
//
//    public function delete($id);
//
//    public function deleteWhere($column, $value);

    public function manageProduct($searchArr,$paginate = 0);

}
