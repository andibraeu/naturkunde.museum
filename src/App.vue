<template>
  <div id="app">
    <Museums />
  </div>
</template>

<script>
import Museums from './components/Museums.vue'

export default {
  name: 'App',
  components: {
    Museums
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.museum-image {
  height: 50px;
}
</style>
