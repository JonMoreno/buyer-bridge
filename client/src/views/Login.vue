<template>
  <v-container class="fill-height">
    <v-row class="row" align="center">
      <v-col cols="11" sm="7" md="6" lg="5" xl="3" class="mx-auto">
        <v-card elevation="5" class="rounded-xl pt-9 pb-10 px-6">
          <v-card-title class="text-h5">Login</v-card-title>
          <v-card-text class="pt-2 pb-5">
            <v-form validate-on="submit lazy" @submit.prevent>
              <v-text-field
                label="Email"
                prepend-icon="mdi-email"
                type="email"
                v-model="form.values.email"
                :error-messages="form.errors.email"
                class="mb-3"
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
            </v-form>
          </v-card-text>
          <v-card-actions class="px-4 d-flex flex-column">
            <v-btn
              color="primary"
              variant="tonal"
              block
              @click="submitForm"
              :loading="processing"
              >Login</v-btn
            >
            <router-link
              to="register"
              class="mt-2 text-grey-darken-2 font-weight-bold text-decoration-none"
              >or, register</router-link
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
        email: "",
        password: "",
      },
      errors: {
        email: "",
        password: "",
      },
      passwordVisible: false,
    },
    processing: false,
    passwordVisible: false,
  }),

  methods: {
    ...mapActions(useAuthStore, ["login", "authenticate", "logout"]),

    async submitForm() {
      this.processing = true;
      this.clearValidation();

      await this.login(this.form.values)
        .then(() => {
          this.processing = false;
          this.$router.push({
            name: "dashboard",
            query: { orderby: "present" },
          });
        })
        .catch(({ response }) => this.handleValidation(response.data));
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
};
</script>

<style scoped>
.row {
  height: 80vh;
}
</style>
