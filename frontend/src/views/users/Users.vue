<script>
    import modal from "@/components/modal.vue";
    export default {
        components: {modal},
        data: () => ({
            users: null,
            weather:null,
            modal: false,


        }),

        created() {
            this.fetchData()
        },

        methods: {
            async fetchData() {
                const url = 'http://localhost/'
                let data = await (await fetch(url)).json()
                this.users = data.users
                // console.log()
            },

            async fetchWeather(id) {
                const url = `http://localhost/${id}`
                let data = await (await fetch(url)).json()
                this.weather = data.user

                this.showModal();
            },

            closeModal(){
                this.modal = false
            },

            showModal(){
                this.modal = true
            },



        }


    }
</script>

<template>
    <div class="relative">
     

        
        <div class="w-full m-auto overflow-x-auto flex flex-wrap align-top justify-evenly relative">
           <modal v-if="modal" :weather="weather" :modal="modal" @close="closeModal" />
            <div v-for="(user, index) in users" :key="index" @click="fetchWeather(user.id)" class="bg-gray-900 text-white my-10 mx-5 lg:w-1/4 md:w-1/3 sm:w-full h-auto px-5 py-12 rounded-md shadow-xl cursor-pointer hover:rotate-2">
                <p class="text-xl font-semibold my-2">
                    Name: {{ user.name }}
                </p>

                <p class="text-xl font-semibold my-2">
                    Email: {{ user.email }}
                </p>

                <p class="flex justify-between text-grey-150 my-2">
                    <span>
                        Latitude: {{ user.latitude }}
                    </span>

                    <span>
                        Longitude: {{ user.longitude }}
                    </span>
                </p>

            </div>
        </div>
    </div>
  
</template>