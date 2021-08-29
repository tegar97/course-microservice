var express = require("express");
const verifyToken = require("../middleware/verifyToken");
var router = express.Router();
const { APP_NAME } = process.env;
const userHandler = require("./handler/users");
/* GET users listing. */
router.post("/register", userHandler.register);
router.post("/login", userHandler.login);
router.put("/", verifyToken, userHandler.update);
router.get("/", verifyToken, userHandler.getUser);
router.post("/logout", verifyToken, userHandler.logout);

module.exports = router;
