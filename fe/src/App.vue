<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <header>
    <div class="wrapper">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand">Laravel + Vue.js Test App</a>
        </div>
      </nav>
    </div>
  </header>

  <RouterView />
</template>
