<?php?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Create an account</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="../Css/auth_base.css">
  <link rel="stylesheet" href="../Css/register_page.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.1/css/intlTelInput.css" />
</head>
<body>
  <div class="auth-shell">
    <div class="auth-card">
      <div class="auth-grid">

        <aside class="auth-visual">
          <div class="auth-caption">Capturing Moments, Creating Memories</div>
        </aside>

        <section class="auth-form">
          <h1 class="auth-title">Create an account</h1>
          <p class="auth-sub">Already have an account? <a href="login.php">Log in</a></p>

          <div id="register-msg" class="alert info" role="status" style="display:none"></div>

          <form id="register-form" autocomplete="on" novalidate>
            <div class="field">
              <label for="name">Full name</label>
              <input class="input" id="name" name="name" type="text" maxlength="100" required placeholder="eg: Ama Mensah">
            </div>

            <div class="field">
              <label for="email">Email</label>
              <input class="input" id="email" name="email" type="email" maxlength="50" required placeholder="eg: amamensah@gmail.com">
            </div>

            <div class="field">
              <label for="password">Password</label>
              <input class="input" id="password" name="password" type="password" minlength="8" maxlength="150" required placeholder="Enter your password">
              <div class="req-box" id="pwd-req">
            <ul class="req-list">
              <li data-rule="upper">One uppercase letter</li>
              <li data-rule="digit">At least one digit</li>
              <li data-rule="special">At least one special character</li>
              <li data-rule="len">Minimum of eight characters</li>
            </ul>
              </div>
            </div>

            <div class="field">
              <label for="confirm_password">Confirm password</label>
              <input class="input" id="confirm_password" name="confirm_password" type="password" minlength="8" maxlength="150" required placeholder="Re-enter your password">
            </div>

            <input type="hidden" id="country" name="country" value="">

            <div class="field">
              <label for="city">City</label>
              <input class="input" id="city" name="city" type="text" maxlength="30" required placeholder="eg: Accra">
            </div>

            <div class="field">
              <label for="phone_number">Contact number</label>
              <input class="input" id="phone_number" name="phone_number" type="tel" maxlength="15" required placeholder="+233 24 123 4567">
              <small class="helper">Choose country and contact number</small>
            </div>

            <button id="register-btn" class="btn" type="submit">Create account</button>
          </form>
        </section>

      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.1/js/intlTelInput.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.1/js/utils.js"></script>

  <script>
    (function () {
      window.iti = window.intlTelInput(document.getElementById('phone_number'), {
        initialCountry: 'gh',
        separateDialCode: true,
        utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.1/js/utils.js',
        preferredCountries: ['gh','ng','us','gb'],
        autoPlaceholder: 'aggressive'
      });

      function syncCountryHidden(){
        var data = window.iti.getSelectedCountryData(); 
        document.getElementById('country').value = data && data.name ? data.name : '';
      }
      syncCountryHidden();
      document.getElementById('phone_number').addEventListener('countrychange', syncCountryHidden);
    })();
  </script>
<script>
  (function(){
    const $pw  = $('#password');
    const $cpw = $('#confirm_password');

    function markBox(id, key, ok){
      const $li = $('#'+id+' [data-rule="'+key+'"]');
      $li.toggleClass('done', !!ok);
    }
    function toggleHasValue($el){
      $el.closest('.field').toggleClass('has-value', $el.val().length > 0);
    }

    function checkPassword(){
      const v = $pw.val();
      const okUpper   = /[A-Z]/.test(v);
      const okDigit   = /\d/.test(v);
      const okSpecial = /[!@#$%^&*(),.?":{}|<>_\-\\[\];'`~]/.test(v);
      const okLen     = v.length >= 8;

      markBox('pwd-req','upper', okUpper);
      markBox('pwd-req','digit', okDigit);
      markBox('pwd-req','special', okSpecial);
      markBox('pwd-req','len', okLen);

      toggleHasValue($pw);
    }

    function checkMatch(){
      const ok = $pw.val() !== '' && $pw.val() === $cpw.val();
      markBox('match-req','match', ok);
      toggleHasValue($cpw);
    }

    // bind events
    $pw.on('focus input blur', function(){ checkPassword(); checkMatch(); });
    $cpw.on('focus input blur', checkMatch);
  })();
</script>

  <script src="../js/register.js"></script>
</body>
</html>
