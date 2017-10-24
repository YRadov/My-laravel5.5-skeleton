<?php

namespace App\Core\Repositories;


interface IRepository {

	public function getOne($id);

	public function getOneWithClause(array $where, array $select);

	public function getAll();

	public function getAllWithClause(array $where, array $select);

	public function save($model);

	public function update($model);

	public function delete($id);

}