<div class="carousel-item" id="tab-register">
    <section class="section">
        <h1 class="title">Sign in</h1>
        <form id="form-signin" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">mail</i>
                    <input id="sign-email" type="email" class="validate @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    <label for="sign-email">Email</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_box</i>
                    <input id="sign-username" type="text" class="validate @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                    <label for="sign-username">Username</label>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="sign-pw" type="password" class="validate @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <label for="sign-pw">Password</label>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="sign-pw-confirm" type="password" class="validate" name="password_confirmation" required autocomplete="new-password">
                    <label for="sign-pw-confirm">Confirm password</label>
                </div>

                <button class="btn pink waves-effect" type="submit" name="action">SIGN IN
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </section>
</div>
