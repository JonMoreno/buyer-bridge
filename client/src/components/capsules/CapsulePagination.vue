<template>
  <div class="d-flex align-center justify-center pt-10">
    <v-btn
      :disabled="page === 1"
      icon="mdi-arrow-left"
      variant="tonal"
      rounded
      @click="prevPage"
    ></v-btn>

    <div class="mx-2 text-caption">Page {{ page }} of {{ pageCount }}</div>

    <v-btn
      :disabled="page >= pageCount"
      icon="mdi-arrow-right"
      variant="tonal"
      rounded
      @click="nextPage"
    ></v-btn>
  </div>
  <div class="text-caption text-center">Total: {{ total }}</div>
</template>

<script>
export default {
  props: {
    page: {
      type: [Number, String],
      required: true,
    },
    pageCount: {
      type: [Number, String],
      required: true,
    },
    prevPage: {
      type: Function,
      required: true,
    },
    nextPage: {
      type: Function,
      required: true,
    },
    total: {
      type: Number,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped></style>
