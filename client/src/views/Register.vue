<template>
  <v-container class="fill-height">
    <v-row>
      <v-col cols="11" sm="7" md="6" lg="5" xl="3" class="mx-auto">
        <v-card elevation="5" class="rounded-xl py-7 px-6">
          <v-card-title class="text-h5">Register</v-card-title>
          <v-card-text>
            <v-form validate-on="submit lazy" @submit.prevent>
              <v-text-field
                label="Name"
                prepend-icon="mdi-account"
                type="text"
                v-model="form.values.name"
                :error-messages="form.errors.name"
              ></v-text-field>
              <v-text-field
                label="Email"
                prepend-icon="mdi-email"
                type="email"
                v-model="form.values.email"
                :error-messages="form.errors.email"
              ></v-text-field>
              <v-text-field
                label="Password"
                prepend-icon="mdi-lock"
                v-model="form.values.password"
                :error-messages="form.errors.password"
                :type="passwordVisible ? 'text' : 'password'"
                :append-inner-icon="passwordVisible ? 'mdi-eye' : 'mdi-eye-off'"
                @click:appendInner="passwordVisible = !passwordVisible"
              ></v-text-field>
              <v-text-field
                label="Confirm Password"
                prepend-icon="mdi-lock"
                counter
                v-model="form.values.confirmPassword"
                :type="passwordVisible ? 'text' : 'password'"
                :error-messages="form.errors.confirmPassword"
                :append-inner-icon="passwordVisible ? 'mdi-eye' : 'mdi-eye-off'"
                @click:appendInner="passwordVisible = !passwordVisible"
              ></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions class="px-4 d-flex flex-column">
            <v-btn
              color="primary"
              variant="tonal"
              block
              @click="submitForm"
              :loading="processing"
            >
              Register</v-btn
            >
            <router-link
              :to="{ name: 'login' }"
              class="mt-2 text-grey-darken-2 font-weight-bold text-decoration-none"
              >or, login</router-link
            >
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { useAuthStore } from "@/store";
import { mapActions } from "pinia";

export default {
  data: () => ({
    form: {
      values: {
        name: "",
        email: "",
        password: "",
        confirmPassword: "",
      },
      errors: {
        name: "",
        email: "",
        password: "",
        confirmPassword: "",
      },
    },
    processing: false,
    passwordVisible: false,
  }),

  methods: {
    ...mapActions(useAuthStore, ["register", "authenticate"]),

    async submitForm() {
      this.processing = true;
      this.clearValidation();
      await this.register(this.form.values)
        .then(() => {
          this.authenticate();
          this.processing = false;
          this.$router.push({
            name: "dashboard",
            query: { orderby: "present" },
          });
        })
        .catch(({ response }) => {
          const errors = response?.data?.errors ?? [];
          for (const key in errors) {
            this.form.errors[key] = errors[key][0];
          }
          this.processing = false;
        });
    },

    clearValidation() {
      for (const key in this.form.errors) {
        this.form.errors[key] = null;
      }
    },
  },
};
</script>
