  <!-- footer-->
  <div class="footer">
      <div class="row no-gutters justify-content-center">
          <div class="col-auto">
              <a href="{{ route('home') }}" class="{{ request()->route()->getName() == 'home' ? 'active' : '' }}">
                  <i class="material-icons las la-home"></i>
                  <p>Home</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="#" class="{{ request()->path() == 'user/analytics' ? 'active' : '' }}">
                  <i class="material-icons lab la-telegram"></i>
                  <p>Telegram</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="#" class="{{ request()->path() == 'plans' ? '' : '' }}">
                <div style="height: 56px; width: 56px; margin-top: -23px;" class="bg-default-light text-default rounded-circle shadow d-flex align-items-center">
                    <i style="font-size: 30px; width: 40px;" class="material-icons las la-trophy"></i>
                </div>
              </a>
          </div>
          <div class="col-auto">
              <a href="{{route('user.register')}}" class="{{ request()->path() == 'user/ptc' ? 'active' : '' }}">
                  <i class="material-icons las la-user-plus"></i>
                  <p>Sign Up</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="{{route('user.login')}}" class="{{ request()->path() == 'user/display-profile' ? 'active' : '' }}">
                  <i class="material-icons las la-door-open"></i>
                  <p>Log in</p>
              </a>
          </div>
      </div>
  </div>
