<div class="carousel-item" id="tab-settings">
    <h2 class="center">Settings</h2>

    <section class="section">
        <h3 class="section-title">Email</h3>
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">verified_user</i>
                <input disabled value="quentin.vallat@he-arc.ch" id="user-email" type="text" class="validate">
            </div>
        </div>
    </section>
    <section class="section">
        <h3 class="section-title">Username</h3>
        <form id="form-change-username" class="fetch-submit" action="api/changeUsername" method="POST">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_box</i>
                    <input id="user-username" name="username" value="{{ Auth::user()->name }}" type="text" class="validate">
                    <label for="user-username">Username</label>
                </div>
                <button class="btn pink waves-effect" type="submit">CHANGE USERNAME
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </section>
    <section class="section">
        <h3 class="section-title">Password</h3>
        <form id="form-change-pw">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="user-pw-current" type="password" class="validate">
                    <label for="user-pw-current">Current password</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="user-pw-new" type="password" class="validate">
                    <label for="user-pw-new">New password</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="user-pw-confirm" type="password" class="validate">
                    <label for="user-pw-confirm">Confirm password</label>
                </div>
                <button class="btn pink waves-effect" type="submit" name="action">CHANGE PASSWORD
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </section>
    <section class="section">
        <h3 class="section-title">Profile picture</h3>
        <div class="row">
            <img class="materialboxed" data-caption="Profile picture" width="100" src="img/pp.jpg">
            <div class="file-field input-field">
                <div class="btn">
                    <span>File</span>
                    <input type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <button class="btn pink waves-effect" type="submit" name="action">CHANGE PICTURE
                <i class="material-icons right">send</i>
            </button>
        </div>
    </section>

</div>
