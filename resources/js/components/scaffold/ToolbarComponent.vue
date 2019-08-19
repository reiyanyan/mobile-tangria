<template>
    <div>
        <v-toolbar app fixed clipped-left dense dark style="background-color: #0F978F">
            <v-toolbar-title>Tangria Spa</v-toolbar-title>
            <!-- <v-spacer></v-spacer>
            <div>
                <v-btn flat @click="logout">Keluar</v-btn>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    <input type="hidden" name="_token" :value="token">
                </form>
            </div> -->
        </v-toolbar>
    </div>
</template>
<script>
export default {
    computed: {
        token() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            return token.content
        }
    },
    methods: {
        logout() {
            document.getElementById('logout-form').submit()
        },
    }
}
</script>