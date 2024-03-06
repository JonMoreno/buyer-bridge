<template>
  <v-container class="fill-height">
    <v-row class="row" align="center">
      <v-col
        cols="12"
        sm="9"
        md="8"
        lg="6"
        xl="4"
        class="mx-auto"
        v-if="capsule"
        style="position: relative"
      >
        <v-icon size="80" color="amber-darken-3 popper"
          >mdi mdi-party-popper</v-icon
        >
        <v-card class="rounded-xl pa-4">
          <v-card-title class="text-h6">
            <v-icon class="mr-2" color="success">mdi-check-circle</v-icon>
            Your capsule has been opened successfully!
          </v-card-title>
          <v-card-subtitle> Title: {{ capsule.title }} </v-card-subtitle>
          <v-divider class="my-2"></v-divider>
          <v-card-text
            class="bg-green-lighten-5 rounded-xl card-text py-3 card-text"
          >
            <div class="text-medium-emphasis text-h6">
              <div class="text-subtitle-1">Message:</div>
              {{ capsule.title }}
            </div>
          </v-card-text>
          <div class="d-flex justify-space-between align-center pt-4 pl-4 pr-3">
            <div class="text-right text-overline">A blast from the past...</div>
            <small class="text-caption">Created on: {{ createdOn }}</small>
          </div>
        </v-card>
        <v-btn
          color="primary"
          @click="$router.go(-1)"
          class="mb-16 float-right mt-2 rounded-pill"
          >Back to Dashboard</v-btn
        >
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import moment from "moment";
import { mapActions, mapState } from "pinia";
import { useTimeCapsuleStore } from "@/store";

export default {
  props: {
    id: {
      type: [Number, String],
      required: true,
    },
  },

  computed: {
    ...mapState(useTimeCapsuleStore, ["capsule"]),

    createdOn() {
      return moment(this.capsule.created_at).format("MM/DD/YY h:mmA");
    },
  },

  methods: {
    ...mapActions(useTimeCapsuleStore, ["openCapsule"]),
  },

  async created() {
    await this.openCapsule(this.id);
  },
};
</script>

<style scoped>
.card-text {
  min-height: 25vh;
}

.popper {
  position: absolute;
  right: -15px;
  top: -30px;
  z-index: 1000;
}
</style>
