<template>
  <v-app-bar
    flat
    id="app-bar"
    v-if="['not-found', 'forbidden'].includes($route.name) ? false : true"
  >
    <v-app-bar-title>
      <div class="d-flex align-center">
        <v-icon icon="mdi mdi-pill mb-1" size="40px" color="primary" />
        <div class="text-h5 font-weight-bold">Time Capsule |</div>
        <span class="text-primary">|<small>|</small></span>
      </div>
    </v-app-bar-title>
    <template v-slot:append v-if="isAuthenticated">
      <v-menu open-on-hover min-width="300">
        <template v-slot:activator="{ props }">
          <v-btn icon v-bind="props">
            <v-icon size="large">mdi-account-circle-outline</v-icon>
          </v-btn>
        </template>
        <v-list>
          <v-divider />
          <v-list-item>
            <v-list-item-title>
              {{ user?.name }}<small> ({{ user?.role }})</small>
            </v-list-item-title>
          </v-list-item>
          <v-divider />
          <v-list-item @click.prevent="onLogout">
            <v-list-item-title>Logout</v-list-item-title>
            <template v-slot:append>
              <v-icon>mdi-logout</v-icon>
            </template>
          </v-list-item>
        </v-list>
      </v-menu>
    </template>
  </v-app-bar>
</template>

<script>
import { mapState, mapActions } from "pinia";
import { useAuthStore } from "@/store";

export default {
  computed: {
    ...mapState(useAuthStore, ["isAuthenticated", "user"]),
  },
  methods: {
    ...mapActions(useAuthStore, ["logout"]),
    async onLogout() {
      await this.logout();
      window.location.href = "/login";
    },
  },
};
</script>

<style>
.rotate {
  transform: rotate(135deg);
}
</style>
