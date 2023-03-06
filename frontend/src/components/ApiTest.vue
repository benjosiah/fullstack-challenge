<script>
export default {
  data: () => ({
    apiResponse: null
  }),

  created() {
    this.fetchData()
  },

  methods: {
    async fetchData() {
      const url = 'http://localhost/'
      this.apiResponse = await (await fetch(url)).json()
    }
  }
}
</script>

<template>
    <div>
      <div class="bg-green-400" v-if="!apiResponse">
      Pinging the api...
    </div>

    <div class="text-green-600" v-if="apiResponse">
      The api responded with: <br />
      <code>
      {{ apiResponse }}
      </code>
    </div>
  </div>
  
</template>