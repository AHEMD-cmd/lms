<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="logo" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Instructor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if (auth()->user()->status == 1)
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-book'></i>
                    </div>
                    <div class="menu-title">Manage Course</div>
                </a>
                <ul>

                    <li> <a href="{{ route('instructor.courses.index') }}"><i class='bx bx-radio-circle'></i>All Courses
                        </a>
                    </li>

                    <li> <a href="{{ route('instructor.courses.create') }}"><i class='bx bx-radio-circle'></i>Create Course
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
    <!--end navigation-->
</div>
