<template>
  <div>
    <form @submit.prevent="shortenUrl">
      <input type="hidden" name="_token" :value="csrf">
      <input type="text" v-model="url" placeholder="Enter URL" required>
      <button type="submit">Shorten</button>
    </form>
    <div v-if="shortUrl">Short URL: <a :href="shortUrl">{{ shortUrl }}</a></div>
    <div v-if="error">{{ error }}</div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      url: '',
      shortUrl: '',
      error: '',
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    };
  },
  methods: {
    async shortenUrl() {
      this.error = '';
      this.shortUrl = '';
      try {
        const req_url = document.URL + 'shorten';
        const response = await axios.post(req_url, { url: this.url, token: this.csrf });
        this.shortUrl = response.data.short_url;
      } catch (error) {
        this.error = error.response.data.message || 'An error occurred';
      }
    }
  }
};
</script>
