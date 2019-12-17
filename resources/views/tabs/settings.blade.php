
<div class="carousel-item" id="tab-settings">
    <h1 class="title">Settings</h1>

    <!-- EMAIL -->

    <section class="section">
        <h2 class="sub-title">Email</h2>
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">mail</i>
                <input disabled value="{{ Auth::user()->email }}" id="user-email" type="text">
            </div>
        </div>
    </section>

    <!-- NAME -->

    <section class="section">
        <h2 class="sub-title">Username</h2>
        <form class="fetch-submit" action="api/changeName" method="POST" data-callback="callback_updateUsername">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_box</i>
                    <input id="name" name="name" value="{{ Auth::user()->name }}" type="text" class="validate">
                    <label for="name">Name</label>
                </div>
                <button class="btn pink waves-effect" type="submit">CHANGE NAME
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </section>

    <!-- PASSWORD -->

    <section class="section">
        <h2 class="sub-title">Password</h2>
        <form class="fetch-submit" action="api/changePassword" method="POST" data-clear="true">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="current-password" name="current-password" type="password" class="validate">
                    <label for="current-password">Current password</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="new-password" name="new-password" type="password" class="validate">
                    <label for="new-password">New password</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="new-password_confirmation" name="new-password_confirmation" type="password" class="validate">
                    <label for="new-password_confirmation">Confirm password</label>
                </div>
                <button class="btn pink waves-effect" type="submit">CHANGE PASSWORD
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </section>

</div>
