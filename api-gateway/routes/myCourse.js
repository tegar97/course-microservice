const express = require("express");
const myCourseHandler = require("./handler/my-courses");
const router = express.Router();
/* GET users listing. */
router.post("/", myCourseHandler.create);
router.get("/", myCourseHandler.get);

module.exports = router;
