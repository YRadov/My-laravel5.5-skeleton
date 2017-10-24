<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Core\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\Role whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\Role whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\Role whereName( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\Role whereUpdatedAt( $value )
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Core\Models\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Core\Models\Permission[] $perms
 */
class Role extends Model {
	public function users() {
		return $this->belongsToMany( 'App\Core\Models\User' );
	}//users

	public function perms() {
		return $this->belongsToMany( 'App\Core\Models\Permission' );
	}//perms


	public function hasPermission( $name, $require = false ) {
		if ( is_array( $name ) ) {
			foreach ( $name as $permissionName ) {
				$hasPermission = $this->hasPermission( $permissionName );

				if ( $hasPermission && ! $require ) {
					return true;
				} elseif ( ! $hasPermission && $require ) {
					return false;
				}
			}

			return $require;
		} else {
			foreach ( $this->perms as $permission ) {
				if ( $permission->name == $name ) {
					return true;
				}
			}
		}

		return false;
	}


	public function hasPermissionById( $perm_id) {
		foreach ( $this->perms as $permission ) {
			if ( $permission->id == $perm_id ) {
				return true;
			}
		}

		return false;
	}


	public function savePermissions( $inputPermissions ) {

		if ( ! empty( $inputPermissions ) ) {
			$this->perms()->sync( $inputPermissions );
		} else {
			$this->perms()->detach();
		}

		return true;
	}

}//Role
