<div>
    <div class="md:w-[350px] w-[300px] bg-white rounded-xl m-auto mt-10 shadow">
        <div class="w-full py-5 px-10">
            <h4 class="font-bold text-xl">ورود</h4>
        </div>
        <hr>
        <div class="py-5 px-5">
            <form wire:submit.prevent="login">
                <div class="my-3">
                    <label for="name">ایمیل</label>
                    <input type="email" wire:model.debounce.500ms="email" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="ایمیل خود را وارد کنید">
                    @error('email')
                        <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-3">
                    <label for="password">رمز ورود</label>
                    <input type="password" wire:model.debounce.500ms="password" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="رمز ورود خود را وارد کنید">
                    @error('password')
                        <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-3 flex">
                    <label for="remember">مرا به یاد داشته باش</label>
                    <input type="checkbox" wire:model.debounce.500ms="remember" class="mx-2 my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="رمز ورود خود را وارد کنید">
                </div>
                <div class="my-3">
                    <button type="submit" class="w-full my-1 rounded bg-blue-400 text-white border font-bold px-3 py-2 outline-none hover:bg-white hover:text-blue-500 hover:border-blue-500 duration-150">ورود</button>
                </div>
                <div class="my-3">
                    <a class="text-blue-500 mx-3" href="{{ route('register') }}">ساخت حساب جدید</a>
                </div>
                @if (session()->has('error'))
                    <span class="my-2 mr-5 text-red-500">{{ session()->get('error') }}</span>
                @endif
            </form>
        </div>
    </div>
</div>
