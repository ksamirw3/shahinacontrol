<aside>
    <div id="sidebar"  class="nav-collapse " style="min-height: 120%">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">


            <section class="cs-mune">
                <!-------------------------------->
                <h3 ><a class="{{(Request::is('admin'))?'active':''}}" href="admin" >Dashboard</a></h3>
                <!-------------------------------->
                <div class="cs-mune-item">
                    <h3>administration</h3>
                    <div>
                        <!-------------------------------->
                     
                     

                    </div>
                </div>
                <!-------------------------------->
                <div class="cs-mune-item">
                    <h3>labs</h3>
                    <div>
                    
                    </div>
                </div>
                <!-------------------------------->
                <div class="cs-mune-item">
                    <h3>instructors</h3>
                    <div>
                       
                    </div>
                </div>
                <!-------------------------------->
                <div class="cs-mune-item">
                    <h3>students</h3>
                    <div>
                     
                    </div>
                </div>
                <!-------------------------------->
             
                <div class="cs-mune-item">
                    <h3>Courses</h3>
                    <div>
              
                    </div>
                </div>
                <!-------------------------------->
                <div class="cs-mune-item">
                    <h3>Attendees</h3>
                    <div>
                      
                    
                    </div>
                </div>
                <!-------------------------------->
                <div class="cs-mune-item">
                    <h3>reports</h3>
                    <div>
                        <!-------------------------------->
                        {{-- */$dir='reports/student-certificate';/* --}}
                        @if($auth::can('view',$dir))
                        <a class="{{((Request::is('admin/'.$dir)||Request::is('admin/'.$dir.'/*'))&& !Request::is('admin/'.$dir.'/edit-account') )?'active':''}}" href="admin/{{$dir}}">
                            <i class="ti-user"></i>
                            <span style="text-transform: capitalize">{{__('admin.studetns certificate')}}</span>
                        </a>
                        @endif
                        <!-------------------------------->
                        <!-------------------------------->
                        {{-- */$dir='reports/lab-schedule';/* --}}
                        @if($auth::can('view',$dir))
                        <a class="{{((Request::is('admin/'.$dir)||Request::is('admin/'.$dir.'/*'))&& !Request::is('admin/'.$dir.'/edit-account') )?'active':''}}" href="admin/{{$dir}}">
                            <i class="ti-user"></i>
                            <span style="text-transform: capitalize">{{__('admin.Lab Schedule ')}}</span>
                        </a>
                        @endif
                        <!-------------------------------->
                        <!-------------------------------->
                        {{-- */$dir='reports/course-schedule';/* --}}
                        @if($auth::can('view',$dir))
                        <a class="{{((Request::is('admin/'.$dir)||Request::is('admin/'.$dir.'/*'))&& !Request::is('admin/'.$dir.'/edit-account') )?'active':''}}" href="admin/{{$dir}}">
                            <i class="ti-user"></i>
                            <span style="text-transform: capitalize">{{__('admin.Course  Schedule ')}}</span>
                        </a>
                        @endif
                        <!-------------------------------->
                        <!-------------------------------->
                        {{-- */$dir='reports/archived-group';/* --}}
                        @if($auth::can('view',$dir))
                        <a class="{{((Request::is('admin/'.$dir)||Request::is('admin/'.$dir.'/*'))&& !Request::is('admin/'.$dir.'/edit-account') )?'active':''}}" href="admin/{{$dir}}">
                            <i class="ti-user"></i>
                            <span style="text-transform: capitalize">{{__('admin.archived group')}}</span>
                        </a>
                        @endif
                        <!-------------------------------->
                        <!-------------------------------->
                        {{-- */$dir='reports/instructor-schedule';/* --}}
                        @if($auth::can('view',$dir))
                        <a class="{{((Request::is('admin/'.$dir)||Request::is('admin/'.$dir.'/*'))&& !Request::is('admin/'.$dir.'/edit-account') )?'active':''}}" href="admin/{{$dir}}">
                            <i class="ti-user"></i>
                            <span style="text-transform: capitalize">{{__('admin.instructor  schedule')}}</span>
                        </a>
                        @endif
                        <!-------------------------------->
                        <!-------------------------------->
                        {{-- */$dir='reports/instructor-rate';/* --}}
                        @if($auth::can('view',$dir))
                        <a class="{{((Request::is('admin/'.$dir)||Request::is('admin/'.$dir.'/*'))&& !Request::is('admin/'.$dir.'/edit-account') )?'active':''}}" href="admin/{{$dir}}">
                            <i class="ti-user"></i>
                            <span style="text-transform: capitalize">{{__('admin.instructor  rate')}}</span>
                        </a>
                        @endif
                        <!-------------------------------->
                    </div>
                </div>
            </section>            



            <?php // dd($auth::can('view', 'admins')) ?>


            <!--*********************************************************-->



            <!--*********************************************************-->


            <!--*********************************************************-->

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
