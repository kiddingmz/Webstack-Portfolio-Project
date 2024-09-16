<template>
  <div id="app">
  <router-view/>
  </div>
</template>

<style>
* {
  font-family: system-ui, -apple-system, "Segoe UI",
  Roboto, "Helvetica Neue", Arial, "Noto Sans",
  "Liberation Sans", sans-serif,
  "Apple Color Emoji", "Segoe UI Emoji",
  "Segoe UI Symbol", "Noto Color Emoji";
}
body {
  //background: #f0f0f0;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a{
  font-weight: bold;
  color: #2c3e50;
}

.router-link-exact-active {
  color: #42b983;
}

</style>
