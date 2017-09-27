<?php
/**
 * fcm service
 * @package google-fcm
 * @version 0.0.1
 * @upgrade true
 */

namespace GoogleFcm\Service;

class Fcm {
    
    public function send($options){
        $phun = \Phun::$dispatcher;
        $preset = $phun->config->fcm;
        $config = array_replace_recursive($preset, $options);
        
        $ph = include BASEPATH . '/modules/core/config.php';
        $gf = include BASEPATH . '/modules/google-fcm/config.php';
        
        $ua = vsprintf('%s(%s) by %s(%s) via %s(%s)', [
            $phun->config->name,
            $phun->config->version,
            'Phun',
            $ph['__version'],
            'GoogleFCM',
            $gf['__version']
        ]);
        
        $cu = curl_init('https://fcm.googleapis.com/fcm/send');
        curl_setopt($cu, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: key=' . $config['apikey']
        ]);
        curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cu, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($cu, CURLOPT_USERAGENT, $ua);
        curl_setopt($cu, CURLOPT_POST, true);
        curl_setopt($cu, CURLOPT_POSTFIELDS, json_encode($config['content']));
        
        $result = curl_exec($cu);
        
        $data = json_decode($result);
        
        return [
            'success' => $data->success,
            'failure' => $data->failure
        ];
    }
    
}