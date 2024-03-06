// -----------------------------------------------------------------------
// Axios configuration
// -----------------------------------------------------------------------
import axios from "axios";

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common["Content-Type"] = "application/json";
window.axios.defaults.headers.common["Accept"] = "application/json";
window.axios.defaults.withCredentials = true;
window.axios.defaults.withXSRFToken = true;

// Response interceptor catch [401,403] and redirect.
window.axios.interceptors.response.use(
  (response) => response,
  (error) => {
    if (
      error.response &&
      error.response.status === 401 &&
      window.location.pathname !== "/login"
    ) {
      window.location.href = "/login";
    }

    if (error.response && error.response.status === 403) {
      window.location.href = "/forbidden";
    }

    if (error.response && error.response.status === 404) {
      window.location.href = "/not-found";
    }
    return Promise.reject(error);
  }
);
