<?php
 
namespace App\Http\Controllers;

use App\Model\User;
use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AppInstallation;

class EventController extends Controller
{
    public function create(Request $request)
    {
        if($this->validateRequest($request)){
            $lookup = \App\Model\AppInstallation::where('weebly_user_id', $request['data']['user_id']);

            if ($request['data']['site_id']) {
                $installs = [];
                $install = $lookup->where('weebly_site_id', $request['data']['site_id'])->first();
                if ($install) {
                    $installs[] = $install;
                }
            } else {
                $installs = $lookup->get();
            }

            foreach ($installs as $install) {
                $install->registerEvent($request['event'], $request['data']);
            }

            return response('Saved.', 200);
        };

        return response('Unauthorized', 403);
    }

    private function validateRequest(Request $request)
    {
        $request_data = [
            'client_id' => getenv('APPLICATION_CLIENT_ID'),
            'event' => $request['event'],
            'timestamp' => $request['timestamp'],
            'data' => $request['data']
        ];

        $hmac = hash_hmac('SHA256', json_encode($request_data), getenv('APPLICATION_CLIENT_SECRET'));
        
        return $hmac === $request['hmac'];
    }
}