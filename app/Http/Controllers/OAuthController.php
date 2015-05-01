<?php
 
namespace App\Http\Controllers;
 
use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AppInstallation;
 
 
class OAuthController extends Controller
{
 
    /**
     * The oauth redirect url endpoint for weebly OAuth flow
     *
     * @param Request $request
     * @return mixed
     */
    public function callback(Request $request)
    {
        if (isset($request['hmac']) && isset($request['user_id']) && isset($request['timestamp'])){
            return $this->handleInitialRequest($request);
        } else if (isset($request['authorization_code'])) {
            return $this->handleAccessTokenRequest($request);
        }
    }
    
    /**
     * Handles the redirect for the initial OAuth flow kickoff
     *
     * @param $request
     * @return void
     */
    private function handleInitialRequest(Request $request)
    {
        if ($this->verifyHMAC($request)) {
            $app_installation = new AppInstallation;
            $app_installation->weebly_site_id = $request['site_id'];
            $app_installation->weebly_user_id = $request['user_id'];
            $app_installation->save();
            
            $required_scope = [
                'read:site',
                'write:site',
                'read:store-catalogue',
                'write:store-catalogue',
                'read:order-catalogue',
                'write:order-catalogue',
                'webhooks'
            ];

            $client = $app_installation->getWeeblyClient();

            return redirect($client->getAuthorizationUrl($required_scope));
        }
    }

    /**
     * Creates an HMAC of the request data for callback redirect and confirms it with the hmac provided
     *
     * @param Request $request
     * @return bool 
     */
    private function verifyHMAC(Request $request)
    {
        $request_data = [
            'user_id' => $request['user_id'],
            'timestamp' => $request['timestamp']
        ];

        if (isset($request['site_id'])) {
            $request_data['site_id'] = $request['site_id'];
        }

        $hmac = hash_hmac('SHA256', http_build_query($request_data), getenv('APPLICATION_CLIENT_SECRET'));

        return $hmac === $request['hmac'];
    }

    /**
     * Handles authorization_code redirect part of Weebly OAuth flow, exchanges authorization
     * code for an access_token and create/updates livefeed user account
     *
     * @param Request $request
     * @return redirect('signup') 
     */
    private function handleAccessTokenRequest(Request $request)
    {
        $app_installation = AppInstallation::where('weebly_user_id', '=', $request['user_id'])
                                                ->where('weebly_site_id', '=', $request['site_id'])
                                                ->firstOrFail();
        $client = $app_installation->getWeeblyClient();
        
        $app_installation->access_token = $client->getAccessToken($_GET['authorization_code']);

        $user = $app_installation->findOrCreateUser();
        $app_installation->user_id = $user->user_id;
        $app_installation->save();

        $app_installation->updateSiteTitle();
        $app_installation->subscribeToWebhooks();

        $_SESSION['user_id'] = $user->user_id;
        return redirect('/');
    }
}