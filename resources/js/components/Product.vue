<template>
  <div height="100%" flat>
    <div>
      <v-container>
          <v-list two-line subheader style="background-color: rgba(0,0,0,0)">
            <v-card class="my-3" flat v-for="item in items" :key="item.title" style="border-radius: 5px" @click="infoProduct(item)">
                <v-img :src="'http://admin.tangriaspa.com/' + item.image" lazy-src="https://via.placeholder.com/150"></v-img>
                <v-list-tile avatar>
                  <v-list-tile-content>
                      <v-list-tile-title v-text="item.name"></v-list-tile-title>
                      <v-list-tile-sub-title>{{ item.description }}</v-list-tile-sub-title>
                      <h6 class="font-weight-light">{{ item.price.harga }}</h6>
                  </v-list-tile-content>
                </v-list-tile>
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

    <!-- Dialog Detail -->
    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
          <v-card>
            <v-toolbar dark style="background-color: #0F978F">
              <v-btn icon dark @click="closeDialogDetail">
                <v-icon>close</v-icon>
              </v-btn>
              <v-toolbar-title>Product Detail</v-toolbar-title>
            </v-toolbar>
            <v-img :src="img_product" lazy-src="https://via.placeholder.com/150" class="grey lighten-2" max-height="300"></v-img>
            <v-container>
                <v-layout row>
                    <v-flex xs-12 class="my-2 mx-2">
                        <v-card color="white" style="border-radius: 4px;">
                            <v-card-title primary-title>
                                <div class="text-left align-center" style="width: 100% !important">
                                    <div class="body-1 font-weight-bold">Name</div>
                                    <span>{{ name }}</span>
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
                                    <div class="body-1 font-weight-bold">Description</div>
                                    <span>{{ description }}</span>
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
                                    <div class="body-1 font-weight-bold">Note</div>
                                    <span class="font-weight-bold">{{ note }}</span>
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
                                    <div class="body-1 font-weight-bold">Price</div>
                                    <span>Rp {{ price }}</span>
                                </div>
                            </v-card-title>
                        </v-card>
                    </v-flex>
                </v-layout>
                <v-btn v-if="available" round class="mx-0" style="width: 100%" @click="bookingPage">
                    Book Now
                </v-btn>
                <v-btn v-else disabled round class="mx-0" style="width: 100%">
                    Book Now
                </v-btn>
            </v-container>
          </v-card>
        </v-dialog>
      </v-layout>
    </template>

    <!-- Dialog Booking -->
    <template>
      <v-layout row justify-center>
        <v-dialog ref="dialog" v-model="dialogBooking" fullscreen hide-overlay transition="dialog-bottom-transition">
          <v-card>
            <v-toolbar dark style="background-color: #0F978F">
              <v-btn icon dark @click="dialogBooking = false">
                <v-icon>close</v-icon>
              </v-btn>
              <v-toolbar-title>Booking Date</v-toolbar-title>
            </v-toolbar>
            <v-container>
              <div class="ma-4">
                  <v-text-field v-model="date" label="Booking Date" prepend-icon="event" readonly @click="modalDate = true"></v-text-field>
                  <h5 class="font-weight-regular">Available Time</h5>
                  <v-container fluid grid-list-sm v-if="available">
                      <v-layout row wrap>
                          <v-flex xs12>
                            <v-radio-group v-model="time" row>
                              <v-radio  v-for="item in itemsTime" :key="item.index" width="100%" height="100%" :label="item.time" :value="item.time"/>
                            </v-radio-group>
                          </v-flex>
                      </v-layout>
                  </v-container>
                  <v-btn v-if="available" round block style="position: relative; bottom: 0; right: 0" @click="bookNow">Book Now</v-btn>
                  <v-btn v-else disabled round block style="position: relative; bottom: 0; right: 0">Book Now</v-btn>
                  <template>
                      <v-dialog ref="dialog" v-model="modalDate" :return-value.sync="date" persistent lazy full-width width="290px">
                          <v-date-picker v-model="date" color="teal" :min="min_date" :max="max_date" scrollable>
                              <v-spacer></v-spacer>
                              <v-btn flat style="background-color: #0F978F" dark @click="modalDate = false">Cancel</v-btn>
                              <v-btn flat style="background-color: #0F978F" dark @click="getAvailableTime(date)">OK</v-btn>
                          </v-date-picker>
                      </v-dialog>
                  </template>
              </div>
            </v-container>
          </v-card>
        </v-dialog>
      </v-layout>
    </template>

    
  </div>
</template>
<script>
  export default {
    mounted() {
      this.dialog_loading = true
      axios.get("product/" + this.category).then((response) => {
          this.items = response.data
          this.dialog_loading = false
      });
    },
    props: [
      'category'
    ],
    data () {
      return {
        dialogBooking: false,
        dialog: false,
        name: '',
        description: '',
        note: '',
        price: '',
        img_product: '',
        available: '',
        colorButton: '',
        orderId: 1,
        max_date: new Date().getFullYear() + 1 + "-" + ((new Date().getMonth() < 10) ? '0' + new Date().getMonth() : '' + new Date().getMonth) + "-" + ((new Date().getDate() < 10) ? '0' + new Date().getDate() : '' + new Date().getDate()),
        min_date: new Date().toJSON().slice(0,10).replace(/-/g,'-'),
        navPosition : localStorage.getItem('navPosition'),
        dialog_loading: false,
        items: [],
        itemsTime: [],
        time: '',
        date: new Date().toISOString().substr(0, 10),
        modalDate: false,
        available: false
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
      infoProduct(product){
        this.dialog = true
        this.name = product.name
        this.img_product = "http://admin.tangriaspa.com/" + product.image
        this.description = product.description
        this.note = product.note
        this.available = (product.available == 'true')
        this.orderId = product.id
        this.price = product.price.harga
      },
      closeDialogDetail(){
        this.dialog = false
        this.name = ''
        this.img_product = ''
        this.description = ''
        this.note = ''
        this.time = ''
        this.itemsTime = []
        this.date = new Date().toISOString().substr(0, 10),
        this.available = false
      },
      bookingPage(){
        this.dialogBooking = true
        this.available = false
      },
      getAvailableTime(date){
        this.dialog_loading = true
        this.modalDate = false
        axios.post("available-time", {
          date: this.date,
          ordername: this.name
        }).then((response) => {
          this.date = date
          this.available = true
          this.itemsTime = response.data.result_available_time
          this.time = this.itemsTime[0].time
          this.dialog_loading = false       
        });
      },
      bookNow(){
        Swal.fire({
          type: 'question',
          title: 'Confirm Bookng',
          text: 'Are you sure want to booking this service ?',
        }).then((result) => {
          if(result.value){
            this.dialog_loading = true
            axios.post("booking", {
              user_id : localStorage.getItem("user_id"),
              order : this.orderId,
              date : this.date + " " + this.time
            }).then((response) => {
              if(response.data.success == 'true'){
                this.dialogBooking = false
                this.dialog = false
                this.dialog_loading = false
                Swal.fire({
                  type: 'success',
                  title: 'Berhasil',
                  text: 'Berhasil melakukan pemesanan'
                })
              } else {
                Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!',
                  footer: '<a href>Why do I have this issue?</a>'
                })
              }
            });
          }
        });
      },
    },
  }
</script>