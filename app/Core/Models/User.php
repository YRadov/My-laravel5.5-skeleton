<?php

namespace App\Core\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Core\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\User whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\User whereEmail( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\User whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\User whereName( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\User wherePassword( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\User whereRememberToken( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Core\Models\User whereUpdatedAt( $value )
 * @mixin \Eloquent
 */
class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'api_token',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
		'api_token',
	];


	public function roles() {
		return $this->belongsToMany( 'App\Core\Models\Role' );
	}//roles


	/**
	 * @param string|array $permission
	 * @param bool $require True когда $permission - это массив разрешений и у пльзователя должны быть ВСЕ из этих разрешений
	 *
	 * @return bool
	 */
	public function canDo( $permission, $require = false ) {
		if ( is_array( $permission ) ) {
			/** @todo если передан массив разрешений */
			foreach ( $permission as $permName ) {
				/** @todo для единичного разрешения применяем рекурсивно canDo() */
				$permName = $this->canDo( $permName );
				if ( $permName && ! $require ) {
					/** @todo когда должно быть хоть одно разрешение из списка */
					return true;
				} else if ( ! $permName && $require ) {
					/** @todo когда пользователь не имеет какого-то  разрешения из списка */
					return false;
				}
			}

			/** @todo если у пользователя есть все разрешения из списка */
			return $require;
		} else {
			foreach ( $this->roles as $role ) {
				foreach ( $role->perms as $perm ) {
					if ( str_is( $permission, $perm->name ) ) {
						return true;
					}
				}
			}

			return false;
		}
	}//canDo


	/**
	 * @param string|array $name
	 * @param bool $require
	 *
	 * @return bool
	 */
	public function hasRole( $name, $require = false ) {
		if ( is_array( $name ) ) {
			foreach ( $name as $roleName ) {
				$roleName = $this->hasRole( $roleName );
				if ( $roleName && ! $require ) {
					return true;
				} else if ( ! $roleName && $require ) {
					return false;
				}
			}

			return $require;
		} else {
			foreach ( $this->roles as $role ) {
				if ( str_is( $name, $role->name ) ) {
					return true;
				}
			}

			return false;
		}
	}//hasRole

}//User
