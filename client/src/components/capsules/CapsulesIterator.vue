<template>
  <v-card color="transparent" flat>
    <v-data-iterator
      :items="items"
      :items-per-page="10"
      :search="search"
      :loading="processing"
    >
      <template v-slot:default="{ items }">
        <v-container class="pa-2" fluid style="min-height: 40vh">
          <v-row dense>
            <v-col
              v-for="item in items"
              :key="item.id"
              cols="10"
              sm="6"
              md="4"
              xl="3"
            >
              <CapsuleItem
                v-if="item"
                :item="item"
                :bg-color="bgColor"
                :icon-color="iconColor"
                :curr-user="currUser"
              />
            </v-col>
          </v-row>
        </v-container>
      </template>
      <template v-slot:no-data>
        <NoDataFeedback :loading="processing" />
      </template>
      <template v-slot:footer="{ page, pageCount, prevPage, nextPage }">
        <CapsulePagination
          :page="page"
          :pageCount="pageCount"
          :prevPage="prevPage"
          :nextPage="nextPage"
          :total="items.length"
        />
      </template>
    </v-data-iterator>
  </v-card>
</template>

<script>
import CapsuleItem from "@/components/capsules/CapsuleItem";
import NoDataFeedback from "@/components/base/NoDataFeedback";
import CapsulePagination from "@/components/capsules/CapsulePagination";

export default {
  components: {
    CapsuleItem,
    NoDataFeedback,
    CapsulePagination,
  },

  props: {
    items: {
      type: Array,
      required: true,
    },
    search: {
      type: [String, null],
      required: true,
    },
    processing: {
      type: Boolean,
      required: true,
    },
    currFilter: {
      type: String,
    },
    currUser: {
      type: Object,
      required: true,
    },
  },

  computed: {
    bgColor() {
      const key = this.currFilter ?? "";
      const bgColors = {
        present: "bg-blue-lighten-5",
        future: "bg-red-lighten-5",
        past: "bg-grey-lighten-2",
      };

      return bgColors?.[key] ?? "";
    },

    iconColor() {
      const key = this.currFilter ?? "";
      const bgColors = {
        present: "blue",
        future: "red-lighten-1",
        past: "grey-darken-2",
      };

      return bgColors?.[key] ?? "";
    },
  },
};
</script>

<style lang="scss" scoped></style>
