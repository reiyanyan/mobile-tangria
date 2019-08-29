<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm8 md4>
      <h4
        v-if="invalid"
        class="text-center font-weight-light red--text text--darken-4"
      >Invalid Email/Password</h4>
      <v-card class="elevation-12">
        <v-toolbar dark flat style="background-color: #0F978F">
          <v-toolbar-title>Login</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-form>
            <v-text-field
              v-model="email"
              color="teal"
              label="Email"
              prepend-icon="email"
              type="text"
            ></v-text-field>
            <v-text-field
              v-model="password"
              color="teal"
              prepend-icon="lock"
              :append-icon="pw_visibility ? 'visibility' : 'visibility_off'"
              :type="pw_visibility ? 'text' : 'password'"
              label="Password"
              class="input-group--focused"
              @click:append="pw_visibility = !pw_visibility"
            ></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-btn style="background-color: #0F978F" dark @click="login" block round>Login</v-btn>
        </v-card-actions>
        <v-card-text>
          <center>or</center>
        </v-card-text>
        <v-card-actions>
          <v-btn
            class="facebook-btn"
            style="background-color: #3B5998"
            dark
            @click="loginFacebook"
            block
            round
          >
            <img src="/img/logo/facebook-logo.png" alt="facebook" /> Login with Facebook
          </v-btn>
        </v-card-actions>
        <v-card-actions>
          <v-btn
            class="google-btn"
            style="background-color: #B6B6B6"
            dark
            @click="loginGoogle"
            block
            round
          >
            <img src="/img/logo/google-logo.png" alt="google" /> Login with Google
          </v-btn>
        </v-card-actions>
      </v-card>
      <h4 class="mt-4 text-center">
        Doesn't have an account ?
        <a href="register" style="text-decoration: none">Sign Up</a>
      </h4>
    </v-flex>

    <template>
      <v-dialog v-model="dialog_loading" persistent width="300">
        <v-card color="primary" dark>
          <v-card-text>
            Mohon tunggu
            <v-progress-linear indeterminate color="white" class="mb-0"></v-progress-linear>
          </v-card-text>
        </v-card>
      </v-dialog>
    </template>
  </v-layout>
</template>

<style scoped>
.facebook-btn img {
  height: 18px;
  margin-right: 10px;
}

.google-btn img {
  height: 18px;
  margin-right: 10px;
}
</style>

<script>
export default {
  mounted() {
    if (this.$root.guest == "false") {
      window.location.href = "home";
      console.log("auth kok");
    }
  },
  props: {
    source: String
  },
  data: () => ({
    email: "",
    password: "",
    pw_visibility: false,
    invalid: false,
    dialog_loading: false
  }),
  methods: {
    login() {
      this.dialog_loading = true;
      axios
        .post("user/login", {
          email: this.email,
          password: this.password
        })
        .then(response => {
          console.log(response.data.success == "true");
          if (response.data.success == "true") {
            this.dialog_loading = false;
            localStorage.setItem("guest", false);
            localStorage.setItem("user_id", response.data.user_id);
            this.invalid = false;
            window.location.href = "home";
          } else {
            localStorage.setItem("guest", true);
            this.dialog_loading = false;
            this.invalid = true;
          }
        });
    },
    loginFacebook() {
      window.location.href = "user/facebook";
    },
    loginGoogle() {
      window.location.href = "user/google";
    }
  }
};
</script>