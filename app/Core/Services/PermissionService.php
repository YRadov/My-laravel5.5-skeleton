<?php

namespace App\Core\Services;


use App\Core\Repositories\PermissionRepository;
use App\Core\Repositories\RoleRepository;

class PermissionService
{
	protected $roleRep;
	protected $permRep;

	public function __construct(RoleRepository $roleRep, PermissionRepository $permRep)
	{
		$this->roleRep = $roleRep;
		$this->permRep = $permRep;
	}//__construct


	public function getAllRoles()
	{
		return $this->roleRep->getAll();
	}

	public function getAllPerms()
	{
		return $this->permRep->getAll();
	}
}//PermissionService