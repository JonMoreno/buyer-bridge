<template>
  <v-container fluid>
    <v-row class="fill-height py-5">
      <!-- Actions -->
      <v-col cols="12" class="px-8 d-flex justify-space-between align-center">
        <v-text-field
          v-model="search"
          placeholder="Search"
          prepend-inner-icon="mdi-magnify"
          style="max-width: 360px"
          variant="outlined"
          clearable
          hide-details
          bg-color="white"
          class="ml-lg-5"
          rounded
        ></v-text-field>
        <v-btn color="primary" size="large" :to="{ name: 'create-capsule' }">
          Create Capsule
        </v-btn>
      </v-col>
      <!-- Filters -->
      <v-col class="pt-3 pb-2 px-8" cols="12">
        <v-divider class="mb-1"></v-divider>
        <v-tabs
          :height="45"
          v-model="tab"
          fixed-tabs
          v-if="!processing"
          :selected-class="getSelectedClass(tab)"
        >
          <v-tab
            :to="{ name: 'dashboard', query: { orderby: filter } }"
            class="text-subtitle-1 text-capitalize"
            @click="handleTransition"
            v-for="filter in filters"
            :value="filter"
            :key="filter"
            >{{ filter }}</v-tab
          >
        </v-tabs>
        <v-divider class="mt-1"></v-divider>
      </v-col>
      <!-- Items -->
      <v-col cols="12">
        <CapsulesIterator
          :curr-user="user"
          :curr-filter="tab"
          :search="search"
          :processing="inTransition ? true : processing"
          :items="inTransition ? [] : filteredCapsules"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { useTimeCapsuleStore, useAuthStore } from "@/store";
import { mapState, mapActions, mapWritableState } from "pinia";
import CapsulesIterator from "@/components/capsules/CapsulesIterator";

export default {
  components: {
    CapsulesIterator,
  },

  data: () => ({
    inTransition: false,
  }),

  watch: {
    search(value) {
      const search = value ?? undefined;
      this.$router.replace({
        query: { ...this.$route.query, search },
      });
    },

    tab(value) {
      const orderby = value ?? undefined;
      this.$router.replace({
        query: { ...this.$route.query, orderby },
      });
    },
  },

  computed: {
    ...mapWritableState(useTimeCapsuleStore, ["search", "tab"]),
    ...mapState(useAuthStore, ["user"]),
    ...mapState(useTimeCapsuleStore, [
      "filteredCapsules",
      "filters",
      "processing",
    ]),
  },

  methods: {
    ...mapActions(useTimeCapsuleStore, ["getCapsules"]),

    getSelectedClass(tab) {
      const selectedTabClass = {
        present: "bg-blue-lighten-1 text-white rounded",
        future: "bg-red-lighten-1 text-white rounded",
        past: "bg-grey-darken-1 text-white rounded",
      };
      return selectedTabClass[tab];
    },

    handleTransition() {
      this.inTransition = true;
      setTimeout(() => (this.inTransition = false), 400);
    },
  },

  async created() {
    await this.getCapsules();
    this.search = this.$route.query.search ?? "";
    this.tab = this.$route.query.orderby ?? "present";
  },
};
</script>

<style lang="scss" scoped></style>
