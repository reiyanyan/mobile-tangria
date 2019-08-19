<template>
    <div class="ma-4">
        <v-text-field v-model="date" label="Booking Date" prepend-icon="event" readonly @click="modal = true"></v-text-field>
        <h5 class="font-weight-regular">Available Time</h5>
        <v-container fluid grid-list-sm v-if="available">
            <v-layout row wrap>
                <v-flex v-for="i in 6" :key="i" xs6>
                    <v-btn width="100%" height="100%" style="border-radius: 7px">12:00</v-btn>
                </v-flex>
            </v-layout>
        </v-container>
        <v-btn v-if="available" round block style="position: relative; bottom: 0; right: 0">Book Now</v-btn>
        <v-btn v-else disabled round block style="position: relative; bottom: 0; right: 0">Book Now</v-btn>
        <template>
            <v-dialog ref="dialog" v-model="modal" :return-value.sync="date" persistent lazy full-width width="290px">
                <v-date-picker v-model="date" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
                    <v-btn flat color="primary" @click="$refs.dialog.save(date)">OK</v-btn>
                </v-date-picker>
            </v-dialog>
        </template>
    </div>
</template>
<script>
export default {
    data() {
        return {
            date: new Date().toISOString().substr(0, 10),
            modal: false,
            available: false
        }
    },
}
</script>
