require("dotenv").config();

const { DB_USERNAME, DB_NAME, DB_PASSWORD, DB_HOSTNAME, DB_CONNECTION } =
  process.env;

module.exports = {
  development: {
    username: DB_USERNAME,
    password: "",
    database: DB_NAME,
    host: DB_HOSTNAME,
    dialect: "mysql",
  },
  test: {
    username: DB_USERNAME,
    password: "",
    database: DB_NAME,
    host: DB_HOSTNAME,
    dialect: "mysql",
  },
  production: {
    username: DB_USERNAME,
    password: "",
    database: DB_NAME,
    host: DB_HOSTNAME,
    dialect: "mysql",
  },
};
