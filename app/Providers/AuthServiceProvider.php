<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Policies\BasiePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerGates();

        //
    }

    public function registerGates()
    {
        try {
            if (Schema::hasTable('modules')) {
                $dataType = app('\App\Models\Module');
                $dataTypes = $dataType->get();
                
                foreach ($dataTypes as $dataType) {
                    $policyClass = 'App\Policies\BasicPolicy';
                    if (isset($dataType->policy_name) && $dataType->policy_name !== ''
                        && class_exists($dataType->policy_name)) {
                        $policyClass = $dataType->policy_name;
                    }
                    $this->policies[$dataType->model_name] = $policyClass;
                }
                $this->registerPolicies();
              
            }else{
               
            }
        } catch (\PDOException $e) {
            var_dump('database error');exit;
            
        }
    }
}
