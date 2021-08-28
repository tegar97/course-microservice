const axios = require("axios");
const { timeOut } = process.env;
module.exports = (baseUrl) => {
  return axios.create({
    baseUrl: baseUrl,
    timeOut: timeOut,
  });
};
