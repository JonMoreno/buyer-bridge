// ----------------------------------------------------------------------------------------
// Utils & Helper functions to share across the app
// ----------------------------------------------------------------------------------------
import axios from "axios";
import moment from "moment";

const url = (path) => `/v1/${path}`;

const csrf = async () => {
  await axios.get(url("sanctum/csrf-cookie/"), {
    headers: {
      Accept: "application/json",
      ["Content-Type"]: "application/json",
    },
  });
};

const filterTimeStamp = (filter = "present", timeStamp) => {
  const today = moment().local();
  const openAt = moment.utc(timeStamp).local();
  if (filter === "future") {
    return openAt.isAfter(today, "day");
  } else if (filter === "past") {
    return openAt.isBefore(today, "day");
  } else if (filter === "present") {
    return openAt.isSame(today, "day");
  }
};

export { csrf, url, filterTimeStamp };
