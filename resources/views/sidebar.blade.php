<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">

            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ asset('images/avatar.png') }}" alt="User-Profile-Image">
                    <div class="user-details">
                        <span>{{ session()->get('name') }}</span>
                    </div>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="pcoded-micon"><i
                                class="bi bi-house-door"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="bi bi-suitcase-lg"></i></span>
                        <span class="pcoded-mtext">Academic</span>
                        {{-- <i class="bi bi-caret-right dropdown-icon"></i> --}}
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('attend.index') }}" target="_self"><i
                                    class="bi bi-arrow-right items"></i>Attendance</a></li>
                        <li><a href="{{ route('timetable.index') }}" target="_self"><i class="bi bi-arrow-right items"></i>Time
                                Table</a></li>
                        <li><a href="{{ route('lessonPlan') }}" target="_self"><i class="bi bi-arrow-right items"></i>Lesson
                                Plan</a></li>
                        <li><a href="{{ route('calenderOfEvent') }}" target="_self"><i
                                    class="bi bi-arrow-right items"></i>Calender of Event</a></li>
                        <li><a href="{{ route('login') }}" target="_self"><i
                                    class="bi bi-arrow-right items"></i>Announcement</a></li>
                        <li><a href="{{ route('login') }}" target="_self"><i
                                    class="bi bi-arrow-right items"></i>Syllabus Covered</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="bi bi-pen"></i></span>
                        <span class="pcoded-mtext">Exam</span>
                        {{-- <i class="bi bi-caret-right dropdown-icon"></i> --}}
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('login') }}" target="_self"><i class="bi bi-arrow-right items"></i>Exam
                                Time Table</a></li>
                        <li><a href="{{ route('login') }}" target="_self"><i
                                    class="bi bi-arrow-right items"></i>Exam-Wise Result</a></li>
                        <li><a href="{{ route('login') }}" target="_self"><i
                                    class="bi bi-arrow-right items"></i>Progress Card</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="bi bi-currency-rupee"></i></span>
                        <span class="pcoded-mtext">Fees</span>
                        {{-- <i class="bi bi-caret-right dropdown-icon"></i> --}}
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('login') }}" target="_self"><i class="bi bi-arrow-right items"></i>Pay
                                Fees</a></li>
                        <li><a href="{{ route('feeHistory') }}" target="_self"><i class="bi bi-arrow-right items"></i>Fees
                                History</a></li>
                        <li><a href="{{ route('feeBalance') }}" target="_self"><i
                                    class="bi bi-arrow-right items"></i>Balance Fees</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="bi bi-people"></i></span>
                        <span class="pcoded-mtext">Parents/ Students</span>
                        {{-- <i class="bi bi-caret-right dropdown-icon"></i> --}}
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('login') }}" target="_self"><i class="bi bi-arrow-right items"></i>Apply
                                Leave</a></li>
                        <li><a href="{{ route('login') }}" target="_self"><i class="bi bi-arrow-right items"></i>Chat
                                With Teacher</a></li>
                        <li><a href="{{ route('login') }}" target="_self"><i
                                    class="bi bi-arrow-right items"></i>Feedback</a></li>
                        <li><a href="{{ route('login') }}" target="_self"><i class="bi bi-arrow-right items"></i>Update
                                Profile</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>
<script>
    document.querySelectorAll('.pcoded-hasmenu > a').forEach(menu => {
        menu.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default action to allow toggling
            var parent = this.parentElement;
            // Debug: Log the parent element
            console.log('Parent element:', parent);
            // Toggle the active class on the parent li
            parent.classList.toggle('active');
            // Debug: Log the new class list of the parent element
            console.log('New class list:', parent.classList);
        });
    });
</script>
<!-- [ navigation menu ] end -->
