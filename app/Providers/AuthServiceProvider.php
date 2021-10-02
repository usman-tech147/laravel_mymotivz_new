<?php

namespace App\Providers;

use App\Models\Admin\AdminCandidate;
use App\Models\Admin\AdminClient;
use App\Models\Admin\AdminContract;
use App\Models\Admin\AdminJob;
use App\Models\Admin\AdminPlacement;
use App\Models\Admin\AdminResume;
use App\Models\Admin\AdminUser;
use App\Policies\Admin\AdminCandidatePolicy;
use App\Policies\Admin\AdminClientPolicy;
use App\Policies\Admin\AdminContractPolicy;
use App\Policies\Admin\AdminJobPolicy;
use App\Policies\Admin\AdminPlacementPolicy;
use App\Policies\Admin\AdminResumePolicy;
use App\Policies\Admin\AdminUserPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        AdminUser::class => AdminUserPolicy::class,
        AdminClient::class => AdminClientPolicy::class,
        AdminContract::class => AdminContractPolicy::class,
        AdminJob::class => AdminJobPolicy::class,
        AdminCandidate::class => AdminCandidatePolicy::class,
        AdminResume::class => AdminResumePolicy::class,
        AdminPlacement::class => AdminPlacementPolicy::class,
        // 'App\Model' => 'App\Policies\ModelPolicy',
//        'App\Job' => 'App\Policies\JobPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
