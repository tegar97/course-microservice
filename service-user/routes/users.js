const express = require("express");
const router = express.Router();
const userHandler = require("./handler/users/");

router.get("/", userHandler.getUsers);
router.post("/", userHandler.register);
router.post("/login", userHandler.login);
router.put("/:id", userHandler.update);
router.get("/:id", userHandler.getUser);
router.post("/logout", userHandler.logout);

module.exports = router;
