<template>
  <div class="file-downloader">
    <a href="#"
       @click.prevent="onDownload"
       v-if="id === null"
    >
      Скачать файлы
    </a>
    <div class="file-downloader" v-else>
      {{ percentage }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'file-downloader',
  data () {
    return {
      id: null,
      percentage: 0
    }
  },
  methods: {
    async onDownload () {
      const id = await this.axios.get('/backend/')
      const connection = new WebSocket('/api/')
      connection.onmessage = function (event) {
        console.log(event)
      }

      connection.onopen = function (event) {
        console.log(event)
        console.log('Successfully connected to the echo websocket server...')
      }

      connection.send({ id })
    }
  }
}
</script>

<style scoped>

</style>
