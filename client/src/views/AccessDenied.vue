<template>
  <v-container class="fill-height">
    <v-row class="row" align="center">
      <v-col cols="12" sm="10" md="7" lg="4" class="mx-auto">
        <v-card class="not-found-card pa-16 mb-16">
          <v-card-title class="text-center text-h4">403 Forbidden</v-card-title>
          <v-card-text class="text-center text-h6 text-medium-emphasis">
            Oops! You are not allowed to access this page.
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" to="/login" block>Go Home</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {};
</script>
