<?php

namespace App\Core\Repositories;


use Illuminate\Database\Eloquent\Model;

class ADefaultRepository implements IRepository
{
	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}//__construct

	public function getOne($id)
	{
		return $this->model->find($id);
	}//getOne

	public function getOneWithClause(array $where = [], array $select = ['*'])
	{
		return $this->model->select($select)->where($where)->first();
	}//getOneWithClause

	public function getAll()
	{
		return $this->model->all();
	}//getAll

	public function getAllWithClause(array $where = [], array $select = ['*'])
	{
		return $this->model->select($select)->where($where)->get();
	}//getAllWithClause

	public function save($model)
	{

	}//save

	public function update($model)
	{

	}//update

	public function delete($id)
	{
		return $this->model->destroy($id);
	}//delete

}//ADefaultRepository