// Components
import App from "./App.vue";

// Composables
import { createApp } from "vue";

// Plugins
import { registerPlugins } from "@/plugins";

// Helpers
import "./config/axios";

import moment from "moment-timezone";
window.moment = moment;

const app = createApp(App);

registerPlugins(app);

app.mount("#app");
