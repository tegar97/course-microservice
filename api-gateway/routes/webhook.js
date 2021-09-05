var express = require("express");
const verifyToken = require("../middleware/verifyToken");
var router = express.Router();
const webHookHandler = require("./handler/webhook");
/* GET users listing. */
router.post("/", webHookHandler.webhook);

module.exports = router;
