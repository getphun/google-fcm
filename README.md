# google-fcm

Broadcast notification ke device melalui Google FCM. Module ini membuat satu service
dengan nama `fcm` yang bisa diakses dari kontroler dengan perintah `$this->fcm`.

Ada tambahan konfigurasi pada level aplikasi agar service ini bisa berjalan dengan
baik, yaitu konfigurasi dengan nama `fcm`:

```php
// ./etc/config.php

return [
    'name' => 'Phun',
    ...
    'fcm' => [
        'apikey' => 'AlzaSyc...',
        'content' => [
            'restricted_package_name' => 'com.example.android.app',
            'notification' => [
                'sound'         => 'default',
                'click_action'  => 'FCM_PLUGIN_ACTIVITY',
                'icon'          => 'fcm_push_icon'
            ],
            'priority'  => 'high',
        ]
    ]
];
```

Kirimkan pesan ke device dengan perintah seperti di bawah:

```php
...
// tindih konfigurasi aplikasi/module
$this->fcm->send([
    'apikey'    => 'AlzaSyc...',
    'content'   => [
        'restricted_package_name' => 'com.example...',
        'notification' => [
            'title'         => 'New Message',
            'body'          => 'You get new message',
            'sound'         => 'default',
            'click_action'  => 'FCM_PLUGIN_ACTIVITY',
            'icon'          => 'fcm_push_icon'
        ],
        'priority'  => 'high',
        'data'      => [
            'key1' => 'value1',
            'key2' => 'value2'
        ],
        'to' => '/topics/admin'
    ]
]);

// gunakan konfigurasi aplikasi/module
$this->fcm->send([
    'content' => [
        'notification' => [
            'title' => 'Alloha Human',
            'body'  => 'What\'s up there?'
        ],
        'data' => [
            'key1' => 'value1',
            'key2' => 'value2'
        ],
        'to' => 'eZ1paNV4NVk...'
    ]
]);
...
```

Masing-masing property yang sudah ada di konfigurasi aplikasi bersifat optional,
jika tidak diset, maka akan menggunakan data dari konfigurasi aplikasi.

Property `to` menerima nilai array registration id, atau string registration id,
atau string topics ( prefix `/topics` ).

Informasi lebih lanjut tentang property masing-masing konfigurasi bisa dilihat di:

1. [cordova-plugin-fcm](https://github.com/fechanique/cordova-plugin-fcm)
1. [http-server-ref](https://firebase.google.com/docs/cloud-messaging/http-server-ref)