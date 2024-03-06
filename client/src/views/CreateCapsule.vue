<template>
  <v-container class="fill-height">
    <v-row class="row" align="center">
      <v-col cols="12" sm="10" md="8" lg="7" xl="5" class="mx-auto">
        <v-card class="rounded-xl py-4 px-2 card" :loading="processing">
          <v-card-title class="text-h5">Create Capsule</v-card-title>
          <v-divider class="mt-2"></v-divider>
          <v-card-text>
            <v-form @submit.prevent>
              <v-divider class="my-0"></v-divider>
              <div class="text-subtitle-2 py-2 px-2 bg-blue-lighten-5">
                Set the title and message for the capsule
              </div>
              <v-divider class="mt-0 mb-2"></v-divider>
              <v-text-field
                v-model="form.values.title"
                label="Title"
                :rules="[(v) => !!v || 'Title is required']"
                prepend-inner-icon="mdi-format-title"
                placeholder="Title for the capsule"
                class="mb-3"
                :error-messages="form.errors.title"
              ></v-text-field>
              <v-textarea
                v-model="form.values.message"
                label="Message"
                placeholder="Write a message for the future"
                :rules="[(v) => !!v || 'Message is required']"
                prepend-inner-icon="mdi-message"
                class="mb-3"
                :error-messages="form.errors.message"
              ></v-textarea>
              <v-divider class="mt-3 mb-0"></v-divider>
              <div class="text-subtitle-2 py-2 px-2 bg-blue-lighten-5">
                Set the open date and time for the capsule
              </div>
              <v-divider class="mt-0 mb-2"></v-divider>
              <v-text-field
                label="Open At Date"
                type="date"
                v-model="form.values.openAtDate"
                :rules="[(v) => !!v || 'Date is required']"
                placeholder="Set a date to open the capsule"
                class="mb-3"
                :error-messages="form.errors.openAtDate"
              ></v-text-field>
              <v-text-field
                label="Open At Time"
                placeholder="Set a time to open the capsule"
                type="time"
                :rules="[(v) => !!v || 'Time is required']"
                class="mb-3"
                v-model="form.values.openAtTime"
                :error-messages="form.errors.openAtTime"
              ></v-text-field>

              <div class="text-center mt-2">
                <v-btn
                  color="secondary"
                  @click="submitForm"
                  size="large"
                  class="rounded-pill"
                  @mouseenter="lock = true"
                  @mouseleave="lock = false"
                  :loading="processing"
                >
                  Save
                  <v-icon right class="ml-1 mb-1">{{
                    !lock ? "mdi mdi-lock-open-variant" : "mdi mdi-lock"
                  }}</v-icon>
                </v-btn>
              </div>
            </v-form>
          </v-card-text>
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
import { useTimeCapsuleStore } from "@/store";
import moment from "moment-timezone";
import { mapActions } from "pinia";

export default {
  data: () => ({
    lock: false,
    processing: true,
    form: {
      values: {
        title: "",
        message: "",
        openAtDate: "",
        openAtTime: "",
      },
      errors: {
        title: "",
        message: "",
        openAtDate: "",
        openAtTime: "",
      },
    },
  }),

  methods: {
    ...mapActions(useTimeCapsuleStore, ["createCapsule"]),

    async submitForm() {
      this.processing = true;
      this.clearValidation();

      const form = { ...this.form.values };
      const { openAtDate, openAtTime } = form;
      if (openAtDate && openAtTime) {
        const timeStamp = `${openAtDate} ${openAtTime}`;
        form.openAtDate = moment(timeStamp).tz("UTC").format("YYYY-MM-DD");
        form.openAtTime = moment(timeStamp).tz("UTC").format("HH:mm");
      }
      await this.createCapsule(form)
        .then(() => {
          this.$router.push({
            name: "dashboard",
            query: { orderby: "present" },
          });
        })
        .catch(({ response }) => {
          this.processing = false;
          this.handleValidation(response.data);
        });
    },

    clearValidation() {
      for (const key in this.form.errors) {
        this.form.errors[key] = null;
      }
    },

    handleValidation(response) {
      const errors = response?.errors ?? [];
      for (const key in errors) {
        this.form.errors[key] = errors[key][0];
      }
      this.processing = false;
    },
  },

  mounted() {
    this.processing = false;
  },
};
</script>

<style scoped>
.row {
  height: 80vh;
}

.pill {
  border-radius: 180px;
  padding: 20% 10%;
}

.card {
  min-height: 40vh;
}
</style>
