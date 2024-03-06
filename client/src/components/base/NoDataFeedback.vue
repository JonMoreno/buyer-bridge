<template>
  <v-row style="min-height: 50vh">
    <v-col cols="12" sm="6" class="d-flex align-center justify-center mx-auto">
      <div v-if="loading" class="text-center">
        <v-progress-circular
          indeterminate
          color="primary"
          size="120"
        ></v-progress-circular>
        <p class="text-center text-h6 text-grey-darken-4 mt-2">
          Loading records...
        </p>
      </div>
      <div class="text-center" v-else>
        <v-icon size="100" color="grey-darken-3"
          >mdi mdi-information-outline</v-icon
        >
        <p class="text-center text-h6 text-grey-darken-4 mt-2">
          Not results found...
        </p>
      </div>
    </v-col>
  </v-row>
</template>

<script>
export default {
  props: {
    loading: {
      type: Boolean,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped></style>
