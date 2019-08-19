<template>
  <div height="100%" flat>
    <div>
      <div>
        <v-container>
            <v-card @click="goToPackage">
              <v-img class="white--text" height="200px" src="/img/spa1.jpg" gradient="transparent, black">
                <v-card-title class="align-end justify-center headline fill-height">Package Treatment</v-card-title>
              </v-img>
            </v-card>
            <v-card class="mt-4" @click="goToAlaCarte">
              <v-img class="white--text" height="200px" src="/img/spa1.jpg" gradient="transparent, black">
                <v-card-title class="white--text align-end justify-center headline fill-height">Ala Carte Treatment</v-card-title>
              </v-img>
            </v-card>
          </v-container>
      </div>
    </div>
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
    data () {
      return {
        navPosition : localStorage.getItem('navPosition'),
      }
    },
    methods: {
      goToPackage(){
        window.location.href = "/package";
      },
      goToAlaCarte(){
        window.location.href = "/ala_carte";
      },
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