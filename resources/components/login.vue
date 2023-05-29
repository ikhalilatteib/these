<style>
.g-recaptcha {
  width: 100%; /* Définissez la largeur souhaitée */
  margin-bottom: 20px; /* Définissez l'espacement souhaité par rapport aux autres éléments du formulaire */
}
</style>
<template>
  <div id="containerbar" class="containerbar authenticate-bg">
    <!-- Start Container -->
    <div class="container">
      <div class="auth-box login-box">
        <!-- Start row -->
        <div class="row no-gutters align-items-center justify-content-center">
          <!-- Start col -->
          <div class="col-md-6 col-lg-5">
            <!-- Start Auth Box -->
            <div class="auth-box-right">
              <div class="card">
                <div class="card-body">
                  <form @submit.prevent="submitForm">
                    <div class="form-head">
                      <a href="index.html" class="logo"><img src="/assets/images/general/logo.png"
                                                             class="img-fluid" alt="logo"></a>
                    </div>
                    <h4 class="text-primary my-4">Giriş Yap !</h4>
                    <div class="form-group">
                      <div v-for="(field,i) of Object.keys(errorMsg)" :key="i">
                        <div v-for="(error,ind) of errorMsg[field] || []" :key="ind" class="text-danger mb-2">{{ error }}</div>
                      </div>
                      <input v-model="email" type="text" name="email" class="form-control" id="username"
                             placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <input v-model="password" type="password" name="password" class="form-control" id="password"
                             placeholder="Şifre" required>
                    </div>
                    <div class="form-row mb-3">
                      <div class="col-sm-6">
                        <div class="custom-control custom-checkbox text-left">
                          <input type="checkbox" name="remember" class="custom-control-input" id="rememberme">
                          <label class="custom-control-label font-14" for="rememberme">Beni Hatırla</label>
                        </div>
                      </div>
                    </div>
                    <div class="g-recaptcha" :data-sitekey="google_key"></div>
                    <button type="submit" class="btn btn-success btn-lg btn-block font-18">Giriş Yap</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- End Auth Box -->
          </div>
          <!-- End col -->
        </div>
        <!-- End row -->
      </div>
    </div>
    <!-- End Container -->
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      email: '',
      password: '',
      remember: false,
      errorMsg: {}
    };
  },
  methods: {
    submitForm() {
      // Logique de soumission du formulaire et validation du reCAPTCHA
      const response = grecaptcha.getResponse();
      if (response.length === 0) {
        // Le reCAPTCHA n'a pas été validé, affichez un message d'erreur ou effectuez une action appropriée
        this.errorMsg['captcha'] = ['Lütfen reCAPTCHA\'yı doğrulayın.'];

        return;
      }

      const formData = {
        email: this.email,
        password: this.password,
        remember: this.remember,

      };

      axios.post('/login', formData)
          .then(response => {
            location.href = '/'
          })
          .catch(error => {
            console.log(error)
            if (error.response && error.response.data) {
              const errors = error.response.data.errors;
              if (errors) {
                this.errorMsg = errors;
              } else if (error.response.data.message) {
                this.errorMsg = {general: [error.response.data.message]};
              }
            } else {
              this.errorMsg = {general: ['Bir hata oluştu. Lütfen tekrar deneyin.']};
            }
          });
    }
  },
  mounted() {
    const script = document.createElement('script');
    script.src = 'https://www.google.com/recaptcha/api.js';
    script.async = true;
    script.defer = true;
    document.body.appendChild(script);
  },
  computed: {
    google_key() {
      return import.meta.env.VITE_GOOGLE_RECAPTCHA_KEY;
    }
  }

};
</script>
