<?php 

namespace App\Model;
 
use Illuminate\Database\Eloquent\Model;
use \App\Model\AppEvent;

class AppInstallation extends Model
{
    protected $table = 'app_installations';
    public $timestamps = false;
    protected $primaryKey = 'app_installation_id';

    /**
     * Subscribes to all webhook events after auth flow
     *
     * @return void
     */
    public function subscribeToWebhooks()
    {
        $client = $this->getWeeblyClient();

        return $client->post(
            '/webhooks',
            [
                'event' => [
                    'user.update',
                    'site.copy',
                    'site.delete',
                    'site.publish',
                    'site.update',
                    'store.info.update',
                    'store.category.create',
                    'store.category.delete',
                    'store.category.update',
                    'store.product.create',
                    'store.product.delete',
                    'store.product.update',
                    'store.cart.create',
                    'store.cart.update',
                    'store.order.create',
                    'store.order.update',
                    'store.order.ship',
                    'store.order.pay',
                    'store.order.refund',
                    'store.order.return',
                    'store.order.cancel',
                ],
                'callback_url' => 'http://weebly-livefeed.scalingo.io/events'
            ]
        );
    }

    /**
     * Returns an instance of a weebly_client populated with the installations details
     *
     * @return WeeblyClient 
     */
    public function getWeeblyClient()
    {
        return new \Weebly\WeeblyClient(
            getenv('APPLICATION_CLIENT_ID'), 
            getenv('APPLICATION_CLIENT_SECRET'), 
            $this->weebly_user_id, 
            $this->weebly_site_id,
            $this->access_token
        );
    }

    /**
     * Finds or creates a new user given a weebly app installation
     *
     *
     * @return \App\Model\User $user
     */
    public function findOrCreateUser()
    {
        $installation = static::where('weebly_user_id', '=', $this->weebly_user_id)->whereNotNull('user_id')->first();

        if ($installation && $installation->user_id) {
            $user = \App\Model\User::find($installation->user_id);
        } else {
            $user = $this->createFromWeebly();
        }

        return $user;
    }

    /**
     * Creates a new user model with an email from Weebly User API
     *
     * @return \App\Model\User $user
     */
    public function createFromWeebly()
    {
        $client = $this->getWeeblyClient();
        $user_information = $client->get('/user');
        $user = \App\Model\User::create([
            'username' => $user_information->user->email,
            'reset_token' => uniqid(),
            'password_hash' => password_hash(uniqid(), PASSWORD_BCRYPT)
        ]);
        $user->sendResetEmail();
        return $user;
    }

    /**
     * Hits weebly api to update site title on installation
     *
     * @return void
     */
    public function updateSiteTitle()
    {
        if ($this->access_token) {
            $client = $this->getWeeblyClient();
            $site_information = $client->get('/user/sites/'.$this->weebly_site_id);
            if ($this->site_title !== $site_information->site->site_title) {
                $this->site_title = $site_information->site->site_title;
                $this->save();
            }
        }
    }

    /** 
     * Create App Event record for this installation
     *
     * @param string $event_name
     * @param array $event_data
     * @return void
     */
    public function registerEvent($event_type, $event_data)
    {
        $event = AppEvent::create([
            'app_installation_id' => $this->app_installation_id,
            'event_type' => $event_type,
            'event_data' => json_encode($event_data),
        ]);
    }

    /**
     * Finds all events subscribed to this app 
     *
     * @return array
     */
    public function allEvents()
    {
        return AppEvent::where('app_installation_id', $this->app_installation_id)->orderBy('app_event_id', 'DESC')->get();
    }
}