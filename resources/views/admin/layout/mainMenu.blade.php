<div class="w-full">
    <ul>
        <li class="my-2">
            <a href="{{ route('admin.profile') }}" class="w-full px-3 py-2 flex justify-between items-center rounded duration-150  {{ is_Url('admin.profile') }}">
                <span>پروفایل</span>
                <i class="fa fa-user"></i>
            </a>
        </li>
        @if(auth()->user()->is_superuser == 1 || auth()->user()->is_staff == 1)
        <li class="my-2">
            <a href="{{ route('admin') }}" class="w-full px-3 py-2 flex justify-between items-center rounded duration-150 {{ is_Url('admin') }}">
                <span>پنل مدیریت</span>
                <i class="fa fa-user"></i>
            </a>
        </li>
        <li class="my-2">
            <a href="{{ route('admin.users.index') }}" class="w-full px-3 py-2 flex justify-between items-center rounded duration-150 {{ is_Url('admin.users.index') }}">
                <span>کاربران</span>
                <i class="fa fa-users"></i>
            </a>
        </li>
        <li class="my-2">
            <a href="{{ route('admin.categories.index') }}" class="w-full px-3 py-2 flex justify-between items-center rounded duration-150 {{ is_Url('admin.categories.index') }}">
                <span>دسته بندی ها</span>
                <i class="fa fa-box"></i>
            </a>
        </li>
        <li class="my-2">
            <a href="{{ route('admin.newses.index') }}" class="w-full px-3 py-2 flex justify-between items-center rounded duration-150 {{ is_Url('admin.newses.index') }}">
                <span>اخبار</span>
                <i class="fa fa-list"></i>
            </a>
        </li>
        <li class="my-2">
            <a href="{{ route('admin.comments.index') }}" class="w-full px-3 py-2 flex justify-between items-center rounded duration-150 {{ is_Url('admin.comments.index') }}">
                <span>نظرات</span>
                <i class="fa fa-comments"></i>
            </a>
        </li>
        <li class="my-2">
            <a href="{{ route('admin.topics.index') }}" class="w-full px-3 py-2 flex justify-between items-center rounded duration-150 {{ is_Url(['admin.topics.index', 'admin.topics.create']) }}">
                <span>مقالات</span>
                <i class="fa fa-book"></i>
            </a>
        </li>
        @endif
    </ul>
</div>