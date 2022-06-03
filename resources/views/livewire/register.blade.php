<div>
    <div class="md:w-[350px] w-[300px] bg-white rounded-xl m-auto mt-10 shadow">
        <div class="w-full py-5 px-10">
            <h4 class="font-bold text-xl">ثبت نام</h4>
        </div>
        <hr>
        <div class="py-5 px-5">
            <form wire:submit.prevent="login">
                <div class="my-3">
                    <label for="name">نام</label>
                    <input type="text" wire:model.debounce.500ms="name" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="نام خود را وارد کنید">
                    @error('name')
                        <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-3">
                    <label for="name">ایمیل</label>
                    <input type="email" wire:model.debounce.500ms="email" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="ایمیل خود را وارد کنید">
                    @error('email')
                        <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-3">
                    <label for="name">رمز ورود</label>
                    <input type="password" wire:model.debounce.500ms="password" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="رمز ورود خود را وارد کنید">
                    @error('password')
                        <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-3">
                    <label for="name">تایید رمز ورود</label>
                    <input type="password" wire:model.debounce.500ms="password_confirmation" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="رمز ورود خود را تایید کنید">
                    @error('password_confimation')
                        <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-3">
                    <button type="submit" class="w-full my-1 rounded bg-blue-400 text-white border font-bold px-3 py-2 outline-none hover:bg-white hover:text-blue-500 hover:border-blue-500 duration-150">ثبت نام</button>
                </div>
                <div class="my-3">
                    <a class="text-blue-500 mx-3" href="{{ route('login') }}">یک حساب دارید ؟ ورود به سایت</a>
                </div>
            </form>
        </div>
    </div>
</div>
