<template>
  <div id="app">
    <div class="app-container">
      <Museums />
    </div>
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
  margin-top: 60px;
}
body{
margin: 0;
height: 100%;
overflow-x: hidden;
overflow-y: auto;
background-color: var(--surface-b);
font-family: var(--font-family);
font-weight: 400;
color: var(--text-color);
}
.museum-image {
  height: 50px;
}
button.contacts {
  margin-right: 10px;
}
a.contact-items, a.contact-items:visited {
  text-decoration: none;
}
span.pi {
  font-size: 1.2rem;
}
</style>
