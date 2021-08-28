"use strict";
const bcrypt = require("bcrypt");
module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.bulkInsert(
      "users",
      [
        {
          name: "Tegar",
          profession: "Admin Micro",
          role: "admin",
          email: "tegar@gmail.com",
          password: await bcrypt.hash("tegar123", 10),
          created_at: new Date(),
          updated_at: new Date(),
        },
        {
          name: "Akmal",
          profession: "Backend Developer ",
          role: "student",
          email: "akmal@gmail.com",
          password: await bcrypt.hash("tegar123", 10),
          created_at: new Date(),
          updated_at: new Date(),
        },
      ],
      {}
    );
  },

  down: async (queryInterface, Sequelize) => {
    await queryInterface.bulkDelete("users", null, {});
  },
};
