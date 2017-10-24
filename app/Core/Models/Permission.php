<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Core\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\Permission whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\Permission whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\Permission whereName( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\Permission whereUpdatedAt( $value )
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Core\Models\Role[] $roles
 */
class Permission extends Model {

	const VIEW_ADMIN = 'VIEW_ADMIN';
	const ADD_POST = 'ADD_POST';
	const UPDATE_POST = 'UPDATE_POST';
	const DELETE_POST = 'DELETE_POST';
	const EDIT_USERS = 'EDIT_USERS';
	const TEST = 'TEST';


	public function roles() {
		return $this->belongsToMany( 'App\Core\Models\Role' );
	}//roles

}//Permission
