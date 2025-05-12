@include('layout.header_user')
<body>
  <div class="container">
    
    {{-- Header --}}
      <header>
        <h1>Login</h1>
      </header>
      {{-- Main Content --}}
      <main>
        {{-- Gambar --}}
        <img src="../img/Logo-Lila-Sari-Sedana.png" alt="Logo" class="img-fluid" style="max-width: 150px" />
        
        {{-- Form Content --}}
        <form id="formLogin" action="{{ route('login.submit') }}" method="post">
          @csrf
          @if (session('gagal'))
          <p class="text text-danger">{{ session('gagal') }}</p>                
          @endif
          @if (session('tidak_terdaftar'))
          <p class="text text-danger">{{ session('tidak_terdaftar') }}</p>                
          @endif
          @if (session('verifikasi_gagal'))
          <p class="text text-danger">{{ session('verifikasi_gagal') }}</p>                
          @endif
          @if ($errors->has('g-recaptcha-response'))
            <div class="text-danger mb-2">
              {{ $errors->first('g-recaptcha-response') }}
            </div>
          @endif
          <div class="mb-3">
            <input id="Username" type="text" class="form-control" placeholder="Username" required name="name"/>
          </div>
          <div class="mb-3 position-relative">
            <input id="password" type="password" class="form-control" placeholder="Password" required name="password"/>
            <i class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="cursor: pointer;"></i>
          </div>
          <div class="mb-3">
            {{-- <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div> --}}
          </div>
          <button type="submit" id="loginButton" class="login-button btn">
              <span id="buttonText" >Login</span>
          </button>
        </form>
        
      </main>
      <footer>
        <a href="#">Contact Us</a>
      </footer>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
      const togglePassword = document.getElementById('togglePassword');
      const password = document.getElementById('password');
    
      togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
    
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
