<?php
 
namespace App\Http\Controllers;

use App\Model\User;
use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AppInstallation;

class AppInstallationController extends Controller
{
    public function all()
    {
        return AppInstallation::where('user_id', $_SESSION['user_id'])->get();
    }

    public function getEvents(Request $request, $app_installation_id)
    {
        $installation = AppInstallation::find($app_installation_id);

        return $installation->allEvents();
    }
}