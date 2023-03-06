<script>
export default {
    props:{
        weather: Object
    },
    data: () => ({
        
    }),
    created() {
        console.log(this.weather)
    },

    methods: {
        date(unix_timestamp){
                return new Date(unix_timestamp * 1000);
            },

            time(unix_timestamp){
                let date = this.date(unix_timestamp)

                let hours = date.getHours();
                // Minutes part from the timestamp
                let minutes = "0" + date.getMinutes();
                // Seconds part from the timestamp
                let seconds = "0" + date.getSeconds();

                // Will display time in 10:30:23 format
                let formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

                return formattedTime
            },
    }
}
</script>

<template>
    <div>
        <div class="absolute h-auto pb-10 lg:w-1/2 md:w-2/3 sm:w-full md:mx-2 sm:mx-1  lg:m-auto rounded-lg top-10 right-0 left-0 bg-white z-50">
                <span @click="$emit('close')" class="absolute cursor-pointer top-1 right-2 font-semibold rounded-full p-1 text-lg hover:text-xl">x</span>
                <div class="flex flex-wrap justify-between items-center py-10">
                    <div class="w-1/2 px-10 py-5 md:w-1/2 sm:w-full">
                        Name: 
                        {{ weather.name }}
                    </div > 
                    <div class="w-1/2 px-10 py-5 md:w-1/2 sm:w-full">
                        Email: 
                        {{ weather.email }}
                    </div>
                    <div class="w-1/2 px-10 py-5 md:w-1/2 sm:w-full">
                        Date: {{ date(weather.weather.current.dt)  }}
                    </div>
                    <div class="w-1/2 px-10 py-5 md:w-1/2 sm:w-full">
                        Time: {{ date(weather.weather.current.dt)   }}
                    </div>
                    <div class="w-1/2 px-10 py-5 md:w-1/2 sm:w-full">
                        Temperature: {{ weather.weather.current.temp}} 
                    </div>
                    <div class="w-1/2 px-10 py-5 md:w-1/2 sm:w-full">
                        Humidity: {{ weather.weather.current.humidity }} %
                    </div>
                    <div class="w-1/2 px-10 py-5 md:w-1/2 sm:w-full">
                        Latitude: {{ weather.latitude }}
                    </div>
                    <div class="w-1/2 px-10 py-5 md:w-1/2 sm:w-full">
                        Longitude: {{ weather.longitude }}
                    </div>
                </div>
            </div>
    </div>
</template>