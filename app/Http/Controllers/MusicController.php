<?php
namespace App\Http\Controllers;

use App\User;
use App\Setting;
use App\Timeline;
use App\Wallet;
use App\Repositories\WalletRepository;
use App\Http\Requests;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Teepluss\Theme\Facades\Theme;
use Response;

class MusicController extends Controller
{
    /** @var WalletRepository */
    private $walletRepository;
    
    private $timeline;

    public function __construct(WalletRepository $walletRepo, Request $request)
    {
        $this->request = $request;
        $this->walletRepository = $walletRepo;        
    }

    public function audioRecording($username)
    {
        $timeline = Timeline::where('username', $username)->first();        
        
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');        
        $trending_tags = trendingTags();
                
        return $theme->scope('music/index', compact('timeline', 'trending_tags', 'balance'))->render();
    }     

}    

