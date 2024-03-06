// -----------------------------------------------------------------------
// Store configuration
// -----------------------------------------------------------------------
import { csrf, url, filterTimeStamp } from "@/lib/utils";
import { defineStore } from "pinia";
import moment from "moment-timezone";
import axios from "axios";

// User store module
export const useAuthStore = defineStore({
  id: "auth",
  state: () => ({
    user: null,
  }),
  getters: {
    isAuthenticated: (state) => !!state.user,
  },
  actions: {
    async register(form) {
      await csrf();
      const res = await axios.post(url("/api/register"), form);
      return res;
    },

    async login(form) {
      await csrf();
      const res = await axios.post(url("/api/login"), form);
      return res;
    },

    async authenticate() {
      try {
        const res = await axios.get(url("api/user"));
        this.user = res.data ?? null;
      } catch (error) {
        this.user = null;
      }
    },

    async logout() {
      await csrf();
      await axios.post(url("api/logout"));
    },
  },
});

// Time capsule store module
export const useTimeCapsuleStore = defineStore({
  id: "timeCapsule",
  state: () => ({
    search: "",
    tab: "present",
    timeCapsules: [],
    capsule: null,
    processing: false,
    filters: ["future", "present", "past"],
  }),

  getters: {
    filteredCapsules: (state) => {
      const filter = state.tab;
      const capsules = state.timeCapsules;
      return capsules
        .filter((timeCapsule) => filterTimeStamp(filter, timeCapsule.open_at))
        .sort((a, b) => moment(b.open_at) - moment(a.open_at));
    },
  },
  actions: {
    async getCapsules() {
      this.processing = true;
      const res = await axios.get(url("api/capsules"));
      this.timeCapsules = res.data.map((i) => ({
        ...i,
        formattedDate: moment.utc(i.open_at).local().format("MM/DD/YY h:mmA"),
      }));
      this.processing = false;
    },

    async createCapsule(form) {
      const res = await axios.post(url("api/capsules"), form);
      return res;
    },

    async openCapsule(id) {
      const res = await axios.get(url(`api/capsules/${id}`));
      this.capsule = res.data;
      return res;
    },
  },
});
