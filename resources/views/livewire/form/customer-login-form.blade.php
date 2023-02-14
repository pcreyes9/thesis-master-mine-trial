
<div class="container flex flex-col lg:flex-row items-center py-5 mt-10">
    <!-- Image -->
    <div class="intro-y flex justify-center flex-1 z-10  hidden  sm:hidden md:hidden lg:hidden xl:block 2xl:block	">
        <img  src="{{ asset('dist/images/login.svg') }}" alt="Go Dental Login Image" />
    </div>
    <!-- Content -->
    <div class="items-center justify-center flex flex-1  ">
        <div class="my-3 px-5  box w-auto   ">
            <div class="p-5 border-b-2 border-slate-100 ">
                <h2 class="intro-x text-xl font-medium  mr-auto  ">
                    Welcome to Go-Dental! Please Login
                </h2>
            </div>
            <div class="p-5">
                <form wire:submit.prevent="login">
                    @csrf
                    @if(session('fail'))
                        <div class="alert alert-danger show flex items-center mb-2" role="alert">
                            <i class="fa-solid  fa-2x fa-circle-exclamation mr-2"></i> {{ session('fail') }}
                        </div>
                    @endif
                    @if(session('info'))
                        <div class="intro-x alert alert-dark show mb-2 mt-2" role="alert">{{session('info')}}</div>
                    @endif

                    @if(session('status'))
                        <div class="alert alert-primary show mb-2" role="alert">{{session('status')}}</div>
                    @endif

                    <div class=" text-base ">
                        <div class="intro-x ">
                            <label class="form-label">Email</label>
                            <input type="email" wire:model.lazy="email" class="form-control @error('email') border-danger @enderror" placeholder="example@gmail.com" >
                            <div class="text-danger mt-2">@error('email'){{$message}}@enderror</div>
                        </div>
                        <div class="mt-3 intro-x">
                            <label class="form-label">Password</label>
                            <input type="password" wire:model.lazy="password" class="form-control" placeholder="password">
                        </div>
                        <div class="intro-x flex text-slate-600 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                                <input type="checkbox" wire:model.lazy="remember" class="form-check-input border mr-2">
                                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                            </div>
                            <a href="{{ Route('resetcustomer.index') }}" class="text-slate-400" >Forgot Password?</a>
                        </div>
                        <div wire:ignore class="intro-x">
                            <button type="submit" class="g-recaptcha btn btn-primary mt-5 w-full"
                            data-sitekey="{{env('CAPTCHA_SITE_KEY')}}"
                            data-callback='handle'
                            data-action='login' >Login</button>
                        </div>
                        <div class="pt-5 text-center intro-x" >
                            <a class="text-primary font-normal" href="{{Route('CRegister.index')}}">New to Go Dental? Click here.</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js?render={{env('CAPTCHA_SITE_KEY')}}"></script>
        <script>
            function handle(e) {
                grecaptcha.ready(function () {
                    grecaptcha.execute('{{env('CAPTCHA_SITE_KEY')}}', {action: 'login'})
                        .then(function (token) {
                            @this.set('captcha', token);
                        });
                });
            }
        </script>
    @endpush
</div>
