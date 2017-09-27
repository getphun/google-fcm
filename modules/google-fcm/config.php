<?php
/**
 * google-fcm config file
 * @package google-fcm
 * @version 0.0.1
 * @upgrade true
 */

return [
    '__name' => 'google-fcm',
    '__version' => '0.0.1',
    '__git' => 'https://github.com/getphun/google-fcm',
    '__files' => [
        'modules/google-fcm' => [
            'install',
            'remove',
            'update'
        ]
    ],
    '__dependencies' => [],
    '_services' => [
        'fcm' => 'GoogleFcm\\Service\\Fcm'
    ],
    '_autoload' => [
        'classes' => [
            'GoogleFcm\\Service\\Fcm' => 'modules/google-fcm/service/Fcm.php'
        ],
        'files' => []
    ],
    
    'fcm' => [
        'content' => [
            'restricted_package_name' => '',
            'notification'  => [
                'sound'         => 'default',
                'click_action'  => 'FCM_PLUGIN_ACTIVITY',
                'icon'          => 'fcm_push_icon'
            ],
            'priority'      => 'high',
        ]
    ]
];