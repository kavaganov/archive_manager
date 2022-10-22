<template>
  <div class="main">
    <file-downloader></file-downloader>
  </div>
</template>

<script>
import FileDownloader from '@/components/file-downloader/file-downloader'
export default {
  name: 'main-page',
  components: {
    FileDownloader
  }
}
</script>
