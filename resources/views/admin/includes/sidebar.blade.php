<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
                    <span>
                        <button type="button"
                                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu</li>
                <li>
                    <a href="{{route('admin')}}">
                        <i class="metismenu-icon pe-7s-map"></i>
                        Recruitment Pipeline
                    </a>
                </li>
                <li>
                    <a href="{{route('client.dashboard')}}">
                        <i class="metismenu-icon pe-7s-map"></i>
                        Client Dashboard
                    </a>
                </li>
                @can('create', App\Models\Admin\AdminUser::class)
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-users"></i>
                            Employees
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>

                            <li>
                                <a href="{{route('sub_admin_create')}}">
                                    Add New Employee
                                </a>
                            </li>

                            <li>
                                <a href="{{route('sub_admin_all')}}">
                                    Employee Database
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Clients
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @can('create', App\Models\Admin\AdminClient::class)
                            <li>
                                <a href="{{route('client.create')}}">
                                    Add New Client
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{route('client.database')}}">
                                Clients Database
                            </a>
                        </li>
                        @can('import', App\Models\Admin\AdminClient::class)
                            <li>
                                <a href="{{route('clientimportpage')}}">
                                    Import Clients
                                </a>
                            </li>
                    @endcan
                    <!--  <li>
                             <a href="#presentModal" data-toggle="modal">
                                 Present
                             </a>
                         </li> -->
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Candidates
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @can('create', App\Models\Admin\AdminCandidate::class)
                            <li>
                                <a href="{{route('candidate.create')}}">
                                    Add New Candidate
                                </a>
                            </li>
                        @endcan
                        @can('import', App\Models\Admin\AdminCandidate::class)
                            <li>
                                <a href="{{route('candidateimportpage')}}">
                                    Import Candidates
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{route('candidate.database')}}">
                                Candidate Database
                            </a>
                        </li>
                        <li>
                            <a href="{{route('candidate.otm')}}">
                                OTM Candidates
                            </a>
                        </li>
                        <li>
                            <a href="{{route('candidate.dnc')}}">
                                DNC Candidates
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-portfolio"></i>
                        Jobs
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @can('create', App\Models\Admin\AdminJob::class)
                            <li>
                                <a href="{{route('job.create')}}">
                                    Add New Job
                                </a>
                            </li>
                        @endcan
                        @can('import', App\Models\Admin\AdminJob::class)
                            <li>
                                <a href="{{route('jobimportpage')}}">
                                    Job Import
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{route('job.database')}}">
                                Job Openings
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-portfolio"></i>
                        User Side Website
                        <span class="notify-x"> {{count(\App\user_job::whereNull('admin_id')->get())}} </span>
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="#">
                                <i class="metismenu-icon pe-7s-portfolio"></i>
                                Admin Jobs
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{route('user_side.create.job')}}">
                                        Post New Job
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('user_side.view.jobs')}}">
                                        View Jobs
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('front.clients')}}">
                                Clients
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="metismenu-icon pe-7s-portfolio"></i>
                                Jobs <span class="notify-x"> {{count(\App\user_job::whereNull('admin_id')->get())}} </span>
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{route('front.pending.jobs')}}">
                                        Pending Jobs<span class="notify-x ml-auto">
                                            {{count(\App\user_job::where('job_approved',0)->whereDate('applied_before','>',now())->whereNull('admin_id')->get()->toArray())}}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('front.active.jobs')}}">
                                        Active Jobs
                                        <span class="notify-x ml-3">
                                            {{count(\App\user_job::where('job_approved',1)->whereDate('applied_before','>',now())->whereNull('admin_id')->get()->toArray())}}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('front.inactive.jobs')}}">
                                        Inactive Jobs
                                        <span class="notify-x ml-3">
                                            {{count(\App\user_job::whereDate('applied_before','<',now())->whereNotIn('job_approved', [2])->whereNull('admin_id')->get()->toArray())}}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('front.rejected.jobs')}}">
                                        Rejected Jobs
                                        <span class="notify-x ml-auto">
                                            {{count(\App\user_job::where('job_approved',2)->whereNull('admin_id')->get()->toArray())}}
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('front.candidates')}}">
                                Candidates
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('scheduled-interviews')}}">
                        <i class="metismenu-icon pe-7s-file">
                        </i>Scheduled Interviews
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-file">
                        </i>Task
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('todoactions')}}">
                                Custom Actions
                            </a>
                        </li>
                        <li>
                            <a href="{{route('todo')}}">
                                To-Do List
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="{{route('calendar')}}">
                        <i class="metismenu-icon pe-7s-date"></i>
                        Calendar
                    </a>
                </li>
                <li>
                    <a href="{{route('allplacement')}}">
                        <i class="metismenu-icon pe-7s-copy-file"></i>
                        Placement
                    </a>
                </li>
                <li>

                    <a href="#">
                        <i class="metismenu-icon pe-7s-file"></i>
                        Status
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('status.create')}}">
                                Candidate Status
                            </a>
                        </li>

                    </ul>
                </li>
                <li>

                    <a href="#">
                        <i class="metismenu-icon pe-7s-file"></i>
                        Education
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('education.create')}}">
                                Add Education
                            </a>
                        </li>
                    </ul>
                </li>
            {{--New Fields--}}
            {{--                <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-users"></i>
                                    New Candidates
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    @can('create', App\Models\Admin\NewCandidate::class)
                                        <li>
                                            <a href="{{route('new.candidate.create')}}">
                                                Add New Candidate
                                            </a>
                                        </li>
                                    @endcan
                                    @can('import', App\Models\Admin\NewCandidate::class)
                                        <li>
                                            <a href="{{route('new.candidate.importpage')}}">
                                                Import Candidates
                                            </a>
                                        </li>
                                    @endcan
                                    <li>
                                        <a href="{{route('new.candidate.database')}}">
                                            Candidate Database
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('candidate.otm')}}">
                                            OTM Candidates
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('candidate.dnc')}}">
                                            DNC Candidates
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-users"></i>
                                    New Clients
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    @can('create', App\Models\Admin\Client::class)
                                        <li>
                                            <a href="{{route('client.create')}}">
                                                Add New Client
                                            </a>
                                        </li>
                                    @endcan
                                    <li>
                                        <a href="{{route('client.database')}}">
                                            Clients Database
                                        </a>
                                    </li>
                                    @can('import', App\Models\Admin\Client::class)
                                        <li>
                                            <a href="{{route('clientimportpage')}}">
                                                Import Clients
                                            </a>
                                        </li>
                                @endcan
                                <!--  <li>
                                         <a href="#presentModal" data-toggle="modal">
                                             Present
                                         </a>
                                     </li> -->
                                </ul>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-portfolio"></i>
                                    New Jobs
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    @can('create', App\Models\Admin\Job::class)
                                        <li>
                                            <a href="{{route('job.create')}}">
                                                Add New Job
                                            </a>
                                        </li>
                                    @endcan
                                    @can('import', App\Models\Admin\Job::class)
                                        <li>
                                            <a href="{{route('jobimportpage')}}">
                                                Job Import
                                            </a>
                                        </li>
                                    @endcan
                                    <li>
                                        <a href="{{route('job.database')}}">
                                            Job Openings
                                        </a>
                                    </li>
                                </ul>
                            </li>--}}
            <!-- <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-trash"></i>
                        Recycle Bin
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="block-employees-list.html">
                                Employee Database
                            </a>
                        </li>
                        <li>
                            <a href="block-clients-list.html">
                                Client Database
                            </a>
                        </li>
                        <li>
                            <a href="block-candidates-list.html">
                                Candidate Database
                            </a>
                        </li> -->
            </ul>
            </li>
            </ul>
        </div>
    </div>
</div>
