<template>
  <v-app id="app" style="height:100vh; background-color: #8c7ae6">
    <v-layout align-center fill-height justify-center>
      <v-flex xs12>
        <v-carousel v-model="model" :show-arrows="false" :hide-delimiters="true" :cycle="false" style="height:100%; box-shadow: none">
          <v-carousel-item v-for="(color, i) in colors" :key="color">
            <v-sheet height="100%" tile style="background-color: #8c7ae6">
              <v-layout align-center fill-height justify-center text-xs-center>
                <div v-if="i == 0">
                  <h1>Intro 1</h1>
                    <img src="img/login_title.png" class="my-4" height="100" width="200" alt="avatar">
                  <h4 class="font-weight-light">Deskripsi</h4>
                </div>
                <div v-if="i == 1">
                  <h1>Intro 2</h1>
                  <v-avatar size="150" color="grey lighten-4">
                    <img src="https://vuetifyjs.com/apple-touch-icon-180x180.png" alt="avatar">
                  </v-avatar>
                </div>
                <div v-if="i == 2">
                    <h1 class="mx-4">Intro 3</h1>
                </div>
              </v-layout>
            </v-sheet>
          </v-carousel-item>
        </v-carousel>
      </v-flex>
    </v-layout>
  </v-app>
</template>

<script>
  export default {
    mounted() {
      console.log("mounted")
    },
    data () {
      return {
        colors: [
          'primary',
          'secondary',
          'yellow darken-2',
        ],
        model: 0,
      }
    },
  }
</script>