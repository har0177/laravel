<?php

return [
  
  /*----------------------------------------
  *   Roles Permissions
  * ----------------------------------------
  */
  'Roles' => [
    'title'       => 'Roles',
    'description' => 'Manage Roles Permissions',
    'abilities'   => [
      
      'manage roles' => [
        'title' => 'Manage Roles Listing',
      ],
      
      'add role' => [
        'title' => 'Add Role',
      ],
      
      'edit role' => [
        'title' => 'Edit Role',
      ],
    ]
  ],
  
  /*----------------------------------------
  *   Users Permissions
  * ----------------------------------------
  */
  'Users' => [
    'title'       => 'Users',
    'description' => 'Manage Users Permissions',
    'abilities'   => [
      
      'manage users' => [
        'title' => 'Manage Users Listing',
      ],
      
      'add user' => [
        'title' => 'Add User',
      ],
      
      'view user' => [
        'title' => 'View User',
      ],
      
      'edit user' => [
        'title' => 'Edit User',
      ],
      
      'delete user' => [
        'title' => 'Delete User',
      ],
    
    ],
  ]

];