<?php

return [
  
  /*----------------------------------------
  *   Roles Permissions
  * ----------------------------------------
  */
  'Roles'    => [
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
  'Users'    => [
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
  ],
  
  /*----------------------------------------
 *   Student Permissions
 * ----------------------------------------
 */
  'Students' => [
    'title'       => 'Students',
    'description' => 'Manage Students Permissions',
    'abilities'   => [
      
      'manage students' => [
        'title' => 'Manage Students Listing',
      ],
      
      'add student' => [
        'title' => 'Add Student',
      ],
      
      'view student' => [
        'title' => 'View Student',
      ],
      
      'edit student' => [
        'title' => 'Edit Student',
      ],
      
      'delete student' => [
        'title' => 'Delete Student',
      ],
    
    ],
  ],
  
  /*----------------------------------------
 *   Projects Permissions
 * ----------------------------------------
 */
  'Projects' => [
    'title'       => 'Projects',
    'description' => 'Manage Projects Permissions',
    'abilities'   => [
      
      'manage projects' => [
        'title' => 'Manage Projects Listing',
      ],
      
      'add project' => [
        'title' => 'Add Project',
      ],
      
      'view project' => [
        'title' => 'View Project',
      ],
      
      'edit project' => [
        'title' => 'Edit Project',
      ],
      
      'delete project' => [
        'title' => 'Delete Project',
      ],
    
    ],
  ]

];