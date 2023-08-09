<?php

namespace App\Traits;

/**
 *
 */
trait HasPermissions
{
  
  protected array $permissions = [];
  
  /**
   * @return array|mixed
   */
  public function abilities() : mixed
  {
    if( empty( $this->permissions ) ) {
      $this->permissions = $this->role?->permissions;
    }
    
    return $this->permissions;
  }// abilities
  
  /**
   * @param $do
   * @return bool
   */
  public function hasAbilityTo( $do ) : bool
  {
    $permissions = $this->abilities();
    return in_array( $do, $permissions, true );
  }// hasAbilityTo
  
  /**
   * Check if the current logged-in user is a root user (Super User) or Super Admin
   * @return bool
   */
  public function isRootUser() : bool
  {
    $root_emails = config( 'spark.root_users' );
    return in_array( strtolower( $this->email ), $root_emails, true );
  }// isRootUser
  
  /**
   * @return bool
   */
  public function isAdmin() : bool
  {
    $adminRole = (int) option( 'role.admin', 0 );
    $role = (int) $this->role->id;
    return $adminRole && $role === $adminRole;
  }// isAdmin
  
}// HasPermissions
