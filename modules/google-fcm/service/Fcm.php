<?php
/**
 * fcm service
 * @package google-fcm
 * @version 0.0.1
 * @upgrade true
 */

namespace GoogleFcm\Service;
use App\Model\Application as App;

class Fcm {
    
    public function send($appid, $options){
        $dis = \Phun::$dispatcher;
        $preset = $dis->config->fcm;
        
        $app = App::get(['id'=>$appid], false);
        if(!$app)
            return 'Application not found';
        
        if(!$app->apikey)
            return 'Application dont have apikey';
        
        $config = array_replace_recursive($preset, $options);
        
        if(!$config['restricted_package_name'] && $app->package)
            $config['restricted_package_name'] = $app->package;
        
        $cu = curl_init('https://fcm.googleapis.com/fcm/send');
        curl_setopt($cu, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: key=' . $app->apikey
        ]);
        curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cu, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($cu, CURLOPT_POST, true);
        curl_setopt($cu, CURLOPT_POSTFIELDS, json_encode($config));
        
        curl_exec($cu);
        return true;
    }
    
}