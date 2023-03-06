<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <div class=" ">
    <header class="w-full bg-black px-5 py-10 flex lg:justify-start">
    
      <div class="text-white text-3xl font-bold">
        <nav>
          <RouterLink to="/">Weather App</RouterLink>
        </nav>
      </div>
    </header>

  <router-view/>
</div>
</template>

<style>
  body{
    background: rgba(11, 2, 64, 0.266);
  }
</style>
