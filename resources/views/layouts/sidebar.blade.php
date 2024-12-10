<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <span class="brand-text font-weight-light">Quiz App</span>
    </a>

    <!-- Sidebar Menu -->
    <div class="sidebar">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('quizzes.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>Quizzes by Category</p>
                </a>
            </li>
            @if(auth()->check())
                <li class="nav-item">
                    <a href="{{ route('my-quizzes') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>My Quizzes</p>
                    </a>
                </li>
            @endif
            @if(auth()->check() && auth()->user()->is_admin)
                <li class="nav-item">
                    <a href="{{ route('quizzes.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>Create Quiz</p>
                    </a>
                </li>
            @endif
        </ul>

    </div>
</aside>
