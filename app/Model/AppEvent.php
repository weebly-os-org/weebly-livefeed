<?php 

namespace App\Model;
 
use Illuminate\Database\Eloquent\Model;


class AppEvent extends Model
{
    protected $table = 'app_events';
    public $timestamps = false;
    protected $primaryKey = 'app_event_id';
    protected $fillable = ['app_installation_id', 'event_type', 'event_data'];
}