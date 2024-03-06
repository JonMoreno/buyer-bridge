<template>
  <v-card class="mx-4 my-2 mx-lg-10 rounded-lg px-4 pt-5 pb-3">
    <v-card-item>
      <v-card-subtitle>Title:</v-card-subtitle>
      <v-card-title class="text-medium-emphasis">{{
        item.raw.title
      }}</v-card-title>
    </v-card-item>
    <div v-cloak>
      <div class="text-caption px-4">Capsule unlocks on:</div>
      <div
        :class="`d-flex justify-space-between px-4 py-2 rounded-pill ${bgColor}`"
      >
        <div class="d-flex align-center text-body-2 text-medium-emphasis me-1">
          <v-icon icon="mdi-clock" start size="28" :color="iconColor"></v-icon>
          <div class="text-truncate">
            {{ item.raw.formattedDate }}
          </div>
        </div>
        <v-btn
          icon
          size="small"
          :disabled="!canOpen"
          :to="{ name: 'open-capsule', params: { id: item.raw.id } }"
          :color="canOpen && !item.raw.is_opened ? 'success' : ''"
        >
          <v-icon>{{
            canOpen && item.raw.is_opened
              ? "mdi mdi-lock-open-variant"
              : "mdi-lock"
          }}</v-icon>
        </v-btn>
      </div>
    </div>
  </v-card>
</template>

<script>
import moment from "moment-timezone";

export default {
  props: {
    item: {
      type: Object,
      required: true,
    },
    bgColor: {
      type: String,
      required: true,
    },
    iconColor: {
      type: String,
      required: true,
    },
    currUser: {
      type: Object,
      required: true,
    },
  },

  computed: {
    canOpen() {
      const openAt = moment.utc(this.item.raw.open_at).local();
      let now = moment().local().endOf("minute");
      return !openAt.isSameOrBefore(now)
        ? this.currUser.role === "admin"
          ? true
          : false
        : true;
    },
  },
};
</script>
