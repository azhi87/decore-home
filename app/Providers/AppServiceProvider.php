<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
    use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

        public function boot()
        {
            Schema::defaultStringLength(191);


            view()->composer('*',function($view) {
            //$view->with('user', \Auth::user()->first());
            $view->with('rate', \App\Rate::latest()->first()); 
        });


        view()->composer(['items.add', 'items.update'], function ($view) {
            $view->with([
                'cats' => \App\Category::all(),
                'items' => \App\Item::notDeleted()->latest()->paginate(35),
                'items_all' => \App\Item::notDeleted()->get(),
                'suppliers' => \App\Supplier::all()
            ]);
        });

             
           view()->composer(['transfers.transfer','transfers.updateTransfer'],function($view){
          $view->with([
            'suppliers'=>\App\Supplier::all(),
            ]);
        });

          view()->composer('auth.register',function($view){
        $view->with([
            'cats'=>\App\Category::all(),
            
            ]);
             });

          view()->composer('items.peripheralUpdates',function($view){
        $view->with([
            'cats'=>\App\Category::all()
			]);
             });

    
        view()->composer('customers.customerUpdate',function($view){
         $view->with([
            'customers'=>\App\Customer::latest()->paginate(15)
            ]);
            });

          view()->composer('suppliers.suppliersHome',function($view){
          $view->with([
            'suppliers'=>\App\Supplier::paginate(15)
            ]);
        });

           view()->composer(['purchases.addPurchase','purchases.updatePurchase'],function($view){
          $view->with([
            'suppliers'=>\App\Supplier::all(),
            'items'=>\App\Item::where('status','1')->get()
            ]);
        });

           
           view()->composer(['paybacks.payback','paybacks.updatePayback'],function($view){
          $view->with([
            'users'=>\App\User::users()
            ]);
        });

           view()->composer(['expenses.expenseHome','staff.staffHome','expenses.expenseUpdate'],function($view){
          $view->with([
            'users'=>\App\User::where('status','1')->get(),
            'branches'=>\App\Branch::all(),
            'reasons'=>\App\Reason::all()
            ]);
        });


           view()->composer(['sales.updateSale','sales.addSale'],function($view){
          $view->with([
            'mandwbs'=>\App\User::users('mandwb'),
             'customers'=>\App\Customer::all(),
            'items'=>\App\Item::where('status','1')->get()

            ]);
        });
        
        view()->composer('main.index',function($view){
          $view->with([
            'items'=>\App\Item::all()
            ]);
        });

          

        }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
