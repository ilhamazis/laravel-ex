<x-guest-layout class="body body_white">
    <main class="main main_login">
        <div class="container">
            <div class="form-login">
                <div class="form-login__header">
                    <div class="form-login__header-logo">
                        <img src="{{ asset('/assets/images/logo_sevima.svg') }}" alt="Logo SEVIMA">
                    </div>
                    <span class="form-login__header-separator"></span>
                    <h1 class="form-login__header-name">SEVIMA Career</h1>
                </div>
                <div class="form-login__content">
                    <div class="form-login__content-wrapper">
                        <h2 class="form-login__content-title">Sign In</h2>
                        <p class="form-login__content-subtitle">Masuk ke akun yang telah terdaftar.</p>
                    </div>
                    <div class="form-login__content-main">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            @method('POST')

                            <div class="form-control">
                                <label for="username" class="form-control__label">
                                    Username atau Email<span class="important">*</span>
                                    <span data-tooltip="Masukkan username atau email yang sudah terdaftar">
                                        <span class="icon icon-information-circle"></span>
                                    </span>
                                </label>
                                <div @class([
                                         'form-control__group',
                                         'error' => $errors->has('username'),
                                     ])>
                                    <input type="text" name="username" class="form-control__input" id="username"
                                           value="{{ old('username') }}"
                                           placeholder="Masukkan username/email dengan benar" required>
                                    <span data-clear="input"></span>
                                </div>
                                @error('username')
                                <div class="form-control__helper error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label for="password" class="form-control__label">
                                    Password<span class="important">*</span>
                                    <span data-tooltip="Masukkan password setidaknya menggunakan 1 symbol">
                                        <span class="icon icon-information-circle"></span>
                                    </span>
                                </label>
                                <div @class([
                                         'form-control__group',
                                         'error' => $errors->has('password'),
                                     ])>
                                    <input type="password" name="password" class="form-control__input" id="password"
                                           placeholder="Masukkan password" required>
                                    <span data-visibility="input" data-type="password"></span>
                                </div>
                                @error('password')
                                <div class="form-control__helper error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-control">
                                <div class="checkbox">
                                    <input @checked(old('remember')) type="checkbox" name="remember"
                                           class="form-control__checkbox"
                                           id="remember-me">
                                    <label for="remember-me" class="form-control__label-checkbox">Ingat Saya</label>
                                </div>
                                <div class="form-control__float-right">
                                    <a class="link" href="#">
                                        Lupa Password?
                                    </a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn_primary">
                                Sign In
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-guest-layout>