/**
 * plugins/vuetify.js
 */

// Styles
import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles";

// Composables
import { createVuetify } from "vuetify";

// Create Vuetify instance
export default createVuetify({
  theme: {
    themes: {
      light: {
        colors: {
          primary: "#2196F3",
          secondary: "#FFC107",
          error: "#FFB300",
        },
      },
    },
  },
});
