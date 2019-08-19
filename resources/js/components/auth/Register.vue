<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm8 md4>
      <v-card class="elevation-12">
        <v-toolbar style="background-color: #0F978F" dark flat>
          <v-toolbar-title>Register form</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-form lazy-validation>
            <v-text-field v-model="email" color="teal" :rules="emailRules" label="Email" prepend-icon="email" type="text"></v-text-field>
            <v-text-field v-model="name" color="teal" :rules="nonNull" label="Username" prepend-icon="person" type="text"></v-text-field>
            <v-text-field v-model="phone" color="teal" :rules="nonNull" label="Phone number" prepend-icon="phone" type="text"></v-text-field>
            <v-text-field v-model="password" color="teal" prepend-icon="lock" :append-icon="pw_visibility ? 'visibility' : 'visibility_off'" :rules="passwordRules" :type="pw_visibility ? 'text' : 'password'" label="Password" hint="At least 8 characters" @click:append="pw_visibility = !pw_visibility" required></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-btn style="background-color: #0F978F" block round dark @click="register">Register</v-btn>
        </v-card-actions>
      </v-card>
      <h4 class="mt-4 text-center">Have an account ? <a href="login" style="text-decoration: none">Sign In</a></h4>
    </v-flex>

    <template>
      <v-dialog v-model="dialog_loading" persistent width="300">
        <v-card style="background-color: #0F978F" dark>
          <v-card-text>
            Mohon tunggu
            <v-progress-linear indeterminate color="white" class="mb-0"></v-progress-linear>
          </v-card-text>
        </v-card>
      </v-dialog>
    </template>

  </v-layout>
</template>

<script>
  export default {
    props: {
      source: String,
    },
    data: () => ({
      email: '',
      name: '',
      phone: '',
      password: '',
      dialog_loading: false,
      pw_visibility: false,
      passwordRules: [
          v => !!v || 'Password is required',
          v => (v && v.length >= 8) || 'Min 8 characters'
      ],
      nonNull: [
        v => !!v || 'Field is Required'
      ],
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid'
      ]
    }),
    methods: {
      register(){
        this.dialog_loading = true
        axios.post("user/register", {
          email: this.email,
          name: this.name,
          password: this.password,
          phone: this.phone
        }).then((response) => {
          if(response.data.success == 'true'){
            this.dialog_loading = false
            localStorage.setItem('guest', false)
            localStorage.setItem('user_id', response.data.user_id)
            window.location.href = "home"
          } else {
            localStorage.setItem('guest', true)
            this.dialog_loading = false
            Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
            })
          }
        });
      }
    }
  }
</script>