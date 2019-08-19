<template>
  <div height="100%" flat>
    <div>
      <v-container>
          <v-layout row class="my-2">
              <v-flex xs-12 class="mx-2">
                  <v-card color="teal lighten-2" dark style="border-radius: 7px;">
                      <v-card-title primary-title>
                          <div class="text-center align-center" style="width: 100% !important">
                              <v-avatar size="90px" color="grey lighten-4">
                                  <img :src="img_profile" alt="avatar">
                              </v-avatar>
                              <div class="headline">{{ name }}</div>
                              <span>{{ email }}</span>
                          </div>
                      </v-card-title>
                  </v-card>
              </v-flex>
          </v-layout>
          <v-layout row>
              <v-flex xs-12 class="my-2 mx-2">
                  <v-card color="white" style="border-radius: 4px;">
                      <v-card-title primary-title>
                          <div class="text-left align-center" style="width: 100% !important">
                              <div class="body-1 font-weight-bold">No Telephone</div>
                              <span>{{ telp }}</span>
                          </div>
                      </v-card-title>
                  </v-card>
              </v-flex>
          </v-layout>
          <v-layout row>
              <v-flex xs-12 class="my-2 mx-2">
                  <v-card color="white" style="border-radius: 4px;" @click="openBookingHistory">
                      <v-card-title primary-title>
                          <div class="text-center justify-center" style="width: 100% !important">
                              <div class="body-1 font-weight-bold">Booking History</div>
                          </div>
                      </v-card-title>
                  </v-card>
              </v-flex>
          </v-layout>
          <v-layout row>
              <v-flex xs-12 class="my-2 mx-2">
                  <v-card color="white" style="border-radius: 4px;" @click="keluar">
                      <v-card-title primary-title>
                          <div class="text-start justify-start" style="width: 100% !important">
                              <div class="body-1 font-weight-bold">Keluar</div>
                          </div>
                      </v-card-title>
                  </v-card>
              </v-flex>
          </v-layout>
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

    <!-- Dialog Detail -->
    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
          <v-card>
            <v-toolbar dark color="teal">
              <v-btn icon dark @click="dialog = false">
                <v-icon>close</v-icon>
              </v-btn>
              <v-toolbar-title>Booking History</v-toolbar-title>
            </v-toolbar>
            <v-container>
              <v-list two-line style="background-color: rgba(0,0,0,0);">
                <v-card class="my-2" v-for="item in items" :key="item.title" style="border-radius: 5px" @click="openDetailBooking(item)">
                  <v-card-title>
                    <v-list-tile avatar>
                      <v-list-tile-action>
                          <v-icon color="teal">info</v-icon>
                      </v-list-tile-action>
                      <v-list-tile-content>
                          <v-list-tile-title style="white-space: pre;">{{ item.order }}</v-list-tile-title>
                          <v-list-tile-sub-title style="white-space: pre;">{{ item.date }}</v-list-tile-sub-title>
                      </v-list-tile-content>
                    </v-list-tile>
                  </v-card-title>
                </v-card>
              </v-list>
            </v-container>
          </v-card>
        </v-dialog>
      </v-layout>
    </template>

    <!-- Modal Detail Booking -->
    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialogDetail" max-width="600">
          <v-card>
            <v-card-text>
              <h4 class="font-weight-regular">Name Product :</h4>
              <h6 class="font-weight-light">{{ name_product }}</h6>
              <h4 class="font-weight-regular">Description :</h4>
              <h6 class="font-weight-light">{{ description }}</h6>
              <h4 class="font-weight-regular">Status :</h4>
              <h6 class="font-weight-bold">{{ status.toUpperCase() }}</h6>
              <h4 class="font-weight-regular text-center">Kode Booking</h4>
              <h6 class="font-weight-bold text-center" v-if="code != null">
                <qrcode-vue :value="code" :size="size" level="H"></qrcode-vue>
                <br>
                {{ code }}
              </h6>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="green darken-1" flat="flat" @click="closeDetailDialog">Close</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-layout>
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
  import QrcodeVue from 'qrcode.vue';

  export default {
    mounted() {
      this.dialog_loading = true
      axios.post("profile", {
        id: localStorage.getItem('user_id')
      }).then((response) => {
        this.name = response.data.name
        this.email = response.data.email
        this.img_profile = response.data.avatar
        this.telp = response.data.no_hp
        this.dialog_loading = false
      });
    },
    data () {
      return {
        img_profile: '',
        name: '',
        email: '',
        telp: '',
        dialogDetail: false,
        items: [],
        dialog: false,
        status: '',
        size: 300,
        name_product: '',
        description: '',
        dialog_loading: false,
        code: '',
        navPosition : localStorage.getItem('navPosition'),
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
      openBookingHistory(){
        this.dialog = true
        this.dialog_loading = true
        axios.post("booking_history", {
          user_id: localStorage.getItem('user_id')
        }).then((response) => {
          this.dialog_loading = false
          this.items = response.data.result_booking_history
        });
      },
      openDetailBooking(item){
        this.dialogDetail = true
        this.name_product = item.order
        this.description = item.order_desc
        this.status = item.status
        this.name_product = item.order
        this.code = item.code
      },
      closeDetailDialog(){
          this.dialogDetail = false
          this.name_product = ''
          this.description = ''
          this.status = ''
          this.name_product = ''
          this.code = ''
      },
      keluar(){
        this.$root.guest = localStorage.setItem('guest', true)
        window.location.href = "login"
      }
    },
    components: {
      QrcodeVue
    }
  }
</script>