<?php

namespace App\Repositorties;


interface RepositoryInterface{
    public function baseQuery($relations = []);
    public function getById($id);
    public function store($params);
    public function update($id,$params);
    public function delete($params);
}