<template>
  <v-app class="bg-blue-grey-lighten-4">
    <default-bar />
    <!--Render main content -->
    <default-view />
  </v-app>
</template>

<script setup>
import DefaultBar from "./AppBar.vue";
import DefaultView from "./View.vue";
</script>
