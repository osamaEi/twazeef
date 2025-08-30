<?php

return [
    'pending_registrations' => [
        'title' => 'Manage New Registrations',
        'welcome_title' => 'Manage New Registrations!',
        'welcome_message' => 'You can review and activate new user accounts.',

        'stats' => [
            'total_pending' => 'Total Pending Registrations',
            'total_pending_desc' => 'Accounts waiting for activation',
            'pending_employees' => 'New Employees',
            'pending_employees_desc' => 'Pending employee accounts',
            'pending_companies' => 'New Companies',
            'pending_companies_desc' => 'Pending company accounts',
        ],

        'tabs' => [
            'employees' => 'New Employees',
            'companies' => 'New Companies',
        ],

        'table' => [
            'name' => 'Name',
            'company_name' => 'Company Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'specialization' => 'Specialization',
            'sector' => 'Sector',
            'status' => 'Status',
            'registration_date' => 'Registration Date',
            'actions' => 'Actions',
        ],

        'status' => [
            'active' => 'Active',
            'pending' => 'Pending',
            'activated' => 'Activated',
        ],

        'actions' => [
            'activate' => 'Activate',
            'deactivate' => 'Deactivate',
            'bulk_activate' => 'Activate Selected',
            'view' => 'View',
        ],

        'confirm' => [
            'activate_single' => 'Are you sure you want to activate this account?',
            'deactivate_single' => 'Are you sure you want to deactivate this account?',
            'activate_bulk' => 'Are you sure you want to activate :count accounts?',
        ],

        'not_specified' => 'Not specified',
        'no_employees' => 'No pending employee registrations',
        'no_companies' => 'No pending company registrations',
    ],
];
