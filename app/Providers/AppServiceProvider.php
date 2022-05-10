<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $lastLog = User::select('lastLog')->where('id', auth()->id())->first();
        // dd($lastLog);
        // $salesCount = Sale::where('created_at', '>=', $lastLog);
        // dd($salesCount);    
        // View::share('salesCount', $salesCount);
        Paginator::defaultView('includes.paginate.paginateView');
        Paginator::defaultSimpleView('includes.paginate.paginateView');
    }
}
