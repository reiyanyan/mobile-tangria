<template>
  <div height="100%" flat>
    <div>
      <v-container>
          <h3 class="text-center">Pemberitahuan Jam Tutup</h3>
          <v-list two-line style="background-color: rgba(0,0,0,0);">
            <v-card class="my-2" flat v-for="item in items" :key="item.title" style="border-radius: 5px">
              <v-card-title>
                <v-list-tile avatar>
                  <v-list-tile-action>
                      <v-icon color="teal">info</v-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                      <v-list-tile-title v-text="item.date"></v-list-tile-title>
                      <v-list-tile-sub-title class="caption" style="white-space: pre-wrap;">{{ item.reason }}</v-list-tile-sub-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-card-title>
            </v-card>
          </v-list>
      </v-container>
    </div>

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

    <v-bottom-nav app :active.sync="navPosition" :value="true" fixed dark style="background-color: #0F978F">
      <v-btn color="white" flat value="home" @click="goToHome">
        <span>Home</span>
        <v-icon>home</v-icon>
      </v-btn>
      <v-btn color="white" flat value="info" @click="goToInfo">
        <span>Info</span>
        <v-icon>info</v-icon>
      </v-btn>
      <v-btn color="white" flat value="profile" @click="goToProfile">
        <span>Profile</span>
        <v-icon>star</v-icon>
      </v-btn>
    </v-bottom-nav>
  </div>
</template>
<script>
  export default {
    mounted() {
      this.dialog_loading = true
      axios.get("busy").then((response) => {
        this.items = response.data.time
        this.dialog_loading = false
      });
    },
    data () {
      return {
        navPosition : localStorage.getItem('navPosition'),
        dialog_loading: false,
        items: []
      }
    },
    methods: {
      goToHome(){
        localStorage.setItem('navPosition', 'home')
        window.location.href = "/home";
      },
      goToInfo(){
        localStorage.setItem('navPosition', 'info')
        window.location.href = "/info";
      },
      goToProfile(){
        localStorage.setItem('navPosition', 'profile')
        window.location.href = "/profile";
      },
    },
  }
</script>